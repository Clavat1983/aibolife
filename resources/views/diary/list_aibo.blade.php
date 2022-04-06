@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>aibo_ID:{{$aibo->id}}「{{$aibo->aibo_name}}」の日記</h2>

                    <br>
                    <h5>直近7日間の日記</h5>
                    <br>
                    @foreach($this_week as $date => $diary)
                        @if($diary == NULL)
                            @if(strtotime($aibo->aibo_birthday) <= strtotime($date)) {{--誕生日が日記の日付より前--}}
                                配列の日付：{{$date}}、<a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$date}}">日記を書く</a>（aiboID:{{$aibo->id}}、日付:{{$date}}）<br>
                            @else
                                配列の日付：{{$date}}、お迎え前<br>
                            @endif
                        @else
                            配列：{{$date}}、aibo：{{$diary->aibo->aibo_name}}、日記：{{$diary->diary_date}}、タイトル：{{$diary->diary_title}}<br>
                        @endif
                    @endforeach


                    <br>
                    <br>
                    <h5>過去の日記</h5>
                    
                    {{-- 
                    @foreach ($archive_count as $yyyy => $yyyymm)
                        {{$yyyy}}年<br>
                        <ul>
                        @foreach ($yyyymm as $month => $count)
                            <li>{{$month}}月（{{$count}}件）</li>
                        @endforeach
                        </ul>
                    @endforeach
                    --}}

                    <br>
                    <br>


                    <a href="{{route('diary.index')}}">日記メニューに戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
