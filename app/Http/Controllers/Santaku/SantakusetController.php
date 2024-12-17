<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\LabelStorages;
use App\Models\LargeLabel;
use App\Models\MiddleLabel;
use App\Models\SmallLabel;
use App\Models\Question;
use App\Models\Rank;
use App\Models\AnswerResults;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SantakusetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 現在認証しているユーザーのIDを取得
        $id = auth()->id();

        // 最新の解答結果を取得
        $latestAnswerResults = AnswerResults::select('question_id', 'answered_question_id', 'created_at', 'start_solving_time')
            ->where('user_id', $id) // ユーザーIDでフィルタリング
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('question_id');

        // 正解・不正解を判定し、平均回答時間を計算
        $results = $latestAnswerResults->map(function ($answerResult) {
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

        // small_label_id毎に数を集計し、平均回答時間を計算
        $summary = $results->groupBy('small_label_id')->map(function ($group) {
            $totalCorrect = $group->where('is_correct', true)->count();
            $totalQuestions = $group->count();
            $totalTimeDiff = $group->sum('time_diff');
            $averageTime = $totalQuestions > 0 ? $totalTimeDiff / $totalQuestions : 0;
            $accuracy = $totalQuestions > 0 ? $totalCorrect / $totalQuestions * 100 : 0;
            return [
                'correct' => $totalCorrect,
                'incorrect' => $totalQuestions - $totalCorrect,
                'total' => $totalQuestions,
                'accuracy' => number_format($accuracy, 1), // 小数点以下1位まで表示
                'average_time' => number_format($averageTime, 2) // 100分の1秒単位で表示
            ];
        });

        // small_label_idの昇順に並べ替え
        $sortedSummary = $summary->sortKeys();

        // 並べ替え結果を表示
        // dump($sortedSummary);

        // ログインしたユーザーの選んだジャンルを呼び出し、Eagerロードのためにwith([ミドルラベル、ラージラベル])してdbへのアクセスを少なくする
        $selectList = LabelStorages::where('user_id', $id)->with('smallLabel.middleLabel.largeLabel','smallLabel.individualtag')->get();
//dump($selectList);
        $smalelabelList = SmallLabel::all();
//dd($smalelabelList);
        // 両方のリストの数を比較
        if ($selectList->count() != $smalelabelList->count()) {
            foreach ($smalelabelList as $item) {
                if (!$selectList->contains('small_label_id', $item->id)) {
                    $selectNewList = new LabelStorages();
                    $selectNewList->user_id = $id; // UserIdを保存
                    $selectNewList->small_label_id = $item->id; // small_label_idを登録
                    $selectNewList->selected = 1; // 中分類を選んだ状態の「1」を登録
                    $selectNewList->basic_select = 1; // basic中分類を選んだ状態の「1」を登録
                    $selectNewList->commontag_id = $item->id; // small_label_idを登録
                    $selectNewList->commontag_selected = 1; // 中分類を選んだ状態の「1」を登録
                    $selectNewList->commontag_basic_select = 1; // basic中分類を選んだ状態の「1」を登録
                    $selectNewList->individualtag_id = $item->id; // small_label_idを登録
                    $selectNewList->individualtag_selected = 1; // 中分類を選んだ状態の「1」を登録
                    $selectNewList->individualtag_basic_select = 1; // basic中分類を選んだ状態の「1」を登録
                    $selectNewList->save();

                }
            }
        } else {
            // $selectListと$smalelabelListの数が同じ場合の処理
            // ここに必要なコードを記述します
        }

        // MiddleLabelごとに関連するQuestionの数を取得
        $middleQuestionCounts = MiddleLabel::leftJoin('small_labels', 'middle_labels.id', '=', 'small_labels.middle_label_id')
            ->leftJoin('questions', 'small_labels.id', '=', 'questions.small_label_id')
            ->select('middle_labels.id')
            ->selectRaw('COUNT(questions.id) as question_count')
            ->groupBy('middle_labels.id')
            ->get()
            ->pluck('question_count', 'id');
//dump($middleQuestionCounts);
        // SmallLabelごとに関連するQuestionの数を取得
        $smallQuestionCounts = SmallLabel::leftJoin('questions', 'small_labels.id', '=', 'questions.small_label_id')
            ->select('small_labels.id')
            ->selectRaw('COUNT(questions.id) as question_count')
            ->groupBy('small_labels.id')
            ->get()
            ->pluck('question_count', 'id');

        // $selectListにMiddleLabelとSmallLabelのquestion_countを追加
        foreach ($selectList as $labelStorage) {
            $middleLabelId = $labelStorage->smallLabel->middle_label_id;
            $smallLabelId = $labelStorage->small_label_id;
            $labelStorage->middle_question_count = $middleQuestionCounts->get($middleLabelId, 0);
            $labelStorage->small_question_count = $smallQuestionCounts->get($smallLabelId, 0);
        }

        $largelabelList = LargeLabel::all();
        $middlelabelList = MiddleLabel::all();

// 最新のtimeカラムの作成日時を取得
$latestRank = Rank::orderBy('created_at', 'desc')->first();

// 取得する回答結果の範囲を決定
if ($latestRank) {
    $startDate = $latestRank->created_at;
} else {
    $startDate = Carbon::now()->subWeek();
}

// 最新のtimeカラムの作成日時以降のデータを取得
$answerCountsBySmallLabel = AnswerResults::where('answer_results.user_id', $id)
    ->where('answer_results.created_at', '>=', $startDate)
    ->leftJoin('questions', 'answer_results.question_id', '=', 'questions.id')
    ->leftJoin('small_labels', 'questions.small_label_id', '=', 'small_labels.id')
    ->select('small_labels.id', 'small_labels.small_label')
    ->selectRaw('COUNT(answer_results.id) as answer_count')
    ->groupBy('small_labels.id', 'small_labels.small_label')
    ->get();


        // 全てのsmall_labelsを取得し、回答されていないものには0を設定
        $allSmallLabels = SmallLabel::all();

        // コレクションを作成し、0の回答数を設定
        $answerCountsWithZeros = $allSmallLabels->map(function ($label) use ($answerCountsBySmallLabel, $id) {
            $answerResult = $answerCountsBySmallLabel->firstWhere('small_label', $label->small_label);
            return (object) [
                'id' => $label->id,
                'small_label' => $label->small_label,
                'answer_count' => $answerResult ? $answerResult->answer_count : 0,
            ];
        });
        // answerCountsWithZerosをIDベースの連想配列に変換
        $answerCountsMap = $answerCountsWithZeros->keyBy('id');

        // selectListをループして対応するanswer_countを追加
        foreach ($selectList as $labelStorage) {
            $smallLabelId = $labelStorage->small_label_id;

            // answerCountsMapに対応するsmall_label_idが存在する場合、そのanswer_countを追加
            if ($answerCountsMap->has($smallLabelId)) {
                $labelStorage->answer_count = $answerCountsMap->get($smallLabelId)->answer_count;
            } else {
                $labelStorage->answer_count = 0; // デフォルト値を0に設定
            }
        }

        // answer_countが20以上のselectListの要素の数をカウント
        $countOfFiftyOrMore = $selectList->filter(function ($labelStorage) {
            return $labelStorage->answer_count >= 10;
        })->count();

        // answer_countの要素の数の総数（small_labelの数＝ジャンルの数）をカウント
        $countOf = $selectList->count();

        foreach ($selectList as $labelStorage) {
            $smallLabelId = $labelStorage->small_label_id;

            // sortedSummaryに対応するsmall_label_idが存在する場合、その結果を追加
            if ($sortedSummary->has($smallLabelId)) {
                $summary = $sortedSummary->get($smallLabelId);
                $labelStorage->correct = $summary['correct'];
                $labelStorage->incorrect = $summary['incorrect'];
                $labelStorage->total = $summary['total'];
                $labelStorage->accuracy = $summary['accuracy'];
                $labelStorage->average_time = $summary['average_time'];
            } else {
                // デフォルト値を設定
                $labelStorage->correct = 0;
                $labelStorage->incorrect = 0;
                $labelStorage->total = 0;
                $labelStorage->accuracy = '0.0';
                $labelStorage->average_time = '0.00';
            }
        }

dump($selectList);
//dump($largelabelList);
//dump($middlelabelList);

        return view('santaku.santakuset')
            ->with('selectList', $selectList)
            ->with('largelabelList', $largelabelList)
            ->with('middlelabelList', $middlelabelList)
            ->with('answerCountsBySmallLabel', $answerCountsWithZeros)
            ->with('countOfFiftyOrMore', $countOfFiftyOrMore) // 50以上回答したジャンルの数をビューに渡す
            ->with('countOf', $countOf); // ジャンル全体の数をビューに渡す

    }
}
