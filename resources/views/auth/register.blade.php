<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="format-detection" content="telephone=no">
  <title>【U_00001】新規登録</title>
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
          <form action="{{ route('register') }}" method="post" novalidate>
            @csrf
            
            <input id="name" type="hidden" name="name" value="do_not_use">

            <section class="panel">
              <header class="panel__header">
                <h1 class="ttl ttl--type2">新規登録</h1>
              </header>
              <div class="panel__content">
                <div class="form">
                  <div class="form__item">
                    <div class="alert alert--info">
                      <p class="alert__text">
                        新「aibo life」のアカウント作成を行います。<br>
                        メールアドレスとパスワードを登録してください。
                      </p>
                    <!-- /.alert --></div>
                  </div>
                  <div class="form__item">
                    <dl class="form-data">
                      <dt>
                        <span class="label-set">
                          <span class="label-set__item">メールアドレス</span>
                          <span class="label-set__item">
                            <span class="label label--required">必須</span>
                          </span>
                        <!-- /.label-set --></span>
                      </dt>
                      <dd>
                        <div class="form-data__item">
                          <p class="input @error('email') input--error @enderror">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="" required autofocus>
                          <!-- /.input --></p>
                        </div>
@error('email')
                        <div class="form-data__item">
                          <p class="error">{{ $message }}</p>
                        </div>
@enderror
                        <div class="form-data__item">
                          <ul class="note-list">
                            <li>旧「aibo life」と異なるメールアドレスでも構いません。</li>
                          <!-- /.note-list --></ul>
                        </div>
                      </dd>
                    <!-- /.form-data --></dl>
                  </div>
                  <div class="form__item">
                    <dl class="form-data">
                      <dt>
                        <span class="label-set">
                          <span class="label-set__item">パスワード</span>
                          <span class="label-set__item">
                            <span class="label label--required">必須</span>
                          </span>
                        <!-- /.label-set --></span>
                      </dt>
                      <dd>
                        <div class="form-data__item">
                          <p class="input @error('password') input--error @enderror">
                            <input type="password" id="password" name="password" placeholder="" required>
                          <!-- /.input --></p>
                        </div>
@error('password')
                        <div class="form-data__item">
                          <p class="error">{{ $message }}</p>
                        </div>
@enderror
                        <div class="form-data__item">
                          <ul class="note-list">
                            <li>半角英数字8文字以上</li>
                          <!-- /.note-list --></ul>
                        </div>
                      </dd>
                    <!-- /.form-data --></dl>
                  </div>
                <!-- /.form --></div>
              </div>
              <div class="panel__footer">
                <ul class="btn-list">
                  <li><button type="submit" class="btn">新規登録</button></li>
                  <li><a href="{{ route('login') }}">ログインする場合はこちら</a></li>
                <!-- /.btn-list --></ul>
              </div>
            <!-- /.panel --></section>
          </form>
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