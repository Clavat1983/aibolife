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
              <p class="c-category-title c-category-title--mypage">
                <span class="c-category-title__en">Registration</span>
            @if(count($owner->aibos) == 0)
                <span class="c-category-title__jp">利用登録［オーナー登録完了］</span>
            @else
                <span class="c-category-title__jp">利用登録［登録完了］</span>
            @endif
              </p>
            </div>

            <div class="l-content__body">

                <p>オーナー名：{{$owner->owner_name}}さん</p>

                @if(count($owner->aibos) == 0)
                    <p>オーナー登録が完了しました。<br>
                    <br>
                    引き続き、aibo登録をしてください。</p>
                    <a href="{{route('root')}}">aibo登録</a><br><!-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ -->
                @else
                    <!-- aibo情報が既にある＝旧利用者なので、内容の見直しを依頼 -->
                    <p>オーナー情報、aibo情報、投稿・コメントなど情報の引継ぎが完了しました。<br>
                    新「aibo life」では、［なかまQRコード］や［耳や尻尾の色］など、「aibo情報」に登録できる項目が増えています。<br>
                    ぜひ「マイページ」から最新の内容に更新してご利用ください。<br>
                        <a href="{{route('mypage')}}">マイページ</a><br>
                    </p>
                    
                    <a href="{{route('root')}}">トップページ</a><br>
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
                <div class="card-header">【ステップ1】オーナー登録（完了）</div>

                <div class="card-body">
                    <p>オーナー名：{{$owner->owner_name}}さん</p>

                    @if(count($owner->aibos) == 0)
                        <p>オーナー情報の引継ぎが完了しました。<br>
                        aiboが登録されていません。<br>
                        aibo登録に進みましょう</p>
                        <a href="{{route('root')}}">aibo登録</a><br><!-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ -->
                    @else
                        <p>オーナー情報、aibo情報、投稿・コメントなど情報の引継ぎが完了しました。</p>
                        <a href="{{route('root')}}">トップページへ</a><br>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
