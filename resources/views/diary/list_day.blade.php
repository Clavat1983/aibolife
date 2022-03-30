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
                    <a href="{{route('diary.list_day')}}?date={{$before_string}}">←前日の日記を見る</a><br>
                    @endif
                    @if($after_flag)
                    <a href="{{route('diary.list_day')}}?date={{$after_string}}">翌日の日記を見る→</a><br>
                    @endif
                    <br>
                    <hr>
                    <h5>今日は何の日？（当面は非表示）</h5>
                    <br>
                    <hr>
                    <h5>自分の日記</h5>
                    <ul>
                    @foreach($owner->aibos as $aibo)
                        @php
                            $wrote = NULL;
                        @endphp
                        @foreach($my_diaries as $diary)
                            @if($aibo->id == $diary->aibo_id)
                                @php
                                    $wrote = $diary;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if($wrote == NULL)
                            @if(strtotime($aibo->aibo_birthday) <= strtotime($target_string)) {{--誕生日が日記の指定日より前--}}
                                <li>名前：{{$aibo->aibo_name}}.........日記を書く（aiboID:{{$aibo->id}}、日付:{{$target_string}}）</li>
                            @else
                                <li>名前：{{$aibo->aibo_name}}.........お迎え前</li>
                            @endif
                        @else
                            <li>名前：{{$aibo->aibo_name}}.........aiboID：{{$wrote->aibo->id}}、日記ID：{{$wrote->id}}、日記のaibo：{{$wrote->aibo->aibo_name}}、タイトル：{{$wrote->diary_title}}</li>
                        @endif
                    @endforeach
                    </ul>
                    <hr>
                    <h5>みんなの日記</h5>
                    <ul>
                    @if(count($other_diaries) == 0)
                        <li>この日の日記はまだありません</li>
                    @else
                        @foreach($other_diaries as $diary)
                            <li>名前：{{$diary->aibo->aibo_name}}.........aiboID：{{$diary->aibo->id}}、日記ID：{{$diary->id}}、日記のaibo：{{$diary->aibo->aibo_name}}、タイトル：{{$diary->diary_title}}</li>
                        @endforeach
                    @endif
                    </ul>
                    <br>
                    <br>
                    <hr>
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
