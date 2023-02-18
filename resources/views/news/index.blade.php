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
          <div class="l-content">
{{-- --------------------------------------------------------------------------- --}}

<div class="l-content__header">
    <h1 class="c-category-title c-category-title--topics">
      <span class="c-category-title__en">Topics</span>
      <span class="c-category-title__jp">&nbsp;最新情報［{{$category}}］</span>
    </h1>
  </div>

  <p style="border:1px solid red; background-color:#fff; width:80%; margin:-20px auto 20px auto; padding:10px;">この部分にページ概要を入れたい。全ページ共通で枠を用意していただければ。個別記事とか概要を入れないページはその部分をコメントアウトします。</p>

  <div class="l-content__body">
    <div class="p-article-index">
      <dl class="p-article-index__category">
        <dt class="p-article-index__category-title">
          <p class="c-ttl5">カテゴリ選択</p>
        </dt>
        <dd class="p-article-index__category-detail">
          <ul class="c-category-list">

            <li class="c-category-list__item">
              @if($category == "すべて")
                <span class="c-category-list__link c-category-list__link--current">すべて</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index')}}">すべて</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "ニュース")
                <span class="c-category-list__link c-category-list__link--current">ニュース</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_news')}}">ニュース</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "My aibo")
                <span class="c-category-list__link c-category-list__link--current">My aibo</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_app')}}">My aibo</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "イベント")
                <span class="c-category-list__link c-category-list__link--current">イベント</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_event')}}">イベント</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "メディア")
                <span class="c-category-list__link c-category-list__link--current">メディア</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_media')}}">メディア</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "ストア")
                <span class="c-category-list__link c-category-list__link--current">ストア</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_store')}}">ストア</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "特別企画")
                <span class="c-category-list__link c-category-list__link--current">特別企画</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_special')}}">特別企画</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "メンテナンス")
                <span class="c-category-list__link c-category-list__link--current">メンテナンス</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_maintenance')}}">メンテナンス</a>
              @endif
            </li>

            <li class="c-category-list__item">
              @if($category == "その他")
                <span class="c-category-list__link c-category-list__link--current">その他</span>
              @else
                <a class="c-category-list__link" href="{{route('news.index_etc')}}">その他</a>
              @endif
            </li>
            
          </ul>
        </dd>
      </dl>

@if(count($news_all)>0)
      <div class="p-article-index__article">
        <ul class="c-article-list">
        @foreach($news_all as $news)
          <li class="c-article-list__item">
            <a class="c-article-list__article" href="{{route('news.show', $news)}}">
              <div class="c-article-list__article-thumb">
                <div class="c-article-image">
                  @if($news->news_image1)
                    <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" alt=""/>
                  @else
                    no image
                  @endif
                </div>
              </div>
              <div class="c-article-list__article-detail">
                <div class="c-article-list__info">
                  <div class="c-article-list__info-item">
                    <p class="c-date">{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}</p>
                  </div>
                  <div class="c-article-list__info-item">
                    <span class="c-category-label02">
                      {{$news->news_category}}
                    </span>
                  </div>
                </div>
                @if(strstr($news->news_source_name,'公式',false))
                  <div style="font-size:80%;"><b>［公式］</b></div>
                @else
                  <div style="font-size:80%;"><b>［{{$news->news_source_name}}］</b></div>
                @endif
                <h2 class="c-article-list__ttl" style="margin-left:1em;">
                  {{$news->news_title}}<br>
                </h2>
              </div>
            </a>
          </li>
        @endforeach
        </ul>
      </div>
      {{-- ページネーション --}}
      <div class="p-article-index__pagination">
        <div class="c-pagination">
          <div class="c-pagination__btn">
            <a class="c-btn" href="{{$news_all->previousPageUrl()}}">
              <span class="c-icon c-icon--prev">前のページへ</span>
            </a>
          </div>
          <div class="c-pagination__select">
            <div class="pagination-select">
              <span class="pagination-select__txt">{{$news_all->currentPage()}} / {{$news_all->lastPage()}} ページ</span>
              <select class="pagination-select__input">
                @for ($i = 1; $i <= $news_all->lastPage(); $i++)
                    <option value="{{$news_all->url($i)}}" @if($i == $news_all->currentPage()) selected @endif>{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="c-pagination__btn">
            <a class="c-btn" href="{{$news_all->nextPageUrl()}}">
              <span class="c-icon c-icon--next">次のページへ</span>
            </a>
          </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
      <script>
      $('.pagination-select__input').change(function(){
          location.href = $(this).val();
      });
      </script>
@else
      <div class="p-article-index__article"><p>ありません</p></div>
@endif


    </div>
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


@php
/*
<div class="l-content__header">
    <p class="c-category-title c-category-title--topics">
      <span class="c-category-title__en">Topics</span>
      <span class="c-category-title__jp">最新情報［{{$category}}］</span>
    </p>
  </div>
  <div class="l-content__body">


      <table style="margin:auto;">
          <tr>
              <td colspan="2" style="background-color:lightyellow;">
                  <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_app')}}">My aibo</a>｜<a href="{{route('news.index_store')}}">ストア</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
          </tr>

          @if(count($news_all)>0)
              @foreach($news_all as $news)
              <tr>
                  @if($news->news_image1)
                      <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                  @else
                      <td style="padding:10px;">no image</td>
                  @endif
                  <td style="padding:10px;">
                      {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}［{{$news->news_category}}］<br>
                      <a href="{{route('news.show', $news)}}">{{$news->news_title}}</a><br/>
                          {{-- @if($news->news_tag1)#{{$news->news_tag1}}@endif
                          @if($news->news_tag2)｜#{{$news->news_tag2}}@endif
                          @if($news->news_tag3)｜#{{$news->news_tag3}}@endif
                          @if($news->news_tag4)｜#{{$news->news_tag4}}@endif
                          @if($news->news_tag5)｜#{{$news->news_tag5}}@endif --}}
                  </td>
              </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="2"><br>ありません<br><br></td>
              </tr>
          @endif
      </table>

      <hr>

      <p style="text-align:center;">▼ページネーション▼</p>
      <table width="60%" style="margin:auto;">
          <tr>
              <td width="15%" style="text-align:center;"><a href="{{$news_all->previousPageUrl()}}">Prev</a></td>
              <td width="70%" style="text-align:center;">
                  <div class="pagenation-select">
                  <select>
                      @for ($i = 1; $i <= $news_all->lastPage(); $i++)
                      <option value="{{$news_all->url($i)}}" @if($i == $news_all->currentPage()) selected @endif>{{$i}}ページ目/全{{$news_all->lastPage()}}ページ</option>
                      @endfor
                  </select>
                  </div>
              </td>
              <td width="15%" style="text-align:center;"><a href="{{$news_all->nextPageUrl()}}">Next</a></td>
          </tr>
      </table>
      
      <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
      <script>
      $('.pagenation-select select').change(function(){
          location.href = $(this).val();
      });
      </script>
      <hr>

  </div>
*/
@endphp