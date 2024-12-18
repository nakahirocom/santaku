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

    <a class="btn btn-link" href="/">HOME画面へ戻る</a></p>
    @auth

    <h2>三択アプリ　{{ Auth::user()->name }}の要望一覧</h2>
    <p>-----------------------------------------------------------------------------------------</p>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    @endauth

    <body>
      <div>
        @foreach($kaizenlist as $kaizen)
        <div>

          <summary>
            <div class="collapse show" id="collapseExample" style="">
              <div class="card card-body">
                <div class="text-sm">
                  <span>分類：
                    {{ $kaizen->question->smallLabel->middleLabel->largeLabel->large_label }}→
                    {{ $kaizen->question->smallLabel->middleLabel->middle_label }}→
                    {{ $kaizen->question->smallLabel->small_label }}</span>
                </div>

                <p>私の要望　{{ $kaizen->kaizen }}</p>
                <p>要望日時　{{ $kaizen->updated_at }}</p>
                <span>問題　{{ $kaizen->question->question }}</span>
                <img src="{{ $kaizen->question->question_path }}">
                <span>答え　{{ $kaizen->question->answer }}</span>
                <span>解説　{{ $kaizen->question->comment }}</span>
                <img src="{{ $kaizen->question->comment_path }}">
              </div>
            </div>
          </summary>
          <br>
          添付File:{{ $kaizen->question->comment_path }}
          <br>
          <a href="{{ $kaizen->question->comment_path }}" download="添付File">添付File</a>
          <br>
          参考URL:{{ $kaizen->question->reference_url }}
          <br>
          <a href="{{ $kaizen->question->reference_url }}" download="参考URL">参考URL</a>


          <form action="{{ route('kaizen', ['questionId' => $kaizen->question_id]) }}">

            @csrf

            <button class="btn btn-outline-primary" type="submit">私の要望を編集する</button>
          </form>


          <form action="{{ route('edit', ['questionId' => $kaizen->question_id]) }}">
            @method('EDIT')
            @csrf
            <button class="btn btn-outline-primary" type="submit">問題を編集する</button>
          </form>

          <form action="{{ route('delete', ['questionId' => $kaizen->id]) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-danger" type="submit">問題を削除する</button>

          </form>
        </div>
        <br>
        @endforeach
      </div>
    </body>
  </div>
</body>