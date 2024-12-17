<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kaizen;


class KaizendeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $questionId = (int) $request->route('questionId');

        $kaizen = Kaizen::where('question_id', $questionId)->firstOrFail();
        $messege =$kaizen->kaizen;
        $kaizen->delete();

        return redirect()
            ->route('kaizenlist')
            ->with('feedback.success', '['.$messege.']のメモを削除しました');

    }
}
