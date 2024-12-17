<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use App\Models\AnswerResults;
use App\Models\Question;
use App\Models\User;
use App\Models\SmallLabel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;

class MasterController extends Controller
{
    public function __invoke(Request $request)
    {
        // 現在認証しているユーザーのIDを取得
        $id = auth()->id();

        // 最新のレコードを取得
        $latestRank = Rank::orderBy('time', 'desc')->first(['*', 'created_at']);
        $newTime = $latestRank ? $latestRank->time + 1 : 1;

        // $newTimeが1(新規登録)ならAnswerResults::all()を走らせる
        if ($newTime == 1) {
            $latestAnswerResults = AnswerResults::all();
        } else {
            // $newTimeが1(新規登録)以外なら前回と今回の間のAnswerResultsを集計する
            $latestAnswerResults = AnswerResults::where('created_at', '>', $latestRank->created_at)->get();
        }

        // ユーザーごとにデータをフラット化して処理
        $results = $latestAnswerResults->groupBy('user_id')->map(function ($userResults) {
            return $userResults->map(function ($answerResult) {
                $question = Question::find($answerResult->question_id);
                $isCorrect = $answerResult->answered_question_id == $question->id;
                $timeDiffMilliseconds = Carbon::parse($answerResult->created_at)->diffInMilliseconds(Carbon::parse($answerResult->start_solving_time)); // ミリ秒単位で取得
                $timeDiff = $timeDiffMilliseconds / 1000; // 秒単位に変換

                return [
                    'small_label_id' => $question->small_label_id,
                    'is_correct' => $isCorrect,
                    'time_diff' => $timeDiff
                ];
            });
        });

        // ユーザーごとに small_label_id 毎の集計を行う
        $summary = $results->map(function ($userResults) {
            return $userResults->groupBy('small_label_id')->map(function ($group) {
                $totalCorrect = $group->where('is_correct', true)->count();
                $totalQuestions = $group->count();
                $totalTimeDiff = $group->sum('time_diff');
                $averageTime = $totalQuestions > 0 ? $totalTimeDiff / $totalQuestions : 0;
                $accuracy = $totalQuestions > 0 ? $totalCorrect / $totalQuestions * 100 : 0;

                // 条件に合わない場合は null を返す
                if ($totalQuestions < 10) { // 条件を10問以上に変更
                    return null;
                }

                return [
                    'correct' => $totalCorrect,
                    'incorrect' => $totalQuestions - $totalCorrect,
                    'total' => $totalQuestions,
                    'accuracy' => number_format($accuracy, 1),
                    'average_time' => number_format($averageTime, 2)
                ];
            })->filter(); // null の結果をフィルタリング
        });

        // small_label_id の昇順に並べ替え
        $sortedSummary = $summary->map(function ($userSummary) {
            return $userSummary->sortKeys();
        });

        // small_label_idごとのデータを取得
        $smallLabelSummary = [];

        foreach ($sortedSummary as $userId => $userSummary) {
            foreach ($userSummary as $smallLabelId => $data) {
                if (!isset($smallLabelSummary[$smallLabelId])) {
                    $smallLabelSummary[$smallLabelId] = [];
                }
                $smallLabelSummary[$smallLabelId][$userId] = $data;
            }
        }

        // $smallLabelSummaryをsmall_label_idの昇順に並べる
        ksort($smallLabelSummary);

        // 各ユーザーの結果をユーザーIDの昇順に並べる
        foreach ($smallLabelSummary as $smallLabelId => $userResults) {
            ksort($userResults);
        }

        // accuracyの降順、同じaccuracyならaverage_timeの昇順に並べ替える関数
        function sortResults($results)
        {
            uasort($results, function ($a, $b) {
                if ($a['accuracy'] == $b['accuracy']) {
                    return $a['average_time'] <=> $b['average_time'];
                }
                return $b['accuracy'] <=> $a['accuracy'];
            });
            return $results;
        }

        // 各small_label_idごとに並べ替える
        foreach ($smallLabelSummary as $smallLabelId => $userResults) {
            $smallLabelSummary[$smallLabelId] = sortResults($userResults);
        }

        // ユーザー情報を取得
        $users = User::pluck('name', 'id');

        // small_labelsテーブルの情報を取得
        $smallLabels = SmallLabel::pluck('small_label', 'id');

        // 各ユーザーごとに順位を追加し、名前とsmall_labelを含める
        foreach ($smallLabelSummary as $smallLabelId => $userResults) {
            $rank = 1;
            foreach ($userResults as $userId => $data) {
                $smallLabelSummary[$smallLabelId][$userId]['rank'] = $rank;
                $smallLabelSummary[$smallLabelId][$userId]['user_id'] = $userId;  // user_idを追加
                $smallLabelSummary[$smallLabelId][$userId]['user_name'] = $users[$userId];
                $smallLabelSummary[$smallLabelId][$userId]['small_label_id'] = $smallLabelId;
                $smallLabelSummary[$smallLabelId][$userId]['small_label'] = $smallLabels[$smallLabelId];
                $rank++;
            }
        }

        // smallLabelSummaryをranksテーブルに新しいレコードとして保存
        foreach ($smallLabelSummary as $smallLabelId => $userResults) {
            foreach ($userResults as $userId => $data) {
                Rank::create([
                    'small_label_id' => $smallLabelId,
                    'small_label' => $data['small_label'],
                    'rank' => $data['rank'],
                    'user_id' => $userId,
                    'name' => $data['user_name'],
                    'accuracy' => $data['accuracy'],
                    'correct' => $data['correct'],
                    'incorrect' => $data['incorrect'],
                    'total' => $data['total'],
                    'average_time' => $data['average_time'],
                    'time' => $newTime // 全体のループで同じtimeを設定
                ]);
            }
        }

        // 点数の計算ロジック
        $rankPoints = [
            1 => 6,
            2 => 4,
            3 => 3,
            4 => 2,
            5 => 1,
        ];

        // 最新のtimeカラムの値を取得
        $latestTime = Rank::max('time');

        // 最新のtimeカラムに基づいてレコードを取得
        $latestRanks = Rank::where('time', $latestTime)->get();

        // ユーザー別にsmall_label_idの数を集計する
        $userSmallLabelCounts = $latestRanks->groupBy('user_id')->map(function ($ranks) {
            return $ranks->pluck('small_label_id')->unique()->count();
        });

        // $newTimeが1(新規登録)ならprevious関連の計算をスキップ
        if ($newTime == 1) {
            $previousUserSmallLabelCounts = collect(); // 空のコレクションを作成しておく
            $previousRanks = collect();
        } else {
            // 最新のtimeカラムの前の値を取得
            $previousTime = Rank::where('time', '<', $latestTime)->max('time');

            // 前回のtimeカラムに基づいてレコードを取得
            $previousRanks = Rank::where('time', $previousTime)->get();

            // ユーザー別にsmall_label_idの数を集計する
            $previousUserSmallLabelCounts = $previousRanks->groupBy('user_id')->map(function ($ranks) {
                return $ranks->pluck('small_label_id')->unique()->count();
            });
        }

        // 点数を集計する関数
        function calculateScores($ranks, $rankPoints)
        {
            $userScores = [];
            foreach ($ranks as $rank) {
                $userId = $rank->user_id;
                $rankValue = $rank->rank;

                // 点数計算
                $points = $rankPoints[$rankValue] ?? 0;

                // ユーザーの点数を集計
                if (!isset($userScores[$userId])) {
                    $userScores[$userId] = 0;
                }
                $userScores[$userId] += $points;
            }
            return $userScores;
        }

        // 直近の保存分の点数を計算
        $latestUserScores = calculateScores($latestRanks, $rankPoints);

        // その前の保存分の点数を計算
        $previousUserScores = calculateScores($previousRanks, $rankPoints);

        // 点数の多い順に並べ替え
        arsort($latestUserScores);
        arsort($previousUserScores);

        // 各ユーザーのジャンルごとの平均順位を計算する関数
        function calculateAverageRanks($ranks)
        {
            $userRanks = [];

            // 各ユーザーの各ジャンルにおける順位を集計
            foreach ($ranks as $rank) {
                $userId = $rank->user_id;
                $smallLabelId = $rank->small_label_id;

                if (!isset($userRanks[$userId])) {
                    $userRanks[$userId] = [];
                }
                if (!isset($userRanks[$userId][$smallLabelId])) {
                    $userRanks[$userId][$smallLabelId] = [];
                }

                $userRanks[$userId][$smallLabelId][] = $rank->rank;
            }

            // 各ユーザーの平均順位を計算し、ジャンル数も追加
            $userAverageRanks = [];
            foreach ($userRanks as $userId => $labels) {
                $totalRanks = 0;
                $totalCount = 0;
                $labelCount = count($labels); // ジャンル数を計算

                foreach ($labels as $smallLabelId => $ranks) {
                    $totalRanks += array_sum($ranks);
                    $totalCount += count($ranks);
                }

                $averageRank = $totalCount > 0 ? $totalRanks / $totalCount : 0;
                $userAverageRanks[$userId] = [
                    'average_rank' => number_format($averageRank, 2),
                    'label_count' => $labelCount // ジャンル数を追加
                ];
            }

            return $userAverageRanks;
        }

        // 直近の保存分の平均順位を計算
        $latestUserAverageRanks = calculateAverageRanks($latestRanks);

        // その前の保存分の平均順位を計算
        $previousUserAverageRanks = calculateAverageRanks($previousRanks);

        // ユーザー情報を点数と平均順位、ジャンル数を含めて取得する関数
        function getUserNamesWithScoresAndRanksAndLabels($userScores, $latestUserAverageRanks, $previousUserAverageRanks)
        {
            // ユーザーIDに基づいてユーザー情報を取得し、点数、平均順位、ジャンル数を追加
            return User::whereIn('id', array_keys($userScores))->get()->mapWithKeys(function ($user) use ($userScores, $latestUserAverageRanks, $previousUserAverageRanks) {
                // 直近のジャンル数
                $latestLabelCount = isset($latestUserAverageRanks[$user->id]['label_count']) ? $latestUserAverageRanks[$user->id]['label_count'] : 0;
                // 直近の1つ前のジャンル数
                $previousLabelCount = isset($previousUserAverageRanks[$user->id]['label_count']) ? $previousUserAverageRanks[$user->id]['label_count'] : 0;

                return [$user->id => [
                    'user_id' => $user->id, // user_idを追加
                    'name' => $user->name,
                    'score' => $userScores[$user->id],
                    'average_rank' => $latestUserAverageRanks[$user->id]['average_rank'] ?? null,
                    'label_count' => $latestLabelCount, // 直近のジャンル数を追加
                    'previous_label_count' => $previousLabelCount // 直近の1つ前のジャンル数を追加
                ]];
            // 点数の多い順に並べ替える
            })->sortByDesc('score');
        }

        // 直近の保存分のユーザー情報と点数、平均順位、ジャンル数を取得
        $latestUserNames = getUserNamesWithScoresAndRanksAndLabels($latestUserScores, $latestUserAverageRanks, $previousUserAverageRanks);

        // 順位を含めたデータを作成
        $rankedLatestUserNames = $latestUserNames->map(function ($user, $userId) use ($latestUserNames) {
            // 現在の順位を計算
            $rank = array_search($userId, array_keys($latestUserNames->toArray())) + 1;
            $user['rank'] = $rank;
            return $user;
        });

        // その前の保存分のユーザー情報と点数、平均順位、ジャンル数を取得
        $previousUserNames = getUserNamesWithScoresAndRanksAndLabels($previousUserScores, $previousUserAverageRanks, []);

        // 順位を含めたデータを作成
        $rankedPreviousUserNames = $previousUserNames->map(function ($user, $userId) use ($previousUserNames) {
            // 現在の順位を計算
            $rank = array_search($userId, array_keys($previousUserNames->toArray())) + 1;
            $user['rank'] = $rank;
            return $user;
        });

        // 共通するユーザーがいる場合は $rankedPreviousUserNames の情報を $rankedLatestUserNames に含める
        $rankedLatestUserNames = $rankedLatestUserNames->map(function ($user, $userId) use ($rankedPreviousUserNames) {
            // $rankedPreviousUserNames に共通するユーザーがいる場合
            if (isset($rankedPreviousUserNames[$userId])) {
                $user['previous_score'] = $rankedPreviousUserNames[$userId]['score'];
                $user['previous_average_rank'] = $rankedPreviousUserNames[$userId]['average_rank'];
                $user['previous_rank'] = $rankedPreviousUserNames[$userId]['rank'];
                $user['previous_label_count'] = $rankedPreviousUserNames[$userId]['label_count']; // 前回のジャンル数を追加
            } else {
                // 共通するユーザーがいない場合
                $user['previous_score'] = null;
                $user['previous_average_rank'] = null;
                $user['previous_rank'] = null;
                $user['previous_label_count'] = null; // 前回のジャンル数がない場合
            }
            return $user;
        });

        // ChatWork APIクライアントの作成
        $client = new Client([
            'headers' => [
                'X-ChatWorkToken' => 'f7f4028e3bfd055ef99673db753c6102' // トークン
            ]
        ]);

        // すべてのユーザーを取得
        $users = User::all();

        foreach ($users as $user) {
            $chatworkRoomId = $user->chatwork_room_id;
            if (!$chatworkRoomId) {
                continue; // このユーザーをスキップ
            }

            // 通知メッセージの作成
            $userId = $user->id;
            $messageBody = "[info]⭐️獲得TOP3 と {$user['name']}さん 今週結果\n";
            $messageBody .= "http://43.206.122.93/login[hr]";
            $messageBody .= "▶︎獲得/挑戦権🎴枚数と平均順位\n";

        
            // 上位5位までの情報を表示
            $top5Users = $rankedLatestUserNames->take(3);
            foreach ($top5Users as $rankedUser) {
                $rank = $rankedUser['rank'];
                if ($rankedUser['user_id'] == $userId) {
                    $messageBody .= "{$rank}位 {$rankedUser['score']}個 {$rankedUser['label_count']}つ平均{$rankedUser['average_rank']}位 (dance) {$rankedUser['name']}さん\n";
                } else {
                    $messageBody .= "{$rank}位 {$rankedUser['score']}個 {$rankedUser['label_count']}つ平均{$rankedUser['average_rank']}位 {$rankedUser['name']}さん\n";
                }
            }

            // 通知を受けるユーザーが3位以内に含まれない場合
            if (!$top5Users->contains('user_id', $userId)) {
                // そのユーザーの情報を追加
                $userRankedInfo = $rankedLatestUserNames->firstWhere('user_id', $userId);
                if ($userRankedInfo) {
                    $rank = $userRankedInfo['rank'];
                    $messageBody .= "\nTOP3ならず残念";
                    $messageBody .= "\n{$rank}位 {$userRankedInfo['score']}個 {$userRankedInfo['label_count']}つ平均{$userRankedInfo['average_rank']}位 (emo) {$rankedUser['name']}さん";
                } else {
                    $messageBody .= "\n今回、挑戦権🎴0枚であなたは圏外(puke)\n1ｼﾞｬﾝﾙ10問解いて挑戦権🎴を獲得しよう";
                }
            }

            // ユーザーのスコアが1以上の場合の処理
            if (isset($latestUserScores[$userId]) && $latestUserScores[$userId] >= 1) {
                $messageBody .= "\n[hr]▶︎あなたの挑戦権🎴順位別ジャンル\n";
            
                $topSmallLabels = Rank::where('time', $latestTime)
                    ->where('user_id', $userId)
                    ->where('rank', '<=', 5)
                    ->orderBy('rank', 'asc')
                    ->get(['small_label_id', 'small_label', 'rank'])
                    ->toArray();
            
                $rankLabels = [];
                foreach ($topSmallLabels as $label) {
                    $rank = $label['rank'];
                    if (!isset($rankLabels[$rank])) {
                        $rankLabels[$rank] = [];
                    }
                    $rankLabels[$rank][] = $label['small_label'];
                }
            
                foreach ($rankLabels as $rank => $labels) {
                    $messageBody .= "{$rank}位: " . implode('.', $labels) . "\n";
                }
            }
        
            $messageBody .= "[/info]";
            $messageBody .= "[ルール]\n・1つのｼﾞｬﾝﾙ毎に5位までスター獲得\n   (1位=6 2位=4 3位=3 4位=2 5位=1)\n・ｼﾞｬﾝﾙ1つ10問回答で挑戦権🎴を獲得\n・ｼﾞｬﾝﾙ各問直前正解率。同率は速さで優劣\n・毎週日曜24時に⭐️獲得戦はリセットされる";


            $messageBody .= "\n";

            // メッセージをChatWorkに送信
            $client->post("https://api.chatwork.com/v2/rooms/{$chatworkRoomId}/messages", [
                'form_params' => [
                    'body' => $messageBody
                ]
            ]);
        }
dd($users);
        return view('santaku.master')
            ->with('selectList', $selectList)
            ->with('largelabelList', $largelabelList)
            ->with('middlelabelList', $middlelabelList)
            ->with('users', $users)
            ->with('currentUser', $id);
    }
}
