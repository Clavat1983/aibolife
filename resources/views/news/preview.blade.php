@extends('layouts.app')

@section('content')
<div class="container">
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br>
                    <h3>{{$news->news_title}}</h3>
                    【タグ】{{$news->news_tag1}}
                     @if($news->news_tag2)｜{{$news->news_tag2}}@endif
                     @if($news->news_tag3)｜{{$news->news_tag3}}@endif
                     @if($news->news_tag4)｜{{$news->news_tag4}}@endif
                     @if($news->news_tag5)｜{{$news->news_tag5}}@endif
                </div>

                <div class="card-body">

                    【画像】<br>
                    <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"><br>
                    @if($news->news_image2)
                        <img src="{{ asset('storage/news_image/'.$news->news_image2)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image3)
                        <img src="{{ asset('storage/news_image/'.$news->news_image3)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image4)
                        <img src="{{ asset('storage/news_image/'.$news->news_image4)}}" style="width:100px;"><br>
                    @endif
                    @if($news->news_image5)
                        <img src="{{ asset('storage/news_image/'.$news->news_image5)}}" style="width:100px;"><br>
                    @endif

                    【本文】<br>
                    {!! $news->news_body !!}<br>

                    @if($news->news_link1_name || $news->news_link2_name || $news->news_link3_name || $news->news_link4_name || $news->news_link5_name)【関連リンク】<br>@endif
                    @if($news->news_link1_name)<a href="{{$news->news_link1_url}}" target="blank">{{$news->news_link1_name}}</a><br>@endif
                    @if($news->news_link2_name)<a href="{{$news->news_link2_url}}" target="blank">{{$news->news_link2_name}}</a><br>@endif
                    @if($news->news_link3_name)<a href="{{$news->news_link3_url}}" target="blank">{{$news->news_link3_name}}</a><br>@endif
                    @if($news->news_link4_name)<a href="{{$news->news_link4_url}}" target="blank">{{$news->news_link4_name}}</a><br>@endif
                    @if($news->news_link5_name)<a href="{{$news->news_link5_url}}" target="blank">{{$news->news_link5_name}}</a><br>@endif

                    {{-- 編集画面へ --}}
                    <p style="text-align:center;">
                        <a href="{{route('news.edit', $news)}}">【編集画面へ】</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
@endsection
