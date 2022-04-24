@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ニュース一覧</div>

                <div class="card-body">

                    @foreach($news_all as $news)
                        {{$news->news_title}}<br>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
