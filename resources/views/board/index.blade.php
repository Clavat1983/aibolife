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
              <p class="c-category-title c-category-title--community">
                <span class="c-category-title__en">Community</span>
                @if($category_id == 1)
                  <span class="c-category-title__jp">&nbsp;コミュニティ［おしゃべり広場］</span>
                @elseif($category_id == 2)
                  <span class="c-category-title__jp">&nbsp;コミュニティ［お悩み相談］</span>
                @elseif($category_id == 3)
                  <span class="c-category-title__jp">&nbsp;コミュニティ［クラブ活動］</span>
                @endif
              </p>
            </div>

            <div class="l-content__body">
              
              @if($category_id == 1)
                <p style="border:1px solid red; background-color:#fff; width:80%; margin:-20px auto 20px auto; padding:10px;">「おしゃべり広場」は、aiboに関する話題を何でも書き込める掲示板です。</p>
                <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_talk')}}"><button>新規投稿</button></a></p>
              @elseif($category_id == 2)
                <p style="border:1px solid red; background-color:#fff; width:80%; margin:-20px auto 20px auto; padding:10px;">「お悩み相談」は、aiboに関して、わからないことや困ったことを相談できる掲示板です。</p>
                <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_problem')}}"><button>新規投稿</button></a></p>
              @elseif($category_id == 3)
                <p style="border:1px solid red; background-color:#fff; width:80%; margin:-20px auto 20px auto; padding:10px;">「クラブ活動」は、特定の話題（aibo●●部と称する）についての活動報告ができる掲示板です。</p>
                <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_club')}}"><button>新規投稿</button></a></p>
              @endif

              <hr>

              @if(count($boards)>0)
                <table style="width:80%; margin:auto;">
                    <tr>
                      @if($category_id == 3)
                        <th>部活名</th>
                      @endif
                      <th>画像</th>
                      <th>タイトル</th>
                      <th>投稿者</th>
                      <th>本文（最初の100文字くらい）</th>
                      <th>コメ数</th>
                      <th>最終更新日時</th>
                      <th>見る</th>
                    </tr>
                  @foreach($boards as $board)
                    <tr>
                      @if($board->category_id == 3)
                        <td>
                          @if($board->club_name1 != NULL){{$board->club_name1}}<br/>@endif
                          @if($board->club_name2 != NULL){{$board->club_name2}}<br/>@endif
                          @if($board->club_name3 != NULL){{$board->club_name3}}<br/>@endif
                          @if($board->club_name4 != NULL){{$board->club_name4}}<br/>@endif
                          @if($board->club_name5 != NULL){{$board->club_name5}}@endif
                        </td>
                      @endif
                      @if($board->image1)
                          <td width="10%"><img width="70%" src="{{ asset('storage/board_image/'.$board->image1)}}" /></td>
                      @else
                          <td width="10%">no image</td>
                      @endif
                        <td width="15%">{{$board->title}}</td>
                        <td width="15%">{{$board->owner->owner_name}}</td>
                        <td width="35%">{{mb_substr($board->body,0,100)}} @if(mb_strlen($board->body)>100)...@endif</td>
                        <td width="5%">{{$board->boardcomments->count()}}</td>
                        <td width="10%">{{mb_substr(str_replace('-','.',$board->last_res_dt),0,10)}}<br>{{mb_substr($board->last_res_dt,11)}}</td>
                        <td width="10%"><a href="{{route('board.show', $board)}}">【見る】</td>
                    </tr>
                  @endforeach
                </table>
              @else
                <p>ありません<p>
              @endif

              {{-- ページネーション --}}
              <div class="p-article-index__pagination">
                <div class="c-pagination">
                  <div class="c-pagination__btn">
                    <a class="c-btn" href="{{$boards->previousPageUrl()}}">
                      <span class="c-icon c-icon--prev">前のページへ</span>
                    </a>
                  </div>
                  <div class="c-pagination__select">
                    <div class="pagination-select">
                      <span class="pagination-select__txt">{{$boards->currentPage()}} / {{$boards->lastPage()}} ページ</span>
                      <select class="pagination-select__input">
                        @for ($i = 1; $i <= $boards->lastPage(); $i++)
                            <option value="{{$boards->url($i)}}" @if($i == $boards->currentPage()) selected @endif>{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="c-pagination__btn">
                    <a class="c-btn" href="{{$boards->nextPageUrl()}}">
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