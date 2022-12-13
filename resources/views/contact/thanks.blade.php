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
                <span class="c-category-ttl__en">Contact</span>
                <span class="c-category-ttl__jp">お問い合わせ［完了］</span>
              </p>
            </div>
            <div class="l-content__body">

                {{-- <!-- 表示されることはないはず -->
                <!-- エラーメッセージ表示 -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- 送信後のメッセージ表示 -->
                @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif --}}

                @auth
                    <div class="row">
                        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
                            <div class="card-body">
                                <h1 class="mt4  mb-3">お問い合わせ</h1>

                                    お問い合わせを受け付けました。<br>
                                    通常1-2日以内に、マイページの<a href="{{route('contact.index')}}">「お問い合わせ履歴」</a>に回答をお送りします。<br>
                                    ※右上の「通知アイコン」でもお知らせします。
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
                            <div class="card-body">
                                <h1 class="mt4  mb-3">お問い合わせ</h1>

                                    お問い合わせを受け付けました。<br>
                                    通常1-2日以内に、メールにて回答をお送りします。<br>

                            </div>
                        </div>
                    </div>
                @endauth


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

<!-- エラーメッセージ表示 -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- 送信後のメッセージ表示 -->
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

@auth
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
            <div class="card-body">
                <h1 class="mt4  mb-3">お問い合わせ</h1>

                    お問い合わせを受け付けました。<br>
                    通常1-2日以内に、メールにて回答をお送りします。<br>
                    ※マイページの<a href="{{route('contact.index')}}">「お問い合わせ履歴」</a>からもご確認いただけます。<br>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
            <div class="card-body">
                <h1 class="mt4  mb-3">お問い合わせ</h1>

                    お問い合わせを受け付けました。<br>
                    通常1-2日以内に、メールにて回答をお送りします。<br>
                    <br>
                    お問い合わせ内容（控え）をメールにてお送りしていますのでご確認ください。<br>
                    ※控えが迷惑メールフォルダに入っていないかもご確認ください。<br>
                    迷惑メールフォルダに入ってしまっている場合は、回答メールも同様に振り分けられてしまうため、控えメールを「迷惑メール」にならないよう振り分け設定などをお願いします。

            </div>
        </div>
    </div>
@endauth


@endsection --}}