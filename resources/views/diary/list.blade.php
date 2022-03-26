@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>{{$target_string_format}}の日記</h2>

                    @if($before_flag)
                    <a href="{{route('diary.list')}}?date={{$before_string}}">←前日の日記を見る</a><br>
                    @endif
                    @if($after_flag)
                    <a href="{{route('diary.list')}}?date={{$after_string}}">翌日の日記を見る→</a><br>
                    @endif
                    <br>
                    <br>
                    <br>

                    <a href="{{route('diary.index')}}">日記メニューに戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
