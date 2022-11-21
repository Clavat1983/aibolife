@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">管理者画面(ADMIN)</div>

                <div class="card-body">

                    <h4>最新情報（Topics）</h4>
                    <a href="{{route('news.admin')}}">全件表示（非表示も含む）＆変更</a><br/>
                    <a href="{{route('news.create')}}">新規入力</a><br/>
                    <hr/>
                    <h4>お問い合わせ</h4>
                    <a href="{{route('contact.list_admin')}}">問い合わせ一覧（全件）</a><br/>
                    <hr/>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
@endsection
