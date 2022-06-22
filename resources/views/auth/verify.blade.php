<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="format-detection" content="telephone=no">
  <title>【U_00001】メール認証</title>
  <meta name="description" content="">
  
  <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
  <link rel="icon" href="{{asset('img/favicon.ico')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/foundation.css')}}">
  <link rel="stylesheet" href="{{asset('css/layout.css')}}">
  <link rel="stylesheet" href="{{asset('css/object.css')}}">
  
  
</head>
<body>
  <div class="wrap">
    <main class="external-content">
      <div class="external-content__inner">
        
        <div class="external-content__header">
          <p class="img">
            <img src="{{asset('img/logo_horizontal.svg')}}" alt="" width="161" height="150">
          <!-- /.img --></p>
        </div>
        <div class="external-content__body">
            <section class="panel">
              <header class="panel__header">
                <h1 class="ttl ttl--type2">メール認証</h1>
              </header>
              <div class="panel__content">
                <div class="form">
                  <div class="form__item">
@if (session('resent'))
                    <div class="alert">
                        <p class="alert__text">メールを再送しました。</p>
                    <!-- /.alert --></div>
@endif
                    <div class="alert" style="margin-top:8px;">
                      <p class="alert__text">
                        入力されたメールアドレスに「アカウント作成」のお知らせメールを送付しました。<br/>
                        1時間以内にお知らせメール内に記載されたURLをクリックし、引き続きオーナー登録をお願いします。<br/>
                        （迷惑メールフォルダなどに振り分けられていないかもご確認ください）<br>
                        <br/>
                        お知らせメールが届いていない場合は、別のメールアドレスで「アカウント作成」を改めて実施いただくか、「メール再送」ボタンをクリックしてください。
                      </p>
                    <!-- /.alert --></div>
                  </div>
                <!-- /.form --></div>
              </div>
              <div class="panel__footer">
                <form action="{{route('verification.resend') }}" name="resend" method="post" novalidate>
                    @csrf
                    <ul class="btn-list">
                        <li><button type="submit" class="btn">メール再送</button></li>
                    <!-- /.btn-list --></ul>
                </form>
                <form action="{{route('logout') }}" name="logout" method="post">
                    @csrf
                    <ul class="btn-list">
                        <li style="margin-top:8px;"><a href="javascript:logout.submit()">新規登録する場合はこちら</a></li>
                    <!-- /.btn-list --></ul>
                </form>
              </div>
            <!-- /.panel --></section>
        </div>
      </div>
    <!-- /.external-content --></main>
    <footer class="external-footer">
      <div class="external-footer__inner">
        <p class="external-footer__item">
          <small class="copyright">©︎ 2022 aibo life</small>
        </p>
        <div class="external-footer__item">
          <nav class="external-footer__nav">
            <ul class="external-footer__nav-list">
              <li><a href="#">プライバシーポリシー</a></li>
              <li><a href="#">利用規約</a></li>
            </ul>
          </nav>
        </div>
      </div>
    <!-- /.external-footer --></footer>
  <!-- /.wrap --></div>

  <script src="{{asset('js/libs/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('js/common.js')}}"></script>

  
</body>

</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メール認証</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            メールを再送付しました。
                        </div>
                    @endif

                    入力されたメールアドレスに「アカウント作成」のお知らせメールを送付しました。<br/>
                    1時間以内にお知らせメール内に記載されたURLをクリックし、引き続きオーナー登録をお願いします。<br/>
                    （迷惑メールフォルダなどに振り分けられていないかもご確認ください）<br>
                    <br/>
                    お知らせメールが届いていない場合は、別のメールアドレスで「アカウント作成」を改めて実施いただくか、「メール再送」ボタンをクリックしてください。<br><br>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="bottun" class="btn btn-primary">メール再送</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
