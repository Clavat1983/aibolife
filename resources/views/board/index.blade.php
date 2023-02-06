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
                <span class="c-category-title__en">Board</span>
                @if($category_id == 1)
                  <span class="c-category-title__jp">おしゃべり広場</span>
                @elseif($category_id == 2)
                  <span class="c-category-title__jp">お悩み相談</span>
                @elseif($category_id == 3)
                  <span class="c-category-title__jp">クラブ活動</span>
                @endif
              </p>
            </div>

            <div class="l-content__body">
              
              @if($category_id == 1)
              <p>「おしゃべり広場」は、aiboに関する話題を何でも書き込める掲示板です。</p>
              <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_talk')}}"><button>新規投稿</button></a></p>
            @elseif($category_id == 2)
              <p>「お悩み相談」は、aiboに関して、わからないことや困ったことを相談できる掲示板です。</p>
              <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_problem')}}"><button>新規投稿</button></a></p>
            @elseif($category_id == 3)
              <p>「クラブ活動」は、特定の話題（aibo●●部と称する）についての活動報告ができる掲示板です。</p>
              <p style="text-align:right; margin-right:15%;"><a href="{{route('board.create_club')}}"><button>新規投稿</button></a></p>
            @endif

              @if(count($boards)>0)
                <table>
                    <tr>
                      @if($category_id == 3)
                        <th>部活名</th>
                      @endif
                      <th>タイトル</th>
                      <th>投稿者</th>
                      <th>本文（最初の100文字くらい）</th>
                      <th>コメント数</th>
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
                        <td>{{$board->title}}</td>
                        <td>{{$board->owner->owner_name}}</td>
                        <td>{{$board->body}}</td>
                        <td>{{$board->boardcomments->count()}}</td>
                        <td>{{$board->last_res_dt}}</td>
                        <td><a href="{{route('board.show', $board)}}">【見る】</td>
                    </tr>
                  @endforeach
                </table>
              @else
                <p>ありません<p>
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