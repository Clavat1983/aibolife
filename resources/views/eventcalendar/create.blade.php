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
                <div class="card-header">イベントカレンダー登録</div>

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

                    <form method="POST" action="{{route('event.store')}}" enctype="multipart/form-data">
                        @csrf
                        
                        <table width="100%" style="border:solid 1px;">
                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_publication_datetime">公開日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_publication_datetime" name="event_publication_datetime" value="{{old('event_publication_datetime',$now)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_publication_flag">公開状態</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '下書き（非公開・終了）',
                                            '公開',
                                        ];
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="event_publication_flag_{{$index}}" name="event_publication_flag" value="{{$value}}" @if(old('event_publication_flag') === $value) checked @endif><label for="event_publication_flag_{{$index}}">{{$value}}</label><br>
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
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="event_confirm_flag_{{$index}}" name="event_confirm_flag" value="{{$value}}" @if(old('event_confirm_flag') === $value) checked @endif><label for="event_confirm_flag_{{$index}}">{{$value}}</label><br>
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
                                        <input type="radio" id="event_category_{{$index}}" name="event_category" value="{{$value}}" @if(old('event_category') === $value) checked @endif><label for="event_category_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>


                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="event_title">タイトル</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="event_title" id="event_title" value="{{old('event_title')}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_start_datetime">開始日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_start_datetime" name="event_start_datetime" value="{{old('event_start_datetime',$now)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="event_end_datetime">終了日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="event_end_datetime" name="event_end_datetime" value="{{old('event_end_datetime',$now)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="link_news_id">関連ニュースID(aibo life内)</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    <input type="text" name="link_news_id" id="link_news_id" value="{{old('link_news_id',0)}}">　｜　【リンク確認】
                                </td>
                            </tr>

                        </table>

                        <p style="margin-top:30px; text-align:center;"><button type="submit">登録</button></p>

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
