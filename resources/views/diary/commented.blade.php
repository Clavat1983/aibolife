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
                    {{-- {{$comments->onEachSide(1)->links()}} --}}

                    <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$comments->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                    <option value="{{$comments->url($i)}}" @if($i == $comments->currentPage()) selected @endif>{{$i}}ページ目/全{{$comments->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$comments->nextPageUrl()}}">Next</a></td>
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
