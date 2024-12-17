<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kaizen;

class KaizenlistController extends Controller
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

                $kaizenlist = Kaizen::where('user_id', $id)->with('question.smallLabel.middleLabel.largeLabel')->get();
         //dump($mymemolist);
         
         return view('santaku.kaizenlist')
         ->with('kaizenlist', $kaizenlist);
        
        
    }
}
