<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>aibo life</title>
    <meta name="description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:title" content="aibo life" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../../assets/images/ogp.png"
    />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:site_name" content="aibo life" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="{{url()->full()}}" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />

    <!-- Google Ad -->
    @include('subview.google-ad')
    
  </head>

  <body id="pagetop">
    <div class="l-wrap">
      
      {{-- 【共通】header & nav --}}
      @include('subview.header-nav')

      {{-- main(各画面の個別部分) --}}
      <main class="l-main">
        <div class="l-main__content">
          <div class="l-content">
{{-- --------------------------------------------------------------------------- --}}
            <div class="l-content__header">

            @php
                \Carbon\Carbon::setLocale('ja');
                $firstday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth();
                $lastday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->endOfMonth();
                $targetday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth();
                $targetday_0000 = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth()->setTime(0, 0, 0);
                $targetday_2359 = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth()->setTime(23, 59, 59);

                $prev = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->subMonth();
                $today = \Carbon\Carbon::now();
                $next = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->addMonth();
            @endphp

              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Event</span>
                <span class="c-category-ttl__jp">イベントカレンダー［{{$firstday->format('Y')}}年{{$firstday->format('n')}}月］</span>
              </p>
            </div>

            <div class="l-content__body">

                <div>

                    <a href="{{route('eventcalendar.index')}}?year={{$prev->format('Y')}}&month={{$prev->format('n')}}">【前月（{{$prev->format('Y')}}年{{$prev->format('n')}}月）】</a>　｜　<a href="{{route('eventcalendar.index')}}?year={{$next->format('Y')}}&month={{$next->format('n')}}">【次月（{{$next->format('Y')}}年{{$next->format('n')}}月）】</a><br>
                    <hr/>

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
                    <a href="{{route('eventcalendar.index')}}?year={{$prev->format('Y')}}&month={{$prev->format('n')}}">【前月（{{$prev->format('Y')}}年{{$prev->format('n')}}月）】</a>　｜　<a href="{{route('eventcalendar.index')}}?year={{$next->format('Y')}}&month={{$next->format('n')}}">【次月（{{$next->format('Y')}}年{{$next->format('n')}}月）】</a><br>
                    <a href="{{route('eventcalendar.index')}}?year={{$today->format('Y')}}&month={{$today->format('n')}}">【今月（{{$today->format('Y')}}年{{$today->format('n')}}月）】</a>

                </div>

            
                
            </div>

{{-- --------------------------------------------------------------------------- --}}
        </div>
    </div>

{{-- 【共通】バナー広告 --}}
@include('subview.banner')

</main>

{{-- 【共通】footer --}}
@include('subview.footer')

</div>
<script type="module" src="{{asset('js/common.js')}}"></script>
</body>
</html>




{{-- @extends('layouts.app')

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
                    
                    <!-- 今月のカレンダーを出力 -->
                    @while ($targetday <= $lastday)
                        @php
                            //曜日1文字の取得
                            $dayname = mb_substr($targetday->dayName,0,1);
                        @endphp
                        
                        <tr>
                            <td>{{$targetday->format('Y/m/d')}}（{{$dayname}}）</td>
                            <td>
                                @foreach ($events as $event)
                                    <!-- イベントの開始・終了の日時でCarbonを作る -->
                                    @php
                                        $event_start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->event_start_datetime);
                                        $event_end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->event_end_datetime);
                                    @endphp

                                    <!-- 開始日時が今日の23:59:59以前＝今日以前に開始+今日始まる　かつ　終了時間が今日の0:00より大きい＝今日以降に終わる -->
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
                    <!--<a href="{{route('eventcalendar.index')}}?year={{$today->format('Y')}}&month={{$today->format('n')}}">【今　月】</a><br>-->
                    <a href="{{route('eventcalendar.index')}}?year={{$next->format('Y')}}&month={{$next->format('n')}}">【次の月】</a><br>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
