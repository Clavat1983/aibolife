@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">最新情報（{{$category}}）</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td colspan="2" style="background-color:lightyellow;">
                                <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_info')}}">お知らせ</a>｜<a href="{{route('news.index_update')}}">アップデート</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a></td>
                        </tr>
@if(count($news_all)>0)
                    @foreach($news_all as $news)
                        <tr>
                            <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                            <td style="padding:10px;">
                                {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br>
                                <a href="{{route('news.show', $news)}}">{{$news->news_title}}</a><br/>
    @if($news->news_tag1){{$news->news_tag1}}@endif
    @if($news->news_tag2)｜{{$news->news_tag2}}@endif
    @if($news->news_tag3)｜{{$news->news_tag3}}@endif
    @if($news->news_tag4)｜{{$news->news_tag4}}@endif
    @if($news->news_tag5)｜{{$news->news_tag5}}@endif
                            </td>
                        </tr>
                    @endforeach
@else
                        <tr>
                            <td colspan="2"><br>ありません<br><br></td>
                        </tr>
@endif
                    </table>
                    {{$news_all->links()}}
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
