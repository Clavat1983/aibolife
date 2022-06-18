@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ニュース一覧</div>

                <div class="card-body">
                    <table>
                    @foreach($news_all as $news)
                        <tr>
                            <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                            <td style="padding:10px;">{{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br><a href="{{route('news.show', $news)}}">{{$news->news_title}}</a></td>
                        </tr>
                    @endforeach
                    </table>
                    {{$news_all->links()}}
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
