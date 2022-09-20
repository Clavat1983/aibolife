@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（詳細）</div>
                <div class="card-body">


                    ID：{{$behavior->id}}、タイトル：{{$behavior->behavior_name}}、aiboの名前：{{$behavior->aibo->aibo_name}}<br>

                    {{-- ログイン中のユーザのオーナーIDと、このふるまいを登録しているaiboのオーナーIDが一緒なら編集 --}}
                    @if(auth()->user()->owner->id == $behavior->aibo->owner_id)
                        自分のaiboなのでふるまいの編集・削除が【可能】
                    @else
                        他人のaiboなのでふるまいの編集・削除は【不可】
                    @endif

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behavior.share_index')}}?page={{$page}}&seed={{$seed}}"><button>ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
