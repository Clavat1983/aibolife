@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <br>
                    <br>
                    aibo日記（ビジュアル）<br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card-body" style="background-color:lightgray; text-align:center; margin:0px; padding:5px;">
                    「aibo life」はソニー株式会社および関連会社とは一切関係のないオーナーコミュニティサイトです<br>
                </div>
            </div>

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Archive</u></h2>
            <h6 style="text-align:center;">過去の日記</h6>
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
@if($before_flg)
                            <th width="25%"><a href="{{route('diary.archive')}}?year={{$before_year}}&month={{$before_month}}">←前の月へ</a></th>
@else
                            <th width="25%">---</th>
@endif

                            <th width="50%">{{$target_year}}年{{$target_month}}月</th>

@if($next_flg)
                            <th width="25%"><a href="{{route('diary.archive')}}?year={{$next_year}}&month={{$next_month}}">次の月へ→</a></th>
@else
                            <th width="25%">---</th>
@endif
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <th>月</th>
                            <th>火</th>
                            <th>水</th>
                            <th>木</th>
                            <th>金</th>
                            <th>土</th>
                            <th>日</th>
                        </tr>

                        <tr>
                        @php $cnt = 0; @endphp
                        @foreach ($calendar as $key => $value)
                            <td>
                            @php
                                $cnt++;
                                $date_str = $target_year.'-'.sprintf('%02d',$target_month).'-'.sprintf('%02d',$value['day']);
                                //その日の日記の件数
                                $date_array = $diaries->firstWhere('diary_date', $date_str);
                                $count = 0;
                                if($date_array){
                                    $count = $date_array['count'];
                                }
                            @endphp

                            @if($value['day'] != '')
                                <a href="{{route('diary.list_day')}}?date={{$date_str}}"><span style="font-size:150%;">{{$value['day']}}</span><br>（{{$count}}件）</a>
                            @else
                                <span style="font-size:150%;">&nbsp;</span>
                            @endif
                            </td>
                     
                        @if($cnt == 7)
                        </tr>
                        <tr>
                        @php $cnt = 0; @endphp
                        @endif
                     
                        @endforeach
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('diary.index')}}"><button type="button">aibo日記に戻る</button></a>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    table {
        width: 100%;
    }
    table th,
    table td {
        border: 1px solid #CCCCCC;
        text-align: center;
        padding: 5px;
        height: 75px;
    }
    table th {
        background: #EEEEEE;
        height: 40px;
    }
    </style>
@endsection
