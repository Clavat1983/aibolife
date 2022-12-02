@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">最新情報（検索）</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td colspan="2" style="background-color:lightyellow;">
                                <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_info')}}">お知らせ</a>｜<a href="{{route('news.index_update')}}">アップデート</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
                        </tr>
                    </table>

                    <br>
                    <form method="get" action="{{route('news.search')}}">
                        @csrf
                        <div>
                            <label for="diary_title">検索キーワード：</label>
                            <input type="text" name="keywords" id="keywords" value="{{old('keywords', $keywords)}}">
                            <button type="submit" class="btn btn-success">検索</button>
                        </div>
                    </form>

                    @if($keywords != "")
                        <hr/>
                        {{$keywords}} の検索結果
                        <hr/>
                        @if(count($results))
                            @foreach ($results as $news)
                                ID：{{$news->id}}、タイトル：{{$news->news_title}}、<a href="{{route('news.show', $news->id)}}">【見る】</a><br>
                                {{-- 本文： {!! $news->news_body !!}<br>
                                <hr> --}}
                            @endforeach
                            <br>


                            {{-- {{$results->appends(['keywords' => $keywords])->onEachSide(1)->links()}}<br> --}}
                            <hr>
                            ▼ページネーション▼
                            <table width="60%" style="margin:auto;">
                                <tr>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends(['keywords' => $keywords])->previousPageUrl()}}">Prev</a></td>
                                    <td width="70%" style="text-align:center;">
                                        <div class="pagenation-select">
                                        <select>
                                            @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends(['keywords' => $keywords])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends(['keywords' => $keywords])->nextPageUrl()}}">Next</a></td>
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
