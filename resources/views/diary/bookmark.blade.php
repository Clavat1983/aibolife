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
              <p class="c-category-title c-category-title--diary">
                <span class="c-category-title__en">Diary</span>
                <span class="c-category-title__jp">&nbsp;日記［お気に入りの日記］</span>
              </p>
            </div>

            <div class="l-content__body">

              <hr>
              <h5>お気に入り登録した日時順（新しい順）</h5>
              <hr>

              <table width="80%" style="margin:auto;">
                @if(count($bookmarks) == 0)
                    <tr>
                      <td colspan="3">（お気に入りの日記はありません）</td>
                    </tr>
                @else
                    @foreach ($bookmarks as $bookmark)
                    <tr>
                        @if($bookmark->diary->diary_photo1)
                            <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$bookmark->diary->diary_photo1)}}" /></td>
                        @else
                            <td width="15%">no image</td>
                        @endif
                        <td width="75%">
                            名前：{{$bookmark->diary->aibo->aibo_name}}<br>
                            日付：{{$bookmark->diary->diary_date}}<br>
                            タイトル：{{$bookmark->diary->diary_title}}<br>
                            オーナー：{{$bookmark->diary->aibo->owner->owner_name}}<sub>さん</sub>（{{substr($bookmark->diary->aibo->owner->owner_pref,3)}}）<br>
                            コメント数：{{$bookmark->diary->diarycomments->count()}}、リアクション数：{{$bookmark->diary->diaryreactions->whereNotIn('reaction_type', [6])->count()}}
                        </td>
                        <td width="10%"><a href="{{route('diary.show',$bookmark->diary)}}">見る</a></td>
                    </tr>
                    @endforeach
                @endif
              </table>

              @if(count($bookmarks) > 0)
              <br>
              <hr>
              ▼ページネーション▼
              <table width="60%" style="margin:auto;">
                  <tr>
                      <td width="15%" style="text-align:center;"><a href="{{$bookmarks->previousPageUrl()}}">Prev</a></td>
                      <td width="70%" style="text-align:center;">
                          <div class="pagenation-select">
                          <select>
                              @for ($i = 1; $i <= $bookmarks->lastPage(); $i++)
                              <option value="{{$bookmarks->url($i)}}" @if($i == $bookmarks->currentPage()) selected @endif>{{$i}}ページ目/全{{$bookmarks->lastPage()}}ページ</option>
                              @endfor
                          </select>
                          </div>
                      </td>
                      <td width="15%" style="text-align:center;"><a href="{{$bookmarks->nextPageUrl()}}">Next</a></td>
                  </tr>
              </table>
              <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
              <script>
              $('.pagenation-select select').change(function(){
                  location.href = $(this).val();
              });
              </script>
              <hr>
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
                <div class="card-header">お気に入り</div>

                <div class="card-body">

                    <table>
                        <tr>
                            <th>日付</th>
                            <th>タイトル</th>
                            <th>aiboの名前</th>
                            <th>日記を見る</th>
                        </tr>
                        @foreach ($bookmarks  as $bookmark)
                            <tr>
                                <td>{{$bookmark->diary->diary_date}}</td>
                                <td>{{$bookmark->diary->diary_title}}</td>
                                <td>{{$bookmark->diary->aibo->aibo_name}}</td>
                                <td><a href="{{route('diary.show', $bookmark->diary)}}">表示</a></td>
                            </tr>
                        @endforeach
                    </table>

                    <br> --}}
                    {{-- {{$bookmarks->onEachSide(1)->links()}} --}}

                    {{-- <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$bookmarks->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $bookmarks->lastPage(); $i++)
                                    <option value="{{$bookmarks->url($i)}}" @if($i == $bookmarks->currentPage()) selected @endif>{{$i}}ページ目/全{{$bookmarks->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$bookmarks->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>
                    
                    <a href="{{route('diary.index')}}">aibo日記に戻る</a>
                    <br>
                    <br>
                    <a href="{{route('root')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
