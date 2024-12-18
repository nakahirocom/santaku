<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->

    <link rel="stylesheet" href="/css/app.css">
    <title>santakuアプリ</title>

</head>

<body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64">


    @auth
    <div class="flex justify-between items-center">
        <div>
            <div class="flex items-center">
                2.選択ジャンル単位で問題を解く
                <!-- 連続正解数表示部分 -->
                </div>
            </div>
            <span id="continuous-correct-answers"></span>
            <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
                href="/">HOMEへ</a>
        </div>
    </div>
    @endauth

    <!-- 表示用ボタン -->
    <div class="flex items-center">
        <button id="show-next-button" type="button"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
            ◯×連続判定</button>
        <!-- 表示エリア -->
        <div id="display-area" class="'justify-left', items-center space-x-4 my-4">
            　
            <!-- 結果を表示するためのスペース（JavaScriptで管理） -->
        </div>
    </div>

    <div class="container text-left relative">
        <div class="border-2 border-gray-300 rounded-md p-1 shadow-lg relative">
            <div class="flex justify-between m-0">
                <div class="flex-none m-0">
                    【答え合わせ】
                </div>
            </div>
            @csrf


            @for ($i = 0; $i < count($viewModels); $i++) <div
                class="items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
                <div class="w-12 h-6 flex items-center">
                    <strong class="text-lg text-white text-center">{{$i+1}}問目</strong>
                </div>
                <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                    {{ $viewModels[$i]->getQuestion() }}


                    <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getQuestion_path() }}" class="max-w-none max-h-[300px]">
                    </div>
                </div>
        </div>

        <div class="flex flex-col justify-end items-end">
            <!-- Incorrect button -->

            <div id="answer-{{ $i }}" class="flex items-center">

                <button type="button" value="{{ $viewModels[$i]->getmissAnswer() }}"
                    class="answer-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-2 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50 text-left mr-1 mb-1"
                    data-correct="{{ $viewModels[$i]->isCorrect() ? 'true' : 'false' }}">
                    {{ $viewModels[$i]->getmissAnswer() }}
                </button>
                <span class="ml-2 hidden" id="mark-{{ $i }}"></span>
            </div>

        </div>

        <div>

            <details class="my-0">
                <summary class="text-lg font-bold text-blue-600 hover:text-blue-800 cursor-pointer">
                    {{$i+1}}問目の問題・答え・解説を見る
                </summary>

                <div class="d-inline p-0 bd-highlight">あなたの正解率：{{ $uidseikairituModels[$i] }}% /累計回答数：{{
                    $uidkaitousuuModels[$i] }}</div>
                <div class="d-sm-inline p-0 bd-highlight">みんなの正解率：{{ $allseikairituModels[$i] }}% /累計回答数：{{
                    $allkaitousuuModels[$i] }}</div>

                @if ($viewModels[$i]->isCorrect() )
                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">
                    <div class="w-12 h-6 flex items-center">
                        <strong class="text-xs text-white">{{$i+1}}</strong>
                    </div>
                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getComment() }}

                    </div>
                    <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>

                    私のメモ:{{ $viewModels[$i]->getMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getReference_url() }}

                </div>
                <a href="{{ $viewModels[$i]->getComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">添付File</a>

                <a href="{{ $viewModels[$i]->getReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">参考URL</a>

                    @auth
                    @if (auth()->user()->id == $viewModels[$i]->getUser_id())
                    <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getAnswerId()]) }}" class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">編集</a>
                    @endif
                    @endauth

                <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    要望
                </a>
                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    私のメモ
                </a>


                <br>

                @else




                <div>問題側セットと編集ボタン</div>
                <div id="question-{{ $i }}"
                    class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">

                    <div class="w-14 h-6 flex justify-center items-center">
                        <strong class="text-lg text-white text-center">{{$i+1}}</strong>
                    </div>
                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        {{ $viewModels[$i]->getQuestion() }}
                        <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                            <img src="{{ $viewModels[$i]->getQuestion_path() }}" class="max-w-none max-h-[300px]">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-end items-end">
                    <!-- Incorrect button -->
                    <div class="text-sm mb-1">

                        <button type="button" value="{{ $viewModels[$i]->getAnswer() }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4">
                            {{ $viewModels[$i]->getAnswer() }}
                        </button>
                    </div>
                </div>
                <br>

                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">


                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getComment() }}
                    </div>
                    <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>
                    私のメモ:{{ $viewModels[$i]->getMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getReference_url() }}
                </div>

                <a href="{{ $viewModels[$i]->getComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">添付File</a>

                <a href="{{ $viewModels[$i]->getReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">参考URL</a>

                    @auth
                    @if (auth()->user()->id == $viewModels[$i]->getUser_id())
                    <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getAnswerId()]) }}" class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">編集</a>
                    @endif
                    @endauth
                    <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    要望
                </a>
                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    私のメモ
                </a>

                <br>
                <br>
                <div>選択ミス側セットと編集ボタン</div>
                <div id="question-{{ $i }}"
                    class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
                    <div class="w-14 h-6 flex justify-center items-center">
                        <strong class="text-lg text-white text-center">{{$i+1}}</strong>
                    </div>
                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        {{ $viewModels[$i]->getmissQuestion() }}
                        <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                            <img src="{{ $viewModels[$i]->getmissQuestion_path() }}" class="max-w-none max-h-[300px]">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-end items-end">
                    <!-- Incorrect button -->
                    <div class="text-sm mb-1">

                        <button type="button" value="{{ $viewModels[$i]->getmissAnswer() }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4">
                            {{ $viewModels[$i]->getmissAnswer() }}
                        </button>-
                    </div>
                </div>
                <br>
                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">


                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getmissComment() }}
                    </div>
                    <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getmissComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>
                    私のメモ:{{ $viewModels[$i]->getmissMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getmissComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getmissReference_url() }}

                </div>
                <a href="{{ $viewModels[$i]->getmissComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">添付File</a>

                <a href="{{ $viewModels[$i]->getmissReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">参考URL</a>

                    @auth
                    @if (auth()->user()->id == $viewModels[$i]->getmissUser_id())
                    <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getmissAnswerId()]) }}" class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">編集</a>
                    @endif
                    @endauth

                    @auth
                @endauth
                <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getmissAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    要望
                </a>
                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getmissAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                    私のメモ
                </a>

                <br>
                <div>
                </div>

                @endif

            </details>
            <br>
            <br>
        </div>
    </div>


    @endfor

    <style>
        .question {
            transition: all 0.3s ease-in-out;
            opacity: 0.5;
        }

        .highlighted-question {
            background-color: #ffd700;
            /* ゴールド色で背景を強調 */
            opacity: 1;
            /* 透明度を通常に戻す */
        }

        /* 選択確定ボタンの通常スタイル */
        #kakutei {
            background-color: #e5e7eb;
            /* 薄いグレー */
            color: #9ca3af;
            /* 暗いグレー */
            border-color: #d1d5db;
            cursor: not-allowed;
        }

        /* 選択確定ボタンが有効化されたときのスタイル */
        #kakutei.enabled {
            background-color: #34d399;
            /* 明るい緑色 */
            color: white;
            border-color: #059669;
            cursor: pointer;
        }
    </style>
    </div>
    </div>


    </div>


    <script>
        var isFirstClick = true; // 初めてのクリックを追跡するためのフラグ
        var continuousCorrectAnswers = {{ $timeoutuser->continuous_correct_answers }}; // PHPの変数をJavaScriptの変数に代入
        var allCorrect = true; // 全問正解かどうかを判断するフラグ
    
        document.addEventListener('DOMContentLoaded', function () {
            var continuousCorrectAnswersSpan = document.getElementById('continuous-correct-answers');
            continuousCorrectAnswersSpan.textContent = continuousCorrectAnswers + ' 正解中'; // 最初の表示
        });
    
        document.getElementById('show-next-button').addEventListener('click', function() {
            if (isFirstClick) {
                isFirstClick = false;
                var answers = document.querySelectorAll('.answer-button');
                var displayArea = document.getElementById('display-area');
                var button = document.getElementById('show-next-button');
    
                function allAnswersDisplayed() {
                    if (allCorrect) {
                        button.textContent = '次の問題へ';
                        button.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                        button.classList.add('bg-green-500', 'hover:bg-green-700');
                    } else {
                        button.textContent = '間違えた問題を解き直す';
                        button.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                        button.classList.add('bg-red-500', 'hover:bg-red-700');
                    }
    
                    button.removeEventListener('click', allAnswersDisplayed);
                    button.addEventListener('click', function() {
                        if (allCorrect) {
                            window.location.href = '/questionrandom';
                        } else {
                            window.location.href = '/questionrandomバツ';
                        }
                    });
                }
    
                function showAnswer(index) {
                    if (index < answers.length) {
                        var answer = answers[index];
                        var mark = document.getElementById('mark-' + index);
    
                        mark.classList.remove('hidden');
    
                        var displayMark = document.createElement('span');
                        displayMark.classList.add('text-xl', 'font-bold');
    
                        if (answer.getAttribute('data-correct') === 'true') {
                            mark.textContent = '⭕️';
                            continuousCorrectAnswers++; // 正解の場合
                            displayMark.textContent = '⭕️';
                            displayMark.classList.add('text-red-500');
                        } else {
                            mark.textContent = '❌';
                            continuousCorrectAnswers = 0; // 不正解の場合
                            displayMark.textContent = '❌';
                            displayMark.classList.add('text-red-500');
                            allCorrect = false; // 不正解がある場合はフラグをfalseに
                        }
    
                        displayArea.appendChild(displayMark);
                        document.getElementById('continuous-correct-answers').textContent = continuousCorrectAnswers + ' 問連続正解中'; // 更新されたスコアを表示
    
                        if (index >= answers.length - 1) {
                            setTimeout(allAnswersDisplayed, 1);
                        } else {
                            setTimeout(function() { showAnswer(index + 1); }, 500);
                        }
                    }
                }
    
                showAnswer(0);
            }
        });
    </script>



</body>