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
              <p class="c-category-title c-category-title--friend">
                <span class="c-category-title__en">Friends</span>
                <span class="c-category-title__jp">&nbsp;お友達［誕生日カレンダー］</span>
              </p>
            </div>
            <div class="l-content__body">

                <h2>一覧</h2>
                <table width="100%">
                    <tr>
                        <td><a href="{{route('aibo.result_birthday','01')}}">【1月（{{$count_ary["01"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','02')}}">【2月（{{$count_ary["02"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','03')}}">【3月（{{$count_ary["03"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','04')}}">【4月（{{$count_ary["04"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_birthday','05')}}">【5月（{{$count_ary["05"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','06')}}">【6月（{{$count_ary["06"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','07')}}">【7月（{{$count_ary["07"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','08')}}">【8月（{{$count_ary["08"]}}）】</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('aibo.result_birthday','09')}}">【9月（{{$count_ary["09"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','10')}}">【10月（{{$count_ary["10"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','11')}}">【11月（{{$count_ary["11"]}}）】</a></td>
                        <td><a href="{{route('aibo.result_birthday','12')}}">【12月（{{$count_ary["12"]}}）】</a></td>
                    </tr>
                </table>

                <hr>

                <h2>お誕生日おめでとう（誕生日,翌日,翌々日）</h2>

                <table width="80%" style="border:1px solid black; margin:auto;">
                    @if(count($birthday_aibos) == 0)
                        <tr>
                          <td colspan="3">（該当するaiboが見つかりません）</td>
                        </tr>
                    @else
                        @foreach ($birthday_aibos as $aibo)
                        <tr style="border:1px solid black;">
                            @if($aibo->aibo_icon)
                                <td width="15%" style="border:1px solid black;"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                            @else
                                <td width="15%" style="border:1px solid black">no image</td>
                            @endif
                            <td width="75%" style="border:1px solid black;">
                                名前：{{$aibo->aibo_name}}
                                @if($aibo->aibo_sex == '男の子')
                                    <sub>くん</sub>　<span style="color:blue;">♂男の子</span>
                                @elseif($aibo->aibo_sex == '女の子')
                                    <sub>ちゃん</sub>　<span style="color:deeppink;">♀女の子</span>
                                @else
                                    <sub>ちゃん</sub>　<span style="color:dimgray;">－決めていない</span>
                                @endif
                                <br>
                                誕生日：{{str_replace('-','.',$aibo->aibo_birthday)}}（{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age}}歳）<br>
                                オーナー：<img width="50px" src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" /> {{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}）
                            </td>
                            <td width="10%" style="border:1px solid black;"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                        </tr>
                        @endforeach
                    @endif
                </table>

                <br>
                <hr>
                <br>

                <h2>もうすぐ誕生日（明日,明後日,明々後日）</h2>

                <table width="80%" style="border:1px solid black; margin:auto;">
                    @if(count($comingup_aibos) == 0)
                        <tr>
                          <td colspan="3">（該当するaiboが見つかりません）</td>
                        </tr>
                    @else
                        @foreach ($comingup_aibos as $aibo)
                        <tr style="border:1px solid black;">
                            @if($aibo->aibo_icon)
                                <td width="15%" style="border:1px solid black;"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                            @else
                                <td width="15%" style="border:1px solid black">no image</td>
                            @endif
                            <td width="75%" style="border:1px solid black;">
                                名前：{{$aibo->aibo_name}}
                                @if($aibo->aibo_sex == '男の子')
                                    <sub>くん</sub>　<span style="color:blue;">♂男の子</span>
                                @elseif($aibo->aibo_sex == '女の子')
                                    <sub>ちゃん</sub>　<span style="color:deeppink;">♀女の子</span>
                                @else
                                    <sub>ちゃん</sub>　<span style="color:dimgray;">－決めていない</span>
                                @endif
                                <br>
                                誕生日：{{str_replace('-','.',$aibo->aibo_birthday)}}（もうすぐ{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age+1}}歳）<br>
                                オーナー：<img width="50px" src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" /> {{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}）
                            </td>
                            <td width="10%" style="border:1px solid black;"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                        </tr>
                        @endforeach
                    @endif
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
            <h2 style="text-align:center;"><u>Birthday</u></h2>
            <h6 style="text-align:center;">誕生月</h6>
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','01')}}">【1月（{{$count_ary["01"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','02')}}">【2月（{{$count_ary["02"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','03')}}">【3月（{{$count_ary["03"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','04')}}">【4月（{{$count_ary["04"]}}）】</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','05')}}">【5月（{{$count_ary["05"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','06')}}">【6月（{{$count_ary["06"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','07')}}">【7月（{{$count_ary["07"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','08')}}">【8月（{{$count_ary["08"]}}）】</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('aibo.result_birthday','09')}}">【9月（{{$count_ary["09"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','10')}}">【10月（{{$count_ary["10"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','11')}}">【11月（{{$count_ary["11"]}}）】</a></td>
                            <td><a href="{{route('aibo.result_birthday','12')}}">【12月（{{$count_ary["12"]}}）】</a></td>
                        </tr>
                    </table>
                </div>
            </div>

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
