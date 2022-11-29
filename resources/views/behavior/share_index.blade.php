@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（ページ：{{$page}}、乱数:{{$seed}}、mes：{{$mes}}）</div>
                <div class="card-body">

                    @foreach ($behaviors as $behavior)
                        ID：{{$behavior->id}}、タイトル：{{$behavior->behavior_name}}、aiboの名前：{{$behavior->aibo->aibo_name}}　<a href="{{route('behaviorshare.show', $behavior)}}?seed={{$seed}}&page={{$page}}">【見る】</a><br>
                    @endforeach
                    <br>
                    ---------------↓ここからページネーションのタグ---------------<br>
                    {{$behaviors->appends(['seed' => $seed])->onEachSide(1)->links()}}
                    ----------------↑ここまでページネーションのタグ--------------------<br>
                    <p style="text-align:center;"><a href="{{route('behaviorshare.create')}}">ふるまいを登録する</a></p>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
