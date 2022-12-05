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
                <span class="c-category-ttl__en">ABOUT</span>
                <span class="c-category-ttl__jp">aibo lifeとは?</span>
              </p>
            </div>
            <div class="l-content__body">
              あああああ
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>aibo_ID:{{$aibo->id}}「{{$aibo->aibo_name}}」の日記</h2>

                    <br>
                    <h5>直近7日間の日記</h5>
                    @if($aibo->owner->user)
                    ログインユーザ：{{auth()->user()->id}}⇔このaiboのオーナーのユーザID{{$aibo->owner->user->id}}<br>
                    @else
                    ログインユーザ：{{auth()->user()->id}}⇔このaiboのオーナーのユーザ（未登録）
                    @endif
                    <br>
                    @foreach($this_week as $date => $diary)
                        @if($diary == NULL) 日記がない --}}
                            {{--自分のaibo--}}
                            {{-- @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id)) --}}
                                {{--誕生日が日記の日付より前--}}
                                {{-- @if(strtotime($aibo->aibo_birthday) <= strtotime($date))
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、<a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$date}}">日記を書く</a>（aiboID:{{$aibo->id}}、日付:{{date('Y年m月d日', strtotime($date))}}）<br>
                                @else
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br>
                                @endif --}}
                            {{--他人のaibo--}}
                            {{-- @else --}}
                                {{--誕生日が日記の日付より前--}}
                                {{-- @if(strtotime($aibo->aibo_birthday) <= strtotime($date))
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、書かれていません<br>
                                @else
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br>
                                @endif
                            @endif --}}
                        {{--日記がある--}}
                        {{-- @else
                            配列の日付：{{date('Y年m月d日', strtotime($date))}}、aibo：{{$diary->aibo->aibo_name}}、日記：{{$diary->diary_date}}、タイトル：{{$diary->diary_title}}、<a href="{{route('diary.show',$diary)}}">【見る】</a><br>
                        @endif
                    @endforeach


                    <br>
                    <br>
                    <h5>過去の日記</h5> --}}
                    
                    {{-- 
                    @foreach ($archive_count as $yyyy => $yyyymm)
                        {{$yyyy}}年<br>
                        <ul>
                        @foreach ($yyyymm as $month => $count)
                            <li>{{$month}}月（{{$count}}件）</li>
                        @endforeach
                        </ul>
                    @endforeach
                    --}}

                    {{-- <br>
                    <br>


                    <a href="{{route('diary.index')}}">日記を見るに戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
