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
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Search</span>
                <span class="c-category-ttl__jp">検索［日記］</span>
              </p>
            </div>

            <div class="l-content__body">
              
                <form method="get" action="{{route('diary.search')}}">
                    @csrf
                    <div>
                        <b>［検索条件］</b><br>
                        <br>
                        <label for="keywords"><b>検索キーワード：</b></label>
                        <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}">
                        <br>
                        ※日記のタイトルか本文に検索キーワードを含むもの。スペース区切りで複数キーワードを検索可能。<br>
                        <br>
                        <label for="diary_date_from"><b>日付：</b></label>
                        <input type="date" name="diary_date_from" id="diary_date_from" value="{{old('diary_date_from', $diary_date_from)}}">～
                        <input type="date" name="diary_date_to" id="diary_date_to" value="{{old('diary_date_to', $diary_date_to)}}">
                        <br>
                        <br>
                        <label for="aibo_name"><b>aiboの名前：</b></label>
                        <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                        <br>
                        ※名前の一部や読み（ひらがな）でも検索可能。<br>
                        <br>
                        <button type="submit" class="btn btn-success">検索</button>
                    </div>
                </form>

            @if($search_flag)
                <hr/>
                
                {{--ページネーション前の合計--}}
                <h2>【検索結果】 {{$results->total()}}件</h2>
                ※日記の日付が新しい順、タイトルか本文に検索キーワードを含むもの。
                
                <br>
                <br>

                @if(count($results))
                    <table width="80%" style="margin:auto;">

                        @foreach ($results as $diary)

                            <tr>
                                <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                                <td width="75%">
                                    名前：{{$diary->aibo->aibo_name}}<br>
                                    日付：{{$diary->diary_date}}<br>
                                    タイトル：{{$diary->diary_title}}
                                </td>
                                <td width="10%"><a href="{{route('diary.show',$diary->id)}}">見る</a></td>
                            </tr>

                            {{-- 日付：[{{$diary->diary_date}}]、ID：{{$diary->id}}、日記：{{$diary->diary_title}}、aibo名：{{$diary->aibo->aibo_name}}　<a href="{{route('diary.show', $diary->id)}}">【見る】</a><br> --}}
                        @endforeach
                    
                    </table>

                    <br>

                    {{-- {{$results->appends([
                        'keywords' => $keywords,
                        'diary_date_from' => $diary_date_from,
                        'diary_date_to' => $diary_date_to,
                        'aibo_name' => $aibo_name,
                    ])->onEachSide(1)->links()}}<br> --}}
                    
                    <hr>
                    
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                'keywords' => $keywords,
                                'diary_date_from' => $diary_date_from,
                                'diary_date_to' => $diary_date_to,
                                'aibo_name' => $aibo_name,
                            ])->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $results->lastPage(); $i++)
                                    <option value="{{$results->appends([
                                        'keywords' => $keywords,
                                        'diary_date_from' => $diary_date_from,
                                        'diary_date_to' => $diary_date_to,
                                        'aibo_name' => $aibo_name,
                                    ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                'keywords' => $keywords,
                                'diary_date_from' => $diary_date_from,
                                'diary_date_to' => $diary_date_to,
                                'aibo_name' => $aibo_name,
                            ])->nextPageUrl()}}">Next</a></td>
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
                    <table width="80%" style="margin:auto;">
                        <tr>
                            <td colspan="3">（検索条件に合致する日記はありません）</td>
                        </tr>
                    </table>
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
                <div class="card-header">日記（検索）</div>

                <div class="card-body">

                    <form method="get" action="{{route('diary.search')}}">
                        @csrf
                        <div>
                            <label for="keywords">検索キーワード：</label>
                            <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}">
                            <br>
                            <br>
                            <label for="diary_date_from">期間：</label>
                            <input type="date" name="diary_date_from" id="diary_date_from" value="{{old('diary_date_from', $diary_date_from)}}">～
                            <input type="date" name="diary_date_to" id="diary_date_to" value="{{old('diary_date_to', $diary_date_to)}}">
                            <br>
                            <br>
                            <label for="aibo_name">aiboの名前：</label>
                            <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-success">検索</button>
                        </div>
                    </form>

                    @if($search_flag)
                    <hr/>
                    {{--ページネーション前の合計--}}
                    {{-- <h2>【検索結果】 {{$results->total()}}件</h2>
                    ※日記の日付が新しい順、タイトルか本文に検索キーワードを含むもの
                    <hr/>
                    @if(count($results))
                        @foreach ($results as $diary)
                            日付：[{{$diary->diary_date}}]、ID：{{$diary->id}}、日記：{{$diary->diary_title}}、aibo名：{{$diary->aibo->aibo_name}}　<a href="{{route('diary.show', $diary->id)}}">【見る】</a><br>
                        @endforeach
                        <br> --}}

                        {{-- {{$results->appends([
                            'keywords' => $keywords,
                            'diary_date_from' => $diary_date_from,
                            'diary_date_to' => $diary_date_to,
                            'aibo_name' => $aibo_name,
                        ])->onEachSide(1)->links()}}<br> --}}
                        {{-- <hr>
                        ▼ページネーション▼
                        <table width="60%" style="margin:auto;">
                            <tr>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'keywords' => $keywords,
                                    'diary_date_from' => $diary_date_from,
                                    'diary_date_to' => $diary_date_to,
                                    'aibo_name' => $aibo_name,
                                ])->previousPageUrl()}}">Prev</a></td>
                                <td width="70%" style="text-align:center;">
                                    <div class="pagenation-select">
                                    <select>
                                        @for ($i = 1; $i <= $results->lastPage(); $i++)
                                        <option value="{{$results->appends([
                                            'keywords' => $keywords,
                                            'diary_date_from' => $diary_date_from,
                                            'diary_date_to' => $diary_date_to,
                                            'aibo_name' => $aibo_name,
                                        ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                        @endfor
                                    </select>
                                    </div>
                                </td>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'keywords' => $keywords,
                                    'diary_date_from' => $diary_date_from,
                                    'diary_date_to' => $diary_date_to,
                                    'aibo_name' => $aibo_name,
                                ])->nextPageUrl()}}">Next</a></td>
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
