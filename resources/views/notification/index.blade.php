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
                    {{$notifications->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
