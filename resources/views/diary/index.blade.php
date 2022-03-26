@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>日記メニュー</h2>
                    <h4>日記を書く</h4>

                    <br>
                    <h4>日記を見る</h4>
                    <p><a href="{{route('diary.list')}}">今日の日記を見る</a></p>
                    

                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
