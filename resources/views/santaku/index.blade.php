<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>santakuアプリ開発チーム</title>

</head>

<body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64">
    <div>
        @if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif

        @auth
    
        <div class="container mx-auto my-4">
            @if (Auth::user()->user_mode == 0)
                <script>
                    Swal.fire({
                        title: '基礎モード開放せよ',
                        html: '開放条件：{{ Auth::user()->basic_count }}問連続正解<br><br>開放に必要な連続正解数：{{ Auth::user()->basic_count - Auth::user()->base_continuous_correct_answers}}問',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6' // ここでボタンの色を変更
                    });
                </script>
                <p class="text-2xl text-center">三択アプリ:基礎モード</p>

                @else
            <script>
                // $useraboveがnullかどうかをチェック
                var userAbove = {{ json_encode($userabove) }};
                var messageHtml = userAbove ?
                    '連続1位を目指せ：{{ Auth::user()->continuous_correct_answers }}問連続正解中<br>現在の順位は {{ $loggedInUserIndex }}位です。<br>あと' + userAbove + '問で順位アップ' :
                    '連続1位を目指せ：{{ Auth::user()->continuous_correct_answers }}問連続正解中<br>現在の順位は {{ $loggedInUserIndex }}位です。<br>連続正解更新中';
            
                Swal.fire({
                    title: 'バトルモード',
                    html: messageHtml,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6' // ボタンの色を設定
                });
            </script>


            
                <p class="text-2xl text-center">三択アプリ:通常モード</p>
            @endif

            <nav>
                <ol>
                    <li class="breadcrumb-item"><span>{{ Auth::user()->name }}</span> がログイン中</li>
                    {{ Auth::user()->continuous_correct_answers }}問連続正解中
                </ol>
            </nav>
        </div>
        @endauth    

        <div class="mx-auto my-4">
            <ul>

                @auth
                    @if (Auth::user()->user_mode == 0)
                    <li class="mb-3">
                        <a href="/questionrandom"
                            class="border border-gray-800 text-white bg-blue-500 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">1.基礎モード問題を解く</a>
                    </li>

                    <li class="mb-3">
                        <a href="/incorrect"
                            class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">2.直近30問の間違えた問題を確認</a>

                            <li class="mb-3">
                                <a href="/mymemolist"
                                    class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">4.私のメモ一覧を見る</a>
                            </li>
                            <li class="mb-3">
                                <a href="/kaizenlist"
                                    class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">5.私の要望一覧を見る</a>
                            </li>
            
                @else        
                <li class="mb-3">
                    <a href="/santakuset"
                    class="border border-gray-800 text-white bg-red-500 hover:bg-red-700 hover:text-white px-3 py-2 rounded-lg text-center">
                    0.出題ジャンルの選択を行う  >>開放済</a>
                </li>

                <li class="mb-3">
                    <a href="/questionrandom"
                        class="border border-gray-800 text-white bg-blue-500 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">1.選択ジャンル問題を解く</a>
                </li>

                <li class="mb-3">
                    <a href="/incorrect"
                        class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">2.直近30問の間違えた問題を確認</a>
                </li>
                <li class="mb-3">
                    <a href="/new"
                        class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">3.新しく問題を登録する</a>
                </li>
                <li class="mb-3">
                    <a href="/mymemolist"
                        class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">4.私のメモ一覧を見る</a>
                </li>
                <li class="mb-3">
                    <a href="/kaizenlist"
                        class="border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-lg text-center">5.私の要望一覧を見る</a>
                </li>

            </ul>
        </div>

        <div class="container mx-auto my-1">
            <div class="flex flex-col">
                <!-- 見出し -->
                <div class="bg-gray-200 p-2 mb-2">
                    <div class="flex justify-between">
                        <span class="text-xs font-semibold flex-grow text-left">今の連続記録 / user</span>
                        <span class="text-xs font-semibold flex-grow text-right">/ 過去最高記録</span>
                    </div>
                </div>
                <!-- ユーザーリスト -->
                @if (isset($users))
    @foreach ($users as $index => $user)
        <!-- ユーザーリストの表示部分 -->
                <div
                    class="{{ $user->id == $currentUser ? 'bg-blue-300 border-blue-500' : 'bg-white border-gray-200' }} flex items-center justify-between border-b p-1 mb-1">
                    <span class="text-xs">{{ $loop->iteration }}位　</span>
                    <div class="text-xs text-gray-600 flex-grow text-cdnter font-semibold">{{
                        $user->continuous_correct_answers }}問　/</div>
                    <div class="flex-grow-0 flex-shrink-0 w-1/4 flex items-left">
                        <div class="text-xs text-gray-800 mr-3">{{ $user->name }}さん
                        </div>
                    </div>
                    <div class="text-xs flex-grow text-right">
                        @if ($user->continuous_correct_answers >= $user->best_record)
                        <span class="font-bold text-red-600 bg-yellow-100 p-1 rounded">/ 記録更新中</span>
                        @else
                        /　 {{ $user->best_record }}問
                        @endif
                    </div>
                    <div class="text-xs text-gray-600 flex-grow ml-auto text-right">{{ date('Y-m-d',
                        strtotime($user->best_record_at)) }}</div>
                </div>
                @endforeach
                @else
                    <p>選択されたジャンルには問題が未登録です</p>
                @endif
            </div>
        </div>
        @endif
        @endauth


    </div>
</body>