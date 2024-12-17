<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionRedoingController extends Controller
{
    public function __invoke(Request $request)
    {

        // 送信された間違った問題のIDを取得
        $missedQuestionIds = explode(',', $request->input('missed_question_ids'));

        // 間違えた問題を再取得して再出題
        $missedQuestions = Question::whereIn('id', $missedQuestionIds)->with('smallLabel.middleLabel.largeLabel')->get();

        $missedQuestionsArray = [];

        foreach ($missedQuestions as $index => $question) {
            $variableName = 'q' . ($index + 1);
            $$variableName = $question;
            $missedQuestionsArray[] = $$variableName;
        }

//        dd($missedQuestionsArray);
        // 配列が空か、nullを含む場合にチェック
        if (empty($missedQuestionsArray)) {
            return view('santaku.index');
        }
        
        $questionj = collect($missedQuestionsArray)->take(1); // ジャンル表示用の最初の問題
        $questionsA = $missedQuestionsArray; // 回答選択肢用の配列
    //dd($questionsA);
        shuffle($questionsA);
        
        $numQuestions = $request->input('num_questions', 7);
        $numQuestions = max(1, $numQuestions);
        
        $questionsQ = collect($missedQuestionsArray)->take($numQuestions)->shuffle();
        
        return view('santaku.redoing', [
            'questions_q' => $questionsQ,
            'questions_a' => $questionsA,
            'questionj' => $questionj,
            'questionIds' => $questionsQ->pluck('id')->all()
        ]);
    }
}