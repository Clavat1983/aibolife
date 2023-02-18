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

                <p style="background-color:black; color:yellow; text-align:center; font-size:150%;">【管理者専用 プレビュー】</p>

                <p class="c-category-title c-category-title--topics">
                  <span class="c-category-title__en">Topics</span>
                  <span class="c-category-title__jp">&nbsp;最新情報［{{$news->news_category}}］</span>
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
                            @if($news->news_category == 'ニュース')
                              <a class="c-category-label" href="{{route('news.index_news')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'My aibo')
                              <a class="c-category-label" href="{{route('news.index_app')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'イベント')
                              <a class="c-category-label" href="{{route('news.index_event')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'メディア')
                              <a class="c-category-label" href="{{route('news.index_media')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'ストア')
                              <a class="c-category-label" href="{{route('news.index_store')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == '特別企画')
                              <a class="c-category-label" href="{{route('news.index_special')}}">{{$news->news_category}}</a>
                            @elseif($news->news_category == 'メンテナンス')
                              <a class="c-category-label" href="{{route('news.index_maintenance')}}">{{$news->news_category}}</a>
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
                            
                            <!-- プレビュー限定 -->
                            @if($news->news_publication_flag)
                                <span style="color:blue;">【公開】</span>
                            @else
                                <span style="color:red;">【非公開】</span>
                            @endif

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

                        @if($news->news_source_url != NULL)
                          <p style="font-size:80%; text-align:right; margin-right:1em;"><b>［情報源：<a href="{{$news->news_source_url}}" target="blank">{{$news->news_source_name}}</a>］</b></p>
                        @else
                          <p style="font-size:80%; text-align:right; margin-right:1em;"><b>［情報源：{{$news->news_source_name}}］</b></p>
                        @endif

                      </div>
                      <footer class="c-article__footer">
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
                      </footer>
                    </div>
                  </div>

                  <div class="p-article-detail__footer">
                    <ul class="c-pager-buttons">
                    {{-- 
                      <li>
                        <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--prev">
                            
                          </span>
                        </a>
                      </li>
                     --}}
                      <li>
                        {{-- <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--next">
                            後の記事
                          </span>
                        </a>
                         --}}
                      </li>
                    
                      <li><a class="c-btn02" href="{{route('news.edit',$news)}}">編集画面へ</a></li>
                    </ul>
                  </div>
                </div>
              </div>

          </div>
        </div>
{{--         
        <br>
        <p style="text-align:center;"><a href="{{url()->previous()}}">一覧へ戻る</a></p> --}}

        <br>
        <p style="background-color:black; color:yellow; text-align:center; font-size:150%;">【管理者専用 プレビュー】</p>

        
        {{-- 【共通】バナー広告 --}}
        @include('subview.banner')

      </main>

      {{-- 【共通】footer --}}
      @include('subview.footer')
      
    </div>
    <script type="module" src="{{asset('js/common.js')}}"></script>
  </body>
</html>



@php
/*

@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
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
                </div>

                <div class="card-body">

                    【画像】<br>
                    @if($news->news_image1)
                        <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"><br>
                    @else {{-- 画像がない場合はデフォルト --}}
                        no image<br>
                        {{-- <img src="{{ asset('storage/news_image/default.jpg')}}" style="width:100px;"><br> --}}
                    @endif
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

                    {{-- 編集画面へ --}}
                    <p style="text-align:center;">
                        <a href="{{route('news.edit', $news)}}">【編集画面へ】</a>
                    </p>
                    {{-- 一覧画面へ --}}
                    <p style="text-align:center;">
                        <a href="{{route('news.admin')}}">【一覧画面へ】</a>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
@endsection

*/
@endphp