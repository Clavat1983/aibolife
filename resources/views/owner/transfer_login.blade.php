@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ1】旧オーナー情報認証</div>

                <div class="card-body">
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

                    <form method="POST" action="{{route('owner.transfer_result')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="radio" id="pattern1" name="pattern" value="1" {{ old('pattern','1') == '1' ? 'checked' : '' }}><label for="pattern1">ログインIDとパスワードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_id">ログインID（旧）</label>
                            <input type="text" name="owner_old_login_id" id="owner_old_login_id" value="{{old('owner_old_login_id')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_login_password">パスワード（旧）</label>
                            <input type="password" name="owner_old_login_password" id="owner_old_login_password" value="{{old('owner_old_login_password')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <input type="radio" id="pattern2" name="pattern" value="2" {{ old('pattern') == '2' ? 'checked' : '' }}><label for="pattern2">セキュリティコードで認証</label>
                        </div>
                        <p>&nbsp;</p>
                        <div style="margin-left:50px;">
                            <label for="owner_old_security_code">セキュリティコード（旧）</label>
                            <input type="text" name="owner_old_security_code" id="owner_old_security_code" value="{{old('owner_old_security_code')}}">
                        </div>
                        <p>&nbsp;</p>
                        <button type="submit">認証（引き継ぎ実行）</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
