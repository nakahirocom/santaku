<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <link rel="stylesheet" href="/css/app.css">
    <title>santakuアプリ</title>

</head>

<body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64">
    @auth
    <div class="flex justify-between items-center">
        <!-- ジャンル表示と連続正解数を含む新しいdivを追加 -->
        <div class="flex items-center">
            1.解き直し
            <!-- 連続正解数表示部分 -->
            <div id="continuousCorrect" class="text-left ml-4">
            </div>
        </div>

        <!-- HOMEへのリンク -->
        <div>
            <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
                href="/">HOMEへ</a>
        </div>
    </div>
    @endauth

    <div class="container text-left relative">
        <form action="{{ route('answerrandom.index') }}" method="post" id="kotae"
            class="border-2 border-gray-300 rounded-md p-0 shadow-lg relative">
            @csrf
            <input type="hidden" name="maxQuestions" value="{{ count($questions_a) }}">
            <input type="hidden" name="timeout">
            <input type="hidden" name="start_solving_time" id="start_solving_time">
            @foreach($questionIds as $questionId)
            <input type="hidden" name="question{{ $loop->iteration }}_Id" value="{{ $questionId }}">
            @endforeach

            <div class="flex justify-between m-0">
                <div class="flex-none m-0">
                    【選択肢】
                </div>
                <div class="w-full">
                    <button id="kakutei" type="button"
                        class="h-8 w-full flex justify-center items-center px-0 py-1 border-2 rounded-md bg-gray-200 text-gray-500 border-gray-300 cursor-not-allowed"
                        onclick="buttonClick1()">
                        答え合わせ
                        <div id="countdown-timer" class="text-gray-500"></div>
                    </button>
                </div>
                <div class="w-full">
                    <button type="button"
                        class="h-8 w-full my-0 px-0 py-1 border-2 border-red-500 rounded-md bg-gradient-to-r from-pink-500 to-yellow-500 text-white font-semibold text-sm shadow-lg hover:shadow-xl transition duration-300"
                        onclick="buttonClick2()">
                        選択リセット
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap items-center my-2">
                @foreach($questions_a as $question_a)
                <div id="buttonz-{{ $question_a->id }}">
                    <button type="button" value="{{ $question_a->answer }}" id="button-{{ $question_a->id }}"
                        onclick="buttonClick({{ $question_a->id }})"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-2 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50 text-left mr-1 mb-1">
                        {{$question_a->answer}}
                    </button>
                </div>
                @endforeach
            </div>

            <style>
                .question {
                    transition: all 0.3s ease-in-out;
                    opacity: 0.5;
                }

                .highlighted-question {
                    transform: scale(1.05);
                    background-color: #ffd700;
                    opacity: 1;
                }

                #kakutei {
                    background-color: #e5e7eb;
                    color: #9ca3af;
                    border-color: #d1d5db;
                    cursor: not-allowed;
                }

                #kakutei.enabled {
                    background-color: #34d399;
                    color: white;
                    border-color: #059669;
                    cursor: pointer;
                }
            </style>

            <script>
                let maxQuestions = {{ count($questions_a) }};
                let clickCounter = 1;
                let idousakiCounter = 4;
                let x = 1;
                let arr = [];

                window.onload = function() {
                    // 解き始めの時間を取得して隠しフィールドに設定
// 現在の日時を取得
var now = new Date();

// 日本標準時 (JST) に変換
var jstOffset = 9 * 60 * 60 * 1000; // 9時間分のミリ秒
var jstTime = new Date(now.getTime() + jstOffset);

// ISO 8601形式の文字列に変換
var startTime = jstTime.toISOString().slice(0, -1); // 最後のZを削除

// 隠しフィールドに設定
document.getElementById('start_solving_time').value = startTime;


                    // 最初の問題を強調
                    let firstQuestion = document.getElementById('question-1');
                    if (firstQuestion) {
                        firstQuestion.classList.add('highlighted-question');
                    }

                    var seconds = 120;
                    var display = document.querySelector('#countdown-timer');
                    startCountdown(seconds, display);
                };

                function buttonClick(questionId) {
                    if (arr.length >= maxQuestions) {
                        return;
                    }
                    if (x >= 0) {
                        arr.push(questionId);
                    }

                    let qq = document.getElementById('question-' + clickCounter);
                    let button = document.getElementById('button-' + questionId);
                    let qquestionArea = document.getElementById('q-' + idousakiCounter);
                    let questionArea = document.getElementById('a-' + idousakiCounter);
                    clickCounter++;
                    idousakiCounter++;

                    if (questionArea) {
                        qquestionArea.appendChild(qq);
                        questionArea.appendChild(button);
                        qquestionArea.classList.remove('hidden');
                        qq.classList.remove('mb-2');
                        button.disabled = true;
                    }

                    for (let i = 1; i <= maxQuestions; i++) {
                        let question = document.getElementById('question-' + i);
                        question.classList.remove('highlighted-question');
                    }

                    if (clickCounter <= maxQuestions) {
                        let nextQuestion = document.getElementById('question-' + clickCounter);
                        if (nextQuestion) {
                            nextQuestion.classList.add('highlighted-question');
                        }
                    }

                    if (arr.length === maxQuestions) {
                        let confirmButton = document.getElementById('kakutei');
                        confirmButton.disabled = false;
                        confirmButton.classList.add('enabled');
                    }
                }

                function buttonClick1() {
                    if (arr.length !== maxQuestions) {
                        return;
                    }

                    var kotae = document.getElementById('kotae');
                    document.getElementById('kakutei').type = 'submit';
                    for (let step = 0; step < 8; step++) {
                        var input_data = document.createElement('input');
                        input_data.type = 'hidden';
                        input_data.name = "choice" + (step + 1) + "_Id";
                        input_data.value = arr[step];
                        kotae.appendChild(input_data);
                    }
                }

                function buttonClick2() {
                    clickCounter = 1;
                    idousakiCounter = 4;

                    for (let i = 0; i < arr.length; i++) {
                        let button = document.getElementById('button-' + arr[i]);
                        let motonoId = 'buttonz-' + arr[i];
                        let moto = document.getElementById(motonoId);
                        let qq = document.getElementById('question-' + (i + 1));
                        let qmotonoId = 'questionz-' + (i + 1);
                        let qmoto = document.getElementById(qmotonoId);
                        let qquestionArea = document.getElementById('q-' + (i + 4));

                        if (moto) {
                            moto.appendChild(button);
                            qmoto.appendChild(qq);
                            qq.classList.add('mb-2');
                            qquestionArea.classList.add('hidden');
                            button.disabled = false;
                        }
                    }

                    arr = [];
                    clickCounter = 1;
                    idousakiCounter = 4;

                    let confirmButton = document.getElementById('kakutei');
                    if (confirmButton) {
                        confirmButton.disabled = true;
                        confirmButton.classList.remove('enabled');
                    }

                    highlightFirstQuestion();
                }

                function highlightFirstQuestion() {
                    for (let i = 1; i <= 7; i++) {
                        let question = document.getElementById('question-' + i);
                        if (question) {
                            question.classList.remove('highlighted-question');
                        }
                    }

                    let firstQuestion = document.getElementById('question-1');
                    if (firstQuestion) {
                        firstQuestion.classList.add('highlighted-question');
                    }
                }

                function startCountdown(duration, display) {
                    var timer = duration * 100;
                    var seconds, milliseconds;
                    var countdownInterval = setInterval(function() {
                        milliseconds = parseInt((timer % 100) / 10, 10);
                        seconds = parseInt(timer / 100, 10);

                        if (seconds < 10) {
                            display.style.color = 'red';
                        }

                        display.textContent = "　残" + seconds + "." + (milliseconds < 10 ? "" : "") + milliseconds;

                        if (--timer < 0) {
                            clearInterval(countdownInterval);
                            document.getElementsByName('timeout')[0].value = 'true';
                            document.getElementById('continuousCorrect').textContent = '0問連続';
                            alert('時間切れ（連続正解ストップ）');
                        }
                    }, 10);
                }
            </script>
    </div>
    </form>

    <div class="relative container border-2 border-gray-300 rounded-md p-6 shadow-lg">
        <div class="absolute top-0 left-0">
            【問題】
        </div>

        @foreach($questions_q as $question_q)
        @if ($loop->index <= 7) <div id="questionz-{{ $loop->iteration }}">
            <div id="question-{{ $loop->iteration }}"
                class="question items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1 mb-2">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-6 flex justify-center items-center">
                        <strong class="text-lg text-white text-center">{{$loop->iteration}}問目</strong>
                    </div>
                    <span class="text-xs font-semibold text-right text-white px-2 py-1">
                        ジャンル: {{ $question_q->smallLabel->middleLabel->middle_label }} - {{ $question_q->smallLabel->small_label }}
                    </span>
                </div>
                                <div class="flex-grow ml-1 bg-white p-1 rounded-md shadow">
                    <div class="w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        {{$question_q->question}}
                        <img src="{{ asset($question_q->question_path) }}" class="max-w-none max-h-[280px]">
                    </div>
                </div>
            </div>
    </div>
    @endif
    @endforeach
    </div>

    <div class="relative container border-2 border-gray-300 rounded-md p-4 shadow-lg">
        <div class="absolute top-0 left-0">
            【回答済】
        </div>
        <br>
        <div id="q-4" class="py-0 hidden">出題1問目</div>
        <div id="a-4" class="py-0 text-right"></div>
        <div id="q-5" class="py-0 hidden">出題2問目</div>
        <div id="a-5" class="py-0 text-right"></div>
        <div id="q-6" class="py-0 hidden">出題3問目</div>
        <div id="a-6" class="py-0 text-right"></div>
        <div id="q-7" class="py-0 hidden">出題4問目</div>
        <div id="a-7" class="py-0 text-right"></div>
        <div id="q-8" class="py-0 hidden">出題5問目</div>
        <div id="a-8" class="py-0 text-right"></div>
        <div id="q-9" class="py-0 hidden">出題6問目</div>
        <div id="a-9" class="py-0 text-right"></div>
        <div id="q-10" class="py-0 hidden">出題7問目</div>
        <div id="a-10" class="py-0 text-right"></div>
    </div>
</body>

</html>