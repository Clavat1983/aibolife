{{-- 【廃止】新規登録でオーナー登録が完了して、aibo登録に進みましょう画面。不要と判断。
    
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
                        <a href="{{route('root')}}">aibo登録へ</a><br>
                    @else
                        <p>新規オーナー登録が完了しました。<br>
                        【エラー】既にaibo登録が完了している状態。この表示が出たらおかしい。</p>
                        <a href="{{route('root')}}">トップページへ</a><br>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection --}}
