@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレス再確認</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @else
                        メールアドレスが変更されました。<br>
                        確認のため認証メールを送信しましたので、届いたメール内のリンクをクリックしてください。<br>
                    @endif
                    数分待ってもメールが届かない場合は、下記のボタンを押して確認メールを送付するか、お問い合わせをお願いします。

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
