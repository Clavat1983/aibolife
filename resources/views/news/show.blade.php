<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>aibo life ------【U_01102】最新情報・News(個別) &#8211; websitekit</title>
    <meta name="description" content="最新情報・News(個別)" />
    <meta property="og:title" content="【U_01102】最新情報・News(個別)" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../../assets/images/ogp.png"
    />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:description" content="最新情報・News(個別)" />
    <meta property="og:site_name" content="websitekit" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="{{url()->full()}}" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />
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
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">TOPICS</span>
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
                          <a href="http://line.me/R/msg/text/?{{url()->full()}}%0a【U_01102】最新情報・News(個別)">
                            <img src="{{asset('img/logo_line.png')}}" width="44" alt="LINE"/>
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a href="http://www.facebook.com/share.php?u={{url()->full()}}" rel="nofollow noopener" target="_blank">
                            <img src="{{asset('img/logo_facebook.png')}}" width="44" alt="Facebook"/>
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a href="https://twiter.com/share?url={{url()->full()}}" rel="nofollow noopener" target="_blank">
                            <img src="{{asset('img/logo_twitter.png')}}" width="44" alt="Twitter"/>
                          </a>
                        </li>
                      </ul>
                    </dd>
                  </dl>
                </footer>
              </article>
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