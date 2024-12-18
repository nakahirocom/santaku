<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Tailwind CSSのみ -->

  <link rel="stylesheet" href="/css/app.css">
  <title>santakuアプリ</title>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      form.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
          event.preventDefault();
          return false;
        }
      });
    });
  </script>

</head>


<body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64">
  <div class="container mx-auto p-4">
    <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
      href="/">HOMEへ</a>

    @auth
    <p class="text-2xl font-bold">三択アプリ　新しく問題を登録する</p>

    @endauth
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    <br>

    <form method="post" action="{{ route('create.index') }}" enctype="multipart/form-data">
      @csrf

      <input type="text" name="small_label_id" class="form-control" placeholder="ジャンル１つ選ぶ"
        value="{{ old('small_label_id') }}">ジャンル選択

      <body class="bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100 px-4 sm:px-8 lg:px-64">
        <!-- 他のコンテンツ -->

        <div class="container text-left relative">
          @foreach($largelabelList as $largelabel)
          <div class="flex flex-col justify-between m-0">
            <div class="font-bold text-lg">
              分類：{{ $largelabel->large_label }}
            </div>

            <div class="flex flex-wrap gap-x-4 gap-y-2">
              @foreach ($middlelabelList as $middlelabel)
              @if($largelabel->id == $middlelabel->large_label_id)
              <div class="flex flex-col">
                <span class="font-semibold text-sm">{{ $middlelabel->middle_label }}</span>

                @foreach ($smalllabelList as $smalllabel)
                @if ($middlelabel->id == $smalllabel->middle_label_id)
                <label class="flex items-center space-x-3">
                  <input type="checkbox" class="single-checkbox form-checkbox h-5 w-5 text-blue-600"
                    data-small-label-id="{{ $smalllabel->id }}">
                  <span class="text-sm">{{ $smalllabel->small_label }}</span>
                </label>
                @endif
                @endforeach
              </div>
              @endif
              @endforeach
            </div>
          </div>
          <br>
          @endforeach
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.single-checkbox');
        var inputField = document.querySelector('input[name="small_label_id"]'); // 入力フィールドを取得
      
        checkboxes.forEach(function(checkbox) {
          checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
              // チェックされた場合、データ属性からIDを取得し、入力フィールドに設定
              inputField.value = checkbox.getAttribute('data-small-label-id');
      
              // 他のすべてのチェックボックスをクリア
              checkboxes.forEach(function(other) {
                if (other !== checkbox) {
                  other.checked = false;
                }
              });
            } else {
              // チェックが外れた場合、入力フィールドをクリア
              inputField.value = '';
            }
          });
        });
      });
        </script>
      </body>



      <input type="text" name="question" class="form-control" placeholder="問題を登録" value="{{ old('question') }}">
      @error('question')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
<br>
      <input type="text" name="question_path" class="form-control" placeholder="問題の添付ファイルpath" value="{{ old('question_path') }}">


      <!-- 画像アップロード用のinput要素 -->
      <input type="file" name="question_image" id="questionImage" placeholder="画像があればセット">画像あればセット(2MBまで)
      <div id="questionimageContainer" class="mt-4">
        <!-- 画像がここに表示される -->
      </div>
<br>
      <input type="text" name="answer" class="form-control" placeholder="答えを登録" value="{{ old('answer') }}">
      @error('answer')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
<br>
      <br>

      <input type="text" name="comment" class="form-control" placeholder="コメント・解説を登録" value="{{ old('comment') }}">
      @error('comment')
      <p class="text-red-500">{{ $message }}</p>
      @enderror
      <br>
      <input type="text" name="comment_path" class="form-control" placeholder="コメントの添付ファイルpath" value="{{ old('comment_path') }}">
      <input type="file" name="comment_image" id="commentImage" placeholder="画像があればセット">画像あればセット(2MBまで)
      <div id="commentimageContainer" class="mt-4">
        <!-- 画像がここに表示される -->
      </div>
      <br>
      <input type="text" name="reference_url" class="form-control" placeholder="参考URLあれば" value="{{ old('reference_url') }}">

      <br/>
      <label for="status" class="block font-bold mt-4">今も使えるor審査中。を選択</label>
      <select name="status" id="status" class="form-control mt-2">
        <option value="">選択してください</option>
        <option value="0">今も使える</option>
        <option value="1">審査中</option>
      </select>
      @error('status')
      <p class="text-red-500">{{ $message }}</p>
      @enderror

      <div class="text-center">
        <button type="submit"
          class="bg-gradient-to-br from-blue-300 to-blue-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">新規登録し確認</button>
      </div>
      <br />
    </form>
    </p>
  </div>
  <script>
    document.getElementById('questionImage').addEventListener('change', function(event) {
      const imageContainer = document.getElementById('questionimageContainer');
      imageContainer.innerHTML = ''; // コンテナをクリア

      const file = event.target.files[0];
      const imgElement = document.createElement('img');
      imgElement.classList.add('w-full'); // Tailwind CSSを適用
      imgElement.src = URL.createObjectURL(file);
      imageContainer.appendChild(imgElement);
    });

    document.getElementById('commentImage').addEventListener('change', function(event) {
      const imageContainer = document.getElementById('commentimageContainer');
      imageContainer.innerHTML = ''; // コンテナをクリア

      const file = event.target.files[0];
      const imgElement = document.createElement('img');
      imgElement.classList.add('w-full'); // Tailwind CSSを適用
      imgElement.src = URL.createObjectURL(file);
      imageContainer.appendChild(imgElement);
    });

  </script>

</body>

</html>