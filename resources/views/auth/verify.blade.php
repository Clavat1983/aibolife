@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メール認証</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            メールを再送付しました。
                        </div>
                    @endif

                    入力されたメールアドレスに「アカウント作成」のお知らせメールを送付しました。<br/>
                    1時間以内にお知らせメール内に記載されたURLをクリックし、引き続きオーナー登録をお願いします。<br/>
                    （迷惑メールフォルダなどに振り分けられていないかもご確認ください）<br>
                    <br/>
                    お知らせメールが届いていない場合は、別のメールアドレスで「アカウント作成」を改めて実施いただくか、「メール再送」ボタンをクリックしてください。<br><br>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="bottun" class="btn btn-primary">メール再送</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
