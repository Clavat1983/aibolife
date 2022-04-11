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

                    オーナー名：{{$aibo->owner->owner_name}}<br>
                    都道府県：{{substr($aibo->owner->owner_pref,3,)}}<br>

                    <br/>
                    @if(auth()->user()->id === $aibo->owner->user->id) {{--自分のaibo--}}
                        自分のaiboなので...<br>
                        <a href="{{route('aibo.edit', $aibo)}}"><button>aiboの編集</button></a><br/>
                    @endif
                    <br/>
                    <br/>
                    <a href="{{route('diary.list_aibo')}}/?aibo={{$aibo->id}}"><button>{{$aibo->aibo_name}}の日記を見る</button></a><br>
                    <br/>
                    <br/>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
