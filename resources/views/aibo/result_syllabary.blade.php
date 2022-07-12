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
            <h2 style="text-align:center;"><u>Syllabary</u></h2>
            <h6 style="text-align:center;">50音順</h6>
            <div class="card">
                <div class="card-body">
                    <h2>「{{$syllabary}}」で始まる</h2>
                    @foreach($aibos as $aibo)
                        名前：{{$aibo->aibo_name}}<br>
                    @endforeach
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.list_syllabary')}}"><button>aibo名鑑(50音リスト)に戻る</button></a><br>
                    <a href="{{route('aibo.index')}}"><button>aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
