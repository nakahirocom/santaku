<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kaizen;
use App\Http\Requests\Santaku\KaizenupdateRequest;

class KaizenupdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(KaizenupdateRequest $request ,$questionId)
    {
                // 現在認証しているユーザーのIDを取得
                $id = auth()->id();
                $ttt =  $request->kaizen;
                //dd($ttt);
                // user_id と question_id で Mymemo レコードを探し、なければ新規作成またはあれば更新
                $kaizen = Kaizen::updateOrCreate(
                    ['user_id' => $id, 'question_id' => $questionId], // 検索条件
                    ['kaizen' => $request->kaizen] // 更新または新規作成時にセットする値
                );
                //dd($mymemo);
                // $id と $mymemo->user_id が一致するか確認
                if ($id === $kaizen->user_id) {
                    // ユーザーIDが一致する場合、リダイレクトとフィードバックメッセージを設定
                    return redirect()
                        ->route('kaizen', ['questionId' => $kaizen->question_id])
                        ->with('kaizens', $kaizen)
                        ->with('feedback.success', '改善要望を更新しました');
                }
        
    }
}
