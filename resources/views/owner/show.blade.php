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
                <span class="c-category-title__en">Owner</span>
                <span class="c-category-title__jp">&nbsp;オーナー［{{$owner->owner_name}}<sub>さん</sub>］</span>
              </p>
            </div>

            <div class="l-content__body">

                @if($owner->owner_icon)
                    <p>オーナーアイコン：<img width="50px" src="{{ asset('storage/owner_icon/'.$owner->owner_icon)}}" /></p>
                @else
                    <p>オーナーアイコン：未登録</p>
                @endif
                <p>オーナー名：{{$owner->owner_name}}<sub>さん</sub></p>
                <p>居住地：{{substr($owner->owner_pref,3)}}</p>

                <h3>aibo一覧</h3>
                <table width="80%" style="border:1px solid black; margin:auto;">
                    @if(count($owner->aibos) == 0)
                        <tr>
                          <td colspan="3">（まだaiboが登録されていません）</td>
                        </tr>
                    @else
                        @foreach ($owner->aibos->sortBy('aibo_birthday') as $aibo)
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
                                {{-- オーナー：<img width="50px" src="{{ asset('storage/owner_icon/'.$aibo->owner->owner_icon)}}" /> {{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}） --}}
                            </td>
                            <td width="10%" style="border:1px solid black;"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                        </tr>
                        @endforeach
                    @endif
                </table>

                <div class="p-article-detail__footer">
                    <ul class="c-pager-buttons">
                      <li>
                        {{-- <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--prev">
                            前の記事
                          </span>
                        </a> --}}
                      </li>
                      <li>
                        {{-- <a class="c-btn" href="#">
                          <span class="c-icon-text c-icon-text--next">
                            後の記事
                          </span>
                        </a> --}}
                      </li>
                      <li><a class="c-btn02" href="{{url()->previous()}}">戻る</a></li>
                    </ul>
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




