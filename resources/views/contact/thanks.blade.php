@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')

{{-- エラーメッセージ表示 --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- 送信後のメッセージ表示 --}}
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

@auth
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
            <div class="card-body">
                <h1 class="mt4  mb-3">お問い合わせ</h1>

                    お問い合わせを受け付けました。<br>
                    通常1-2日以内に、メールにて回答をお送りします。<br>
                    ※マイページの<a href="{{route('contact.index')}}">「お問い合わせ履歴」</a>からもご確認いただけます。<br>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
            <div class="card-body">
                <h1 class="mt4  mb-3">お問い合わせ</h1>

                    お問い合わせを受け付けました。<br>
                    通常1-2日以内に、メールにて回答をお送りします。<br>
                    <br>
                    お問い合わせ内容（控え）をメールにてお送りしていますのでご確認ください。<br>
                    ※控えが迷惑メールフォルダに入っていないかもご確認ください。<br>
                    迷惑メールフォルダに入ってしまっている場合は、回答メールも同様に振り分けられてしまうため、控えメールを「迷惑メール」にならないよう振り分け設定などをお願いします。

            </div>
        </div>
    </div>
@endauth


@endsection