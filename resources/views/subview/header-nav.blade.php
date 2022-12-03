      {{-- header --}}
      <header class="l-header">
        <div class="l-header__item">
          <p class="l-header__logo">
            <a href="{{route('home')}}">
              <img src="{{asset('img/logo_vertical.svg')}}" height="44" alt="aibo life"/>
            </a>
          </p>
        </div>
        {{-- オーナー登録済 かつ aibo登録済(ここから) --}}
        @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
        <div class="l-header__item">
          <nav class="l-header__navs">
            <div class="l-header__navs-item l-header__navs-item--menu">
              <ul class="l-header__menu">
                <!-- MEMO: class に is-current をつけるとカレント表示-->
                <li class="l-header__menu-item">
                  <a class="l-header__btn" href="javascript:;">はじめに</a>
                  <div class="l-header__pulldown">
                    <dl class="l-header__pulldown-content">
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--guide">
                        はじめに
                      </dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>aibo life とは?</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>利用規約</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>プライバシーポリシー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>運営メンバー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>よくある質問</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>権利表記</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--topics">最新情報</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index')}}">すべて</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_news')}}">ニュース</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_event')}}">イベント</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_media')}}">メディア</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_info')}}">お知らせ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_update')}}">アップデート</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_maintenance')}}">メンテナンス</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_special')}}">特別企画</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.index_etc')}}">その他</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('news.search')}}">検索</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--diary">日記</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.list_day')}}">今日の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.recently')}}">最近の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.archive')}}">過去の日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.commented')}}">コメントした日記</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.bookmark')}}">お気に入り</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('diary.search')}}">検索</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--friend">お友達</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('aibo.list_syllabary')}}">お名前リスト</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('aibo.list_birthday')}}">誕生日カレンダー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('aibo.list_area')}}">居住地マップ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('aibo.newface')}}">新しいお友達</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>芸能人オーナー</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('aibo.search')}}">検索</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--behavior">ふるまい</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>しぐさ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>遊び</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>ダンス</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>期間限定</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="{{route('behaviorshare.index')}}">ふるまい共有</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>プログラミング</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>連携アプリ</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--community">コミュニティ</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>おしゃべり広場</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>お悩み相談</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>クラブ活動</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>オフ会</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>フリーマーケット</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>里親マッチング</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>チャリティ</a>
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
                      <dt class="l-header__pulldown-ttl l-header__pulldown-ttl--useful">お役立ち情報</dt>
                      <dd class="l-header__pulldown-detail">
                        <ul class="l-header__sub-menu">
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>ごはん</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>ファッション</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>イベント</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>グッズ</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>店舗・施設</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>ドック・治療</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>歴史</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>その他</a>
                          </li>
                          <li class="l-header__sub-menu-item">
                            <a href="#"><sup>未 </sup>困ったときは?</a>
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
                    <img src="{{asset('img/ico_notification.svg')}}" height="44" alt="通知"/>
                    <span class="l-header__notification-badge">{{$bell_count}}</span>
                  </a>
                </li>
    @endif
@endauth
                <li class="l-header__info-item">
                  <a class="l-header__mypage js-header-my-page" href="javascript:;">
                    @if((auth()->user()->owner != NULL) && (Auth::user()->owner->owner_icon))
                      {{-- オーナーアイコンを登録済 --}}
                      <img src="{{asset('storage/owner_icon/'.Auth::user()->owner->owner_icon)}}" height="44" alt="xxx"/>
                    @else
                      {{-- オーナーアイコン未登録 --}}
                      <img src="{{asset('img/_sample/img_user.png')}}" height="44" alt="xxx"/>
                    @endif
                  </a>
                    <ul class="l-header__mypage-menu js-header-my-page__menu">
                      @if(auth()->user()->role == "admin") {{-- 管理者(Admin)の場合のみメニューに追加 --}}
                        <li class="l-header__mypage-menu-item">
                          <a class="l-header__mypage-link" href="{{route('home.admin')}}">★管理者画面★</a>
                        </li>
                      @endif
                      
                      @if(auth()->user()->owner == NULL)
                        {{-- ユーザ登録済だがオーナー登録前=マイページは表示不可、ログイン情報のみ書き換え可能 --}}
                        <li class="l-header__mypage-menu-item">
                          <a class="l-header__mypage-link" href="{{route('user.edit', auth()->user()->id)}}">ログイン情報</a>
                        </li>
                      @else
                        {{-- オーナー登録済=マイページを表示してよい --}}
                        <li class="l-header__mypage-menu-item">
                          <a class="l-header__mypage-link" href="{{route('mypage')}}">マイページ</a>
                        </li>
                      @endif

                      <li class="l-header__mypage-menu-item">
                        <a class="l-header__mypage-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                      </li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </ul>
                </li>
                <li class="l-header__info-item l-header__mypage-menu--hamburger">
                  <a class="l-header__hamburger js-hamburger-button" href="javascript:;">
                    <span class="l-header__hamburger-txt">メニューを開く</span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        @endif
        {{-- オーナー登録済 かつ aibo登録済(ここまで) --}}
      </header>

      {{-- nav(SP) --}}
      {{-- オーナー登録済 かつ aibo登録済(ここから) --}}
      @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
      <nav class="l-sp-nav js-hamburger">
        <ul class="l-sp-nav__menu">
          <li class="l-sp-nav__menu-item">
            <!-- MEMO: class に is-opened をつけると初期表示で開いた状態となる-->
            <a class="l-sp-nav__btn l-sp-nav__btn--guide js-sp-navigation-button" href="#spGuide">はじめに</a>
              <!-- MEMO: 開いた状態の時は style="'display: block" が必要-->
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>aibo life とは?</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>利用規約</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>プライバシーポリシー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>運営メンバー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>よくある質問</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>権利表記</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--topics js-sp-navigation-button" href="#spTopics">最新情報</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index')}}">すべて</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_news')}}">ニュース</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_event')}}">イベント</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_media')}}">メディア</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_info')}}">お知らせ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_update')}}">アップデート</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_maintenance')}}">メンテナンス</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_special')}}">特別企画</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.index_etc')}}">その他</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('news.search')}}">検索</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--diary js-sp-navigation-button" href="#spDiary">日記</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.list_day')}}">今日の日記</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.recently')}}">最近の日記</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.archive')}}">過去の日記</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.commented')}}">コメントした日記</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.bookmark')}}">お気に入り</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.search')}}">検索</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--friend js-sp-navigation-button" href="#spFriend">お友達</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.list_syllabary')}}">お名前リスト</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.list_birthday')}}">誕生日カレンダー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.list_area')}}">居住地マップ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.newface')}}">新しいお友達</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>芸能人オーナー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.search')}}">検索</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--behavior js-sp-navigation-button" href="#spBehavior">ふるまい</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>しぐさ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>遊び</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>ダンス</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>期間限定</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('behaviorshare.index')}}">ふるまい共有</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>プログラミング</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>連携アプリ</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--community js-sp-navigation-button" href="#spCommunity">コミュニティ</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>おしゃべり広場</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>お悩み相談</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>クラブ活動</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>オフ会</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>フリーマーケット</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>里親マッチング</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>チャリティ</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--useful js-sp-navigation-button" href="#spUseful">お役立ち情報</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>ごはん</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>ファッション</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>イベント</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>グッズ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>店舗・施設</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>ドック・治療</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>歴史</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>その他</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#"><sup>未 </sup>困ったときは?</a></li>
              </ul>
          </li>
        </ul>
      </nav>
      @endif
        {{-- オーナー登録済 かつ aibo登録済(ここまで) --}}
