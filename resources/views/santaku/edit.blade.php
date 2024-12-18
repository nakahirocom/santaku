<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSS only -->
  <link rel="stylesheet" href="/css/app.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>santakuアプリ</title>
</head>

<body>
  <div class="container">

    <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
      href="/">HOMEへ</a>
    @auth
    <p class="h2">三択アプリ　編集・削除画面</p>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><span class="mark">{{ Auth::user()->name }}</span> がログイン中</li>
        <li class="breadcrumb-item active" aria-current="page">ユーザーid{{ Auth::user()->id }}</li>
      </ol>
    </nav>
    @endauth

    <p>-----------------------------------------------------------------------------------------</p>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif





    <form action="{{ route('update.put', ['questionId' => $question->id])
              }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      @if(!$question->Mymemo)
      <!-- ログインユーザーが質問のオーナーで、かつmymemoが存在する場合 -->
      <span>現在のメモ：</span>
      <br>
      <span>メモの変更：</span>
      <input type="text" name="mymemo" class="form-control" value="">

      @else
      <!-- 条件に一致しない場合 -->
      <span>現在のメモ：{{ $question->Mymemo->mymemo }}</span>
      <br>
      <span>メモの変更：</span>
      <input type="text" name="mymemo" class="form-control" value="{{ $question->Mymemo->mymemo }}"></span>
      @endif


      <br />
      <span>編集前の小分類：{{ $question->small_label_id }}</span>
      <input type="text" name="small_label_id" class="form-control" value="{{ $question->small_label_id }}">

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


      <span>編集前の問題：{{ $question->question }}</span>
      <input type="text" name="question" class="form-control" value="{{ $question->question }}">
      @error('question')
      <p style="coler: red;">{{ $message }}</p>
      @enderror
      <br />
      <span>question_path：{{ $question->question_path }}</span>
      <br />

      <img src="{{ $question->question_path }}">
      <br />
      <input type="text" name="question_path" class="form-control" value="{{ $question->question_path }}">


      <!-- 画像アップロード用のinput要素 -->
      <input type="file" name="question_image" id="questionImage" placeholder="画像があればセット">画像あればセット(2MBまで)

      <div id="questionimageContainer" class="mt-4">
        <!-- 画像がここに表示される -->
      </div>




      <br />
      <span>編集前の答え：{{ $question->answer }}</span>
      <input type="text" name="answer" class="form-control" value="{{ $question->answer }}">
      @error('answer')
      <p style="coler: red;">{{ $message }}</p>
      @enderror

      <br />
      <span>編集前の解説：{{ $question->comment }}</span>
      <input type="text" name="comment" class="form-control" value="{{ $question->comment }}">
      @error('comment')
      <p style="coler: red;">{{ $message }}</p>
      @enderror
      <br />
      <span>編集前のcomment_path：{{ $question->comment_path }}</span>
      <br />
      <img src="{{ $question->comment_path }}">


      <br />
      <input type="file" name="comment_image" id="commentImage" placeholder="画像があればセット">画像あればセット(2MBまで)
      <div id="commentimageContainer" class="mt-4">
        <!-- 画像がここに表示される -->
      </div>
      <input type="text" name="comment_path" class="form-control" value="{{ $question->comment_path }}">


      <span>編集前のreference_url：{{ $question->reference_url }}</span>
      <input type="text" name="reference_url" class="form-control" value="{{ $question->reference_url }}">

      <span>編集前のステータス：
        @if($question->status === 0)
          今も使える
        @elseif($question->status === 1)
          審査中
        @elseif($question->status === 2)
          削除予定
        @else
          不明
        @endif
      </span>
      <select name="status" id="status" class="form-control mt-2">
        <option value="">選択してください</option>
        <option value="0" {{ $question->status === 0 ? 'selected' : '' }}>今も使える</option>
        <option value="1" {{ $question->status === 1 ? 'selected' : '' }}>審査中</option>
        <option value="2" {{ $question->status === 2 ? 'selected' : '' }}>削除予定</option>
      </select>

      <br />

      <br />
      <br />
      <div class="col-12">
        <button type="submit" class="btn btn-outline-primary">編集したものを登録する</button>
      </div>
    </form>
    <br />

    <form action="{{ route('delete', ['questionId' => $question->id])
                    }}" method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-outline-danger">この問題を削除</button>
    </form>
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