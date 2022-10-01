@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン情報編集</div>

                <div class="card-body">
                    ログインに使用するメールアドレス・パスワードを変更できます。<br>
                    なお、メールアドレスを変更した場合は、再度、メール認証が必要です。<br><br>
                    ログインしているユーザのID：{{auth()->user()->id}}<br>
                    編集対象のユーザID：{{$user->id}}<br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('user.update', $user)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="email">メールアドレス</label>
                            <input type="text" name="email" id="email" value="{{old('email', $user->email)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password">新パスワード</label>
                            <input type="password" name="password" id="password" value="">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="password_confirmation">新パスワード（確認用）</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" value="">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">変更</button>

                    </form>
                    
                    <a href="{{route('mypage')}}"><button type="button">マイページに戻る</button></a>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
