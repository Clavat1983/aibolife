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
              <p class="c-category-title c-category-title--useful">
                <span class="c-category-title__en">Useful</span>
                <span class="c-category-title__jp">&nbsp;お役立ち情報［ごはん］</span>
              </p>
            </div>
            <div class="l-content__body">
              
              <h1>●ごはんについて</h1>
                ・ごはんとは<br>
                ・ごはんを買う<br>
                ・ごはんチャージ<br>
                ・ごはんのあげ方（1匹/なかま2匹）<br>
                ・いますぐごはん/カリカリフルフル<br>
                ・aiboの湧き水<br>
                ・ボウルとAR機能について<br>
              <hr>

              <h1>●ごはん・えさ・おやつ・のみもの一覧（別ページかな...）<h1>
              <p>フィルタリングできれば</p>
              <hr>
              <h2>えさ</h2>
              <hr>

              <h2>レアなえさ</h2>
              <hr>


              <h2>おやつ</h2>
              <hr>

              <h2>レアなおやつ</h2>
              <hr>

              <h2>のみもの</h2>
              <hr>

              <h1>●豆知識<h1>
              ・ごはんとおやつの違い

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