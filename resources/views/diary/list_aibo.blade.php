@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>aibo_ID:{{$aibo->id}}「{{$aibo->aibo_name}}」の日記</h2>

                    <br>
                    この1週間の日記は{{$diaries->count()}}件です<br>
                    <br>
                    @foreach($calendar['days'] as $date) {{--7日間ループ--}}
                        @if($diaries->contains('diary_date', $date)) {{--その日に書かれている日記があるか(true/falseしかわからない)--}}
                            @foreach($diaries as $diary) {{--日記の数だけループ--}}
                                @if($diary->diary_date == $date) {{--その日に書かれている日記なら--}}
                                    日付：{{$date}}、タイトル：{{$diary->diary_title}}<br>
                                @endif
                            @endforeach
                        @else
                            日付：{{$date}}、なし<br>
                        @endif
                    @endforeach


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
