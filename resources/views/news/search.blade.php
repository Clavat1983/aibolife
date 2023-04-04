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
              <p class="c-category-title c-category-title--topics">
                <span class="c-category-title__en">Topics</span>
                <span class="c-category-title__jp">&nbsp;最新情報［検索］</span>
              </p>
            </div>

            <div class="l-content__body">
                <div class="p-article-index">
                    <form method="get" action="{{route('news.search')}}">
                        @csrf
                        
                        <div>
                            検索キーワード ※必須：
                            <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}"><br>
                            (?)タイトルまたは本文にキーワードが含まれるものが検索されます。<br>
                            (?)キーワードはスペースを入れて複数指定が可能です。その場合はすべてを含むものが検索されます。<br>
                        </div>
                        <div>
                            @if((strstr(url()->full(),'?') && old('keywords', $keywords) == ''))
                                <span style="color:red">検索キーワードは必須です</span>
                            @endif
                        </div>
                        <br>
                        <div>
                            カテゴリー（複数選択可）：
                                {{-- URLにtokenという文字がない=初回検索か、チェックが入っている場合 --}}
                                <input type="checkbox" name="cat_news" value="1" @if(!strstr(url()->full(),'?') || old('cat_news') || $cat_news == 1) checked @endif>
                                <label for="cat_news">ニュース</label>
                                <input type="checkbox" name="cat_app" value="1" @if(!strstr(url()->full(),'?') || old('cat_app') || $cat_app == 1) checked @endif>
                                <label for="cat_app">My aibo</label>
                                <input type="checkbox" name="cat_event" value="1" @if(!strstr(url()->full(),'?') || old('cat_event') || $cat_event == 1) checked @endif>
                                <label for="cat_event">イベント</label>
                                <input type="checkbox" name="cat_media" value="1" @if(!strstr(url()->full(),'?') || old('cat_media') || $cat_media == 1) checked @endif>
                                <label for="cat_media">メディア</label>
                                <input type="checkbox" name="cat_store" value="1" @if(!strstr(url()->full(),'?') || old('cat_store') || $cat_store == 1) checked @endif>
                                <label for="cat_store">ストア</label>
                                <input type="checkbox" name="cat_special" value="1" @if(!strstr(url()->full(),'?') || old('cat_special') || $cat_special == 1) checked @endif>
                                <label for="cat_special">特別企画</label>
                                <input type="checkbox" name="cat_maintenance" value="1" @if(!strstr(url()->full(),'?') || old('cat_maintenance') || $cat_maintenance == 1) checked @endif>
                                <label for="cat_maintenance">メンテナンス</label>
                                <input type="checkbox" name="cat_etc" value="1" @if(!strstr(url()->full(),'?') || old('cat_etc') || $cat_etc == 1) checked @endif>
                                <label for="cat_etc">その他</label>
                        </div>
                        <br>
                        <div>
                            検索期間：<input type="date" name="date_from" id="date_from" value="{{old('date_from', $date_from)}}">～
                            <input type="date" name="date_to" id="date_to" value="{{old('date_to', $date_to)}}"><br>
                            (?)指定しない場合は全期間。「開始」「終了」のみの指定も可能。
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">検索</button>
                    </form>

                    <br>
                    <br>
                    @if(strstr(url()->full(),'?') && $results != NULL)
                        <hr/>
                        検索結果（{{$results->total()}}件）
                        @if($results->total())
                            <div class="p-article-index__article">
                                <ul class="c-article-list"> 
                                    @foreach ($results as $news)
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

                            {{-- <table>
                                @foreach ($results as $news)
                                    <tr>
                                        @if($news->news_image1)
                                            <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                                        @else
                                            <td style="padding:10px;">no image</td>
                                        @endif
                                        <td style="padding:10px;">
                                            {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}［{{$news->news_category}}］<br>
                                            <a href="{{route('news.show', $news)}}">{{$news->news_title}}</a><br/>
                                                @if($news->news_tag1)#{{$news->news_tag1}}@endif
                                                @if($news->news_tag2)｜#{{$news->news_tag2}}@endif
                                                @if($news->news_tag3)｜#{{$news->news_tag3}}@endif
                                                @if($news->news_tag4)｜#{{$news->news_tag4}}@endif
                                                @if($news->news_tag5)｜#{{$news->news_tag5}}@endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table> --}}

                            <br>

                            {{-- {{$results->appends(['keywords' => $keywords])->onEachSide(1)->links()}}<br> --}}

                            @php
                                $appends = [
                                    'keywords' => $keywords,
                                    'cat_news' => $cat_news,
                                    'cat_app' => $cat_app,
                                    'cat_event' => $cat_event,
                                    'cat_media' => $cat_media,
                                    'cat_store' => $cat_store,
                                    'cat_special' => $cat_special,
                                    'cat_maintenance' => $cat_maintenance,
                                    'cat_etc' => $cat_etc,
                                    'date_from' => $date_from,
                                    'date_to' => $date_to,
                                ];
                            @endphp

                            <div class="p-article-index__pagination">
                                <div class="c-pagination">
                                <div class="c-pagination__btn">
                                    <a class="c-btn" href="{{$results->appends($appends)->previousPageUrl()}}">
                                    <span class="c-icon c-icon--prev">前のページへ</span>
                                    </a>
                                </div>
                                <div class="c-pagination__select">
                                    <div class="pagination-select">
                                    <span class="pagination-select__txt">{{$results->currentPage()}} / {{$results->lastPage()}} ページ</span>
                                    <select class="pagination-select__input">
                                        @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends($appends)->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                    </div>
                                </div>
                                <div class="c-pagination__btn">
                                    <a class="c-btn" href="{{$results->appends($appends)->nextPageUrl()}}">
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

                            {{-- <table width="60%" style="margin:auto;">
                                <tr>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends($appends)->previousPageUrl()}}">Prev</a></td>
                                    <td width="70%" style="text-align:center;">
                                        <div class="pagenation-select">
                                        <select>
                                            @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends($appends)->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends($appends)->nextPageUrl()}}">Next</a></td>
                                </tr>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                            <script>
                            $('.pagenation-select select').change(function(){
                                location.href = $(this).val();
                            });
                            </script> --}}

                        @else
                            <div class="p-article-index__article"><p>ありません</p></div>
                        @endif
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



