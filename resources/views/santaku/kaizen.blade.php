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

  <title>santakuアプリ</title>
</head>

<body>
  <div class="container">

    <a class="btn btn-link" href="/">index画面へ戻る</a></p>
    @auth

    <h2>三択アプリ　{{ Auth::user()->name }}改善の依頼画面</h2>
    <p>-----------------------------------------------------------------------------------------</p>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    @endauth

    <body>
      <form action="{{ route('kaizen.put', ['questionId' => $question->id])
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
        @if(!$question->Kaizen)
        <!-- ログインユーザーが質問のオーナーで、かつmymemoが存在する場合 -->
        <span>現在の要望：</span>
        <br>
        <span>要望の変更：</span>
        <input type="text" name="kaizen" class="form-control" value="">

        @else
        <!-- 条件に一致しない場合 -->
        <span>現在の要望：{{ $question->Kaizen->kaizen }}</span>
        <br>
        <span>要望の変更：</span>
        <input type="text" name="kaizen" class="form-control" value="{{ $question->Kaizen->kaizen }}"></span>
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
        <span>更新日時：{{ $question->updated_at }}</span>


        <br />
        @if($errors->has('kaizen'))
        <p style="color: red;">{{ $errors->first('kaizen') }}</p>
        @endif
        <br />
        <br />
        <div class="col-12">
          <button type="submit" class="btn btn-outline-primary">改善要望を登録</button>
        </div>
      </form>
      <br />

      <form action="{{ route('kaizendelete', ['questionId' => $question->id])
            }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-outline-danger">改善要望を削除</button>
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








  <div>
    @foreach($kaizens as $kaizen)
    <div>

      <summary>
        <div class="collapse show" id="collapseExample" style="">
          <div class="card card-body">
            <p>投稿者　{{ $kaizen->user->name }}</p>
            <p>要望　{{ $kaizen->kaizen }}</p>
            <p>開発側コメント　{{ $kaizen->developer_comment }}</p>
            <p>更新日　{{ $kaizen->updated_at }}</p>

          </div>
        </div>
      </summary>
    </div>
    <br>
    @endforeach
  </div>
</body>
</div>
</body>