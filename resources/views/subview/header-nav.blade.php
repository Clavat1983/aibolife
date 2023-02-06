      {{-- header --}}
      <header class="l-header">
        <div class="l-header__item">
          <p class="l-header__logo">
            <a href="{{route('home')}}">
              <img src="{{asset('img/logo_vertical.svg')}}" height="44" alt="aibo life"/>
            </a>
          </p>
        </div>

        <div class="l-header__item">
          <nav class="l-header__navs">

            @auth {{--ログイン済(1) begin--}}
              @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0)) {{-- aibo登録済(1) begin--}}

                {{-- コンテンツヘッダーを表示 begin --}}
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
                                <a href="{{route('guide.about')}}">aibo life とは?</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.manual')}}">利用ガイド</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.rule')}}">利用規約</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.policy')}}">プライバシーポリシー</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.staff')}}">運営メンバー</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.faq')}}">よくある質問</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('guide.copyright')}}">権利表記</a>
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
                                <a href="{{route('diary.commented')}}">コメントをつけた日記</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('diary.bookmark')}}">お気に入りの日記</a>
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
                              {{-- <li class="l-header__sub-menu-item">
                                <a href="#">芸能人オーナー<sup> 未</sup></a>
                              </li> --}}
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
                                <a href="{{route('behaviorshare.index')}}">ふるまい共有</a>
                              </li>
                              {{-- <li class="l-header__sub-menu-item">
                                <a href="#">プログラミング<sup> 未</sup></a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="#">連携アプリ</a>
                              </li>                              --}}
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
                                <a href="{{route('board.index_talk')}}">おしゃべり広場</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('board.index_problem')}}">お悩み相談</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('board.index_club')}}">クラブ活動</a>
                              </li>
                              {{-- <li class="l-header__sub-menu-item">
                                <a href="#">オフ会<sup> 未</sup></a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="#">フリーマーケット<sup> 未</sup></a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="#">里親マッチング<sup> 未</sup></a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="#">チャリティ<sup> 未</sup></a>
                              </li> --}}
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
                                <a href="{{route('useful.food')}}">ごはん</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('useful.fashion')}}">ファッション</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('useful.event')}}">イベント</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('useful.goods')}}">グッズ</a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('useful.shop')}}">店舗・施設</a>
                              </li>
                              {{--
                              <li class="l-header__sub-menu-item">
                                <a href="#">ドック・治療<sup> 未</sup></a>
                              </li>
                              --}}
                              <li class="l-header__sub-menu-item">
                                <a href="{{route('useful.history')}}">歴史</a>
                              </li>
                              {{--
                              <li class="l-header__sub-menu-item">
                                <a href="#">その他<sup> 未</sup></a>
                              </li>
                              <li class="l-header__sub-menu-item">
                                <a href="#">困ったときは?<sup> 未</sup></a>
                              </li>
                              --}}
                            </ul>
                          </dd>
                        </dl>
                      </div>
                    </li>
                  </ul>
                </div>
                {{-- コンテンツヘッダーを表示 end --}}

              @endif
            @endauth


            {{-- 通知・マイメニュー --}}
            <div class="l-header__navs-item l-header__navs-item--other">
              <ul class="l-header__info">
                @auth
                  @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
                  
                    {{-- 通知 --}}
                    <li class="l-header__info-item">
                      <a class="l-header__notification" href="{{ route('notification.index') }}">
                      <img src="{{asset('img/ico_notification.svg')}}" height="44" alt="通知"/>
                        @if(isset( $bell_count ))
                          <span class="l-header__notification-badge">{{$bell_count}}</span>
                        @endif
                      </a>
                    </li>

                    {{-- マイメニュー --}}
                    <li class="l-header__info-item l-header__info-item--mypage">
                      <a class="l-header__mypage js-header-mypage" href="javascript:;">
                        @if((auth()->user()->owner != NULL) && (Auth::user()->owner->owner_icon))
                          {{-- オーナーアイコンを登録済 --}}
                          <img src="{{asset('storage/owner_icon/'.Auth::user()->owner->owner_icon)}}" height="44" alt="xxx"/>
                        @else
                          {{-- オーナーアイコン未登録 --}}
                          <img src="{{asset('img/_sample/img_user.png')}}" height="44" alt="xxx"/>
                        @endif
                      </a>
                        <ul class="l-header__mypage-menu js-header-mypage__menu">
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

                    {{-- ハンバーガーメニュー --}}
                    <li class="l-header__info-item l-header__mypage-menu--hamburger">
                      <a class="l-header__hamburger js-hamburger-button" href="javascript:;">
                        <span class="l-header__hamburger-txt">メニューを開く</span>
                      </a>
                    </li>
                  @else
                    <li class="xxxxx">
                      <a class="aaaaa" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  @endif
                @endauth

                @guest
                  <li class="yyyyy">
                    <a class="bbbbb" href="{{route('home')}}">
                      ログイン
                    </a>
                  </li>
                @endguest

              </ul>
            </div>
          </nav>
        </div>


      </header>

      {{-- nav(SP) --}}
  @auth
      {{-- オーナー登録済 かつ aibo登録済(ここから) --}}
      @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
      <nav class="l-sp-nav js-hamburger">
        <ul class="l-sp-nav__menu">
          <li class="l-sp-nav__menu-item">
            <!-- MEMO: class に is-opened をつけると初期表示で開いた状態となる-->
            <a class="l-sp-nav__btn l-sp-nav__btn--guide js-sp-navigation-button" href="#spGuide">はじめに</a>
              <!-- MEMO: 開いた状態の時は style="'display: block" が必要-->
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.about')}}">aibo life とは?</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.manual')}}">利用ガイド</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.rule')}}">利用規約</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.policy')}}">プライバシーポリシー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.staff')}}">運営メンバー</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.faq')}}">よくある質問</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('guide.copyright')}}">権利表記</a></li>
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
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.commented')}}">コメントをつけた日記</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('diary.bookmark')}}">お気に入りの日記</a></li>
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
                {{-- <li class="l-sp-nav__sub-menu-item"><a href="#">芸能人オーナー<sup> 未</sup></a></li> --}}
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('aibo.search')}}">検索</a></li>
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--behavior js-sp-navigation-button" href="#spBehavior">ふるまい</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="#">しぐさ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">遊び</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">ダンス</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">期間限定</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('behaviorshare.index')}}">ふるまい共有</a></li>
                {{-- <li class="l-sp-nav__sub-menu-item"><a href="#">プログラミング<sup> 未</sup></a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">連携アプリ<sup> 未</sup></a></li> --}}
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--community js-sp-navigation-button" href="#spCommunity">コミュニティ</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('board.index_talk')}}">おしゃべり広場</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('board.index_problem')}}">お悩み相談</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('board.index_club')}}">クラブ活動</a></li>
                {{-- <li class="l-sp-nav__sub-menu-item"><a href="#">オフ会<sup> 未</sup></a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">フリーマーケット<sup> 未</sup></a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">里親マッチング<sup> 未</sup></a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">チャリティ<sup> 未</sup></a></li> --}}
              </ul>
          </li>
          <li class="l-sp-nav__menu-item">
            <a class="l-sp-nav__btn l-sp-nav__btn--useful js-sp-navigation-button" href="#spUseful">お役立ち情報</a>
              <ul class="l-sp-nav__sub-menu js-sp-navigation-submenu">
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.food')}}">ごはん</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.fashion')}}">ファッション</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.event')}}">イベント</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.goods')}}">グッズ</a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.shop')}}">店舗・施設</a></li>
                {{--
                <li class="l-sp-nav__sub-menu-item"><a href="#">ドック・治療<sup> 未</sup></a></li>--}}
                <li class="l-sp-nav__sub-menu-item"><a href="{{route('useful.history')}}">歴史</a></li>
                {{--
                <li class="l-sp-nav__sub-menu-item"><a href="#">その他<sup> 未</sup></a></li>
                <li class="l-sp-nav__sub-menu-item"><a href="#">困ったときは?<sup> 未</sup></a></li> --}}
              </ul>
          </li>
        </ul>
      </nav>
      @endif
        {{-- オーナー登録済 かつ aibo登録済(ここまで) --}}
  @endauth