<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>santakuアプリ</title>
</head>

<body>
  <div class="container">

    <a class="btn btn-link" href="/">index画面へ戻る</a></p>
    @auth

    <h2>三択アプリ　{{ Auth::user()->name }}が作った問題一覧画面</h2>
    <p>-----------------------------------------------------------------------------------------</p>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    @endauth

    <body>
      <div>
        @foreach($questionList as $question)
        <div>

          <summary>
            <div class="collapse show" id="collapseExample" style="">
              <div class="card card-body">

                <p>問題　{{ $question->question }}</p>
                <p>答え　{{ $question->answer }}</p>
                <p>解説　{{ $question->comment }}</p>
                <p>添付File　{{ $question->comment_path }}</p>
                <p>参考URL　{{ $question->reference_url }}</p>
              </div>
            </div>
          </summary>
          <a href="{{ $question->comment_path }}" download="添付File">添付File</a>

            <a href="{{ $question->reference_url }}" download="参考URL">参考URL</a>

          <form action="{{ route('edit', ['questionId' => $question->id]) }}">
            @method('EDIT')
            @csrf
            <button class="btn btn-outline-primary" type="submit">編集する</button>
            <form action="{{ route('delete', ['questionId' => $question->id]) }}" method="post">
              @method('DELETE')
              @csrf
              <button class="btn btn-outline-danger" type="submit">削除する</button>

              <form action="{{ route('mymemo', ['questionId' => $question->id]) }}" method="post">
                @method('POST')
                @csrf
                <button class="btn btn-outline-danger" type="submit">メモする</button>
  
              </form>
            </form>
        </div>
        <br>
        @endforeach
      </div>
    </body>
  </div>
</body>