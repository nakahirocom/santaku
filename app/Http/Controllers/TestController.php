<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabelStorages;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{
    public function register(Request $request)
    {
        $input_data = $request->all();

        // ログイン中のユーザーを取得
        $user = Auth::user();

        // 変更前のデータを取得
        $previous_basic_count = $user->basic_count;
        $previous_user_mode = $user->user_mode;

        // labelstorages_idの処理
        foreach ($input_data['labelstorages_id'] as $key => $value) {
            $user_info = LabelStorages::select('*')->find($key);

            // フォームの種類に応じて、basic_selectまたはselectedを設定しつつ、usersテーブルにデータを保存
            if ($request->input('form_type') == 'basic_select') {
                $user_info->basic_select = $value;

                // フォームから送信されたデータをusersテーブルに保存
                $user->basic_count = $request->input('basic_count'); // フォームのデータをセット
                $user->user_mode = $request->input('user_mode'); // フォームのデータをセット
                $user->save(); // usersテーブルに保存


        // 変更後のデータを取得
        $current_basic_count = $user->basic_count;
        $current_user_mode = $user->user_mode;

        // 変更前と変更後の数値を通知メッセージに含める
        $message = "ユーザー情報が変更されました。\n" .
                   "basic_count: {$previous_basic_count} → {$current_basic_count}\n" .
                   "user_mode: {$previous_user_mode} → {$current_user_mode}";


            } elseif ($request->input('form_type') == 'selected') {
                $user_info->selected = $value;
                $message = "ジャンルを変更しました";

            }

            $user_info->save(); // labelstoragesテーブルのデータを保存
        }

        // フォームのボタンによってリダイレクト先を決める
        if ($request->has('KeepForIndex')) {
            return Redirect::route('index')->with('success', $message);
        }

        return Redirect::route('questionrandom')->with('success', $message);
    }
}