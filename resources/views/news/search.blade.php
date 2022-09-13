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
                    <form method="get" action="{{route('news.search')}}?keywords={{Session::get('keywords')}}">
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
                                ID：{{$news->id}}、タイトル：{{$news->news_title}}、本文：{{$news->news_body}}<br>
                            @endforeach
                            {{$results->appends(['keywords' => $keywords])->links()}}<br>
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
