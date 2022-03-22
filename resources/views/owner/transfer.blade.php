@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ0】オーナー登録方法の選択</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('owner.transfer_login')}}">・旧「aibo life」（スマホ版）を利用されていた方【データ引継あり】</a><br>
                    <br>
                    <a href="{{route('owner.create')}}">・新「aibo life」（Web版）から初めてご利用される方【データ引継なし】</a><br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
