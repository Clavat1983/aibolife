@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り</div>

                <div class="card-body">

                    <table>
                        <tr>
                            <th>日付</th>
                            <th>タイトル</th>
                            <th>aiboの名前</th>
                            <th>日記を見る</th>
                        </tr>
                        @foreach ($bookmarks  as $bookmark)
                            <tr>
                                <td>{{$bookmark->diary->diary_date}}</td>
                                <td>{{$bookmark->diary->diary_title}}</td>
                                <td>{{$bookmark->diary->aibo->aibo_name}}</td>
                                <td><a href="{{route('diary.show', $bookmark->diary)}}">表示</a></td>
                            </tr>
                        @endforeach
                    </table>

                    <br>
                    {{$bookmarks->links()}}

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
