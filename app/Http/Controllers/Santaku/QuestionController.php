<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * 受け取ったリクエストを処理します。
     *
     * @param  Request  $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $questions = Question::getThreeQuestionsAtRandom();
        //dump($questions);
        // 配列が空か、nullを含む場合にチェック
        if (empty($questions)) {
            // santoku.indexビューにリダイレクト
            return view('santaku.index');
        }

        $questionj = collect($questions)->take(1); // ジャンル表示用の最初の問題
        //dd($questionj);
        $questionsA = $questions;   // 回答選択肢用の配列
        shuffle($questionsA);

        $numQuestions = $request->input('num_questions', 7); // リクエストから問題数を取得、デフォルトは7
        $numQuestions = max(1, $numQuestions); // 最小値を1とする

        $questionsQ = collect($questions)->take($numQuestions)->shuffle();
        //dd($questionsQ);
        return view('santaku.question', [
            'questions_q' => $questionsQ,
            'questions_a' => $questionsA,
            'questionj' => $questionj,
            'questionIds' => $questionsQ->pluck('id')->all()
        ]);
    }
}
