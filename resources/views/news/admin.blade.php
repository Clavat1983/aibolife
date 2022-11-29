@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【管理者用】ニュース一覧（非公開含む全件）</div>
                <div class="card-body">
                    <p style="text-align:right;"><a href="{{route('news.create')}}">【新規ニュース投稿】</a></p>
                    <table>
                    @foreach($news_all as $news)
                        <tr>
                            <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                            <td style="padding:10px;">
                                @if($news->news_publication_flag && (strtotime($news->news_publication_datetime) <= strtotime('now')))
                                    【公　開】
                                @elseif($news->news_publication_flag && (strtotime($news->news_publication_datetime) > strtotime('now')))
                                    【待　ち】
                                @else
                                    【非公開】
                                @endif
                                {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br><a href="{{route('news.preview', $news)}}">（プレビュー画面）{{$news->news_title}}</a></td>
                        </tr>
                    @endforeach
                    </table>
                    {{$news_all->onEachSide(1)->links()}}
                </div>


            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
@endsection
