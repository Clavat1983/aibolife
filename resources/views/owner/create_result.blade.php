@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ1】オーナー登録（完了）</div>

                <div class="card-body">
                    <p>オーナー名：{{$owner->owner_name}}さん</p>

                    @if(count($owner->aibos) == 0)
                        <p>オーナー登録が完了しました。<br>
                        aiboが登録されていません。<br>
                        aibo登録に進みましょう</p>
                        <a href="{{route('home')}}">aibo登録へ</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                    @else
                        <p>新規オーナー登録が完了しました。<br>
                        【エラー】既にaibo登録が完了している状態。この表示が出たらおかしい。</p>
                        <a href="{{route('home')}}">トップページへ</a><br>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
