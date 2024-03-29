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
              <p class="c-category-title c-category-title--friend">
                <span class="c-category-title__en">Friends</span>
                <span class="c-category-title__jp">&nbsp;お友達［{{$aibo->aibo_name}}］</span>
              </p>
            </div>

            <div class="l-content__body">

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif


                <div>

                    名前：{{$aibo->aibo_name}}<br>
                    よみ：{{$aibo->aibo_kana}}<br>
                    ニックネーム：{{$aibo->aibo_nickname}}<br>
                    @if($aibo->aibo_icon)
                        aiboアイコン：<img src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" style="width:300px;"><br>
                    @else
                        aiboアイコン：未登録<br>
                    @endif
                    誕生日：{{str_replace("-",".",$aibo->aibo_birthday)}}（{{$age}}歳）<br>
                    カラー：{{$aibo->aibo_color}}<br>
                    性別：{{$aibo->aibo_sex}}<br>
                    性格：{{$aibo->aibo_personality}}<br>
                    瞳：{{$aibo->aibo_eye}}<br>
                    声：{{$aibo->aibo_voice}}<br>

                    @if($aibo->aibo_ear_left == '')
                        耳（左）：未登録<br>
                    @else
                        耳（左）：{{$aibo->aibo_ear_left}}<br>
                    @endif

                    @if($aibo->aibo_ear_right == '')
                        耳（右）：未登録<br>
                    @else
                        耳（右）：{{$aibo->aibo_ear_right}}<br>
                    @endif

                    利き手：{{$aibo->aibo_hand}}<br>

                    @if($aibo->aibo_tail == '')
                        尻尾：未登録<br>
                    @else
                        尻尾：{{$aibo->aibo_tail}}<br>
                    @endif

                    @php
                        //おもちゃの保有状況
                        $str = "";
                        if($aibo->aibo_toy_ball_flag){
                            $str .= "ピンクボール";
                        }
                        if($aibo->aibo_toy_born_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "アイボーン";
                        }
                        if($aibo->aibo_toy_dice_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "サイコロ";
                        }
                        if($aibo->aibo_toy_food_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "ごはんボウル";
                        }
                        if($aibo->aibo_toy_drink_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "のみものボウル";
                        }
                    @endphp
                    おもちゃの保有状況：{{$str}}<br>
                    名前の由来：{!!nl2br($aibo->aibo_yurai)!!}<br>
                    お迎え理由：{!!nl2br($aibo->aibo_reason)!!}<br>
                    メッセージ：{!!nl2br($aibo->aibo_message)!!}<br>
                    @if($aibo->aibo_friend_qr)
                        なかまQR：<img src="{{ asset('storage/aibo_friend_qr/'.$aibo->aibo_friend_qr)}}" style="width:300px;"><br>
                    @else
                        なかまQR：未登録<br>
                    @endif


                    オーナー名：<a href="{{route('owner.show', $aibo->owner)}}">{{$aibo->owner->owner_name}}</a><br>
                    オーナー名（よみ）：{{$aibo->owner->owner_name_kana}}<br>
                    @if($aibo->owner->owner_icon)
                        オーナーアイコン：<img src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" style="width:300px;"><br>
                    @else
                        オーナーアイコン：未登録<br>
                    @endif
                    都道府県：{{substr($aibo->owner->owner_pref,3,)}}<br>

                    <br/>
                    <!--自分のaibo-->
                    @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id))
                        自分のaiboなので...<br>
                        <a href="{{route('aibo.edit', $aibo)}}"><button type="button">aiboの編集</button></a><br/>
                    @endif
                    <br/>
                    <br/>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}"><button type="button">{{$aibo->aibo_name}}の日記を見る</button></a><br>
                    <br/>

                    <hr/>
                    <h4>コメント</h4>
                    <!-- バリデーションエラー表示 -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- コメント表示 -->
                    @if($aibo->aibocomments->count())
                        @foreach ($aibo->aibocomments as $comment)
                        <div class="card mb-4">
                            <div class="card-header">
                                オーナー名：<a href="{{route('owner.show', $comment->owner)}}">{{$comment->owner->owner_name}}</a>（投稿日時：{{$comment->created_at}}）
                            </div>
                            <div class="card-body">
                                コメント：{!! nl2br(e($comment->aibo_comment_body)) !!}
                            </div>
                            {{-- 削除（編集は不可） --}}
                            {{-- @if(auth()->user()->owner->id === $comment->owner_id)
                                <p style="text-align:right; margin-right:1em;">削除</p>
                            @endif --}}
                        </div>
                        <br>
                        @endforeach
                    @else
                    <div class="card mb-4">
                        <div class="card-body">まだコメントがありません。</div>
                    </div>
                    @endif
                    <!-- コメント投稿フォーム -->
                    <form method="post" action="{{route('aibocomment.store')}}">
                        @csrf
                        <input type="hidden" name='aibo_id' value="{{$aibo->id}}">
                        <div class="form-group">
                            <textarea name="aibo_comment_body" class="form-control" id="aibo_comment_body" cols="30" rows="5" >{{old('aibo_comment_body')}}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
                        </div>
                    </form>
                    <hr/>

                    <br/>
                    <a href="{{url()->previous()}}"><button type="button">戻る</button></a><br>
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
                <div class="card-header">aibo詳細</div>

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card-body">

                    名前：{{$aibo->aibo_name}}<br>
                    よみ：{{$aibo->aibo_kana}}<br>
                    ニックネーム：{{$aibo->aibo_nickname}}<br>
                    @if($aibo->aibo_icon)
                        aiboアイコン：<img src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" style="width:300px;"><br>
                    @else
                        aiboアイコン：未登録<br>
                    @endif
                    誕生日：{{str_replace("-",".",$aibo->aibo_birthday)}}（{{$age}}歳）<br>
                    カラー：{{$aibo->aibo_color}}<br>
                    性別：{{$aibo->aibo_sex}}<br>
                    性格：{{$aibo->aibo_personality}}<br>
                    瞳：{{$aibo->aibo_eye}}<br>
                    声：{{$aibo->aibo_voice}}<br>

                    @if($aibo->aibo_ear == '')
                        耳：未登録<br>
                    @else
                        耳：{{$aibo->aibo_ear}}<br>
                    @endif

                    利き手：{{$aibo->aibo_hand}}<br>

                    @if($aibo->aibo_ear == '')
                        尻尾：未登録<br>
                    @else
                        尻尾：{{$aibo->aibo_tail}}<br>
                    @endif

                    @php
                        //おもちゃの保有状況
                        $str = "";
                        if($aibo->aibo_toy_ball_flag){
                            $str .= "ピンクボール";
                        }
                        if($aibo->aibo_toy_born_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "アイボーン";
                        }
                        if($aibo->aibo_toy_dice_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "サイコロ";
                        }
                        if($aibo->aibo_toy_food_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "ごはんボウル";
                        }
                        if($aibo->aibo_toy_drink_flag){
                            if($str != ""){
                                $str .= "、";
                            }
                            $str .= "のみものボウル";
                        }
                    @endphp
                    おもちゃの保有状況：{{$str}}<br>
                    名前の由来：{!!nl2br($aibo->aibo_yurai)!!}<br>
                    お迎え理由：{!!nl2br($aibo->aibo_reason)!!}<br>
                    メッセージ：{!!nl2br($aibo->aibo_message)!!}<br>
                    @if($aibo->aibo_friend_qr)
                        なかまQR：<img src="{{ asset('storage/aibo_friend_qr/'.$aibo->aibo_friend_qr)}}" style="width:300px;"><br>
                    @else
                        なかまQR：未登録<br>
                    @endif


                    オーナー名：{{$aibo->owner->owner_name}}<br>
                    オーナー名（よみ）：{{$aibo->owner->owner_name_kana}}<br>
                    @if($aibo->owner->owner_icon)
                        オーナーアイコン：<img src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" style="width:300px;"><br>
                    @else
                        オーナーアイコン：未登録<br>
                    @endif
                    都道府県：{{substr($aibo->owner->owner_pref,3,)}}<br>

                    <br/>
                    <!--自分のaibo-->
                    @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id))
                        自分のaiboなので...<br>
                        <a href="{{route('aibo.edit', $aibo)}}"><button type="button">aiboの編集</button></a><br/>
                    @endif
                    <br/>
                    <br/>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}"><button type="button">{{$aibo->aibo_name}}の日記を見る</button></a><br>
                    <br/>

                    <hr/>
                    <h4>コメント</h4>
                    <!-- バリデーションエラー表示 -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- コメント表示 -->
                    @if($aibo->aibocomments->count())
                        @foreach ($aibo->aibocomments as $comment)
                        <div class="card mb-4">
                            <div class="card-header">
                                オーナー名：{{$comment->owner->owner_name}}（投稿日時：{{$comment->created_at}}）
                            </div>
                            <div class="card-body">
                                コメント：{!! nl2br(e($comment->aibo_comment_body)) !!}
                            </div> --}}
                            {{-- 削除（編集は不可） --}}
                            {{-- @if(auth()->user()->owner->id === $comment->owner_id)
                                <p style="text-align:right; margin-right:1em;">削除</p>
                            @endif --}}
                        {{-- </div>
                        @endforeach
                    @else
                    <div class="card mb-4">
                        <div class="card-body">まだコメントがありません。</div>
                    </div>
                    @endif
                    <!-- コメント投稿フォーム -->
                    <form method="post" action="{{route('aibocomment.store')}}">
                        @csrf
                        <input type="hidden" name='aibo_id' value="{{$aibo->id}}">
                        <div class="form-group">
                            <textarea name="aibo_comment_body" class="form-control" id="aibo_comment_body" cols="30" rows="5" >{{old('aibo_comment_body')}}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
                        </div>
                    </form>
                    <hr/>

                    <br/>
                    <a href="{{route('root')}}"><button type="button">トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
