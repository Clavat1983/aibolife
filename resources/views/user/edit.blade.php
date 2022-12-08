<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>aibo life</title>
    <meta name="description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:title" content="aibo life" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../../assets/images/ogp.png"
    />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:site_name" content="aibo life" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="{{url()->full()}}" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />

    <!-- Google Ad -->
    @include('subview.google-ad')
    
  </head>

  <body id="pagetop">
    <div class="l-wrap">
      
      {{-- 【共通】header & nav --}}
      @include('subview.header-nav')

      {{-- main(各画面の個別部分) --}}
      <main class="l-main">
        <div class="l-main__content">
          <div class="l-content">
{{-- --------------------------------------------------------------------------- --}}
            <div class="l-content__header">
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">My Page</span>
                <span class="c-category-ttl__jp">マイページ［ログイン情報編集］</span>
              </p>
            </div>
            <div class="l-content__body">

                <div>
                    ログインに使用するメールアドレス・パスワードを変更できます。<br>
                    なお、メールアドレスを変更した場合は、再度、メール認証が必要です。<br><br>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            【エラー】<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            【メッセージ】<br>
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

                <hr>
                <br>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('user.update', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="email">メールアドレス</label>
                            <input type="text" name="email" id="email" value="{{old('email', $user->email)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password">新パスワード</label>
                            <input type="password" name="password" id="password" value="">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password_confirmation">新パスワード（再入力）</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" value="">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">変更</button>

                    </form>
                    
                    <br>
                    <a href="{{route('mypage')}}"><button type="button">戻る</button></a>

                </div>


            </div>

{{-- --------------------------------------------------------------------------- --}}
        </div>
    </div>

{{-- 【共通】バナー広告 --}}
@include('subview.banner')

</main>

{{-- 【共通】footer --}}
@include('subview.footer')

</div>
<script type="module" src="{{asset('js/common.js')}}"></script>
</body>
</html>







{{-- @extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン情報編集</div>

                <div class="card-body">
                    ログインに使用するメールアドレス・パスワードを変更できます。<br>
                    なお、メールアドレスを変更した場合は、再度、メール認証が必要です。<br><br>
                    ログインしているユーザのID：{{auth()->user()->id}}<br>
                    編集対象のユーザID：{{$user->id}}<br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('user.update', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="email">メールアドレス</label>
                            <input type="text" name="email" id="email" value="{{old('email', $user->email)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password">新パスワード</label>
                            <input type="password" name="password" id="password" value="">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password_confirmation">新パスワード（確認用）</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" value="">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">変更</button>

                    </form>
                    
                    <a href="{{route('mypage')}}"><button type="button">マイページに戻る</button></a>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection --}}
