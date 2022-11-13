<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7254144694077351"
     crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth{{--ログイン済--}}
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @else{{--ログインしていない--}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @endauth

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        @if((auth()->user()->owner != NULL) && (count(auth()->user()->owner->aibos)>0))
                            <ul class="navbar-nav me-auto">
                                <li style="color:red"><b>&nbsp;&nbsp;&nbsp; <a href="{{ route('notification.index') }}">@yield('notification')件</a></b></li>
                            </ul>
                        @endif
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{-- {{ Auth::user()->name }} --}}
@if((auth()->user()->owner != NULL) && (Auth::user()->owner->owner_icon))
                                    <img src="{{ asset('storage/owner_icon/'.Auth::user()->owner->owner_icon)}}" style="height:20px; width:20px;">設定
@else
                                    <img src="{{ asset('storage/owner_icon/default.jpg')}}" style="height:20px; width:20px;">設定
@endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    @if(auth()->user()->role == "admin") {{-- 管理者(Admin)の場合のみメニューに追加 --}}
                                    <a class="dropdown-item" href="{{ route('home.admin') }}">
                                        管理画面（Admin）
                                    </a>
                                    @endif
                                    
                                    @if(auth()->user()->owner == NULL)
                                    <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}">
                                        マイページ（ログイン情報編集）
                                    </a>
                                    @else
                                    {{-- (auth()->user()->owner != NULL) --}}
                                        {{-- <a class="dropdown-item" href="{{ route('owner.edit', auth()->user()->owner->id) }}"> --}}
                                        <a class="dropdown-item" href="{{ route('mypage') }}">
                                            マイページ（トップ）
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth {{--ログインしていたら--}}
            {{-- トップページが表示される場合(オーナー登録済 かつ aibo登録済)、グローバルナビを出力 --}}
            @if(auth()->user()->owner != NULL && count(auth()->user()->owner->aibos) > 0)
                <nav class="navbar navbar-expand-md" style="background-color:pink;">【ログイン中】　｜はじめに｜最新情報｜日記｜お友達｜ふるまい｜コミュニティ｜お役立ち情報｜<a href="{{route('contact.index')}}">お問い合わせ</a></nav>
            @endif
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
