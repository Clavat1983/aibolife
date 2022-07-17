@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ1】オーナー登録（完了）</div>

                <div class="card-body">
                    <p>オーナー名：{{$owner->owner_name}}さん</p>

                    @if(count($owner->aibos) == 0)
                        <p>オーナー情報の引継ぎが完了しました。<br>
                        aiboが登録されていません。<br>
                        aibo登録に進みましょう</p>
                        <a href="{{route('home')}}">aibo登録</a><br>{{-- homeに戻せば自動的に「aibo.create」に転送される。「aibo.create」と書いても同じ --}}
                    @else
                        <p>オーナー情報、aibo情報、投稿・コメントなど情報の引継ぎが完了しました。</p>
                        <a href="{{route('home')}}">トップページへ</a><br>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
