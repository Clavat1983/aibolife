@extends('layouts.app')

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
                        aiboアイコン：ありません<br>
                    @endif
                    誕生日：{{str_replace("-",".",$aibo->aibo_birthday)}}（{{$age}}歳）<br>
                    カラー：{{$aibo->aibo_color}}<br>
                    性別：{{$aibo->aibo_sex}}<br>
                    性格：{{$aibo->aibo_personality}}<br>
                    瞳：{{$aibo->aibo_eye}}<br>
                    声：{{$aibo->aibo_voice}}<br>
                    耳：{{$aibo->aibo_ear}}<br>
                    利き手：{{$aibo->aibo_hand}}<br>
                    尻尾：{{$aibo->aibo_tail}}<br>
                    おもちゃの保有状況：xxxxxxxxxxxxxxxxxx<br>
                    名前の由来：{!!nl2br($aibo->aibo_yurai)!!}<br>
                    お迎え理由：{!!nl2br($aibo->aibo_reason)!!}<br>
                    メッセージ：{!!nl2br($aibo->aibo_message)!!}<br>
                    @if($aibo->aibo_icon)
                        なかまQR：<img src="{{ asset('storage/aibo_friend_qr/'.$aibo->aibo_friend_qr)}}" style="width:300px;"><br>
                    @else
                        なかまQR：ありません<br>
                    @endif


                    オーナー名：{{$aibo->owner->owner_name}}<br>
                    オーナー名（よみ）：{{$aibo->owner->owner_name_kana}}<br>
                    @if($aibo->owner->owner_icon)
                        オーナーアイコン：<img src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" style="width:300px;"><br>
                    @else
                        オーナーアイコン：ありません<br>
                    @endif
                    都道府県：{{substr($aibo->owner->owner_pref,3,)}}<br>

                    <br/>
                    @if(auth()->user()->id === $aibo->owner->user->id) {{--自分のaibo--}}
                        自分のaiboなので...<br>
                        <a href="{{route('aibo.edit', $aibo)}}"><button>aiboの編集</button></a><br/>
                    @endif
                    <br/>
                    <br/>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}"><button>{{$aibo->aibo_name}}の日記を見る</button></a><br>
                    <br/>
                    <br/>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
