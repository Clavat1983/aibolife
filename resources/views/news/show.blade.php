<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>aibo life</title>
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
              <div class="l-content__header">
                <p class="c-category-title c-category-title--topics">
                  <span class="c-category-title__en">News</span>
                  <span class="c-category-title__jp">最新情報［{{$news->news_category}}］</span>
                </p>
              </div>
              <div class="l-content__body">
                <div class="p-article-detail">
                  <div class="p-article-detail__content">
                    <div class="c-article c-article--topics">
                      <header class="c-article__header">
                        <div class="c-article__info">
                          <div class="c-article__info-item">
                            <p class="c-date">{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}</p>
                          </div>
                          <div class="c-article__info-item">
                            @if($news->news_category == '公式ニュース')
                              <a class="c-category-label" href="{{route('news.index_news')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == '公式イベント')
                              <a class="c-category-label" href="{{route('index_event')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'メディア')
                              <a class="c-category-label" href="{{route('news.index_media')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'お知らせ')
                              <a class="c-category-label" href="{{route('news.index_info')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'アップデート')
                              <a class="c-category-label" href="{{route('news.index_update')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'メンテナンス')
                              <a class="c-category-label" href="{{route('news.index_maintenance')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'スペシャル')
                              <a class="c-category-label" href="{{route('news.index_special')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'その他')
                              <a class="c-category-label" href="{{route('news.index_etc')}}">{{$news->news_category}}</a>
                            @else
                              <a class="c-category-label" href="{{route('news.index')}}">{{$news->news_category}}</a>
                            @endif
                          </div>
                        </div>
                        <div class="c-article__ttl">
                          <h1 class="c-article-ttl">
                            {{$news->news_title}}
                          </h1>
                        </div>
                        {{-- <div class="c-article__tag">
                          <ul class="c-tags">
                            <li class="c-tags__item"><a href="#">#{{$news->news_tag1}}</a></li>
                            @if($news->news_tag2)<li class="c-tags__item"><a href="#">#{{$news->news_tag2}}</a></li>@endif
                            @if($news->news_tag3)<li class="c-tags__item"><a href="#">#{{$news->news_tag3}}</a></li>@endif
                            @if($news->news_tag4)<li class="c-tags__item"><a href="#">#{{$news->news_tag4}}</a></li>@endif
                            @if($news->news_tag5)<li class="c-tags__item"><a href="#">#{{$news->news_tag5}}</a></li>@endif
                          </ul>
                        </div> --}}
                      </header>
                      <div class="c-article__content">
                        <div class="c-article__images">
                          <ul class="c-images">
                            @if($news->news_image1)
                                <li class="c-images__item">
                                  <a href="javascript:;">
                                    <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" />
                                  </a>
                                </li>
                            @else
                                <li class="c-images__item">no image</li>
                            @endif
      
                            @if($news->news_image2)
                            <li class="c-images__item">
                              <a href="javascript:;">
                                <img src="{{ asset('storage/news_image/'.$news->news_image2)}}" />
                              </a>
                            </li>
                            @endif
                            @if($news->news_image3)
                            <li class="c-images__item">
                              <a href="javascript:;">
                                <img src="{{ asset('storage/news_image/'.$news->news_image3)}}" />
                              </a>
                            </li>
                            @endif
                            @if($news->news_image4)
                            <li class="c-images__item">
                              <a href="javascript:;">
                                <img src="{{ asset('storage/news_image/'.$news->news_image4)}}" />
                              </a>
                            </li>
                            @endif
                            @if($news->news_image5)
                            <li class="c-images__item">
                              <a href="javascript:;">
                                <img src="{{ asset('storage/news_image/'.$news->news_image5)}}" />
                              </a>
                            </li>
                            @endif
                          </ul>
                        </div>
                        <div class="c-article__body">
                          {!! $news->news_body !!}
                        </div>

                        @if($news->news_link1_name || $news->news_link2_name || $news->news_link3_name || $news->news_link4_name || $news->news_link5_name)
                        <aside class="c-article__aside">
                          <header class="c-article__aside-ttl">
                            <h2 class="c-icon-ttl">リンク</h2>
                          </header>
                          <div class="c-article__aside-body">
                            <ul class="c-link-list">
                              @if($news->news_link1_name)
                              <li class="c-link-list__item">
                                <a href="{{$news->news_link1_url}}" target="blank">{{$news->news_link1_name}}</a>
                              </li>
                              @endif
                              @if($news->news_link2_name)
                              <li class="c-link-list__item">
                                <a href="{{$news->news_link2_url}}" target="blank">{{$news->news_link2_name}}</a>
                              </li>
                              @endif
                              @if($news->news_link3_name)
                              <li class="c-link-list__item">
                                <a href="{{$news->news_link3_url}}" target="blank">{{$news->news_link3_name}}</a>
                              </li>
                              @endif
                              @if($news->news_link4_name)
                              <li class="c-link-list__item">
                                <a href="{{$news->news_link4_url}}" target="blank">{{$news->news_link4_name}}</a>
                              </li>
                              @endif
                              @if($news->news_link5_name)
                              <li class="c-link-list__item">
                                <a href="{{$news->news_link5_url}}" target="blank">{{$news->news_link5_name}}</a>
                              </li>
                              @endif
                            </ul>
                          </div>
                        </aside>
                        @endif

                      </div>
                      {{-- <footer class="c-article__footer">
                        <dl class="c-sns">
                          <dt class="c-sns__ttl">SNS にシェア</dt>
                          <dd class="c-sns__detail">
                            <ul class="c-sns-list">
                              <li class="c-sns-list__item">
                                <a href="http://line.me/R/msg/text/?{{url()->full()}}%0a【U_01102】最新情報・News(個別)" target="_blank">
                                  <img src="{{asset('img/logo_line.png')}}" width="44" alt="LINE"/>
                                </a>
                              </li>
                              <li class="c-sns-list__item">
                                <a href="http://www.facebook.com/share.php?u={{url()->full()}}" rel="nofollow noopener" target="_blank">
                                  <img src="{{asset('img/logo_facebook.png')}}" width="44" alt="Facebook"/>
                                </a>
                              </li>
                              <li class="c-sns-list__item">
                                <a href="https://twitter.com/share?url={{url()->full()}}" rel="nofollow noopener" target="_blank">
                                  <img src="{{asset('img/logo_twitter.png')}}" width="44" alt="Twitter"/>
                                </a>
                              </li>
                            </ul>
                          </dd>
                        </dl>
                      </footer> --}}
                    </div>
                  </div>
                  <div class="p-article-detail__footer">
                    <ul class="c-pager-buttons">
                      <li>
                        <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--prev">
                            前の記事
                          </span>
                        </a>
                      </li>
                      <li>
                        <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--next">
                            後の記事
                          </span>
                        </a>
                      </li>
                      <li><a class="c-btn02" href="{{url()->previous()}}">一覧</a></li>
                    </ul>
                  </div>
                </div>
              </div>

