{{-- @extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">最新情報（検索）</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td colspan="2" style="background-color:lightyellow;">
                                <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_app')}}">My aibo</a>｜<a href="{{route('news.index_store')}}">ストア</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
                        </tr>
                    </table>

                    <br>
                    <form method="get" action="{{route('news.search')}}">
                        @csrf
                        <div>
                            <label for="diary_title">検索キーワード：</label>
                            <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}">
                            <button type="submit" class="btn btn-success">検索</button>
                        </div>
                    </form>

                    @if($keywords != "")
                        <hr/>
                        {{$keywords}} の検索結果
                        <hr/>
                        @if(count($results))
                            @foreach ($results as $news)
                                ID：{{$news->id}}、タイトル：{{$news->news_title}}、<a href="{{route('news.show', $news->id)}}">【見る】</a><br> --}}
                                {{-- 本文： {!! $news->news_body !!}<br>
                                <hr> --}}
                            {{-- @endforeach
                            <br> --}}


                            {{-- {{$results->appends(['keywords' => $keywords])->onEachSide(1)->links()}}<br> --}}
                            {{-- <hr>
                            ▼ページネーション▼
                            <table width="60%" style="margin:auto;">
                                <tr>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends(['keywords' => $keywords])->previousPageUrl()}}">Prev</a></td>
                                    <td width="70%" style="text-align:center;">
                                        <div class="pagenation-select">
                                        <select>
                                            @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends(['keywords' => $keywords])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends(['keywords' => $keywords])->nextPageUrl()}}">Next</a></td>
                                </tr>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                            <script>
                            $('.pagenation-select select').change(function(){
                                location.href = $(this).val();
                            });
                            </script>
                            <hr>

                            
                        @else
                            検索結果がありません
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection --}}
