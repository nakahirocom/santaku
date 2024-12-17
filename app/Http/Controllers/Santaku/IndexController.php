<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AnswerResults;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::orderBy('continuous_correct_answers', 'DESC')->get();
        $authId = auth()->id();
//dd($users);

        // ユーザーを連続正解数で降順にソート
        $users = User::orderBy('continuous_correct_answers', 'DESC')->get();

        // ログインユーザーのIDを取得
        $authId = auth()->id();
        $loggedInUser = $users->firstWhere('id', $authId);
        $loggedInUserIndex = $users->search($loggedInUser);

        // ログインユーザーより1つ順位が上のユーザーを見つける
        $userAbove = null;
        if ($loggedInUserIndex > 0) { // ログインユーザーが最上位でない場合
            $userAbove = $users[$loggedInUserIndex - 1]->continuous_correct_answers - $loggedInUser->continuous_correct_answers;;
        }
//dump($userAbove);

        return view('santaku.index')
            ->with('users', $users)
            ->with('currentUser', $authId)
            ->with('currentUser', $authId)
            ->with('loggedInUserIndex' , $loggedInUserIndex + 1) // 順位は0からではなく1から始まるため
            ->with('userabove', $userAbove);
    }
}
