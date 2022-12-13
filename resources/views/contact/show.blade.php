<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no" />
    <title>aibo life</title>
    <meta name="description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:title" content="aibo life" />
    <meta property="og:type" content="website" />
    <meta
      property="og:image"
      content="https://example.com../../assets/images/ogp.png"
    />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:description" content="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" />
    <meta property="og:site_name" content="aibo life" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Twitter" />
    <link rel="canonical" href="{{url()->full()}}" />
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />

    <!-- Google Ad -->
    @include('subview.google-ad')
    
  </head>

  <body id="pagetop">
    <div class="l-wrap">
      
      {{-- 【共通】header & nav --}}
      @include('subview.header-nav')

      {{-- main(各画面の個別部分) --}}
      <main class="l-main">
        <div class="l-main__content">
          <div class="l-content">
{{-- --------------------------------------------------------------------------- --}}
            <div class="l-content__header">
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Contact</span>
                <span class="c-category-ttl__jp">お問い合わせ［返信］</span>
              </p>
            </div>
            <div class="l-content__body">

                @if(auth()->user()->role == 'admin')
                <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
                @endif
            

            
                <div class="card-body">
                    <!-- 問い合わせ -->
                    @foreach ($contacts as $contact)
                        @if($loop->first)
                        名前：{{$contact->name}}<br>
                            @if($contact->owner_id == 0)
                                <span style="color:red;"><b>【非ログインでの問い合わせ】<br>
                                メールアドレス：{{$contact->email}}</b></span><br>
                            @endif
                        カテゴリー：{{$contact->category}}<br/>
                        タイトル：{{$contact->title}}<br/>
                        日時：{{$contact->created_at}}<br/>
                        本文：{!! nl2br(e($contact->body)) !!}<br/>
                        @endif
                    @endforeach
                </div>

                <div style="width:80%; margin:auto;">
                    <!-- 問い合わせのレス -->
                    @foreach ($contacts as $contact)
                        @if($loop->first)
                            <!-- 親は上で表示しているため何もしない -->
                        @else
                            <hr/>
                            返信：{{$contact->child_no}}<br/>
                            日時：{{$contact->created_at}}<br/>
                            名前：{{$contact->owner->owner_name}}<br/>
                            本文：{!! nl2br(e($contact->body)) !!}<br>
                        @endif
                    @endforeach
                </div>

                <div style="width:80%; margin:auto;">
                    <hr>
                    <br>
                    返信
    
                    <form method="post" action="{{route('contact.store_res')}}">
                        @csrf
                            {{-- オーナーID：{{auth()->user()->owner->id}}<br>
                            名前：{{auth()->user()->owner->owner_name}}<br>
                            メールアドレス：{{auth()->user()->email}}<br>
                            <br> --}}

                        @foreach ($contacts as $contact)
                            @if($loop->first)
                            
                            {{-- ID：{{$contact->id}}<br>
                            親番号：{{$contact->parent_no}}<br>


                            問い合わせ元のオーナーIDと名前：【{{$contact->owner_id}}】{{$contact->name}}<br>

                            問い合わせ元のメールアドレス：{{$contact->email}}<br>

                            区分：{{$contact->category}}<br>
                            タイトル：{{$contact->title}}<br> --}}

                            <input type="hidden" name="owner_id_from" id="owner_id_from" value="{{$contact->owner_id}}">
                            <input type="hidden" name="owner_id" id="owner_id" value="{{auth()->user()->owner->id}}">
                            <input type="hidden" name="name" id="name" value="{{auth()->user()->owner->owner_name}}">
                            <input type="hidden" name="email" id="email" value="{{auth()->user()->email}}">
                            <input type="hidden" name="id" id="id" value="{{$contact->id}}">
                            <input type="hidden" name="parent_no" id="parent_no" value="{{$contact->parent_no}}">
                            <input type="hidden" name="category" id="category" value="{{$contact->category}}">
                            <input type="hidden" name="title" id="title" value="{{$contact->title}}">
        
                                @if($contact->owner_id != 0)
                                <div class="form-group">
                                    <label for="body"></label>
                                    <textarea name="body" 
                                    class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                                </div>
                                @else
                                    <div class="form-group">
                                        <label for="body"></label>
                                        <textarea readonly name="body" 
                                        class="form-control" id="body" cols="30" rows="10">直接メールで返信しました。（返信が完了したら「送信」ボタンを押すこと）</textarea>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        
                        <p>&nbsp;</p>
                        <button type="submit" class="btn btn-success">送信</button>
                    </form>

                    <br>
                    @if(auth()->user()->role == 'admin')
                    <a href="{{route('contact.list_admin')}}"><button type="button">戻る（管理者）</button></a>
                    @else
                    <a href="{{route('contact.list')}}"><button type="button">戻る</button></a>
                    @endif

    
                </div>
           
            
                @if(auth()->user()->role == 'admin')
                    <br>
                    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
                @endif
            





            </div>

