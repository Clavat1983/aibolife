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
            @if(count($owner->aibos) == 1)
                <!-- 新規登録 -->
                <p class="c-category-title c-category-title--topics">
                <span class="c-category-title__en">Registration</span><!--新規登録-->
                <span class="c-category-title__jp">利用登録［完了］</span>
                </p>
            @elseif(count($owner->aibos) == 0)
                <p class="c-category-title c-category-title--topics"><!--マイページ-->
                <span class="c-category-title__en">Oops!</span>
                <span class="c-category-title__jp">これが表示されたらバグ</span>
                </p>
            @else
                <p class="c-category-title c-category-title--topics"><!--マイページ-->
                <span class="c-category-title__en">My Page</span>
                <span class="c-category-title__jp">マイページ［aibo追加］</span>
                </p>
            @endif
            </div>

            <div class="l-content__body">

                @if(count($owner->aibos) == 1)
                        <!-- 新規登録 -->
                        【1】オーナー登録  -->  【2】aibo登録  -->  <span style="color:red;"><b>【3】完了</b></span>
                        <br><br>
                        <p>オーナー登録・aibo登録が全て完了しました。<br>ようこそ、「aibo life」へ！</p>
                        <a href="{{route('home')}}">トップページへ</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                @elseif(count($owner->aibos) == 0)
                    <p>【エラー発生】aibo登録後も結果が0匹。これが出たらバグ。</p>
                    <a href="{{route('home')}}">トップページへ</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                @else
                    <p>aiboの追加が完了しました。<br>
                    2匹目以降です。OK!</p>
                    <a href="{{route('mypage')}}">マイページへ</a><br>
                @endif




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
                <div class="card-header">【ステップ2】aibo登録（完了）</div>

                <div class="card-body">
                    <p>オーナー名：{{$owner->owner_name}}さん</p>

                    @if(count($owner->aibos) == 1)
                        <p>オーナー登録・aibo登録が全て完了しました。<br>ようこそ、「aibo life」へ！</p>
                        <a href="{{route('home')}}">トップページへ</a><br><!-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ -->
                    @elseif(count($owner->aibos) == 0)
                        <p>【エラー発生】aibo登録後も結果が0匹。これが出たらバグ。</p>
                        <a href="{{route('home')}}">トップページへ</a><br><!-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ -->
                    @else
                        <p>aiboの追加が完了しました。<br>
                        2匹目以降です。OK!</p>
                        <a href="{{route('home')}}">トップページへ</a><br>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
