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
            <h2 style="text-align:center;"><u>(Tab3) Birthday</u></h2>
            <h6 style="text-align:center;">誕生月</h6>
            <div class="card">
                <div class="card-body">
                    【1月（{{$month_ary["01"]}}）】【2月（{{$month_ary["02"]}}）】【3月（{{$month_ary["03"]}}）】【4月（{{$month_ary["04"]}}）】【5月（{{$month_ary["05"]}}）】【6月（{{$month_ary["06"]}}）】<br>
                    【7月（{{$month_ary["07"]}}）】【8月（{{$month_ary["08"]}}）】【9月（{{$month_ary["09"]}}）】【10月（{{$month_ary["10"]}}）】【11月（{{$month_ary["11"]}}）】【12月（{{$month_ary["12"]}}）】<br>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