{{-- --------------------------------------------------------------------------- --}}
        </div>
    </div>

{{-- 【共通】バナー広告 --}}
@include('subview.banner')

</main>

{{-- 【共通】footer --}}
@include('subview.footer')

</div>
<script type="module" src="{{asset('js/common.js')}}"></script>
</body>
</html>




{{-- @extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')

<div class="container">

    @if(auth()->user()->role == 'admin')
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お問い合わせ</div>

                <div class="card-body">

                        <!-- 問い合わせ -->
                        @foreach ($contacts as $contact)
                            @if($loop->first)
                            カテゴリー：{{$contact->category}}<br/>
                            タイトル：{{$contact->title}}<br/>
                            本文：{!! nl2br(e($contact->body)) !!}<br/>
                            日時：{{$contact->created_at}}<br/>
                            @endif
                        @endforeach

                        <!-- 問い合わせのレス -->
                        @foreach ($contacts as $contact)
                            @if($loop->first)
                                <!-- 親は上で表示しているため何もしない -->
                            @else
                                <hr/>
                                レス番号：{{$contact->child_no}}<br/>
                                オーナー名(ID)：{{$contact->owner->owner_name}}（{{$contact->owner->id}}）<br/>
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

                    <div class="card-body">
                        <form method="post" action="{{route('contact.store_res')}}">
                            @csrf
                                    オーナーID：{{auth()->user()->owner->id}}<br>
                                    名前：{{auth()->user()->owner->owner_name}}<br>
                                    メールアドレス：{{auth()->user()->email}}<br>
                                    <br>

                                @foreach ($contacts as $contact)
                                    @if($loop->first)
                                    
                                    ID：{{$contact->id}}<br>
                                    親番号：{{$contact->parent_no}}<br>


                                    問い合わせ元のオーナーIDと名前：【{{$contact->owner_id}}】{{$contact->name}}<br>

                                    問い合わせ元のメールアドレス：{{$contact->email}}<br>

                                    区分：{{$contact->category}}<br>
                                    タイトル：{{$contact->title}}<br>

                                    <input type="hidden" name="owner_id_from" id="owner_id_from" value="{{$contact->owner_id}}">
                                    <input type="hidden" name="owner_id" id="owner_id" value="{{auth()->user()->owner->id}}">
                                    <input type="hidden" name="name" id="name" value="{{auth()->user()->owner->owner_name}}">
                                    <input type="hidden" name="email" id="email" value="{{auth()->user()->email}}">
                                    <input type="hidden" name="id" id="id" value="{{$contact->id}}">
                                    <input type="hidden" name="parent_no" id="parent_no" value="{{$contact->parent_no}}">
                                    <input type="hidden" name="category" id="category" value="{{$contact->category}}">
                                    <input type="hidden" name="title" id="title" value="{{$contact->title}}">
                
                                        @if($contact->owner_id != 0)
                                        <div class="form-group">
                                            <label for="body">本文</label>
                                            <textarea name="body" 
                                            class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                                        </div>
                                        @else
                                            <div class="form-group">
                                                <label for="body">本文</label>
                                                <textarea readonly name="body" 
                                                class="form-control" id="body" cols="30" rows="10">ログインしていない人からの問い合わせ。直接メールで返信してから「送信」ボタンを押すこと。</textarea>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                                
                                <p>&nbsp;</p>
                                <button type="submit" class="btn btn-success">送信する</button>
                            </form>

                            <br>
                            @if(auth()->user()->role == 'admin')
                            <a href="{{route('contact.list_admin')}}"><button type="button">一覧に戻る（管理者）</button></a>
                            @else
                            <a href="{{route('contact.list')}}"><button type="button">一覧に戻る</button></a>
                            @endif
                    </div>

            </div>
        </div>
    </div>


    @if(auth()->user()->role == 'admin')
        <br>
        <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
    @endif

</div>
@endsection --}}