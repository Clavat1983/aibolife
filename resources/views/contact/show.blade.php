@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お問い合わせ（個別：{{$access_flag}}）</div>

                <div class="card-body">

                        {{-- 問い合わせ --}}
                        @foreach ($contacts as $contact)
                            @if($loop->first)
                            カテゴリー：{{$contact->category}}<br/>
                            タイトル：{{$contact->title}}<br/>
                            本文：{!! nl2br(e($contact->body)) !!}<br/>
                            日時：{{$contact->created_at}}<br/>
                            @endif
                        @endforeach

                        {{-- 問い合わせのレス --}}
                        @foreach ($contacts as $contact)
                            @if($loop->first)
                                {{-- 親は上で表示しているため何もしない --}}
                            @else
                                <hr/>
                                レス番号：{{$contact->child_no}}<br/>
                                レス番号：{{$contact->owner->owner_name}}<br/>
                                レス本文：{!! nl2br(e($contact->body)) !!}<br>
                                レス日時：{{$contact->created_at}}<br/>
                            @endif
                        @endforeach
                    </table>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">返信</div>

                @if(auth()->user()->role == 'admin')
                    <div class="card-body">
                        管理者画面からレスすること
                    </div>
                @else
                    <div class="card-body">
                        <form method="post" action="{{route('contact.store_res')}}">
                            @csrf
                                    オーナーID：{{auth()->user()->owner->id}}<br>
                                    名前：{{auth()->user()->owner->owner_name}}<br>
                                    メールアドレス：{{auth()->user()->email}}<br>
                                    <br>
                                    ID：{{$contact->id}}<br>
                                    親番号：{{$contact->parent_no}}<br>
                                    区分：{{$contact->category}}<br>
                                    タイトル：{{$contact->title}}<br>
                                    <input type="hidden" name="owner_id" id="owner_id" value="{{auth()->user()->owner->id}}">
                                    <input type="hidden" name="name" id="name" value="{{auth()->user()->owner->owner_name}}">
                                    <input type="hidden" name="email" id="email" value="{{auth()->user()->email}}">
                                    <input type="hidden" name="id" id="id" value="{{$contact->id}}">
                                    <input type="hidden" name="parent_no" id="parent_no" value="{{$contact->parent_no}}">
                                    <input type="hidden" name="category" id="category" value="{{$contact->category}}">
                                    <input type="hidden" name="title" id="title" value="{{$contact->title}}">
                
                
                                <div class="form-group">
                                    <label for="body">本文</label>
                                    <textarea name="body" 
                                    class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                                </div>
                
                                <p>&nbsp;</p>
                                <button type="submit" class="btn btn-success">送信する</button>
                            </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection