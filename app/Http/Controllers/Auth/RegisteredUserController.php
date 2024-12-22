<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SmallLabel;
use App\Models\LabelStorages;
use App\Providers\RouteServiceProvider;
use App\Mail\NewUserIntroduction;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Mail\Mailer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Mailer $mailer)
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'region' => ['required', 'integer', 'in:1,2'],
        ]);

        $newUser = User::create([
            'region_id' => $request->region ?? 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 0,
            'best_record' => null,
            'best_record_at' => now(),
        ]);


        event(new Registered($newUser));

        Auth::login($newUser);

        //新規登録した自身のuseridを取得する
        $id = auth()->id();

        //SmallLabelテーブルの全てのデータ(中分類)を$smalllabelNewListに保存する
        $smallLabelNewList = SmallLabel::all();

        //LabelStoragesテーブルの[user_id=全てログインユーザーの$id][small_label_id=全てのid][selected=全て1]
        foreach ($smallLabelNewList as $item) {
            $selectNewList = new LabelStorages();
            $selectNewList->user_id = $id; // ここでUserIdを保存している　❌ =$id();
            $selectNewList->small_label_id = $item->id; //small_label_idを登録
            $selectNewList->selected = 1; //中分類を選んだ状態の「１」を登録
            $selectNewList->basic_select = 1; // デフォルト値を設定
            $selectNewList->commontag_id = 1; // デフォルト値を設定
            $selectNewList->commontag_selected = 1; // デフォルト値を設定
            $selectNewList->commontag_basic_selected = 1; // デフォルト値を設定
            $selectNewList->individualtag_id = 1; // デフォルト値を設定
            $selectNewList->individualtag_selected = 1; // デフォルト値を設定
            $selectNewList->individualtag_basic_selected = 1; // デフォルト値を設定
            $selectNewList->save();
        }

        //メールの送信処理を追加
        //        $allUser = User::get();
        //        foreach ($allUser as $user) {
        //            $mailer->to($user->email)
        //            ->send(new NewUserIntroduction($user, $newUser));
        //        }

        return redirect(RouteServiceProvider::HOME);
    }
}
