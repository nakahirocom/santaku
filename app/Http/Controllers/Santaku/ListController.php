<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Services\SantakuService;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SantakuService $santakuService)
    {
        // 現在認証しているユーザーのIDを取得
        $id = auth()->id();
        //　認証しているユーザーのIDが作成者の問題をdbから抽出する
        $questionList = Question::where('user_id', $id)->get();

        return view('santaku.list')
            ->with('questionList', $questionList);
    }
}
