@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>

                <div class="card-body">
                    <h2>マイページ</h2>


                    @if ($owner == NULL)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        ユーザーID:{{$owner->user_id}}｜オーナーID:{{$owner->id}} ⇒ (オーナー名){{$owner->owner_name}}<br><br><br>

                        {{-- @if(count($owner->aibos) == 0)
                            aibo登録がされていない。これが表示されたらバグ。
                        @else --}}
                            <h4>ログイン情報</h4>
                            <ul>
                                <li><a href="{{ route('user.edit', $owner->user_id) }}">メールアドレス・パスワードの変更</a></li>
                            </ul>
                            <br>
                            <h4>オーナー情報</h4>
                            <ul>
                                <li><a href="{{ route('owner.edit', $owner->id) }}">オーナー名・アイコン・都道府県の変更</a></li>
                            </ul>
                            <br>
                            <h4>aibo情報</h4>
                            <ul>
                            @foreach ($owner->aibos as $aibo)
                                <li>aibo ID:{{$aibo->id}} ... 名前:{{$aibo->aibo_name}}　を<a href="{{ route('aibo.show', $aibo->id) }}">【表示】</a>／<a href="{{ route('aibo.edit', $aibo->id) }}">【変更】</a></li>
                            @endforeach
                                <li><a href="{{ route('aibo.create') }}">aiboの追加</a></li>
                            </ul>
                        {{-- @endif --}}
                    @endif
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
