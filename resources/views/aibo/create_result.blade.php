@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ2】aibo登録（完了）</div>

                <div class="card-body">
                    <p>オーナー名：{{$owner->owner_name}}さん</p>

                    @if(count($owner->aibos) == 1)
                        <p>オーナー登録・aibo登録が全て完了しました。<br>ようこそ、「aibo life」へ！</p>
                        <a href="{{route('home')}}">トップページへ</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                    @elseif(count($owner->aibos) == 0)
                        <p>【エラー】aibo登録後も結果が0匹。</p>
                        <a href="{{route('home')}}">トップページへ</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                    @else
                        <p>aiboの追加が完了しました。<br>
                        2匹目以降です。OK!</p>
                        <a href="{{route('home')}}">トップページへ</a><br>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
