<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>santakuアプリ</title>
</head>

<body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64 min-h-screen">

    @auth
    <div class="flex justify-between items-center my-4">
        <div class="flex items-center">
            <a class="text-gray-500 hover:text-gray-700 underline transition duration-300 ease-in-out"
                href="/">HOMEへ</a>

            @if ($timeoutuser->user_mode == 0)
            <span class="text-xl font-semibold text-gray-700">0.強制モード</span>
            @else
            <span class="text-xl font-semibold text-gray-700">1.自由ジャンル</span>
            @endif
        </div>
        <span id="continuous-correct-answers" class="text-lg font-medium text-blue-600"></span>
    </div>
    @endauth

    <div class="flex justify-between items-center w-full my-1">
        <button id="show-next-button"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300 ease-in-out">
            結果
        </button>

        <div id="display-area" class="flex items-left justify-start space-x-4">
            <!-- 中間の表示エリアの内容をここに挿入 -->
        </div>

        <button id="next-kekka"
            class="bg-pink-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300 ease-in-out">
            判定
        </button>
    </div>
    <form id="redo-form" action="{{ route('questionredoing') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="missed_question_ids" id="missed-question-ids"
            value="{{ implode(',', $missedQuestionIds) }}">
        <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-2">
            解直し
        </button>
    </form>

    <div id="question-container" class="container mx-auto px-4">
        @for ($i = 0; $i < count($viewModels); $i++) <div class="question-card bg-white rounded-md shadow-lg p-4 mb-4">
            <div class="bg-white rounded-md shadow-lg p-4 mb-4">
                <div class="flex items-center justify-between">

                    <h2 class="text-xl font-bold text-gray-800">{{$i+1}}問目</h2>
                    <div id="answer-status-{{ $i }}"
                        class="hidden mt-0 p-1 rounded-md text-lg font-bold text-left mr-auto block">
                    </div>

                    <div class="mt-2 text-sm">
                        <p>あなた正解率:{{ $uidseikairituModels[$i] }}% / 総回答数:{{ $uidkaitousuuModels[$i] }}</p>
                        <p>みんな正解率:{{ $allseikairituModels[$i] }}% / 総回答数:{{ $allkaitousuuModels[$i] }}</p>
                    </div>

                </div>

                <div class="bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-2 my-0">
                    <p class="text-white text-lg">{{ $viewModels[$i]->getQuestion() }}</p>
                    <img src="{{ $viewModels[$i]->getQuestion_path() }}"
                        class="mt-2 w-full h-auto max-h-[300px] object-cover rounded-md shadow-md">
                </div>

                <div class="flex flex-col justify-end items-end">
                    <!-- Incorrect button -->
                    <div class="text-sm mb-1">

                        <button type="button" value="{{ $viewModels[$i]->getAnswer() }}"
                            class="answer-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50"
                            data-correct="{{ $viewModels[$i]->isCorrect() ? 'true' : 'false' }}">
                            {{ $viewModels[$i]->getmissAnswer() }}
                        </button>
                    </div>
                </div>

                <summary class="text-blue-600 font-bold cursor-pointer">問題・答え・解説を見る</summary>

                @if ($viewModels[$i]->isCorrect() )
                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">
                    <div class="w-12 h-6 flex items-center">
                        <strong class="text-xs text-white">{{$i+1}}</strong>
                    </div>
                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getComment() }}

                    </div>
                    <div class="w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>

                    私のメモ:{{ $viewModels[$i]->getMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getReference_url() }}

                </div>
                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    私のメモ
                </a>

                <a href="{{ $viewModels[$i]->getComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">添付File</a>

                <a href="{{ $viewModels[$i]->getReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">参考サイト</a>


                @auth
                @if (auth()->user()->id == $viewModels[$i]->getUser_id())
                <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">問題編集</a>
                @else
                <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    改善要望
                </a>


                @endif
                @endauth




                <br>

                @else




                <div>【出題問題セット】</div>
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

                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">

                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getComment() }}
                    </div>
                    <div class="w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>
                    私のメモ:{{ $viewModels[$i]->getMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getReference_url() }}
                </div>

                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    私のメモ
                </a>
                <a href="{{ $viewModels[$i]->getComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">添付File</a>

                <a href="{{ $viewModels[$i]->getReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">参考サイト</a>

                @auth
                @if (auth()->user()->id == $viewModels[$i]->getUser_id())
                <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">問題編集</a>
                @else
                <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    改善要望
                </a>


                @endif
                @endauth

                <br>
                <br>
                <div>【選択ミス問題セット】</div>
                <div id="question-{{ $i }}"
                    class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
                    <div class="w-14 h-6 flex justify-center items-center">
                        <strong class="text-lg text-white text-center">{{$i+1}}</strong>
                    </div>
                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        {{ $viewModels[$i]->getmissQuestion() }}
                        <div class="w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

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
                        </button>
                    </div>
                </div>

                <div class="items-center bg-gradient-to-r from-gray-400 to-yellow-500 rounded-lg shadow-xl p-1">


                    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">
                        解説:{{ $viewModels[$i]->getmissComment() }}
                    </div>
                    <div class="w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                        <img src="{{ $viewModels[$i]->getmissComment_path() }}" class="max-w-none max-h-[300px]">
                    </div>
                    私のメモ:{{ $viewModels[$i]->getmissMymemo() }}
                    <br>
                    添付File{{ $viewModels[$i]->getmissComment_path() }}
                    <br>
                    参考URL{{ $viewModels[$i]->getmissReference_url() }}

                </div>

                <a href="{{ route('mymemo', ['questionId' => $viewModels[$i]->getmissAnswerId()]) }}"
                    class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    私のメモ
                </a>
                <a href="{{ $viewModels[$i]->getmissComment_path() }}" download="添付File"
                    class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">添付File</a>

                <a href="{{ $viewModels[$i]->getmissReference_url() }}" download="参考URL"
                    class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">参考サイト</a>



                @auth
                @if (auth()->user()->id == $viewModels[$i]->getUser_id())
                <a href="{{ route('edit', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">問題編集</a>
                @else
                <a href="{{ route('kaizen', ['questionId' => $viewModels[$i]->getAnswerId()]) }}"
                    class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out mx-1">
                    改善要望
                </a>


                @endif
                @endauth


                <br>
                <div>
                </div>

                @endif


            </div>
    </div>
    @endfor
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nextKekkaButton = document.getElementById('next-kekka');
            const answerButtons = document.querySelectorAll('.answer-button');
            let currentAnswerIndex = 0;

            nextKekkaButton.addEventListener('click', function () {
                if (currentAnswerIndex < answerButtons.length) {
                    answerButtons[currentAnswerIndex].click();
                    currentAnswerIndex++;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const questionContainer = document.getElementById('question-container');
        const questionCards = document.querySelectorAll('.question-card');
        let currentCardIndex = 0; // 現在のカードのインデックス
        const totalCards = questionCards.length; // カードの総数
        const nextKekkaButton = document.getElementById('next-kekka');
    
        nextKekkaButton.addEventListener('click', function () {
            // カードを次に進める
            const currentCard = questionCards[currentCardIndex];
            questionContainer.appendChild(currentCard);
            currentCardIndex = (currentCardIndex + 1) % totalCards;
    
            // 画面をスクロールしてトップに表示
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const questionContainer = document.getElementById('question-container');
            const questionCards = document.querySelectorAll('.question-card');
            let currentCardIndex = 0;  // 現在のカードのインデックス
            let displayedCardsCount = 0;  // 表示済みのカード数
            const totalCards = questionCards.length;  // カードの総数
            const displayArea = document.getElementById('display-area'); // 結果表示エリア
            let continuousCorrectAnswers = 0;  // 連続正解数
            
            document.querySelectorAll('.answer-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    // 現在のカードを最後に移動
                    const currentCard = questionCards[currentCardIndex];
                    questionContainer.appendChild(currentCard);
        
                    // 次のカードのインデックスを計算
                    currentCardIndex = (currentCardIndex + 1) % questionCards.length;
                    displayedCardsCount++;  // 表示済みカード数を更新
                    
                // 一巡した後は連続正解数を更新しない
                if (displayedCardsCount <= totalCards) {
                    const isCorrect = button.getAttribute('data-correct') === 'true';
                    const resultText = document.createElement('div');
                    resultText.textContent = displayedCardsCount + '問' +
                        (isCorrect ? '⭕️' : '❌');
                    resultText.className = isCorrect ? 'text-green-600' : 'text-red-600';
                    displayArea.appendChild(resultText);
        
                    if (isCorrect) {
                        continuousCorrectAnswers++;  // 正解の場合のみカウントを増やす
                        remaining--;
                    } else {
                        continuousCorrectAnswers = 0;  // 不正解の場合はリセット
                        allCorrect = false;
                        missedQuestions.push(button.getAttribute('data-question-id'));
                    }
                }
        
        
                    // ページ全体を<body>の最上部から表示させる
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        });
        
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var isFirstClick = true;
    var continuousCorrectAnswers = {{ $timeoutuser->continuous_correct_answers }};
    var basicCount = {{ $timeoutuser->basic_count }};
    var baseContinuousCorrectAnswers = {{ $timeoutuser->base_continuous_correct_answers }};
    var remaining = basicCount - baseContinuousCorrectAnswers;
    var continuousCorrectAnswersSpan = document.getElementById('continuous-correct-answers');
    var allCorrect = true;
    var missedQuestions = [];
    var answeredQuestionsCount = 0; // 回答済みの問題数を追跡
    var totalQuestions = document.querySelectorAll('.answer-button').length; // 問題の総数

    updateContinuousCorrectAnswersText();

    function updateContinuousCorrectAnswersText() {
        if ({{ $timeoutuser->user_mode }} == 0) {
            continuousCorrectAnswersSpan.textContent = 'あと' + remaining + '問で開放';
        } else {
            continuousCorrectAnswersSpan.textContent = continuousCorrectAnswers + ' 問連続正解中';
        }
    }

    document.querySelectorAll('.answer-button').forEach(function (button, index) {
        button.addEventListener('click', function () {
            var isCorrect = button.getAttribute('data-correct') === 'true';
            var answerStatus = document.getElementById('answer-status-' + index); // 回答状況の表示領域

            answerStatus.classList.remove('hidden'); // 表示する

            if (answeredQuestionsCount < totalQuestions) {
                if (isCorrect) {
                    answerStatus.textContent = '⭕️';
                    answerStatus.classList.add('text-green-600'); // 正解の場合の色
                    continuousCorrectAnswers++;
                    remaining--;
                } else {
                    answerStatus.textContent = '❌';
                    answerStatus.classList.add('text-red-600'); // 不正解の場合の色
                    continuousCorrectAnswers = 0;
                    remaining = basicCount;
                    allCorrect = false;
                    missedQuestions.push(button.getAttribute('data-question-id'));
                }

                answeredQuestionsCount++; // 回答済みの問題数を更新
            }

            updateContinuousCorrectAnswersText();

            if (index >= totalQuestions - 1) {
                showResult();
            }
        });
    });

    function showResult() {
        var button = document.getElementById('show-next-button');
        if (allCorrect) {
            button.textContent = '次へ';
            button.classList.replace('bg-blue-500', 'bg-green-500');
            button.classList.replace('hover:bg-blue-700', 'hover:bg-green-700');
        } else {
            button.textContent = '解直し';
            button.classList.replace('bg-blue-500', 'bg-red-500');
            button.classList.replace('hover:bg-blue-700', 'hover:bg-red-700');
        }

        button.addEventListener('click', function () {
            if (allCorrect) {
                window.location.href = '/questionrandom';
            } else {
                document.getElementById('redo-form').submit();
            }
        });

        @if (session('message'))
        Swal.fire({
            title: 'ジャンル開放',
            text: '{{ session('message') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = "{{ route('index') }}";
        });
        @endif
    }
});  


    </script>


</body>

</html>