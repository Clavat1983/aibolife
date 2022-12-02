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
                    {{-- {{$bookmarks->onEachSide(1)->links()}} --}}

                    <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$bookmarks->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $bookmarks->lastPage(); $i++)
                                    <option value="{{$bookmarks->url($i)}}" @if($i == $bookmarks->currentPage()) selected @endif>{{$i}}ページ目/全{{$bookmarks->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$bookmarks->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>
                    
                    <a href="{{route('diary.index')}}">aibo日記に戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
