@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">コメントした日記</div>

                <div class="card-body">

                    <table>
                        <tr>
                            <th>日付</th>
                            <th>タイトル</th>
                            <th>aiboの名前</th>
                            <th>日記を見る</th>
                        </tr>
                        @foreach ($comments  as $comment)
                            <tr>
                                <td>{{$comment->diary->diary_date}}</td>
                                <td>{{$comment->diary->diary_title}}</td>
                                <td>{{$comment->diary->aibo->aibo_name}}</td>
                                <td><a href="{{route('diary.show', $comment->diary)}}">表示</a></td>
                            </tr>
                        @endforeach
                    </table>

                    <br>
                    {{$comments->links()}}

                    <hr>
                    <a href="{{route('diary.index')}}">aibo日記に戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
