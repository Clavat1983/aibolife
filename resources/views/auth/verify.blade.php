<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>【U_00002】メール認証</title>
    <meta
      name="description"
      content="xxxxx"
    />
    <meta property="og:title" content="【U_00002】メール認証" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../assets/images/ogp.png"
    />
    <meta property="og:url" content="https://example.com/login/" />
    <meta
      property="og:description"
      content="xxxxx"
    />
    <meta property="og:site_name" content="websitekit" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="https://example.com/login/" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />

    <!-- Google Ad -->
    @include('subview.google-ad')
    
  </head>

  <body>
    <div class="l-wrap">
      <main class="l-external-content">
        <div class="l-external-content__inner">
          <div class="p-login-index">
            <div class="p-login-index__header">
              <p class="c-img">
                <img
                  src="{{asset('img/logo_horizontal.svg')}}"
                  alt=""
                  width="161"
                  height="150"
                />
              </p>
            </div>
            <div class="p-login-index__body">
              <section class="c-panel">
                <header class="c-panel__header">
                  <h1 class="c-ttl c-ttl--type2">メール認証が必要です</h1>
                </header>
                <div class="c-panel__content">
                  <div class="c-form">
                    <div class="c-form__item">
@if (session('resent'))
                      <div class="c-alert c-alert--success">
                        <div class="c-alert__text">
                          メールを再送しました。
                        </div>
                      </div>
@else
                      <div class="c-alert c-alert--success">
                        <div class="c-alert__text">
                          メールアドレスの確認メールを送付しました。
                        </div>
                      </div>
@endif
                      <div class="c-alert c-alert--info" style="margin-top:8px;">
                        <div class="c-alert__text">
                          ①メールを受信してください。<br>
                          （迷惑メールフォルダなどに振り分けられていないかもご確認ください）<br>
                          ②1時間以内にメール内に記載されたURLをクリックしてメール認証をしてください。<br>
                          <br/>
                          メールが届いていない場合は、以下の「メール再送」ボタンをクリックしてください。
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-panel__footer">
                  <form action="{{ route('verification.resend') }}" name="resend" method="post" novalidate>
                  @csrf

                    <ul class="c-btn-list">
                      <li class="c-btn-list__item">
                        <button class="c-btn" type="submit">メール再送</button>
                      </li>
                    </ul>
                  </form>
                  <form action="{{ route('logout') }}" name="logout" method="post" novalidate>
                    @csrf

                    <ul class="c-btn-list">
                      <li class="c-btn-list__item" style="margin-top:8px;">
                        <a href="javascript:logout.submit()">ログアウト</a>
                      </li>
                    </ul>
                  </form>
                </div>
              </section>
            </form>
          </div>
        </div>
      </div>
    </main>

    {{-- サブビュー(外部フッター) --}}
    @include('subview.external-footer')
    
  </div>
  <script type="module" src="{{asset('js/common.js')}}"></script>

  </body>
</html>