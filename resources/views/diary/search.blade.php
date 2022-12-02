@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">日記（検索）</div>

                <div class="card-body">

                    <form method="get" action="{{route('diary.search')}}">
                        @csrf
                        <div>
                            <label for="keywords">検索キーワード：</label>
                            <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}">
                            <br>
                            <br>
                            <label for="diary_date_from">期間：</label>
                            <input type="date" name="diary_date_from" id="diary_date_from" value="{{old('diary_date_from', $diary_date_from)}}">～
                            <input type="date" name="diary_date_to" id="diary_date_to" value="{{old('diary_date_to', $diary_date_to)}}">
                            <br>
                            <br>
                            <label for="aibo_name">aiboの名前：</label>
                            <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-success">検索</button>
                        </div>
                    </form>

                    @if($search_flag)
                    <hr/>
                    <h2>【検索結果】 {{$results->total()}}件</h2> {{--ページネーション前の合計--}}
                    ※日記の日付が新しい順、タイトルか本文に検索キーワードを含むもの
                    <hr/>
                    @if(count($results))
                        @foreach ($results as $diary)
                            日付：[{{$diary->diary_date}}]、ID：{{$diary->id}}、日記：{{$diary->diary_title}}、aibo名：{{$diary->aibo->aibo_name}}　<a href="{{route('diary.show', $diary->id)}}">【見る】</a><br>
                        @endforeach
                        <br>

                        {{-- {{$results->appends([
                            'keywords' => $keywords,
                            'diary_date_from' => $diary_date_from,
                            'diary_date_to' => $diary_date_to,
                            'aibo_name' => $aibo_name,
                        ])->onEachSide(1)->links()}}<br> --}}
                        <hr>
                        ▼ページネーション▼
                        <table width="60%" style="margin:auto;">
                            <tr>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'keywords' => $keywords,
                                    'diary_date_from' => $diary_date_from,
                                    'diary_date_to' => $diary_date_to,
                                    'aibo_name' => $aibo_name,
                                ])->previousPageUrl()}}">Prev</a></td>
                                <td width="70%" style="text-align:center;">
                                    <div class="pagenation-select">
                                    <select>
                                        @for ($i = 1; $i <= $results->lastPage(); $i++)
                                        <option value="{{$results->appends([
                                            'keywords' => $keywords,
                                            'diary_date_from' => $diary_date_from,
                                            'diary_date_to' => $diary_date_to,
                                            'aibo_name' => $aibo_name,
                                        ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                        @endfor
                                    </select>
                                    </div>
                                </td>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'keywords' => $keywords,
                                    'diary_date_from' => $diary_date_from,
                                    'diary_date_to' => $diary_date_to,
                                    'aibo_name' => $aibo_name,
                                ])->nextPageUrl()}}">Next</a></td>
                            </tr>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                        <script>
                        $('.pagenation-select select').change(function(){
                            location.href = $(this).val();
                        });
                        </script>
                        <hr>

                    @else
                        検索結果がありません
                    @endif
                @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
