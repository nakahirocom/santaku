<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Kaizen;
use App\Models\Question;

use Illuminate\Http\Request;

class KaizenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $uid = $request->user()->id;

        $questionId = (int) $request->route('questionId');
        $kaizens = Kaizen::with('user.question.smallLabel.middleLabel.largeLabel')->where('question_id', $questionId)->get();

        //dump($questionId);
        //dump($kaizens);
        $question = Question::with('smallLabel.middleLabel.largeLabel')->where('id', $questionId)
            ->with(['Kaizen' => function ($query) use ($uid, $questionId) {
                $query->where('user_id', $uid)
                    ->where('question_id', $questionId); // ユーザーIDと質問IDの両方でフィルタリング
            }])
            ->firstOrFail();

//dump($question);
        return view('santaku.kaizen')
        ->with('kaizens', $kaizens)
        ->with('question', $question);

    }
}
