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
                @if($board->category_id == 1)
                  <span class="c-category-title__jp">おしゃべり広場</span>
                @elseif($board->category_id == 2)
                  <span class="c-category-title__jp">お悩み相談</span>
                @elseif($board->category_id == 3)
                  <span class="c-category-title__jp">クラブ活動</span>
                @endif
              </p>
            </div>

            <div class="l-content__body">

              @if($board)
                <table>
                    <tr>
                      @if($board->category_id == 3)
                        <th>部活名</th>
                      @endif
                      <th>タイトル</th>
                      <th>投稿者</th>
                      <th>本文</th>
                    </tr>
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

                    </tr>
                </table>

                <hr>

              <form method="POST" action="{{route('boardcomment.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="board_id" value="{{$board->id}}">

                  @if(count($board->boardcomments) > 0)
                    <p>コメントが{{count($board->boardcomments)}}件あります</p>
                    <hr>

                    @php
                      $prev_child_no = 0;
                      $prev_mago_no = 0;
                      $margin = 0;
                    @endphp

                    @foreach($board->boardcomments->sortBy([
                        ['child_no', true], // [カラム名, 昇順でソートするか]
                        ['mago_no', true]
                      ]) as $comment)
                      
                      {{-- 孫レスの投稿フォーム --}}
                      @if($prev_child_no != 0 && $prev_child_no != $comment->child_no)
                        <p style="margin-left:80px"><b>レスのレス　入力欄（親:{{$comment->board_id}}、子:{{$prev_child_no}}）</b><br>
                        <textarea name="body_{{$comment->board_id}}-{{$prev_child_no}}-x"></textarea><br>
                        <button type="submit" name=submit_no value="{{$comment->board_id}}-{{$prev_child_no}}-x">投稿（{{$comment->board_id}}-{{$prev_child_no}}-x）</button></p>
                        <hr>
                      @endif

                      {{-- 本文 --}}
                      @if($comment->mago_no == 0)
                        <p style="margin-left:30px">{{$comment->board_id}}-{{$comment->child_no}}-{{$comment->mago_no}}　⇒　{{$comment->body}}</p>
                      @else
                        <p style="margin-left:80px">{{$comment->board_id}}-{{$comment->child_no}}-{{$comment->mago_no}}　⇒　{{$comment->body}}</p>
                      @endif

                      @php
                        $prev_child_no = $comment->child_no;
                        $prev_mago_no = $comment->mago_no;
                      @endphp

                    @endforeach


                    <!-- ループ後 -->
                    {{-- 直前が孫で終わっていたら、孫レスの投稿フォーム --}}
                    {{-- @if($prev_mago_no != 0) --}}
                      <p style="margin-left:80px"><b>レスのレス　入力欄（親:{{$comment->board_id}}、子:{{$prev_child_no}}）</b><br>
                      <textarea name="body_{{$comment->board_id}}-{{$prev_child_no}}-x"></textarea><br>
                      <button type="submit" name=submit_no value="{{$comment->board_id}}-{{$prev_child_no}}-x">投稿（{{$comment->board_id}}-{{$prev_child_no}}-x）</button></p>
                      <hr>
                    {{-- @endif --}}
                    
                    {{-- レスの投稿フォーム --}}
                    <p style="margin-left:30px"><b>レスの入力欄（親:{{$comment->board_id}}）</b><br>
                    <textarea name="body_{{$comment->board_id}}-x-0"></textarea><br>
                    <button type="submit" name=submit_no value="{{$comment->board_id}}-x-0">投稿（{{$comment->board_id}}-x-0）</button></p>
                    <hr>

                  @else
                    <p>コメントはありません</p>
                    <hr>
                    {{-- レスの投稿フォーム --}}
                    <p style="margin-left:30px"><b>レスの入力欄（親:{{$board->id}}）</b><br>
                      <textarea name="body_{{$board->id}}-x-0"></textarea><br>
                      <button type="submit" name=submit_no value="{{$board->id}}-x-0">投稿（{{$board->id}}-x-0）</button></p>
                  @endif

                @endif

                  
              </form>

              <!-- 戻るボタン -->
              @if($board->category_id == 1)
                <p style="text-align:center;"><a href="{{route('board.index_talk')}}"><button>一覧に戻る</button></a></p>
              @elseif($board->category_id == 2)
                <p style="text-align:center;"><a href="{{route('board.index_problem')}}"><button>一覧に戻る</button></a></p>
              @elseif($board->category_id == 3)
                <p style="text-align:center;"><a href="{{route('board.index_club')}}"><button>一覧に戻る</button></a></p>
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