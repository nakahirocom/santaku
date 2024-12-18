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

<body class="min-h-screen bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100">
  <div class="container mx-auto px-4 sm:px-8 lg:px-16">

    @auth
    @if (session('feedback.success'))
    <p class="text-green-500">{{ session('feedback.success') }}</p>
    @endif
    <div class="flex justify-between items-center">
      <div class="flex items-center">
        3.間違えた問題を直近から30問まで確認
    </div>

      <div>
        <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
          href="/">HOMEへ</a>
      </div>
    </div>
    @endauth

    <!-- 前の要素に戻るボタン -->
    <button id="show-prev-button" type="button"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
      前の問題を表示</button>
    <!-- 表示用ボタン -->
    <button id="show-next-button" type="button"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
      次の問題を表示</button>
    <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">

    </div>




    <div class="container text-left relative">
      <div class="border-2 border-gray-300 rounded-md p-1 shadow-lg relative">

        @csrf
        <div id="display-area" class="incorrect-item flex flex-col">
          <!-- 表示エリア。ここにforeachループの要素が表示される -->
        </div>
        @foreach($incolist as $incorrect)
        <div id="item-{{ $loop->index }}" class="incorrect-item flex flex-col" style="display:none;">


          <div class="flex flex-col">

            <div class="text-sm">
              <span>ジャンル：
                {{ $incorrect->syutudai->smallLabel->middleLabel->largeLabel->large_label }}→
                {{ $incorrect->syutudai->smallLabel->middleLabel->middle_label }}→
                {{ $incorrect->syutudai->smallLabel->small_label }}</span>

            </div>

            <div class="text-xs">{{ $incorrect->inco->updated_at}}</div>
          </div>

          <div id="question-{{ $loop->iteration }}"
            class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
            <div class="w-14 h-6 flex justify-center items-center">

              <strong class="text-lg text-white text-center">{{$loop->iteration}}</strong>
            </div>

            <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">
              {{$incorrect->syutudai->question}}
              <img src="{{ asset($incorrect->syutudai->question_path) }}" class="max-w-none max-h-[300px]">
            </div>

          </div>



          <div class="flex flex-col justify-end items-end">
            <!-- Incorrect button -->
            <div class="text-sm mb-1">
              <button type="button" id="button-{{ $incorrect->syutudai->id }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-2 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50 text-left mr-1 mb-1">
                {{ $incorrect->matigai->answer }}
              </button>❌
            </div>
          </div>

          <div class="justify-start">

            <details class="my-0">
              <summary class="text-lg font-bold text-blue-600 hover:text-blue-800 cursor-pointer">
                問題・答え・解説を見る
              </summary>



              <div>問題側セットと編集ボタン</div>

              <div id="question-{{ $loop->iteration }}"
                class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
                <div class="w-14 h-6 flex justify-center items-center">
                  <strong class="text-lg text-white text-center">{{$loop->iteration}}</strong>
                </div>

                <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                  {{$incorrect->syutudai->question}}
                  <img src="{{ asset($incorrect->syutudai->question_path) }}" class="max-w-none max-h-[300px]">
                </div>
              </div>

              <div class="flex flex-col justify-end items-end">
                <!-- Incorrect button -->
                <div class="text-sm mb-1">
                  <button type="button" id="button-{{ $incorrect->syutudai->id }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-2 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50 text-left mr-1 mb-1">
                    {{ $incorrect->syutudai->answer }}
                  </button>-
                </div>
              </div>
              解説

              <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                {{$incorrect->syutudai->comment}}
                <img src="{{ asset($incorrect->syutudai->comment_path) }}" class="max-w-none max-h-[300px]">
              </div>
              @if(!$incorrect->syutudai->mymemo)
              <!-- ログインユーザーが質問のオーナーで、かつmymemoが存在する場合 -->
              <span>現在のメモ：</span>
              @else
              <!-- 条件に一致しない場合 -->
              <span>現在のメモ：{{ $incorrect->syutudai->mymemo->mymemo }}</span>
              @endif
              <br>
              添付File{{ $incorrect->syutudai->comment_path }}
              <br>
              参考URL{{ $incorrect->syutudai->reference_url }}

              <div>
                <a href="{{ $incorrect->syutudai->comment_path }}" download="添付File"
                  class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">添付File</a>

                <a href="{{ $incorrect->syutudai->reference_url }}" download="参考URL"
                  class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">参考URL</a>

                <a href="{{ route('edit', ['questionId' => $incorrect->syutudai->id]) }}"
                  class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                  編集
                </a>
                <a href="{{ route('kaizen', ['questionId' => $incorrect->syutudai->id]) }}"
                  class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                  投稿
                </a>
                <a href="{{ route('mymemo', ['questionId' => $incorrect->syutudai->id]) }}"
                  class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                  私のメモ
                </a>

              </div>
              <br>
              <br>
              <br>

              <div>選択ミス側セットと編集ボタン</div>
              <div id="question-{{ $loop->iteration }}"
                class="flex items-center bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg shadow-xl p-1">
                <div class="w-14 h-6 flex justify-center items-center">
                  <strong class="text-lg text-white text-center">{{$loop->iteration}}</strong>
                </div>
                <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">

                  <div class="overflow-auto w-full max-w-none flex-grow ml-1 bg-white p-0 rounded-md shadow">

                    {{$incorrect->matigai->question}}
                    <img src="{{ asset($incorrect->matigai->question_path) }}" class="max-w-none max-h-[300px]">
                  </div>

                </div>
              </div>
              <div class="flex flex-col justify-end items-end">
                <!-- Incorrect button -->
                <div class="text-sm mb-1">
                  <button type="button" value="{{ $incorrect->matigai->answer }}"
                    id="button-{{ $incorrect->matigai->id }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-2 rounded-md shadow-inner transition duration-300 ease-in-out focus:outline-none disabled:opacity-50 text-left mr-1 mb-1">
                    {{ $incorrect->matigai->answer }}
                  </button>-
                </div>
              </div>
              <br>

              <div class="flex-grow ml-1 bg-white p-0 rounded-md shadow">

                解説:{{$incorrect->matigai->comment}}

                <img src="{{ asset($incorrect->matigai->comment_path) }}" class="max-w-none max-h-[300px]">
              </div>
              @if(!$incorrect->matigai->mymemo)
              <!-- ログインユーザーが質問のオーナーで、かつmymemoが存在する場合 -->
              <span>現在のメモ：</span>
              @else
              <!-- 条件に一致しない場合 -->
              <span>現在のメモ：{{ $incorrect->matigai->mymemo->mymemo }}</span>
              @endif
              <br>
              添付Fiel{{ $incorrect->matigai->comment_path }}
              <br>
              参考URL{{ $incorrect->matigai->reference_url }}

              <br>
              <a href="{{ $incorrect->matigai->comment_path }}" download="添付File"
                class="bg-red-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">添付File</a>

              <a href="{{ $incorrect->matigai->reference_url }}" download="参考URL"
                class="bg-orange-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">参考URL</a>


              <a href="{{ route('edit', ['questionId' => $incorrect->matigai->id]) }}"
                class="bg-green-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                編集
              </a>
              <a href="{{ route('kaizen', ['questionId' => $incorrect->matigai->id]) }}"
                class="bg-blue-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                投稿
              </a>
              <a href="{{ route('mymemo', ['questionId' => $incorrect->matigai->id]) }}"
                class="bg-pink-500 text-white font-bold py-1 px-1 rounded hover:bg-green-700 transition duration-300 ease-in-out">
                私のメモ
              </a>

          </div>


          </details>
        </div>
      </div>
      <br>


      @endforeach

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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var current = 0; // 現在の要素のインデックス
      var max = {{ count($incolist) }}; // 要素の合計数
      var displayArea = document.getElementById('display-area'); // 表示エリア
      var nextButton = document.getElementById('show-next-button');
      var prevButton = document.getElementById('show-prev-button');

      nextButton.addEventListener('click', function() {
        current = (current + 1) % max; // インデックスをインクリメントし、必要ならループする
        displayContent(current);
        updateButtonState();
      });

      prevButton.addEventListener('click', function() {
        if (current > 0) {
          current--; // インデックスをデクリメント
        } else {
          current = max - 1; // リストの最後に移動
        }
        displayContent(current);
        updateButtonState();
      });

      function displayContent(index) {
        var content = document.getElementById('item-' + index).innerHTML;
        displayArea.innerHTML = content; // 表示エリアに内容を挿入
      }

      function updateButtonState() {
        prevButton.disabled = false;
        nextButton.disabled = false;
      }

      // 初期化
      if (max > 0) {
        displayContent(0);
        updateButtonState();
      }
    });
  </script>
  </div>
</body>

</html>