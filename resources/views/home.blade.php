@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}<br><br>

                    @if (count($owners) == 0)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        @foreach ($owners as $owner)
                            オーナーID:{{$owner->id}}<br>
                            オーナー名:{{$owner->name}}<br>
                            旧ログインID:{{$owner->old_login_id}}<br>
                            旧セキュリティコード:{{$owner->old_security_code}}<br>

                            @if(count($owner->aibos) == 0)
                                aibo登録がされていない。これが表示されたらバグ。
                            @else
                                @foreach ($owner->aibos as $aibo)
                                aibo ID:{{$aibo->id}} ... 名前{{$aibo->name}}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
