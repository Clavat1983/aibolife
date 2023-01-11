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
                <span class="c-category-title__jp">最新情報［検索］</span>
              </p>
            </div>
            <div class="l-content__body">


                <table style="margin:auto;">
                    <tr>
                        <td colspan="2" style="background-color:lightyellow;">
                            <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">公式ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_info')}}">お知らせ</a>｜<a href="{{route('news.index_update')}}">アップデート</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
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
                        <table>
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
                                            {{-- @if($news->news_tag1)#{{$news->news_tag1}}@endif
                                            @if($news->news_tag2)｜#{{$news->news_tag2}}@endif
                                            @if($news->news_tag3)｜#{{$news->news_tag3}}@endif
                                            @if($news->news_tag4)｜#{{$news->news_tag4}}@endif
                                            @if($news->news_tag5)｜#{{$news->news_tag5}}@endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <br>


                        {{-- {{$results->appends(['keywords' => $keywords])->onEachSide(1)->links()}}<br> --}}
                        <hr>
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
                                <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_info')}}">お知らせ</a>｜<a href="{{route('news.index_update')}}">アップデート</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
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
