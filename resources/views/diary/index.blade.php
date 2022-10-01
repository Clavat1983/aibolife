@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <br>
                    <br>
                    aibo日記（ビジュアル）<br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card-body" style="background-color:lightgray; text-align:center; margin:0px; padding:5px;">
                    「aibo life」はソニー株式会社および関連会社とは一切関係のないオーナーコミュニティサイトです<br>
                </div>
            </div>

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Recently</u></h2>
            <h6 style="text-align:center;">新しい日記</h6>
            <div class="card">
                <div class="card-body">
                    @if($diaries->count() > 0)
                        @foreach($diaries as $diary)
                            <li>{{$diary->diary_title}}（{{$diary->aibo->aibo_name}}）<a href="{{route('diary.show', $diary)}}">【見る】</a></li>
                        @endforeach
                    @else
                        <li>日記がありません</li>
                    @endif
                </div>
            </div>

            <p>&nbsp;</p>
            <hr/>
            <p>&nbsp;</p>

            <div class="card">
                <div class="card-header">日記を見る</div>
                <div class="card-body">
                    <a href="{{route('diary.list_day')}}">今日の日記</a><br>
                    <a href="{{route('diary.archive')}}">過去の日記</a><br>
                    条件検索（後日公開）<br>
                </div>
            </div>

            <p>&nbsp;</p>
            <div class="card">
                <div class="card-header">日記を書く</div>
                <div class="card-body">
                    日記を書くaiboを選択してください。<br>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
