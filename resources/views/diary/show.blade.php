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
                <span class="c-category-title__jp">&nbsp;日記［{{$diary->aibo->aibo_name}}］</span>
              </p>
            </div>

            <div class="l-content__body">

            <div style="margin:auto;width:80%;">
                <p>日付：{{date('Y年m月d日', strtotime($diary->diary_date))}}</p>
                <h4>タイトル：{{$diary->diary_title}}</h4>

                {{-- お気に入り追加 --}}
                <form method="post" action="{{route('diaryreaction.store')}}">
                    @csrf
                    <input type="hidden" name='diary_id' value="{{$diary->id}}">
                    <div class="form-group">
                        @if($my_reaction != null && $my_reaction->max('reaction_type') == 6)
                            <button type="submit" name=reaction_type value="7" class="btn btn-success float-right mb-3 mr-3">お気に入り取消(7)</button>
                        @else
                            <button type="submit" name=reaction_type value="6" class="btn btn-success float-right mb-3 mr-3">お気に入り追加(6)</button>
                        @endif
                    </div>
                </form>

                {{-- 表示部分 --}}
                <br>
                @if($diary->aibo->aibo_icon)
                    <p>aiboの写真：<img src="{{asset('storage/aibo_icon/'.$diary->aibo->aibo_icon)}}" style="height:50px;"></p>
                @else
                    <p>aiboの写真：no image</p>
                @endif
                <p>aiboの名前：<a href="{{route('aibo.show', $diary->aibo)}}">{{$diary->aibo->aibo_name}}</a></p>
                <p>オーナーアイコン：<img src="{{asset('storage/owner_icon/'.$diary->aibo->owner->owner_icon)}}" style="height:50px;"></p>
                <p>オーナー名：<a href="{{route('owner.show', $diary->aibo->owner)}}">{{$diary->aibo->owner->owner_name}}</a></p>
                <p>この日の性格：{{$diary->diary_personality}}、この日の天気：{{$diary->diary_weather}}</p>
                @if($diary->diary_photo1)
                   <p>画像：<img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="height:300px;"></p>
                @else
                   <p>画像：no image</p>
                @endif
                <p>本文：{!! nl2br(e($diary->diary_body)) !!}</p> {{--改行あり--}}
                
                <br/>
                @if(($diary->aibo->owner->user != NULL) && (auth()->user()->id === $diary->aibo->owner->user->id)) {{--自分のaibo--}}
                    ↓自分のaiboなので編集可能↓<br>
                    <a href="{{route('diary.edit', $diary)}}"><button type="button">日記の編集</button></a><br/>
                @endif
                <hr/>

                {{-- リアクション投稿フォーム --}}
                <h4>リアクション</h4>
                @php 
                    $reaction_name = ['＊＊＊','いいね','面白い','悲しい','ひどい','ガーン'];
                @endphp

                <form method="post" action="{{route('diaryreaction.store')}}">
                    @csrf
                    <input type="hidden" name='diary_id' value="{{$diary->id}}">
                    <div class="form-group">
                        <table>
                            <tr>
                        @for ($i = 1; $i <= 5; $i++)
                            <td style="text-align:center;">
                                @if($my_reaction->firstWhere('reaction_type', '<=', 5) != null && $my_reaction->firstWhere('reaction_type', '<=', 5)->reaction_type == $i)
                                    <button type="submit" name=reaction_type value="0" class="btn btn-success float-right mb-3 mr-3">いいね({{$i}}を取消)</button>
                                @else
                                <button type="submit" name=reaction_type value="{{$i}}" class="btn btn-success float-right mb-3 mr-3">{{$reaction_name[$i]}}({{$i}})</button>
                                @endif
                            <br>
                            {{$diary->diaryreactions()->where('reaction_type', $i)->count()}}件
                            </td>
                        @endfor
                            </tr>
                        </table>
                    </div>
                </form>

                <hr/>

                <h4>コメント</h4>
                {{-- バリデーションエラー表示 --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {{-- コメント表示 --}}
                @if($diary->diarycomments->count())
                    @foreach ($diary->diarycomments as $comment)
                    <div class="card mb-4">
                        <div class="card-header">
                            ------------------<br>
                            オーナー名：<img src="{{asset('storage/owner_icon/'.$comment->owner->owner_icon)}}" style="height:30px;"><a href="{{route('owner.show', $comment->owner)}}">{{$comment->owner->owner_name}}</a>（投稿日時：{{$comment->created_at}}）
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($comment->diary_comment_body)) !!}
                        </div>
                        {{-- 削除（編集は不可） --}}
                        {{-- @if(auth()->user()->owner->id === $comment->owner_id)
                            <p style="text-align:right; margin-right:1em;">削除</p>
                        @endif --}}
                    </div>
                    @endforeach
                @else
                <div class="card mb-4">
                    <div class="card-body">まだコメントがありません。</div>
                </div>
                @endif


                {{-- コメント投稿フォーム --}}
                <form method="post" action="{{route('diarycomment.store')}}">
                    @csrf
                    ------------------<br>
                    <input type="hidden" name='diary_id' value="{{$diary->id}}">
                    <div class="form-group">
                        <textarea name="diary_comment_body" class="form-control" id="diary_comment_body" cols="30" rows="5" >{{old('diary_comment_body')}}</textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
                    </div>
                </form>
                <hr/>
                {{-- <p style="text-align:center;"><a href="{{url()->previous()}}">一覧へ戻る</a></p> --}}
                {{-- <p style="text-align:center;"><a href="{{route('diary.list_day')}}">今日の日記</a></p> --}}
                <p style="text-align:center;"><a href="{{route('diary.list_aibo')}}?aibo={{$diary->aibo_id}}">{{$diary->aibo->aibo_name}}の日記一覧</a></p>
            
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
                <div class="card-header">aibo日記</div>

                <div class="card-body">

                    <h4>タイトル：{{$diary->diary_title}}</h4>

                    <?php //お気に入り追加 ?>
                    <form method="post" action="{{route('diaryreaction.store')}}">
                        @csrf
                        <input type="hidden" name='diary_id' value="{{$diary->id}}">
                        <div class="form-group">
                            @if($my_reaction != null && $my_reaction->max('reaction_type') == 6)
                                <button type="submit" name=reaction_type value="7" class="btn btn-success float-right mb-3 mr-3">お気に入り取消(7)</button>
                            @else
                                <button type="submit" name=reaction_type value="6" class="btn btn-success float-right mb-3 mr-3">お気に入り追加(6)</button>
                            @endif
                        </div>
                    </form>

                    <p>名前：{{$diary->aibo->aibo_name}}</p>
                    <p>（オーナー名：{{$diary->aibo->owner->owner_name}}）</p>
                    <p>日付：{{date('Y年m月d日', strtotime($diary->diary_date))}}、この日の性格：{{$diary->diary_personality}}、この日の天気：{{$diary->diary_weather}}</p>
                    @if($diary->diary_photo1)
                       <p>画像：<img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="height:300px;"></p>
                    @else
                       <p>画像：ありません</p>
                    @endif
                    <p>本文：{!! nl2br(e($diary->diary_body)) !!}</p> <?php //改行あり ?>
                    
                    <br/>
                    @if(($diary->aibo->owner->user != NULL) && (auth()->user()->id === $diary->aibo->owner->user->id)) <?php //自分のaibo?>
                        自分のaiboなので...<br>
                        <a href="{{route('diary.edit', $diary)}}"><button type="button">日記の編集</button></a><br/>
                    @endif
                    <hr/>

                    <h4>リアクション</h4>
                    @php 
                        $reaction_name = ['＊＊＊','いいね','面白い','悲しい','ひどい','ガーン'];
                    @endphp

                    <?php //リアクション投稿フォーム ?>
                    <form method="post" action="{{route('diaryreaction.store')}}">
                        @csrf
                        <input type="hidden" name='diary_id' value="{{$diary->id}}">
                        <div class="form-group">
                            <table>
                                <tr>
                            @for ($i = 1; $i <= 5; $i++)
                                <td style="text-align:center;">
                                    @if($my_reaction->firstWhere('reaction_type', '<=', 5) != null && $my_reaction->firstWhere('reaction_type', '<=', 5)->reaction_type == $i)
                                        <button type="submit" name=reaction_type value="0" class="btn btn-success float-right mb-3 mr-3">いいね({{$i}}を取消)</button>
                                    @else
                                    <button type="submit" name=reaction_type value="{{$i}}" class="btn btn-success float-right mb-3 mr-3">{{$reaction_name[$i]}}({{$i}})</button>
                                    @endif
                                <br>
                                {{$diary->diaryreactions()->where('reaction_type', $i)->count()}}件
                                </td>
                            @endfor
                                </tr>
                            </table>
                        </div>
                    </form>

                    <hr/>

                    <h4>コメント</h4>
                    <?php //バリデーションエラー表示 ?>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <?php // コメント表示 ?>
                    @if($diary->diarycomments->count())
                        @foreach ($diary->diarycomments as $comment)
                        <div class="card mb-4">
                            <div class="card-header">
                                オーナー名：{{$comment->owner->owner_name}}（投稿日時：{{$comment->created_at}}）
                            </div>
                            <div class="card-body">
                                {!! nl2br(e($comment->diary_comment_body)) !!}
                            </div>
                            <?php // 削除（編集は不可） ?>
                            <?php /*
                            @if(auth()->user()->owner->id === $comment->owner_id)
                                <p style="text-align:right; margin-right:1em;">削除</p>
                            @endif
                            */ ?>
                        </div>
                        @endforeach
                    @else
                    <div class="card mb-4">
                        <div class="card-body">まだコメントがありません。</div>
                    </div>
                    @endif
                    <?php //コメント投稿フォーム ?>
                    <form method="post" action="{{route('diarycomment.store')}}">
                        @csrf
                        <input type="hidden" name='diary_id' value="{{$diary->id}}">
                        <div class="form-group">
                            <textarea name="diary_comment_body" class="form-control" id="diary_comment_body" cols="30" rows="5" >{{old('diary_comment_body')}}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
                        </div>
                    </form>
                    <hr/>
                    <p style="text-align:center;"><a href="{{url()->previous()}}">一覧へ戻る</a></p>
                    <hr/>
                    <br/>
                    <a href="{{route('diary.list_day')}}?date={{$diary->diary_date}}"><button type="button">{{date('Y年m月d日', strtotime($diary->diary_date))}}の日記一覧</button></a><br><br>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$diary->aibo_id}}"><button type="button">{{$diary->aibo->aibo_name}}の日記一覧</button></a><br><br>
                    <a href="{{route('root')}}"><button type="button">トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
