<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="format-detection" content="telephone=no">
  <title>【U_00008】パスワード再設定</title>
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
          <form action="{{ route('password.update') }}" method="post" novalidate>
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">{{-- メールごとのトークン --}}

            <input type="hidden" id="email" name="email" value="{{ $email ?? old('email') }}">{{-- メールアドレス情報 --}}

            <section class="panel">
              <header class="panel__header">
                <h1 class="ttl ttl--type2">パスワード再設定</h1>
              </header>
              <div class="panel__content">
                <div class="form">
                  <div class="form__item">
                    <div class="alert">
                      <p class="alert__text">
                        新しく設定するパスワードを2回入力してください。
                      </p>
                    <!-- /.alert --></div>
                  </div>
                  {{-- <div class="form__item">
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
                            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" placeholder="" required readonly>
                          <!-- /.input --></p>
                        </div>
@error('email')
                        <div class="form-data__item">
                          <p class="error">{{ $message }}</p>
                        </div>
@enderror
                        <div class="form-data__item">
                          <ul class="note-list">
                            <li>補足事項</li>
                          <!-- /.note-list --></ul>
                        </div>
                      </dd>
                    <!-- /.form-data --></dl>
                  </div> --}}
                  <div class="form__item">
                    <dl class="form-data">
                      <dt>
                        <span class="label-set">
                          <span class="label-set__item">新パスワード</span>
                          <span class="label-set__item">
                            <span class="label label--required">必須</span>
                          </span>
                        <!-- /.label-set --></span>
                      </dt>
                      <dd>
                        <div class="form-data__item">
                          <p class="input @error('password') input--error @enderror">
                            <input type="password" id="password" name="password" required autofocus>
                          <!-- /.input --></p>
                        </div>
                      </dd>
                    <!-- /.form-data --></dl>
                  </div>
                  <div class="form__item">
                    <dl class="form-data">
                      {{-- <dt>
                        <span class="label-set">
                          <span class="label-set__item">新パスワード（確認用）</span>
                          <span class="label-set__item">
                            <span class="label label--required">必須</span>
                          </span>
                        <!-- /.label-set --></span>
                      </dt> --}}
                      <dd>
                        <div class="form-data__item">
                          <p class="input @error('password') input--error @enderror">
                            <input type="password" id="password-confirm" name="password_confirmation" required>
                          <!-- /.input --></p>
                        </div>
@error('password')
                        <div class="form-data__item">
                          <p class="error">{{ $message }}</p>
                        </div>
@enderror
                        <div class="form-data__item">
                          <ul class="note-list">
                            <li>補足事項</li>
                          <!-- /.note-list --></ul>
                        </div>
                      </dd>
                    <!-- /.form-data --></dl>
                  </div>
                <!-- /.form --></div>
              </div>
              <div class="panel__footer">
                <ul class="btn-list">
                  <li><button type="submit" class="btn">パスワード再設定</button></li>
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




{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">新{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">新{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
