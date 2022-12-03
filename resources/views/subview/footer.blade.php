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
              <a class="l-footer__logo-link" href="{{route('home')}}">
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
                  <a class="l-footer__list-link" href="{{route('contact.index')}}">お問い合わせ</a>
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
          <small class="l-footer__copyright-inner">©︎ aibo life</small>
        </p>
      </div>
    </div>
  </footer>