@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">イベントカレンダー</div>
                <div class="card-body">
                    @php
                        \Carbon\Carbon::setLocale('ja');
                        $firstday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth();
                        $lastday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->endOfMonth();
                        $targetday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth();
                        $targetday_0000 = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth()->setTime(0, 0, 0);
                        $targetday_2359 = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth()->setTime(23, 59, 59);
                    @endphp

                    <table>
                        <tr>
                            <th>日付</th>
                            <th>イベント</th>
                        </tr>
                    
                    {{-- 今月のカレンダーを出力 --}}
                    @while ($targetday <= $lastday)
                        @php
                            //曜日1文字の取得
                            $dayname = mb_substr($targetday->dayName,0,1);
                        @endphp
                        
                        <tr>
                            <td>{{$targetday->format('Y/m/d')}}（{{$dayname}}）</td>
                            <td>
                                @foreach ($events as $event)
                                    {{-- イベントの開始・終了の日時でCarbonを作る --}}
                                    @php
                                        $event_start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->event_start_datetime);
                                        $event_end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->event_end_datetime);
                                    @endphp

                                    {{-- 開始日時が今日の23:59:59以前＝今日以前に開始+今日始まる　かつ　終了時間が今日の0:00より大きい＝今日以降に終わる --}}
                                    @if(($event_start <= $targetday_2359) && ($event_end >= $targetday_0000))
                                        {{$event->event_title}}<br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @php
                            $targetday->addDay();
                            $targetday_0000->addDay();
                            $targetday_2359->addDay();
                        @endphp
                    @endwhile

                    </table>

                    <hr/>
                    @php
                        $prev = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->subMonth();
                        $today = \Carbon\Carbon::now();
                        $next = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->addMonth();
                    @endphp
                    <a href="{{route('eventcalendar.index')}}?year={{$prev->format('Y')}}&month={{$prev->format('n')}}">【前の月】</a><br>
                    <a href="{{route('eventcalendar.index')}}?year={{$today->format('Y')}}&month={{$today->format('n')}}">【今　月】</a><br>
                    <a href="{{route('eventcalendar.index')}}?year={{$next->format('Y')}}&month={{$next->format('n')}}">【次の月】</a><br>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
