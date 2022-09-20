@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（新規登録＝共有コード取り込み）</div>
                <div class="card-body">

                    <form method="post" action="{{route('behavior.share_create_confirm')}}">
                        @csrf

                        <label for="my_aibo_code">My aibo 共有コード貼り付け</label><br>
                        （My aiboからコピーした共有コードをそのまま編集せずに貼り付けてください）<br>
                        <br>
                        <textarea name="my_aibo_code" id="my_aibo_code" cols="50" rows="12">{{old('my_aibo_code')}}</textarea>
                        <br>
                        @if(session('message'))
                            エラーメッセージ:{{session('message')}}<br>
                        @endif

                        <br>
                        <button type="submit" class="btn btn-success">読み込み</button>
                    </form>

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
