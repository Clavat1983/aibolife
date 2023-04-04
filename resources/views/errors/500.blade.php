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
          {{-- <div class="l-content"> --}}
{{-- --------------------------------------------------------------------------- --}}

            <div class="l-main__content">
                <div class="p-error-404">
                <div class="p-error-404__content">
                    <div class="p-error-404__image">
                    <img src="{{asset('img/img_error.png')}}" width="160" alt="" />
                    </div>
                    <div class="p-error-404__title">
                    <h1 class="c-error-title">
                        <span class="c-error-title__en">Sorry...</span>
                        <span class="c-error-title__jp">500 : Internal Server Error</span>
                    </h1>
                    </div>
                    <p class="p-error-404__text"><b>処理中にエラーが発生しました</b><br><span style="font-size:85%;">（サーバの設定不備 or プログラムのバグ）</span></p>
                </div>
                <div class="p-error-404__footer">
                    <p class="p-error-404__button">
                    <a class="c-btn02" href="{{route('contact.index')}}">お問い合わせ</a>
                    </p>
                    <p class="p-error-404__text">この画面が表示された場合は<span class="p-error-404__mark">、</span>発生状況の詳細をご連絡ください</p>
                  </div>
                </div>
            </div>

{{-- --------------------------------------------------------------------------- --}}
        {{-- </div> --}}
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

