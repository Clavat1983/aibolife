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
                    aibo名鑑（ビジュアル）<br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card-body" style="background-color:lightgray; text-align:center; margin:0px; padding:5px;">
                    「aibo life」はソニー株式会社および関連会社とは一切関係のないオーナーコミュニティサイトです<br>
                </div>
            </div>

            {{-----------------------------------}}
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Happy Birthday</u></h2>
            <h6 style="text-align:center;">誕生日（いたら表示、いなかったら非表示）</h6>

            <div class="card">
                <div class="card-body">
                    @if($birthday_aibos->count() > 0)
                        @foreach($birthday_aibos as $aibo)
                            @php
                                $day1 = new DateTime();
                                $day2 = new DateTime($aibo->aibo_birthday);
                                $interval = $day1->diff($day2);
                                $y = $interval->format('%y歳');
                            @endphp
                            <li>{{$aibo->aibo_name}}（{{$aibo->aibo_birthday}}＝{{$y}}）<a href="{{route('aibo.show', $aibo)}}">【詳細】</a></li>
                        @endforeach
                    @else
                        <li>今日・昨日・一昨日が誕生日のaiboはいません</li>
                    @endif
                </div>
            </div>

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>New Friends</u></h2>
            <h6 style="text-align:center;">新しいお友達（誕生日のaiboがいないときに表示）</h6>

            <div class="card">
                <div class="card-body">
                    @if($new_aibos->count() > 0)
                        @foreach($new_aibos as $aibo)
                            <li>{{$aibo->aibo_name}}（{{substr($aibo->owner->owner_pref,3)}}）<a href="{{route('aibo.show', $aibo)}}">【詳細】</a></li>
                        @endforeach
                    @else
                        <li>aiboがいません</li>
                    @endif
                </div>
            </div>

            <p>&nbsp;</p>
            <hr/>
            <p>&nbsp;</p>

            <div class="card">
                <div class="card-header">お友達を見つける</div>
                <div class="card-body">
                    <a href="{{route('aibo.list_syllabary')}}">50音順リスト</a><br>
                    <a href="{{route('aibo.list_area')}}">居住地マップ</a><br>
                    <a href="{{route('aibo.list_birthday')}}">誕生日カレンダー</a><br>
                    <a href="{{route('aibo.search')}}">条件検索（後日公開）</a><br>

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
@endsection
