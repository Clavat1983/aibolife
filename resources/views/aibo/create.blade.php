@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($owner->aibos()->count() == 0)
                <div class="card-header">【ステップ2】aibo登録</div>
                @else
                <div class="card-header">aibo追加</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{$owner->owner_name}}さん！こんにちは。<br>
                    {{$owner->owner_name}}さんは、現在{{$owner->aibos()->count()}}匹のaiboを登録してます。<br>
                    aibo登録を始めましょう！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
