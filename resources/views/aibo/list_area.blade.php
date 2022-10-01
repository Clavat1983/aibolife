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

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Area</u></h2>
            <h6 style="text-align:center;">居住地</h6>
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                    <tr>
                        @php
                            $pref_count = 0;
                        @endphp
                        @foreach (config('const.pref_list') as $pref)
                            @if(mb_substr($pref,0,2) != '00')
                                <td><a href="{{route('aibo.result_area',mb_substr($pref,3))}}">【{{mb_substr($pref,3)}}（{{$count_ary[$pref]}}）】</a></td>
                            @endif
                            @php
                                if(mb_substr($pref,0,2) != '00'){
                                    $pref_count++;
                                }
                            @endphp
                            @if($pref_count % 4 == 0)
                    </tr>
                    <tr>
                            @endif
                        @endforeach
                        <td><a href="{{route('aibo.result_area','非公開')}}">【非公開（{{$count_ary['00_非公開']}}）】</a></td>
                    </tr>
                    </table>
                    <br>
                    <h3 style="text-align:right">全{{$count}}匹</h3>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.index')}}"><button type="button">aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
