<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\View\View;


class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    /**
     * 答えが被らない問題を3つ返却する
     *
     * @return array
     */

    //間違いの多い問題を抽出する
    public static function getThreeQuestionsAtRandom(): array
    {
        //ログインしているユーザーidを取得する
        $id = auth()->id();

        //ログインしているユーザーがチェックをしている小分類（問題ジャンル）をピックアップ
        $user_choice = LabelStorages::where('user_id', $id)
            ->where('selected', 1)
            ->select('small_label_id')
            ->get();
        //        dump($user_choice);
        //userが選択したジャンルに対応するquestionを全てピックアップ
        $usersentakuchoice_question = Question::whereHas('smallLabel', function ($q) use ($user_choice) {
            $q->whereIn('id', $user_choice);
        })
            ->get();
        //        dump($usersentakuchoice_question);


        $zennmonn_count1 = count($usersentakuchoice_question);
        //        dump($zennmonn_count1);

        //AnswerResults(回答履歴)のうち、userが選択したジャンルに対応するquestionで回答履歴のあるquestionをgroupByでピックアップ
        $usersentakuchoice_question_kaitouzumi =
            AnswerResults::whereHas('question.smallLabel', function ($q) use ($user_choice) {
                $q->whereIn('id', $user_choice);
            })
            ->select('question_id')
            //            ->selectRaw('COUNT(question_id)')
            ->where('user_id', auth()->id())
            ->groupBy('question_id')
            ->get();
        //        dump($usersentakuchoice_question_kaitouzumi);

        $toita_count2 = count($usersentakuchoice_question_kaitouzumi);
        //        dump($toita_count2);
        //                dump($usersentakuchoice_question_kaitouzumi);

        //新規ユーザーの1問目のケース　⭐️一回も回答履歴がない場合は、選んだジャンルのquestionからランダムに出題する
        if ($usersentakuchoice_question_kaitouzumi->isEmpty()) {
            $q1 = Question::
                //ユーザーが選んでいるジャンルの内、（LabelStoragesのselectカラムが１）をwhereinの検索条件にinRandomOrder()しfirst()で１つ取得する。
                wherein('small_label_id', $user_choice)
                ->inRandomOrder()->with('smallLabel.middleLabel.largeLabel')
                ->first();

            if ($q1 === null) {
                // $q1がnullならgetThreeQuestionsAtRandom()の戻り値に空の配列で返す
                return [];
            }

            $q2 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNot('answer', $q1?->answer)->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q2 === null) {
                // $q2がnullならgetThreeQuestionsAtRandom()に$q1までの戻り値を返す
                return [$q1];
            }


            $q3 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q3 === null) {
                // $q3がnullならgetThreeQuestionsAtRandom()に$q2までの戻り値を返す
                return [$q1, $q2];
            }



            $q4 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q4 === null) {
                // $q4がnullならgetThreeQuestionsAtRandom()に$q3までの戻り値を返す
                return [$q1, $q2, $q3];
            }

            $q5 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer, $q4?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q5 === null) {
                // $q5がnullならgetThreeQuestionsAtRandom()に$q4までの戻り値を返す
                return [$q1, $q2, $q3, $q4];
            }

            return [$q1, $q2, $q3, $q4, $q5];
        }


        //⭐️ユーザーの選択した小分類のquestion_idと回答済みの'question_id'が一致する場合には、未回答問題が無いためワースト正解率を計算し出題する。
        else if ($zennmonn_count1 == $toita_count2) {

            $questions_seikaisuu = AnswerResults::whereHas('question.smallLabel', function ($q) use ($user_choice) {
                $q->whereIn('id', $user_choice);
            })
                ->select('question_id')
                ->selectRaw('COUNT(question_id) as seikaisuu')
                //ユーザーが選択したものも条件に追加する必要がある。
                ->where('user_id', auth()->id())
                ->whereColumn('question_id', 'answered_question_id')
                ->groupBy('question_id')
                ->orderBy('question_id', 'asc')
                ->get();
            //                        dump($questions_seikaisuu);

            //AnswerResults（回答履歴）の中から、ユーザーが選択した小分類のquestion_id毎に'question_id'の数を数えて出題数をカウントする。
            $questions_allsyutudaisuu = AnswerResults::whereHas('question.smallLabel', function ($q) use ($user_choice) {
                $q->whereIn('id', $user_choice);
            })
                ->select('question_id')
                ->selectRaw('COUNT(question_id) as syutudaisuu')
                //ユーザーが選択したものも条件に追加する必要がある。
                ->where('user_id', auth()->id())
                ->groupBy('question_id')
                //            ->orderBy('question_id', 'asc')
                ->get();
            //                        dump($questions_allsyutudaisuu);

            //foreachで出題数コレクションを回す。
            foreach ($questions_allsyutudaisuu as $key => $value) {
                //正解数コレクションに同じ出題数[$key]に対応するquestion_idが存在するか判定する。
                $contains = $questions_seikaisuu->contains('question_id', $questions_allsyutudaisuu[$key]->question_id);

                if ($contains) {
                    //ture（question_idが双方にある）なら出題数のquestion_idと一致する正解数のqustion_idを配列で取得する。
                    $ittiseikaisuu = $questions_seikaisuu->firstwhere('question_id', $questions_allsyutudaisuu[$key]->question_id)->toArray();
                    //連想配列の$ittiseikaisuuに$questions_allsyutudaisuuから一致する出題数を追加する。
                    $ittiseikaisuu = array_merge($ittiseikaisuu, array('syutudaisuu' => $questions_allsyutudaisuu[$key]->syutudaisuu));
                    //連想配列の$ittiseikaisuuに分子と分母が揃ったので正解率を計算し連想配列に追加する。
                    $kobetuseikairitu = array_merge($ittiseikaisuu, array('seikairitu' => $ittiseikaisuu['seikaisuu'] / $ittiseikaisuu['syutudaisuu']));
                    //個別の情報を新たな配列に集める。
                    $seikairituArray[$key] = $kobetuseikairitu;
                    //                    dump($seikairituArray);
                } else {
                    //false（question_idが正解数にない＝正解が1つもない）なら[$key]に対応する要素の出題数を配列に入れる。
                    $huittiseikaisuu = $questions_allsyutudaisuu[$key]->toArray();
                    //連想配列の$huittiseikaisuuに'seikairitu'０の連想配列を$huittiseikaisuuに追加する。
                    $huittiseikaisuu = array_merge($huittiseikaisuu, array('seikaisuu' => 0));
                    //連想配列の$huittiseikaisuuに分子と分母が揃ったので正解率を計算し連想配列に追加する。
                    $kobetuseikairitu = array_merge($huittiseikaisuu, array('seikairitu' => $huittiseikaisuu['seikaisuu'] / $huittiseikaisuu['syutudaisuu']));
                    //個別の情報を新たに作成した配列に追加する。
                    $seikairituArray[$key] = $kobetuseikairitu;
                    //                    dump($seikairituArray);
                }
            }
            //連想配列をコレクションに戻す
            $syuukei = collect($seikairituArray);
            //コレクションメソッドから正解率ワースト１を抽出する
            $Worstseikairitu = $syuukei->sortBy('seikairitu');
            //            dump($syuukei);
            //            dump($Worstseikairitu);

            //ユーザーが選んでいるジャンルの内（LabelStoragesのselectカラムが１）,Worstsekairituで最も正解率の低いものを抽出。
            $q1 = Question::where('id', $Worstseikairitu->first()['question_id'])->with('smallLabel.middleLabel.largeLabel')
                //正解率が一番低いものを１つ取得する
                ->first();

            //dump($q1);
            if ($q1 === null) {
                // $q1がnullならgetThreeQuestionsAtRandom()の戻り値を空の配列で返す
                return [];
            }


            // q1と同じジャンルで正解率の2番目に低いものをq2に入れる。無ければ、ランダムに同ジャンルから選んだものをq2に入れる。
            $found = false;
            $counter = 1;
            foreach ($Worstseikairitu as $worst) {
                $q2 = Question::where('small_label_id', ($q1->small_label_id))->where('id', $Worstseikairitu->skip($counter)->first()['question_id'])
                    ->whereNot('answer', $q1?->answer)
                    ->with('smallLabel.middleLabel.largeLabel')
                    ->first(); // 昇順で最初のものを取得

                //                dump($counter);
                //                dump($q2);

                if ($q2 !== null) {
                    $found = true;
                    break; // 条件に合うQuestionが見つかったらループを抜ける
                }
                $counter++; //カウントを増加
            }

            if (!$found) {
                // $Worstseikairitu内で適切なものが見つからなかった場合、$q1と同じsmall_label_idを持つQuestionを探す
                $q2 = Question::where('small_label_id', $q1->small_label_id)
                    ->whereNot('answer', $q1?->answer)
                    ->inRandomOrder()
                    ->with('smallLabel.middleLabel.largeLabel')
                    ->first(); // ランダムに並べ替えて最初のものを取得
            }
            if ($q2 === null) {
                // $q2がnullならgetThreeQuestionsAtRandom()に$q1までの戻り値を返す
                return [$q1];
            }

            //dump($q2);
            $q3 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q3 === null) {
                // $q3がnullならgetThreeQuestionsAtRandom()に$q2までの戻り値を返す
                return [$q1, $q2];
            }
            //dump($q3);

            $q4 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();
            //dump($q4);

            if ($q4 === null) {
                // $q4がnullならgetThreeQuestionsAtRandom()に$q3までの戻り値を返す
                return [$q1, $q2, $q3];
            }
            $q5 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer, $q4?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();
            //dump($q5);

            if ($q5 === null) {
                // $q5がnullならgetThreeQuestionsAtRandom()に$q4までの戻り値を返す
                return [$q1, $q2, $q3, $q4];
            }

            return [$q1, $q2, $q3, $q4, $q5];
        }

        //⭐️ユーザーの選択した小分類のquestion_idより回答済みの'question_id'が少ない場合、未回答問題があるため、未回答問題から出題する。
        else {

            //41行目のコード：ログインユーザーが選択したジャンルに対応する問題のうち、回答済み問題をQuestionテーブルから抽出。
            $toita_question = Question::whereIn('id', $usersentakuchoice_question_kaitouzumi)->with('smallLabel.middleLabel.largeLabel')->get();
            //            dump($toita_question);

            //選択したジャンルに対応する全問題の内、解いた問題以外を抽出する
            $toitenai_question = $usersentakuchoice_question->diff($toita_question);
                        //dump($toitenai_question);

            $q1 = $toitenai_question->random();

            //ユーザーが選んでいるジャンルの内、（LabelStoragesのselectカラムが１）をwhereinの検索条件にinRandomOrder()しfirst()で１つ取得する。
            if ($q1 === null) {
                // $q1がnullならgetThreeQuestionsAtRandom()の戻り値を空の配列で返す
                return [];
            }

            //            dump($q1);
            $q2 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNot('answer', $q1?->answer)->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q2 === null) {
                // $q2がnullならgetThreeQuestionsAtRandom()に$q1までの戻り値を返す
                return [$q1];
            }


            $q3 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q3 === null) {
                // $q3がnullならgetThreeQuestionsAtRandom()に$q2までの戻り値を返す
                return [$q1, $q2];
            }


            $q4 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q4 === null) {
                // $q4がnullならgetThreeQuestionsAtRandom()に$q3までの戻り値を返す
                return [$q1, $q2, $q3];
            }
            $q5 = Question::
                //$q1でランダムで選択されたジャンルと同じジャンルをwhereで範囲指定し、$q1,$q2,$q3のanswerと答えが被らないものをランダムに１つ取得する。
                where('small_label_id', ($q1->small_label_id))
                ->whereNotIn('answer', [$q1?->answer, $q2?->answer, $q3?->answer, $q4?->answer])->inRandomOrder()
                ->with('smallLabel.middleLabel.largeLabel')->first();

            if ($q5 === null) {
                // $q5がnullならgetThreeQuestionsAtRandom()に$q4までの戻り値を返す
                return [$q1, $q2, $q3, $q4];
            }


            return [$q1, $q2, $q3, $q4, $q5];
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function smallLabel()
    {
        return $this->belongsTo(SmallLabel::class);
    }

    public function answerResult()
    {
        return $this->hasMany(AnswerResults::class);
    }

    public function kaizen()
    {
        return $this->hasOne(Kaizen::class);
    }
    public function mymemo()
    {
        return $this->hasOne(Mymemo::class);
    }

}
