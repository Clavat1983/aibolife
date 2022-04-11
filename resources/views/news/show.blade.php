@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ニュース表示</div>

                <div class="card-body">

                    {!! $news->news_body !!}
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
