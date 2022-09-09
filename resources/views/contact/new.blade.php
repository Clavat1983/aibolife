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

<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">お問い合わせ</h1>
            <form method="post" action="{{route('contact.store_new')}}">
            @csrf

@auth
                    オーナーID：{{auth()->user()->owner->id}}<br>
                    名前：{{auth()->user()->owner->owner_name}}<br>
                    メールアドレス：{{auth()->user()->email}}<br>
                    <input type="hidden" name="owner_id" id="owner_id" value="{{auth()->user()->owner->id}}">
                    <input type="hidden" name="name" id="name" value="{{auth()->user()->owner->owner_name}}">
                    <input type="hidden" name="email" id="email" value="{{auth()->user()->email}}">
@else
                <input type="hidden" name="owner_id" id="owner_id" value="0">
                <div class="form-group">
                    <label for="title">お名前</label>
                    <input type="name" name="name" 
                    class="form-control" id="name" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" 
                    class="form-control" id="email" value="{{old('email')}}" 
                    placeholder="">
                </div>
@endauth

                <div class="form-group">
                    <label for="category">区分</label>
                    <input type="text" name="category" 
                    class="form-control" id="category" value="{{old('category')}}">
                </div>

                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" 
                    class="form-control" id="title" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" 
                    class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                    <p>（備考）<br/>
                        <ul>
                            @auth  
                                {{-- 特になし --}}
                            @else {{-- ログインしていない場合のみ表示 --}}
                            <li>ログイン情報に関するお問い合わせの場合は、オーナー様を特定できる情報をお書き添えください。</li>
                            @endauth
                            
                            <li>不具合などのご連絡は、パソコンかスマートフォンか、iPhoneかAndroidか、ページのURLやエラーメッセージ、不具合の発生する再現手順を、出来るだけ詳細にお書き添えください。</li>
                        </ul>
                    </p>
                </div>

                <p>&nbsp;</p>
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection