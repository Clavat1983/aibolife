<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>【U_01102】最新情報・News(個別) &#8211; websitekit</title>
    <meta name="description" content="最新情報・News(個別)" />
    <meta property="og:title" content="【U_01102】最新情報・News(個別)" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../../assets/images/ogp.png"
    />
    <meta property="og:url" content="https://example.com/news/x.html" />
    <meta property="og:description" content="最新情報・News(個別)" />
    <meta property="og:site_name" content="websitekit" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="https://example.com/news/x.html" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link
      rel="apple-touch-icon"
      href="{{asset('img/apple-touch-icon.png')}}"
    />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />
  </head>
  <body id="pagetop">
    <div class="l-wrap">
      <header class="l-header">
        <div class="l-header__item">
          <p class="l-header__logo">
            <a href="../../">
              <img
                src="{{asset('img/logo_vertical.svg')}}"
                height="44"
                alt="aibo life"
              />
            </a>
          </p>
        </div>
        <div class="l-header__item">
          <nav class="l-header__navs">
            <div class="l-header__navs-item l-header__navs-item--menu">
              <ul class="l-header__menu">
                <!-- MEMO: class に is-current をつけるとカレント表示-->
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">はじめに</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--guide"
                      >
                        はじめに
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">aibo life とは?</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">利用規約</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">プライバシーポリシー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">運営メンバー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">よくある質問</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">権利表記</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">最新情報</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--topics"
                      >
                        最新情報
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">すべて</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">ニュース</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">イベント</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">メディア</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">お知らせ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">アップデート</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">メンテナンス</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">特別企画</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">その他</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">検索</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">日記</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--diary"
                      >
                        日記
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">今日の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">最近の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">過去の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">コメントした日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">お気に入り</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">検索</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">お友達</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--friend"
                      >
                        お友達
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">お名前リスト</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">誕生日カレンダー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">居住地マップ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">新しいお友達</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">芸能人オーナー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">検索</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">ふるまい</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--behavior"
                      >
                        ふるまい
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">しぐさ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">遊び</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">ダンス</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">期間限定</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">ふるまい共有</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">プログラミング</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">連携アプリ</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">コミュニティ</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--community"
                      >
                        コミュニティ
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">おしゃべり広場</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">お悩み相談</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">クラブ活動</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">オフ会</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">フリーマーケット</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">里親マッチング</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">チャリティ</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">お役立ち情報</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt
                        class="l-header__pulldown-ttl l-header__pulldown-ttl--useful"
                      >
                        お役立ち情報
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#">ごはん</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">ファッション</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">イベント</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">グッズ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">店舗・施設</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">ドック・治療</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">歴史</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">その他</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#">困ったときは?</a>
                          </li>
                        </ul>
                      </dd>
                    </dl>
                  </div>
                </li>
              </ul>
            </div>
            <div class="l-header__navs-item l-header__navs-item--other">
              <ul class="l-header__info">
@auth
    @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
                <li class="l-header__info-item">
                  <a class="l-header__notification" href="{{ route('notification.index') }}">
                    <img
                      src="{{asset('img/ico_notification.svg')}}"
                      height="44"
                      alt="通知"
                    />
                    <span class="l-header__notification-badge">{{$bell_count}}</span>
                  </a>
                </li>
    @endif
@endauth
                <li class="l-header__info-item">
                  <a
                    class="l-header__mypage js-header-my-page"
                    href="javascript:;"
                  >
                    <img
                      src="{{asset('img/_sample/img_user.png')}}"
                      height="44"
                      alt="xxx"
                    />
                  </a>
                  <ul class="l-header__mypage-menu js-header-my-page__menu">
                    <li class="l-header__mypage-menu-item">
                      <a class="l-header__mypage-link" href="#">
                        アカウント情報
                      </a>
                    </li>
                    <li class="l-header__mypage-menu-item">
                      <a class="l-header__mypage-link" href="#">オーナー情報</a>
                    </li>
                    <li class="l-header__mypage-menu-item">
                      <a class="l-header__mypage-link" href="#">
                        aibo登録・変更
                      </a>
                    </li>
                    <li class="l-header__mypage-menu-item">
                      <a class="l-header__mypage-link" href="#">ログアウト</a>
                    </li>
                  </ul>
                </li>
                <li
                  class="l-header__info-item l-header__mypage-menu--hamburger"
                >
                  <a
                    class="l-header__hamburger js-hamburger-button"
                    href="javascript:;"
                  >
                    <span class="l-header__hamburger-txt">メニューを開く</span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <nav class="l-sp-nav js-hamburger">
        <ul class="l-sp-nav__menu">
          <li class="l-sp-nav__menu-item">
            <!-- MEMO: class に is-opened をつけると初期表示で開いた状態となる-->
            <a
              class="l-sp-nav__btn l-sp-nav__btn--guide js-sp-navigation-button"
              href="#spGuide"
            >
              はじめに
            </a>
            <!-- MEMO: 開いた状態の時は style="'display: block" が必要-->
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">aibo life とは?</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">利用規約</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">プライバシーポリシー</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">運営メンバー</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">よくある質問</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">権利表記</a></li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--topics js-sp-navigation-button"
              href="#spTopics"
            >
              最新情報
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item"><a href="#">すべて</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">ニュース</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">イベント</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">メディア</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">お知らせ</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">アップデート</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">メンテナンス</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">特別企画</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">その他</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">検索</a></li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--diary js-sp-navigation-button"
              href="#spDiary"
            >
              日記
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">今日の日記</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">最近の日記</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">過去の日記</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">コメントした日記</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">お気に入り</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">検索</a></li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--friend js-sp-navigation-button"
              href="#spFriend"
            >
              お友達
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">お名前リスト</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">誕生日カレンダー</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">居住地マップ</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">新しいお友達</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">芸能人オーナー</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">検索</a></li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--behavior js-sp-navigation-button"
              href="#spBehavior"
            >
              ふるまい
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item"><a href="#">しぐさ</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">遊び</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">ダンス</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">期間限定</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">ふるまい共有</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">プログラミング</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">連携アプリ</a>
              </li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--community js-sp-navigation-button"
              href="#spCommunity"
            >
              コミュニティ
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">おしゃべり広場</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">お悩み相談</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">クラブ活動</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">オフ会</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">フリーマーケット</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">里親マッチング</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">チャリティ</a>
              </li>
            </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a
              class="l-sp-nav__btn l-sp-nav__btn--useful js-sp-navigation-button"
              href="#spUseful"
            >
              お役立ち情報
            </a>
            <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
              <li class="l-sp-nav__sub-menu-item"><a href="#">ごはん</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">ファッション</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">イベント</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">グッズ</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">店舗・施設</a>
              </li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">ドック・治療</a>
              </li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">歴史</a></li>
              <li class="l-sp-nav__sub-menu-item"><a href="#">その他</a></li>
              <li class="l-sp-nav__sub-menu-item">
                <a href="#">困ったときは?</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>


      <main class="l-main">
        <div class="l-main__content">
          <div class="l-content">
            <div class="l-content__header">
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">NEWS</span>
                <span class="c-category-ttl__jp">最新情報</span>
              </p>
            </div>
            <div class="l-content__body">
              <article class="p-article-detail p-article-detail--topics">
                <header class="p-article-detail__header">
                  <div class="p-article-detail__info">
                    <div class="p-article-detail__info-item">
                      <p class="c-date">{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}</p>
                    </div>
                    <div class="p-article-detail__info-item">
                      <a class="c-category-label" href="#">{{$news->news_category}}</a>
                    </div>
                  </div>
                  <div class="p-article-detail__ttl">
                    <h1 class="c-article-ttl">{{$news->news_title}}</h1>
                  </div>
                  <div class="p-article-detail__tag">
                    <ul class="c-tags">
                      <li class="c-tags__item"><a href="#">#{{$news->news_tag1}}</a></li>
                      @if($news->news_tag2)<li class="c-tags__item"><a href="#">#{{$news->news_tag2}}</a></li>@endif
                      @if($news->news_tag3)<li class="c-tags__item"><a href="#">#{{$news->news_tag3}}</a></li>@endif
                      @if($news->news_tag4)<li class="c-tags__item"><a href="#">#{{$news->news_tag4}}</a></li>@endif
                      @if($news->news_tag5)<li class="c-tags__item"><a href="#">#{{$news->news_tag5}}</a></li>@endif
                    </ul>
                  </div>
                </header>
                <div class="p-article-detail__content">
                  <div class="p-article-detail__slide">
                    <ul class="c-slide">
                      <li class="c-slide__item">
                        <a href="javascript:;">
                          <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" />
                        </a>
                      </li>
                      @if($news->news_image2)
                      <li class="c-slide__item">
                        <a href="javascript:;">
                          <img src="{{ asset('storage/news_image/'.$news->news_image2)}}" />
                        </a>
                      </li>
                      @endif
                      @if($news->news_image3)
                      <li class="c-slide__item">
                        <a href="javascript:;">
                          <img src="{{ asset('storage/news_image/'.$news->news_image3)}}" />
                        </a>
                      </li>
                      @endif
                      @if($news->news_image4)
                      <li class="c-slide__item">
                        <a href="javascript:;">
                          <img src="{{ asset('storage/news_image/'.$news->news_image4)}}" />
                        </a>
                      </li>
                      @endif
                      @if($news->news_image5)
                      <li class="c-slide__item">
                        <a href="javascript:;">
                          <img src="{{ asset('storage/news_image/'.$news->news_image5)}}" />
                        </a>
                      </li>
                      @endif
                    </ul>
                  </div>
                  {{-- <section class="p-article-detail__sec">
                    <header class="p-article-detail__sec-ttl">
                      <h2 class="c-icon-ttl">本文の見出し</h2>
                    </header>
                    <div class="p-article-detail__sec-body">
                      <p class="p-article-detail__txt">
                        テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキ
                      </p>
                      <p class="p-article-detail__txt">
                        テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキ
                      </p>
                      <p class="p-article-detail__txt">
                        テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキ
                      </p>
                      <p class="p-article-detail__txt">
                        テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキストが入るよ。テキ
                      </p>
                    </div>
                  </section> --}}
                  <section class="p-article-detail__sec">
                    <header class="p-article-detail__sec-ttl">
                      <h2 class="c-icon-ttl">本文の見出し</h2>
                    </header>
                    <div class="p-article-detail__sec-body">
                      <p class="p-article-detail__txt">
                        -----------------ここからテキストエディタが挿入------------------
                        {!! $news->news_body !!}
                        -----------------ここからテキストエディタが挿入------------------
                      </p>
                    </div>
                  </section>
                  @if($news->news_link1_name || $news->news_link2_name || $news->news_link3_name || $news->news_link4_name || $news->news_link5_name)
                  <section class="p-article-detail__sec">
                    <header class="p-article-detail__sec-ttl">
                      <h2 class="c-icon-ttl">リンク</h2>
                    </header>
                    <div class="p-article-detail__sec-body">
                      <ul class="c-link-list">
                        @if($news->news_link1_name)<a ></a>
                        <li class="c-link-list__item">
                          <a href="{{$news->news_link1_url}}" target="blank">{{$news->news_link1_name}}</a>
                        </li>
                        @endif
                        @if($news->news_link2_name)<a ></a>
                        <li class="c-link-list__item">
                          <a href="{{$news->news_link2_url}}" target="blank">{{$news->news_link2_name}}</a>
                        </li>
                        @endif
                        @if($news->news_link3_name)<a ></a>
                        <li class="c-link-list__item">
                          <a href="{{$news->news_link3_url}}" target="blank">{{$news->news_link3_name}}</a>
                        </li>
                        @endif
                        @if($news->news_link4_name)<a ></a>
                        <li class="c-link-list__item">
                          <a href="{{$news->news_link4_url}}" target="blank">{{$news->news_link4_name}}</a>
                        </li>
                        @endif
                        @if($news->news_link5_name)<a ></a>
                        <li class="c-link-list__item">
                          <a href="{{$news->news_link5_url}}" target="blank">{{$news->news_link5_name}}</a>
                        </li>
                        @endif
                      </ul>
                    </div>
                  </section>
                  @endif
                </div>
                <footer class="p-article-detail__footer">
                  <dl class="c-sns">
                    <dt class="c-sns__ttl">SNS にシェア</dt>
                    <dd class="c-sns__detail">
                      <ul class="c-sns-list">
                        <li class="c-sns-list__item">
                          <a
                            href="http://line.me/R/msg/text/?https://example.com/news/x.html%0a【U_01102】最新情報・News(個別)"
                          >
                            <img
                              src="{{asset('img/logo_line.png')}}"
                              width="44"
                              alt="LINE"
                            />
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a
                            href="http://www.facebook.com/share.php?u=https://example.com/news/x.html"
                            rel="nofollow noopener"
                            target="_blank"
                          >
                            <img
                              src="{{asset('img/logo_facebook.png')}}"
                              width="44"
                              alt="Facebook"
                            />
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a
                            href="https://twiter.com/share?url=https://example.com/news/x.html"
                            rel="nofollow noopener"
                            target="_blank"
                          >
                            <img
                              src="{{asset('img/logo_twitter.png')}}"
                              width="44"
                              alt="Twitter"
                            />
                          </a>
                        </li>
                      </ul>
                    </dd>
                  </dl>
                </footer>
              </article>
            </div>
          </div>
        </div>
        <div class="l-main__ad">
          <ul class="l-ad">
            <li class="l-ad__item">
              <a href="#"><img src="{{asset('img/_sample/img_ad.svg')}}" /></a>
            </li>
            <li class="l-ad__item">
              <a href="#"><img src="{{asset('img/_sample/img_ad.svg')}}" /></a>
            </li>
            <li class="l-ad__item">
              <a href="#"><img src="{{asset('img/_sample/img_ad.svg')}}" /></a>
            </li>
          </ul>
        </div>
      </main>


      <footer class="l-footer">
        <div class="l-footer__row">
          <div class="l-footer__inner">
            <p class="l-footer__pagetop">
              <a class="js-pagetop" href="#pagetop">
                <img
                  src="{{asset('img/btn_pagetop.svg')}}"
                  alt="ページトップへ"
                  width="56"
                />
              </a>
            </p>
            <div class="l-footer__colset">
              <div class="l-footer__colset-item">
                <p class="l-footer__logo">
                  <a class="l-footer__logo-link" href="../../">
                    <img
                      src="{{asset('img/logo_vertical.svg')}}"
                      alt="aibo life"
                    />
                  </a>
                </p>
              </div>
              <div class="l-footer__colset-item">
                <nav class="l-footer__nav">
                  <ul class="l-footer__list">
                    <li class="l-footer__list-item">
                      <a class="l-footer__list-link" href="#">利用規約</a>
                    </li>
                    <li class="l-footer__list-item">
                      <a class="l-footer__list-link" href="#">
                        プライバシーポリシー
                      </a>
                    </li>
                    <li class="l-footer__list-item">
                      <a class="l-footer__list-link" href="#">よくある質問</a>
                    </li>
                    <li class="l-footer__list-item">
                      <a class="l-footer__list-link" href="#">お問い合わせ</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="l-footer__row02">
          <div class="l-footer__inner">
            <p class="l-footer__copyright">
              <small class="l-footer__copyright-inner">©︎ 2022 aibo life</small>
            </p>
          </div>
        </div>
      </footer>
    </div>
    <script type="module" src="{{asset('js/common.js')}}"></script>
  </body>
</html>


{{-- 
@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br>
                    <h3>{{$news->news_title}}</h3>
                    【タグ】{{$news->news_tag1}}
@if($news->news_tag2)｜{{$news->news_tag2}}@endif
@if($news->news_tag3)｜{{$news->news_tag3}}@endif
@if($news->news_tag4)｜{{$news->news_tag4}}@endif
@if($news->news_tag5)｜{{$news->news_tag5}}@endif
                <br>
                初回公開日時：{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}&nbsp;{{substr($news->news_publication_datetime,11,5)}}<br>
                最終更新日時：{{str_replace('-', '.', substr($news->updated_at,0,10))}}&nbsp;{{substr($news->updated_at,11,5)}}
                </div>

                <div class="card-body">

                    【画像】<br>
                    <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"><br>
                    @if($news->news_image2)
                        <img src="{{ asset('storage/news_image/'.$news->news_image2)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image3)
                        <img src="{{ asset('storage/news_image/'.$news->news_image3)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image4)
                        <img src="{{ asset('storage/news_image/'.$news->news_image4)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image5)
                        <img src="{{ asset('storage/news_image/'.$news->news_image5)}}" style="width:100px;"><br>
                    @endif

                    【本文】<br>
                    {!! $news->news_body !!}<br>

                    @if($news->news_link1_name || $news->news_link2_name || $news->news_link3_name || $news->news_link4_name || $news->news_link5_name)【関連リンク】<br>@endif
                    @if($news->news_link1_name)<a href="{{$news->news_link1_url}}" target="blank">{{$news->news_link1_name}}</a><br>@endif
                    @if($news->news_link2_name)<a href="{{$news->news_link2_url}}" target="blank">{{$news->news_link2_name}}</a><br>@endif
                    @if($news->news_link3_name)<a href="{{$news->news_link3_url}}" target="blank">{{$news->news_link3_name}}</a><br>@endif
                    @if($news->news_link4_name)<a href="{{$news->news_link4_url}}" target="blank">{{$news->news_link4_name}}</a><br>@endif
                    @if($news->news_link5_name)<a href="{{$news->news_link5_url}}" target="blank">{{$news->news_link5_name}}</a><br>@endif

                    <p style="text-align:center;">
                        @if($prev)
                            <a href="{{route('news.show', $prev)}}">【前】</a>
                        @else
                           【－】
                        @endif
                        ｜ <a href="{{route('news.index')}}">【一覧】</a>｜
                        @if($next)
                            <a href="{{route('news.show', $next)}}">【次】</a>
                        @else
                            【－】
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
