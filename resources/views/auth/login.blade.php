<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>【U_00005】ログイン画面</title>
    <meta
      name="description"
      content="xxxxx"
    />
    <meta property="og:title" content="【U_00005】ログイン画面" />
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
              <form action="{{ route('login') }}" method="post" novalidate>
              @csrf
              
              <section class="c-panel">
                <header class="c-panel__header">
                  <h1 class="c-ttl c-ttl--type2">ログイン</h1>
                </header>
                <div class="c-panel__content">
                  <div class="c-form">
                    <div class="c-form__item">
                      <div class="c-alert c-alert--info">
                        <div class="c-alert__text">
                          新「aibo life」の<a href="{{route('register')}}">アカウント作成</a>はお済みですか？<br>旧「aibo life」のログイン情報ではログインできません。
                        </div>
                      </div>
                    </div>
                    <div class="c-form__item">
                      <dl class="c-form-data-list">
                        <dt class="c-form-data-list__ttl">
                          <span class="c-label-set">
                            <span class="c-label-set__item">
                              メールアドレス
                            </span>
                            <span class="c-label-set__item">
                              <span class="c-label c-label--required">
                                必須
                              </span>
                            </span>
                          </span>
                        </dt>
                        <dd class="c-form-data-list__data">
                          <div class="c-form-data-list__item">
                            <input
                              class="c-input @error('email') is-error @enderror"
                              type="email"
                              id="email"
                              name="email"
                              value="{{ old('email') }}"
                              placeholder=""
                              required
                              autofocus
                            />
                          </div>
@error('email')
                          <div class="c-form-data-list__item">
                            <p class="c-error">{{ $message }}</p>
                          </div>
@enderror
                          {{-- <div class="c-form-data-list__item">
                            <ul class="c-note-list">
                              <li class="c-note-list__item">補足事項</li>
                            </ul>
                          </div> --}}
                        </dd>
                      </dl>
                    </div>
                    <div class="c-form__item">
                      <dl class="c-form-data-list">
                        <dt class="c-form-data-list__ttl">
                          <span class="c-label-set">
                            <span class="c-label-set__item">
                              パスワード
                            </span>
                            <span class="c-label-set__item">
                              <span class="c-label c-label--required">
                                必須
                              </span>
                            </span>
                          </span>
                        </dt>
                        <dd class="c-form-data-list__data">
                          <div class="c-form-data-list__item">
                            <input
                              class="c-input @error('password') is-error @enderror"
                              type="password"
                              id="password"
                              name="password"
                              placeholder=""
                              required
                            />
                          </div>
@error('password')
                          <div class="c-form-data-list__item">
                            <p class="c-error">{{ $message }}</p>
                          </div>
@enderror
                          <div class="c-form-data-list__item">
                            <ul class="c-note-list">
                              <li class="c-note-list__item">半角英数字8文字以上</li>
                            </ul>
                          </div>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="c-panel__footer">
                  <ul class="c-btn-list">
                    <li class="c-btn-list__item">
                      <button class="c-btn" type="submit">ログイン</button>
                    </li>
@if (Route::has('password.request'))
                    <li class="c-btn-list__item">
                      <a href="{{ route('password.request') }}">パスワードがわからない場合はこちら</a>
                    </li>
@endif
                  </ul>
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