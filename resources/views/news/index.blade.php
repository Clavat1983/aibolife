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
                                <a href="{{route('news.index')}}">すべて</a>｜<a href="{{route('news.index_news')}}">ニュース</a>｜<a href="{{route('news.index_event')}}">イベント</a>｜<a href="{{route('news.index_media')}}">メディア</a>｜<a href="{{route('news.index_info')}}">お知らせ</a>｜<a href="{{route('news.index_update')}}">アップデート</a>｜<a href="{{route('news.index_maintenance')}}">メンテナンス</a>｜<a href="{{route('news.index_special')}}">特別企画</a>｜<a href="{{route('news.index_etc')}}">その他</a>｜<a href="{{route('news.search')}}">検索</a></td>
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

                    {{-- {{$news_all->onEachSide(1)->links()}} --}}

                    <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$news_all->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $news_all->lastPage(); $i++)
                                    <option value="{{$news_all->url($i)}}" @if($i == $news_all->currentPage()) selected @endif>{{$i}}ページ目/全{{$news_all->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$news_all->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
