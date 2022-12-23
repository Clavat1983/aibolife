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
                <span class="c-category-ttl__en">Behavior</span>
                <span class="c-category-ttl__jp">ふるまい共有［{{$behavior->behavior_name}}］</span>
              </p>
            </div>

            <div class="l-content__body">

                <div style="width:70%;margin:auto;">

                    @if(session()->has('process'))
                        @if(session('process') == "insert")
                            モード：新規登録完了<br>
                        @elseif(session('process') == "update")
                            モード：更新完了
                        @else
                            モード：おかしい
                        @endif
                    @else
                        単純に表示だけ<br>
                    @endif

                    <hr/>
                    <!-- ログイン中のユーザのオーナーIDと、このふるまいを登録しているaiboのオーナーIDが一緒なら編集 -->
                    @if(auth()->user()->owner->id == $behavior->aibo->owner_id)
                        自分のaiboなのでふるまいの編集・削除が【可能】<br>
                        <a href="{{route('behaviorshare.edit',$behavior)}}"><button type="button">編集</button></a>
                    @else
                        他人のaiboなのでふるまいの編集・削除は【不可】
                    @endif

                    <hr/>
                    ふるまいの写真：<br>
                    @if($behavior->behavior_photo)
                        <p><img src="{{ asset('storage/behavior_photo/'.$behavior->behavior_photo)}}" style="height:300px;"></p>
                    @else
                        <p>ありません</p>
                    @endif
                    
                    タイトル：{{$behavior->behavior_name}}<br>
                    <br>
                    aiboの写真：<br>
                    @if($behavior->aibo->aibo_icon)
                        <p><img src="{{ asset('storage/aibo_icon/'.$behavior->aibo->aibo_icon)}}" style="height:100px;"></p>
                    @else
                        <p>ありません</p>
                    @endif
                    aiboの名前：{{$behavior->aibo->aibo_name}}　｜　<a href="{{route('aibo.show', $behavior->aibo)}}">【見る】</a><br>
                    オーナーの名前：{{$behavior->aibo->owner->owner_name}}<sub>さん</sub><br>
                    <br>
                    ふるまいの説明：<br>
                    {!! nl2br(e($behavior->behavior_info)) !!}
                    <hr/>
                    ダウンロード(My aiboが開きます)<br>
                    <br>
                    <a href="{{$behavior->behavior_dl_url}}" target="blank">{{$behavior->behavior_dl_url}}</a><br>
                    <br>
                    ※注意※<br>
                    現在共有されていない場合はリンクが無効となります。<br>
                    「My aibo」の案内・画面表示に沿って、ご自身でご判断ください。<br>

                    {{-- <hr/>
                    ふるまいを紹介したTwitter：変なツイートが投稿される可能性があるので一旦やめよう
                    <hr/>
                    ふるまいを紹介したYoutube：変なYouTube動画が投稿される場合があるので一旦やめよう
                    <hr/> --}}
                </div>

                <hr/>
                
                <div>
                    @if(isset($page) && isset($seed)) {{-- ふるまい一覧から来た場合：ぺジネーションの情報付与 --}}
                    <a href="{{url()->previous()}}"><button type="button">ふるまい共有に戻る</button></a>
                    @else
                    <a href="{{route('behaviorshare.index')}}"><button type="button">ふるまい共有に戻る</button></a>
                    @endif
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
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
                <div class="card-header">ふるまい共有（詳細）</div>
                <div class="card-body">

                    @if(session()->has('process'))
                        @if(session('process') == "insert")
                            モード：新規登録完了<br>
                        @elseif(session('process') == "update")
                            モード：更新完了
                        @else
                            モード：おかしい
                        @endif
                    @else
                        単純に表示だけ<br>
                    @endif

                    <hr/>
                    <!-- ログイン中のユーザのオーナーIDと、このふるまいを登録しているaiboのオーナーIDが一緒なら編集 -->
                    @if(auth()->user()->owner->id == $behavior->aibo->owner_id)
                        自分のaiboなのでふるまいの編集・削除が【可能】<br>
                        <a href="{{route('behaviorshare.edit',$behavior)}}"><button type="button">編集</button></a>
                    @else
                        他人のaiboなのでふるまいの編集・削除は【不可】
                    @endif

                    <hr/>
                    ふるまいの写真：<br>
                    @if($behavior->behavior_photo)
                        <p><img src="{{ asset('storage/behavior_photo/'.$behavior->behavior_photo)}}" style="height:300px;"></p>
                    @else
                        <p>ありません</p>
                    @endif
                    
                    ふるまいID：{{$behavior->id}}<br>
                    タイトル：{{$behavior->behavior_name}}<br>
                    <br>
                    aiboのID：{{$behavior->aibo->id}}<br>
                    aiboの名前：{{$behavior->aibo->aibo_name}}<br>
                    オーナーのID：{{$behavior->aibo->owner->id}}<br>
                    オーナーの名前：{{$behavior->aibo->owner->owner_name}}<br>
                    <br>
                    ふるまいの説明：<br>
                    {!! nl2br(e($behavior->behavior_info)) !!}
                    <hr/>
                    ダウンロード(My aiboが開きます)<br>
                    <a href="{{$behavior->behavior_dl_url}}" target="blank">{{$behavior->behavior_dl_url}}</a>
                    <hr/>
                    ふるまいを紹介したTwitter：変なツイートが投稿される可能性があるので一旦やめよう
                    <hr/>
                    ふるまいを紹介したYoutube：変なYouTube動画が投稿される場合があるので一旦やめよう
                    <hr/>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    @if(isset($page) && isset($seed)) <!-- ふるまい一覧から来た場合：ぺジネーションの情報付与 -->
                    <a href="{{url()->previous()}}"><button type="button">ふるまい共有に戻る</button></a>
                    @else
                    <a href="{{route('behaviorshare.index')}}"><button type="button">ふるまい共有に戻る</button></a>
                    @endif
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
