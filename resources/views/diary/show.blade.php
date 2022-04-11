@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">

                    <h4>タイトル：{{$diary->diary_title}}</h4>
                    <p>名前：{{$diary->aibo->aibo_name}}</p>
                    <p>日付：{{date('Y年m月d日', strtotime($diary->diary_date))}}、この日の性格：{{$diary->diary_personality}}、この日の天気：{{$diary->diary_weather}}</p>
                    @if($diary->diary_photo1)
                       <p>画像：<img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="height:300px;"></p>
                    @else
                       <p>画像：ありません</p>
                    @endif
                    <p>本文：{!! nl2br(e($diary->diary_body)) !!}</p> {{--改行あり--}}
                    
                    <br/>
                    @if(auth()->user()->id === $diary->aibo->owner->user->id) {{--自分のaibo--}}
                        自分のaiboなので...<br>
                        <a href="{{route('diary.edit', $diary)}}"><button>日記の編集</button></a><br/>
                    @endif
                    <hr/>

                    <h4>コメント</h4>
                    {{-- バリデーションエラー表示 --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- コメント表示 --}}
                    @if($diary->diarycomments->count())
                        @foreach ($diary->diarycomments as $comment)
                        <div class="card mb-4">
                            <div class="card-header">
                                オーナー名：{{$comment->owner->owner_name}}（投稿日時：{{$comment->created_at}}）
                            </div>
                            <div class="card-body">
                                コメント：{!! nl2br(e($comment->diary_comment_body)) !!}
                            </div>
                            {{-- 削除（編集は不可） --}}
                            {{-- @if(auth()->user()->owner->id === $comment->owner_id)
                                <p style="text-align:right; margin-right:1em;">削除</p>
                            @endif --}}
                        </div>
                        @endforeach
                    @else
                    <div class="card mb-4">
                        <div class="card-body">まだコメントがありません。</div>
                    </div>
                    @endif
                    {{-- コメント投稿フォーム --}}
                    <form method="post" action="{{route('diarycomment.store')}}">
                        @csrf
                        <input type="hidden" name='diary_id' value="{{$diary->id}}">
                        <div class="form-group">
                            <textarea name="diary_comment_body" class="form-control" id="diary_comment_body" cols="30" rows="5" >{{old('diary_comment_body')}}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
                        </div>
                    </form>
                    <hr/>
                    <br/>
                    <a href="{{route('diary.list_day')}}?date={{$diary->diary_date}}"><button>{{date('Y年m月d日', strtotime($diary->diary_date))}}の日記一覧</button></a><br><br>
                    <a href="{{route('diary.list_aibo')}}?aibo={{$diary->aibo_id}}"><button>{{$diary->aibo->aibo_name}}の日記一覧</button></a><br><br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
