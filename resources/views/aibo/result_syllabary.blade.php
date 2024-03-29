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
                <span class="c-category-title__jp">&nbsp;お友達［お名前リスト］</span>
              </p>
            </div>
            <div class="l-content__body">


                <h2>「{{$syllabary}}」で始まるaibo（{{$aibos->total()}}匹）</h2>

                <table width="80%" style="border:1px solid black; margin:auto;">
                    @if(count($aibos) == 0)
                        <tr>
                          <td colspan="3">（該当するaiboが見つかりません）</td>
                        </tr>
                    @else
                        @foreach ($aibos as $aibo)
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

                @if(count($aibos) > 0)
                <br>
                <hr>
                ▼ページネーション▼
                <table width="60%" style="margin:auto;">
                    <tr>
                        <td width="15%" style="text-align:center;"><a href="{{$aibos->previousPageUrl()}}">Prev</a></td>
                        <td width="70%" style="text-align:center;">
                            <div class="pagenation-select">
                            <select>
                                @for ($i = 1; $i <= $aibos->lastPage(); $i++)
                                <option value="{{$aibos->url($i)}}" @if($i == $aibos->currentPage()) selected @endif>{{$i}}ページ目/全{{$aibos->lastPage()}}ページ</option>
                                @endfor
                            </select>
                            </div>
                        </td>
                        <td width="15%" style="text-align:center;"><a href="{{$aibos->nextPageUrl()}}">Next</a></td>
                    </tr>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                <script>
                $('.pagenation-select select').change(function(){
                    location.href = $(this).val();
                });
                </script>
                @endif

                <hr>
                <div>
                    <a href="{{route('aibo.list_syllabary')}}"><button type="button">お名前リストに戻る</button></a><br>
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
            <div class="card">
                <div class="card-body">
                    <h2>「{{$syllabary}}」で始まる</h2>
                    @foreach($aibos as $aibo)
                        名前：{{$aibo->aibo_name}}<br>
                    @endforeach
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.list_syllabary')}}"><button type="button">aibo名鑑(50音リスト)に戻る</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
