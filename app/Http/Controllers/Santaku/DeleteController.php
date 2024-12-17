<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Services\SantakuService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SantakuService $santakuService)
    {
        $questionId = (int) $request->route('questionId');
        if (!$santakuService->checkOwnMondai($request->user()->id, $questionId)) {
            return redirect()
                ->route('list')
                ->with('feedback.success', '他のユーザーの問題は削除出来ません');

            throw new AccessDeniedHttpException();
        }

        $question = Question::where('id', $questionId)->firstOrFail();
        $question->delete();

        return redirect()
            ->route('list')
            ->with('feedback.success', '問題を削除しました');
    }
}
