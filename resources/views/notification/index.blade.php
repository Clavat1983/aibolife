@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">通知一覧（未読：{{$bell_count}}件）</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th style="padding-left:10px; padding-right:10px;">通知ID</th>
                            <th style="padding-left:10px; padding-right:10px;">カテゴリ</th>
                            <th style="padding-left:10px; padding-right:10px;">送信者ID</th>
                            <th style="padding-left:10px; padding-right:10px;">送信者名</th>
                            <th style="padding-left:10px; padding-right:10px;">タイトル</th>
                            <th style="padding-left:10px; padding-right:10px;">通知日時</th>
                            <th style="padding-left:10px; padding-right:10px;">状態</th>
                        </tr>
                    @foreach($notifications as $notification)
@if($notification->read_at)
                        <tr>
@else
                        <tr style="font-weight:bold; background-color:lemonchiffon;">
@endif
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->number}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->category}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->send_user_id}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->owner_name}}</td>
                            <td style="padding-left:10px; padding-right:10px;"><a href="{{ route('notification.redirect', $notification->number) }}">{{$notification->title}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->created_datetime}}</td>
@if($notification->read_at)
                            <td style="padding-left:10px; padding-right:10px;">-</td>
@else
                            <td style="padding-left:10px; padding-right:10px;">未</td>
@endif
                        </tr>
                    @endforeach
                    </table>

                    {{-- {{$notifications->onEachSide(1)->links()}} --}}
                    <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$notifications->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                    <option value="{{$notifications->url($i)}}" @if($i == $notifications->currentPage()) selected @endif>{{$i}}ページ目/全{{$notifications->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$notifications->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>
                    
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
