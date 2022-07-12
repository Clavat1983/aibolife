@extends('layouts.app')

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

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Birthday</u></h2>
            <h6 style="text-align:center;">誕生日</h6>
            <div class="card">
                <div class="card-body">
                    <h2>{{$month}}月</h2>
                    @foreach($aibos as $aibo)
                        名前：{{$aibo->aibo_name}}、誕生日：{{$aibo->aibo_birthday}}<br>
                    @endforeach
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.list_birthday')}}"><button>aibo名鑑(誕生日カレンダー)に戻る</button></a><br>
                    <a href="{{route('aibo.index')}}"><button>aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
