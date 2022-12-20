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
                <div class="card-header">【管理者用】イベントカレンダー一覧（非公開含む全件）</div>
                <div class="card-body">
                    <p style="text-align:right;"><a href="{{route('event.create')}}">【新規イベント作成】</a></p>
                    <table>
                    @foreach($events as $event)
                        <tr>
                            <td style="padding:10px;">
                                <!-- 公開中かどうか -->
                                @if($event->event_publication_flag && (strtotime($event->event_publication_datetime) <= strtotime('now')))
                                    ★公開中★
                                @elseif($event->event_publication_flag && (strtotime($event->event_publication_datetime) > strtotime('now')))
                                    ！待機中！
                                @else
                                    （非公開）
                                @endif

                                <!-- 内容確定かどうか -->
                                @if($event->event_confirm_flag)
                                    <span style="color:green;">【確定】</span>
                                @else
                                    <span style="color:red;">【不明】</span>
                                @endif

                                ｜{{str_replace('-', '.', substr($event->event_start_datetime,0,10))}}～{{str_replace('-', '.', substr($event->event_end_datetime,0,10))}}<br>
                                <a href="{{route('event.edit', $event)}}">【{{$event->event_category}}】{{$event->event_title}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </table>

                    <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$events->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $events->lastPage(); $i++)
                                    <option value="{{$events->url($i)}}" @if($i == $events->currentPage()) selected @endif>{{$i}}ページ目/全{{$events->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$events->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>

                    <a href="{{route('home.admin')}}"><button type="button">管理者メニューに戻る</button></a>

                </div>


            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
@endsection
