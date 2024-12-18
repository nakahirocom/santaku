<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">

  <title>santakuアプリ</title>
</head>

<body>
  <div class="container">

    <a class="btn btn-link text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
      href="/">HOMEへ</a>
    @auth
    <p class="h2">三択アプリ　Mymemo画面</p>
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

    <form action="{{ route('mymemo.put', ['questionId' => $question->id])
              }}" method="post" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="text-sm">
        <span>分類：
          {{ $question->smallLabel->middleLabel->largeLabel->large_label }}→
          {{ $question->smallLabel->middleLabel->middle_label }}→
          {{ $question->smallLabel->small_label }}</span>
      </div>
      <br>
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

      <span>問題：{{ $question->question }}</span>
      <br>
      <span>question_path：{{ $question->question_path }}</span>
      <br>
      <img src="{{ $question->question_path }}">
      <br />
      <span>答え：{{ $question->answer }}</span>
      <br />
      <span>解説：{{ $question->comment }}</span>
      <br />
      <span>comment_path：{{ $question->comment_path }}</span>
      <br />
      <img src="{{ $question->comment_path }}">


      <br />
      @if($errors->has('mymemo'))
      <p style="color: red;">{{ $errors->first('mymemo') }}</p>
      @endif
      <br />
      <br />
      <div class="col-12">
        <button type="submit" class="btn btn-outline-primary">私のメモを登録</button>
      </div>
    </form>
    <br />

    <form action="{{ route('mymemodelete', ['questionId' => $question->id])
                    }}" method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-outline-danger">私のメモを削除</button>
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