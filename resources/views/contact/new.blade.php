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
              <p class="c-category-title c-category-title--topics">
                <span class="c-category-title__en">Contact</span>
                <span class="c-category-title__jp">お問い合わせ［新規］</span>
              </p>
            </div>
            <div class="l-content__body">

                
                <div style="width:80%; margin:auto;">

                    @if ($errors->any())
                        <hr>
                        【エラー】<br>
                        
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <hr>
                    @else
                        @auth
                            <p style="color:red;">返信や追加連絡について、該当のお問い合わせ履歴からお願いします。</p>
                        @endauth
                    @endif

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
                                            <!-- 特になし -->
                                        @else <!-- ログインしていない場合のみ表示 -->
                                        <li>ログイン情報に関するお問い合わせの場合は、オーナー様を特定できる情報をお書き添えください。</li>
                                        @endauth
                                        
                                        <li>不具合などのご連絡は、パソコンかスマートフォンか、iPhoneかAndroidか、ページのURLやエラーメッセージ、不具合の発生する再現手順を、出来るだけ詳細にお書き添えください。</li>
                                    </ul>
                                </p>
                            </div>
            
                            <p>&nbsp;</p>
                            <button type="submit" class="btn btn-success">送信</button>
                        </form>
                    
                    <br>
                    <a href="{{route('contact.list')}}"><button type="button">戻る</button></a>

                </div>

            
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

<!-- エラーメッセージ表示 -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- 送信後のメッセージ表示 -->
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
                                <!-- 特になし -->
                            @else <!-- ログインしていない場合のみ表示 -->
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
@endsection --}}