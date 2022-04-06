@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">

                    <h4>タイトル：{{$diary->diary_title}}</h4>

                    <a href="{{route('diary.list_day')}}?date={{$diary->diary_date}}"><button>{{$diary->diary_date}}の日記一覧</button></a><br><br>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$diary->aibo_id}}"><button>{{$diary->aibo->aibo_name}}の日記一覧</button></a><br><br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
