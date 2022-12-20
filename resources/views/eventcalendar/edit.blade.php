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
                <div class="card-header">イベントカレンダー編集</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('event.update', $event)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        @php
                            $old_event_publication_datetime = substr($event->event_publication_datetime,0,10).'T'.substr($event->event_publication_datetime,11,5);
                            $old_event_start_datetime = substr($event->event_start_datetime,0,10).'T'.substr($event->event_start_datetime,11,5);
                            $old_event_end_datetime = substr($event->event_end_datetime,0,10).'T'.substr($event->event_end_datetime,11,5);
                        @endphp
                        
                        <table width="100%" style="border:solid 1px;">
                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_publication_datetime">公開日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_publication_datetime" name="event_publication_datetime" value="{{old('event_publication_datetime',$old_event_publication_datetime)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_publication_flag">公開状態</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '下書き（非公開・終了）',
                                            '公開',
                                        ];

                                        $event_publication_flag = '';
                                        if ($event->event_publication_flag === 1){
                                            $event_publication_flag = '公開';
                                        } else {
                                            $event_publication_flag = '下書き（非公開・終了）';
                                        }
                                    @endphp
                                    <!-- HTMLタグ出力 -->
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="event_publication_flag_{{$index}}" name="event_publication_flag" value="{{$value}}" @if(old('event_publication_flag', $event_publication_flag) === $value) checked @endif><label for="event_publication_flag_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_confirm_flag">情報確度</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '未確認',
                                            '確定',
                                        ];

                                        $event_confirm_flag = '';
                                        if ($event->event_confirm_flag === 1){
                                            $event_confirm_flag = '確定';
                                        } else {
                                            $event_confirm_flag = '未確認';
                                        }
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="event_confirm_flag_{{$index}}" name="event_confirm_flag" value="{{$value}}" @if(old('event_confirm_flag', $event_confirm_flag) === $value) checked @endif><label for="event_confirm_flag_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_category">カテゴリー</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            'ごはん',
                                            'ふるまい',
                                            'イベント'
                                        ];
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="event_category_{{$index}}" name="event_category" value="{{$value}}" @if(old('event_category', $event->event_category) === $value) checked @endif><label for="event_category_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>


                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_title">タイトル</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="event_title" id="event_title" value="{{old('event_title',$event->event_title)}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_start_datetime">開始日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_start_datetime" name="event_start_datetime" value="{{old('event_start_datetime',$old_event_start_datetime)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_end_datetime">終了日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_end_datetime" name="event_end_datetime" value="{{old('event_end_datetime',$old_event_end_datetime)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="link_news_id">関連ニュースID(aibo life内)</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    <input type="text" name="link_news_id" id="link_news_id" value="{{old('link_news_id',$event->link_news_id)}}">　｜　【リンク確認】
                                </td>
                            </tr>

                        </table>

                        <p style="margin-top:30px; text-align:center;"><button type="submit">更新</button></p>

                        {{-- 一覧画面へ --}}
                        <p style="text-align:center;">
                            <a href="{{route('event.admin')}}">【一覧画面へ】</a>
                        </p>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>

@endsection
