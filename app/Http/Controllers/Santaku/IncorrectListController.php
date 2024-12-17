<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnswerResults;
use App\Models\Question;
use Illuminate\Support\Collection;

class IncorrectItem
{
    public $inco;
    public $syutudai;
    public $matigai;

    public function __construct($inco, $syutudai, $matigai)
    {
        $this->inco = $inco;
        $this->syutudai = $syutudai;
        $this->matigai = $matigai;
    }
}

class IncorrectListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $id = auth()->id();

        $incorrectlist = AnswerResults::whereColumn('answer_results.question_id', '!=', 'answer_results.answered_question_id')
            ->where('answer_results.user_id', '=', $id)
            ->orderBy('answer_results.created_at', 'DESC')
            ->take(30)
            ->get();

        $question_ids = $incorrectlist->pluck('question_id')->unique();
        $answered_question_ids = $incorrectlist->pluck('answered_question_id')->unique();

        $syutudaiquestions = Question::whereIn('id', $question_ids)
            ->with(['smallLabel.middleLabel.largeLabel', 'mymemo' => function ($query) use ($id) {
                $query->where('user_id', '=', $id);
            }])
            ->get();

        $matigaiquestions = Question::whereIn('id', $answered_question_ids)
            ->with(['smallLabel.middleLabel.largeLabel', 'mymemo' => function ($query) use ($id) {
                $query->where('user_id', '=', $id);
            }])
            ->get();

        $combinedResults = collect();

        foreach ($incorrectlist as $inco) {
            $syutudai = $syutudaiquestions->firstWhere('id', $inco->question_id);
            $matigai = $matigaiquestions->firstWhere('id', $inco->answered_question_id);

            $combinedResults->push(new IncorrectItem($inco, $syutudai, $matigai));
        }

        //dump($combinedResults);


        return view('santaku.incorrect')->with('incolist', $combinedResults);
    }


    //        //**  不正解問題（正解idと解答idが不一致）で認証ユーザーの問題を新しい日時順でdbから抽出する
    //        $incorrectList = AnswerResults::with(['question.smallLabel.middleLabel.largeLabel', 'mymemo'])
    //            ->whereColumn('answer_results.question_id', '!=', 'answer_results.answered_question_id')
    //            ->where('answer_results.user_id', '=', $id)
    //            ->select(
    //                'answer_results.id',
    //                'answer_results.user_id',
    //                'answer_results.question_id',
    //                'answer_results.answered_question_id',
    //                'answer_results.updated_at',
    //
    //
    //                'questions.id as q_id',
    //                'questions.question as q_question',
    //                'questions.question_path as q_question_path',
    //                'questions.answer as q_answer',
    //                'questions.comment as q_comment',
    //                'questions.comment_path as q_comment_path',
    //
    //
    //                'mymemos.id as mymemo_id', // mymemoカラムの追加
    //                'mymemos.question_id as mymemo_qestion_id', // mymemoカラムの追加
    //                'mymemos.user_id as mymemo_user_id', // mymemoカラムの追加
    //                'mymemos.mymemo as mymemo', // mymemoカラムの追加
    //
    //                )
    //    ->join('questions', 'answer_results.answered_question_id', '=', 'questions.id')
    //    ->join('mymemos', function ($join) use ($id) {
    //        $join->on('mymemos.question_id', '=', 'questions.id')
    //             ->where('mymemos.user_id', '=', $id);
    //    }) // mymemoテーブルを user_id と question_id で結合
    //    ->orderBy('answer_results.created_at', 'DESC')
    //    ->take(30)
    //    ->get();
    //    


}