{{-- --------------------------------------------------------------------------- --}}
@php
/*
<div class="l-content__header">
              <p class="c-category-title c-category-title--topics">
                <span class="c-category-title__en">TOPICS</span>
                <span class="c-category-title__jp">最新情報［{{$news->news_category}}］</span>
              </p>
            </div>
            <div class="l-content__body">
              <div class="p-article-detail">
                <div class="p-article-detail__content">
                  <div class="c-article c-article--topics">
                    <header class="c-article__header">
                      <div class="c-article__info">
                        <div class="c-article__info-item">
                          <p class="c-date">{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}</p>
                        </div>
                        <div class="c-article__info-item">
                          @if($news->news_category == '公式ニュース')
                            <a class="c-category-label" href="{{route('news.index_news')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == '公式イベント')
                            <a class="c-category-label" href="{{route('index_event')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'メディア')
                            <a class="c-category-label" href="{{route('news.index_media')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'お知らせ')
                            <a class="c-category-label" href="{{route('news.index_info')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'アップデート')
                            <a class="c-category-label" href="{{route('news.index_update')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'メンテナンス')
                            <a class="c-category-label" href="{{route('news.index_maintenance')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'スペシャル')
                            <a class="c-category-label" href="{{route('news.index_special')}}">{{$news->news_category}}</a>
                          @elseif($news->news_category == 'その他')
                            <a class="c-category-label" href="{{route('news.index_etc')}}">{{$news->news_category}}</a>
                          @else
                            <a class="c-category-label" href="{{route('news.index')}}">{{$news->news_category}}</a>
                          @endif
                        </div>
                      </div>
                      <div class="p-article-detail__ttl">
                        <h1 class="c-article-ttl">{{$news->news_title}}</h1>
                      </div>
                  <!-- タグ(要整理)は当面非表示に -->
                  {{-- <div class="c-article__tag">
                        <ul class="c-tags">
                      <li class="c-tags__item"><a href="#">#{{$news->news_tag1}}</a></li>
                      @if($news->news_tag2)<li class="c-tags__item"><a href="#">#{{$news->news_tag2}}</a></li>@endif
                      @if($news->news_tag3)<li class="c-tags__item"><a href="#">#{{$news->news_tag3}}</a></li>@endif
                      @if($news->news_tag4)<li class="c-tags__item"><a href="#">#{{$news->news_tag4}}</a></li>@endif
                      @if($news->news_tag5)<li class="c-tags__item"><a href="#">#{{$news->news_tag5}}</a></li>@endif
                    </ul>
                      </div> --}}
                </header>
                <div class="p-article-detail__content">
                  <div class="p-article-detail__slide">
                    <ul class="c-slide">
                      @if($news->news_image1)
                          <li class="c-slide__item">
                            <a href="javascript:;">
                              <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" />
                            </a>
                          </li>
                      @else
                          <li class="c-slide__item">no image</li>
                      @endif

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
                        <!-----------------ここからテキストエディタが挿入------------------>
                        {!! $news->news_body !!}
                        <!-----------------ここからテキストエディタが挿入------------------>
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
                {{-- <footer class="p-article-detail__footer">
                  <dl class="c-sns">
                    <dt class="c-sns__ttl">SNS にシェア</dt>
                    <dd class="c-sns__detail">
                      <ul class="c-sns-list">
                        <li class="c-sns-list__item">
                          <a href="http://line.me/R/msg/text/?{{url()->full()}}%0a【U_01102】最新情報・News(個別)" target="_blank">
                            <img src="{{asset('img/logo_line.png')}}" width="44" alt="LINE"/>
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a href="http://www.facebook.com/share.php?u={{url()->full()}}" rel="nofollow noopener" target="_blank">
                            <img src="{{asset('img/logo_facebook.png')}}" width="44" alt="Facebook"/>
                          </a>
                        </li>
                        <li class="c-sns-list__item">
                          <a href="https://twitter.com/share?url={{url()->full()}}" rel="nofollow noopener" target="_blank">
                            <img src="{{asset('img/logo_twitter.png')}}" width="44" alt="Twitter"/>
                          </a>
                        </li>
                      </ul>
                    </dd>
                  </dl>
                </footer> --}}
              </article>
            </div>
{{-- --------------------------------------------------------------------------- --}}
*/
@endphp

          </div>
        </div>
{{--         
        <br>
        <p style="text-align:center;"><a href="{{url()->previous()}}">一覧へ戻る</a></p> --}}

        {{-- 【共通】バナー広告 --}}
        @include('subview.banner')

      </main>

      {{-- 【共通】footer --}}
      @include('subview.footer')
      
    </div>
    <script type="module" src="{{asset('js/common.js')}}"></script>
  </body>
</html>