@extends('layouts.app')

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
                    {{-- ログイン中のユーザのオーナーIDと、このふるまいを登録しているaiboのオーナーIDが一緒なら編集 --}}
                    @if(auth()->user()->owner->id == $behavior->aibo->owner_id)
                        自分のaiboなのでふるまいの編集・削除が【可能】<br>
                        <a href="{{route('behaviorshare.edit',$behavior)}}"><button>編集</button></a>
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
                    {{-- {{$behavior->behavior_info}} --}}
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
                    @if(isset($page) && isset($seed)) {{-- ふるまい一覧から来た場合：ぺジネーションの情報付与 --}}
                    <a href="{{route('behaviorshare.index')}}?page={{$page}}&seed={{$seed}}"><button>ふるまい共有に戻る</button></a>
                    @else
                    <a href="{{route('behaviorshare.index')}}"><button>ふるまい共有に戻る</button></a>
                    @endif
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
