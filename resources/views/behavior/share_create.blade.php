@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（新規登録）</div>
                <div class="card-body">

                    (2匹以上のオーナーさん)<br>
                    aibo選択：<br>
                    (1匹のみなら)<br>
                    hiddenでaibo_idを渡す<br>

                    <br>
                    登録ボタン

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behavior.share_index')}}"><button>ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
