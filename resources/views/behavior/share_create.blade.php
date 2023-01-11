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
                <span class="c-category-title__en">Behavior</span>
                <span class="c-category-title__jp">ふるまい共有［新規登録］</span>
              </p>
            </div>

            <div class="l-content__body">

                <div style="width:80%; margin:auto;">

                    <form method="post" action="{{route('behaviorshare.store')}}">
                        @csrf

                        @if ($errors->any() || session()->has('code_error_flg') || session()->has('code_exists_flg'))
                        <hr/>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(session()->has('code_error_flg'))
                                <li>{{ session('code_error_flg') }}：「my aibo」で取得したコードをそのまま貼り付けてください。</li>
                                @endif
                                @if(session()->has('code_exists_flg'))
                                <li>{{ session('code_exists_flg') }}：このふるまいは既に登録されています。</li>
                                @endif
                            </ul>
                        </div>
                        <hr/>
                        @endif


                        【aiboの名前】<br>
                        @if($aibos->count() > 1)
                            このふるまいを共有しているaiboを選択<br>
                            <select id="aibo_id" name="aibo_id">
                            <option disabled="disabled" selected>選択してください</option>
                            @foreach ($aibos as $aibo)
                                <option value='{{$aibo->id}}' @if($aibo->id == old('aibo_id')) selected @endif>{{$aibo->aibo_name}}</option>
                            @endforeach
                            </select>
                        @else
                            ID：{{$aibos->first()->id}}、名前：{{$aibos->first()->aibo_name}}<br>
                            <input type="hidden" name="aibo_id" value="{{$aibos->first()->id}}"/>
                        @endif
                        <br>
                        <br>
                        <label for="my_aibo_code">【My aibo 共有コード貼り付け】</label><br>
                        （My aiboからコピーした共有コードをそのまま編集せずに貼り付けてください）<br>
                        <br>
                        <textarea name="my_aibo_code" id="my_aibo_code" cols="50" rows="12">{{old('my_aibo_code')}}</textarea>
                        <br>



                        <br>
                        <button type="submit" class="btn btn-success">登録</button>
                    </form>

                </div>

                <hr>
                <br>
                <div class="card-body">
                    <a href="{{route('behaviorshare.index')}}"><button type="button">ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（新規登録＝共有コード取り込み）</div>
                <div class="card-body">

                    <form method="post" action="{{route('behaviorshare.store')}}">
                        @csrf

                        【aiboの名前】<br>
                        @if($aibos->count() > 1)
                            このふるまいを共有しているaiboを選択<br>
                            <select id="aibo_id" name="aibo_id">
                            <option disabled="disabled" selected>選択してください</option>
                            @foreach ($aibos as $aibo)
                                <option value='{{$aibo->id}}' @if($aibo->id == old('aibo_id')) selected @endif>{{$aibo->aibo_name}}</option>
                            @endforeach
                            </select>
                        @else
                            ID：{{$aibos->first()->id}}、名前：{{$aibos->first()->aibo_name}}<br>
                            <input type="hidden" name="aibo_id" value="{{$aibos->first()->id}}"/>
                        @endif
                        <br>
                        <br>
                        <label for="my_aibo_code">【My aibo 共有コード貼り付け】</label><br>
                        （My aiboからコピーした共有コードをそのまま編集せずに貼り付けてください）<br>
                        <br>
                        <textarea name="my_aibo_code" id="my_aibo_code" cols="50" rows="12">{{old('my_aibo_code')}}</textarea>
                        <br>

                        @if ($errors->any() || session()->has('code_error_flg') || session()->has('code_exists_flg'))
                        <hr/>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(session()->has('code_error_flg'))
                                <li>{{ session('code_error_flg') }}：「my aibo」で取得したコードをそのまま貼り付けてください。</li>
                                @endif
                                @if(session()->has('code_exists_flg'))
                                <li>{{ session('code_exists_flg') }}：このふるまいは既に登録されています。</li>
                                @endif
                            </ul>
                        </div>
                        <hr/>
                        @endif

                        <br>
                        <button type="submit" class="btn btn-success">登録</button>
                    </form>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behaviorshare.index')}}"><button type="button">ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
