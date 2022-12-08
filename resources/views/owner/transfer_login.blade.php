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
                <span class="c-category-ttl__en">Registration</span>
                <span class="c-category-ttl__jp">利用登録［データ引継］</span>
              </p>
            </div>
            <div class="l-content__body">

                <p><b>旧「aibo life」（スマホアプリ版）でのログイン情報を入力してください。</b><br>
                　過去の登録内容・投稿・コメントなどのデータが移行された状態でご利用いただけます。<br>
                　※旧「aibo life」のログイン情報が不明な方は、お問い合わせください。<br>
                　　新規登録は過去のデータが移行されないだけでなく、重複登録となる場合があるため、おやめください。
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <hr>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>[E]{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        [M]{{ session('message') }}
                    </div>
                @endif
                
                <hr>

                <div style="width:80%; margin:auto;">

                    <form method="POST" action="{{route('owner.transfer_result')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="radio" id="pattern1" name="pattern" value="1" {{ old('pattern','1') == '1' ? 'checked' : '' }}><label for="pattern1">ログインIDとパスワードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_id">ログインID（旧）</label>
                            <input type="text" name="owner_old_login_id" id="owner_old_login_id" value="{{old('owner_old_login_id')}}"><br/>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_password">パスワード（旧）</label>
                            <input type="password" name="owner_old_login_password" id="owner_old_login_password" value="{{old('owner_old_login_password')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <input type="radio" id="pattern2" name="pattern" value="2" {{ old('pattern') == '2' ? 'checked' : '' }}><label for="pattern2">セキュリティコードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_security_code">セキュリティコード（旧）</label>
                            <input type="text" name="owner_old_security_code" id="owner_old_security_code" value="{{old('owner_old_security_code')}}">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">認証（引き継ぎ実行）</button>
                        
                    </form>
                    <br>
                    <button onclick="location.href='{{route('owner.transfer')}}'">戻る</button>

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
                <div class="card-header">【ステップ1】旧オーナー情報認証</div>

                <div class="card-body">
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

                    <form method="POST" action="{{route('owner.transfer_result')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="radio" id="pattern1" name="pattern" value="1" {{ old('pattern','1') == '1' ? 'checked' : '' }}><label for="pattern1">ログインIDとパスワードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_id">ログインID（旧）</label>
                            <input type="text" name="owner_old_login_id" id="owner_old_login_id" value="{{old('owner_old_login_id')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_password">パスワード（旧）</label>
                            <input type="password" name="owner_old_login_password" id="owner_old_login_password" value="{{old('owner_old_login_password')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <input type="radio" id="pattern2" name="pattern" value="2" {{ old('pattern') == '2' ? 'checked' : '' }}><label for="pattern2">セキュリティコードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_security_code">セキュリティコード（旧）</label>
                            <input type="text" name="owner_old_security_code" id="owner_old_security_code" value="{{old('owner_old_security_code')}}">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">認証（引き継ぎ実行）</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection --}}
