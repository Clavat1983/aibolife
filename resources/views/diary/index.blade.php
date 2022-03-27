@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>日記メニュー</h2>
                    <br>
                    <h4>日記を書く</h4>

                    日記を書くaiboを選ぶ
                    <ul>
                    @foreach($owner->aibos as $aibo)
                        <li><a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}">{{$aibo->aibo_name}}</a></li>
                    @endforeach
                    </ul>

                    <br>
                    <h4>日記を見る</h4>
                    <p><a href="{{route('diary.list_day')}}">今日の日記を見る</a></p>
                    

                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
