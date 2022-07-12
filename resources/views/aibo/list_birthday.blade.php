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
            <h6 style="text-align:center;">誕生月</h6>
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','01')}}">【1月（{{$count_ary["01"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','02')}}">【2月（{{$count_ary["02"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','03')}}">【3月（{{$count_ary["03"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','04')}}">【4月（{{$count_ary["04"]}}）】</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','05')}}">【5月（{{$count_ary["05"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','06')}}">【6月（{{$count_ary["06"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','07')}}">【7月（{{$count_ary["07"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','08')}}">【8月（{{$count_ary["08"]}}）】</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','09')}}">【9月（{{$count_ary["09"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','10')}}">【10月（{{$count_ary["10"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','11')}}">【11月（{{$count_ary["11"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','12')}}">【12月（{{$count_ary["12"]}}）】</a></td>
                        </tr>
                    </table>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.index')}}"><button>aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
