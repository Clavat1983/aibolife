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
              <p class="c-category-title c-category-title--guide">
                <span class="c-category-title__en">Copyrights</span>
                <span class="c-category-title__jp">権利表記</span>
              </p>
            </div>
            <div class="l-content__body">

              <div style="width:70%; margin:auto;">

                <div class="gray_sub_header"><b>ソニー株式会社および関連会社の権利</b></div>
    
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 「aibo」「アイボ」「aiboのロゴマーク」等は、ソニー株式会社および関連会社の商標です。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 「aibo」公式サイト（https://aibo.sony.jp）で提供されている画像等を一部使用していますが、これらの著作権はソニー株式会社および関連会社が有します。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 「aibo life」はソニー株式会社の公式サイト・関連サイトではないため、その旨の周知を徹底します。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;4. 「aibo life」は、ソニー株式会社および関連会社が保有する非公開データ（未公開情報・オーナー情報・aibo情報等）は一切取得していません。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;5. ソニー株式会社および関連会社から、権利侵害の指摘や申し入れ、情報の修正依頼などがあった場合、「aibo life」は速やかに改善に努めます。</p>
                  </div>

                <div class="gray_sub_header"><b>ユーザーの権利</b></div>
    
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーが「aibo life」に投稿ないしアップロードした文章・画像・映像等の著作権については、当該ユーザーおよび既存の権利者に留保されるものとしますが、「aibo life」内での利用に関して、ユーザーは著作者人格権を行使できないものとします。（利用規約 第7条 参照）
                    </p>
                  </div>

                <div class="gray_sub_header"><b>「aibo life」の権利</b></div>
    
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 上記の通り、ソニー株式会社および関連会社が権利を有するもの、ユーザーが権利を有するものを除き、サービス（文章・画像・プログラムなどを含む）に関する一切の権利は「aibo life」が有します。</p>
                  </div>  

                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;2. 旧「aibo life」のアイコン（画像参照）については、ことみさん（Twitter：cotomi3535）の著作物であり、「aibo life」以外での無断転載・無断使用は禁止します。<br/>
                    <img src="{{ asset('img/old_aibolife_icon.png')}}" width="100px"/>
                    </p>
                  </div>
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;3. 現「aibo life」のアイコンおよび各種イラスト（画像参照）については、たたみさん（Twitter：tatamixaibo）の著作物であり、「aibo life」以外での無断転載・無断使用は禁止します。<br/>
                    <img src="{{asset('img/logo_horizontal.svg')}}" width="100px">
                    </p>
                  </div>

                <br>
                <div class="gray_sub_header"><b>規定・改定</b></div>
                  <div>
                    <div class="kiyaku_1st kiyaku_dai_komoku" style="text-align:right; padding-right:1em;">規定日：2020年01月11日</div><!-- 先頭 -->
                    <div class="kiyaku_2nd kiyaku_dai_komoku" style="text-align:right; padding-right:1em;">改定日：2022年12月22日</div>
                  </div>  
              
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