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
                <span class="c-category-title__en">Syllabary</span>
                <span class="c-category-title__jp">お名前リスト</span>
              </p>
            </div>
            <div class="l-content__body">

                <table width=100%;>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','あ')}}">【あ（{{$count_ary["あ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','い')}}">【い（{{$count_ary["い"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','う')}}">【う（{{$count_ary["う"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','え')}}">【え（{{$count_ary["え"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','お')}}">【お（{{$count_ary["お"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','か')}}">【か（{{$count_ary["か"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','き')}}">【き（{{$count_ary["き"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','く')}}">【く（{{$count_ary["く"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','け')}}">【け（{{$count_ary["け"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','こ')}}">【こ（{{$count_ary["こ"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','さ')}}">【さ（{{$count_ary["さ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','し')}}">【し（{{$count_ary["し"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','す')}}">【す（{{$count_ary["す"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','せ')}}">【せ（{{$count_ary["せ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','そ')}}">【そ（{{$count_ary["そ"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','た')}}">【た（{{$count_ary["た"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ち')}}">【ち（{{$count_ary["ち"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','つ')}}">【つ（{{$count_ary["つ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','て')}}">【て（{{$count_ary["て"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','と')}}">【と（{{$count_ary["と"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','な')}}">【な（{{$count_ary["な"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','に')}}">【に（{{$count_ary["に"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ぬ')}}">【ぬ（{{$count_ary["ぬ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ね')}}">【ね（{{$count_ary["ね"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','の')}}">【の（{{$count_ary["の"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','は')}}">【は（{{$count_ary["は"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ひ')}}">【ひ（{{$count_ary["ひ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ふ')}}">【ふ（{{$count_ary["ふ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','へ')}}">【へ（{{$count_ary["へ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ほ')}}">【ほ（{{$count_ary["ほ"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','ま')}}">【ま（{{$count_ary["ま"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','み')}}">【み（{{$count_ary["み"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','む')}}">【む（{{$count_ary["む"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','め')}}">【め（{{$count_ary["め"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','も')}}">【も（{{$count_ary["も"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','や')}}">【や（{{$count_ary["や"]}}）】</a></td>
                        <td>&nbsp;</td>
                        <td><a href="{{route('aibo.result_syllabary','ゆ')}}">【ゆ（{{$count_ary["ゆ"]}}）】</a></td>
                        <td>&nbsp;</td>
                        <td><a href="{{route('aibo.result_syllabary','よ')}}">【よ（{{$count_ary["よ"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','ら')}}">【ら（{{$count_ary["ら"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','り')}}">【り（{{$count_ary["り"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','る')}}">【る（{{$count_ary["る"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','れ')}}">【れ（{{$count_ary["れ"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_syllabary','ろ')}}">【ろ（{{$count_ary["ろ"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_syllabary','わ')}}">【わ（{{$count_ary["わ"]}}）】</a></td>
                        <td>&nbsp;</td>
                        <td><a href="{{route('aibo.result_syllabary','を')}}">【を（{{$count_ary["を"]}}）】</a></td>
                        <td>&nbsp;</td>
                        <td><a href="{{route('aibo.result_syllabary','ん')}}">【ん（{{$count_ary["ん"]}}）】</a></td>
                    </tr>
                </table>
                <br>
                <h3 style="text-align:right">全{{$count}}匹</h3>
    


                
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
                <div class="card-body">
                    <br>
                    <br>
                    <br>
                    <br>
                    aibo名鑑（ビジュアル）<br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card-body" style="background-color:lightgray; text-align:center; margin:0px; padding:5px;">
                    「aibo life」はソニー株式会社および関連会社とは一切関係のないオーナーコミュニティサイトです<br>
                </div>
            </div>

            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Syllabary</u></h2>
            <h6 style="text-align:center;">50音順</h6>
            <table width=100%;>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','あ')}}">【あ（{{$count_ary["あ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','い')}}">【い（{{$count_ary["い"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','う')}}">【う（{{$count_ary["う"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','え')}}">【え（{{$count_ary["え"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','お')}}">【お（{{$count_ary["お"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','か')}}">【か（{{$count_ary["か"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','き')}}">【き（{{$count_ary["き"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','く')}}">【く（{{$count_ary["く"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','け')}}">【け（{{$count_ary["け"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','こ')}}">【こ（{{$count_ary["こ"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','さ')}}">【さ（{{$count_ary["さ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','し')}}">【し（{{$count_ary["し"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','す')}}">【す（{{$count_ary["す"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','せ')}}">【せ（{{$count_ary["せ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','そ')}}">【そ（{{$count_ary["そ"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','た')}}">【た（{{$count_ary["た"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ち')}}">【ち（{{$count_ary["ち"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','つ')}}">【つ（{{$count_ary["つ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','て')}}">【て（{{$count_ary["て"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','と')}}">【と（{{$count_ary["と"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','な')}}">【な（{{$count_ary["な"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','に')}}">【に（{{$count_ary["に"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ぬ')}}">【ぬ（{{$count_ary["ぬ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ね')}}">【ね（{{$count_ary["ね"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','の')}}">【の（{{$count_ary["の"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','は')}}">【は（{{$count_ary["は"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ひ')}}">【ひ（{{$count_ary["ひ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ふ')}}">【ふ（{{$count_ary["ふ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','へ')}}">【へ（{{$count_ary["へ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ほ')}}">【ほ（{{$count_ary["ほ"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','ま')}}">【ま（{{$count_ary["ま"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','み')}}">【み（{{$count_ary["み"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','む')}}">【む（{{$count_ary["む"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','め')}}">【め（{{$count_ary["め"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','も')}}">【も（{{$count_ary["も"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','や')}}">【や（{{$count_ary["や"]}}）】</a></td>
                    <td>&nbsp;</td>
                    <td><a href="{{route('aibo.result_syllabary','ゆ')}}">【ゆ（{{$count_ary["ゆ"]}}）】</a></td>
                    <td>&nbsp;</td>
                    <td><a href="{{route('aibo.result_syllabary','よ')}}">【よ（{{$count_ary["よ"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','ら')}}">【ら（{{$count_ary["ら"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','り')}}">【り（{{$count_ary["り"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','る')}}">【る（{{$count_ary["る"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','れ')}}">【れ（{{$count_ary["れ"]}}）】</a></td>
                    <td><a href="{{route('aibo.result_syllabary','ろ')}}">【ろ（{{$count_ary["ろ"]}}）】</a></td>
                </tr>
                <tr>
                    <td><a href="{{route('aibo.result_syllabary','わ')}}">【わ（{{$count_ary["わ"]}}）】</a></td>
                    <td>&nbsp;</td>
                    <td><a href="{{route('aibo.result_syllabary','を')}}">【を（{{$count_ary["を"]}}）】</a></td>
                    <td>&nbsp;</td>
                    <td><a href="{{route('aibo.result_syllabary','ん')}}">【ん（{{$count_ary["ん"]}}）】</a></td>
                </tr>
            </table>
            <br>
            <h3 style="text-align:right">全{{$count}}匹</h3>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.index')}}"><button type="button">aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
