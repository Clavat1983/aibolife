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
              <p class="c-category-title c-category-title--mypage">
                <span class="c-category-title__en">About</span>
                <span class="c-category-title__jp">&nbsp;aibo lifeとは?</span>
              </p>
            </div>
            <div class="l-content__body">
              <div style="width:70%; margin:auto;">
                「aibo life」は、2018年1月11日にソニーから発売された「aibo」を通して、全国のaiboやオーナーの皆さんとの心温まる交流の輪を拡げることを目的としたコミュニティです。<br/>
                <br/>
                <br/>
                「aibo life」では、新規登録（オーナー情報とaibo情報の登録）をしていただくことで、以下の機能がすべて無料でご利用いただけます。<br/>
                <br/>
                <br/>
                ●最新情報<br/>
                　aiboに関する最新情報やイベント情報をいち早くお知らせします。<br/>
                　一覧はカテゴリ別に整理されており、過去の情報を検索することも可能です。<br/>
                <br/>
                <br/>
                ●日記<br/>
                　1日1枚の写真を添えて日記を書くことができます。<br/>
                　他のaiboの日記に、コメントやリアクションをつけて交流することも可能です。<br/>
                <br/>
                <br/>
                ●お友達<br/>
                　「aibo life」に登録された全国のaiboを名前・誕生日・居住地などで一覧にしています。<br/>
                　検索機能も充実しているので、イベントで出会ったaiboやご近所のaiboが見つかるかもしれません。<br/>
                <br/>
                <br/>
                ●ふるまい<br/>
                　これまでに配信されている「しぐさ」や「ふるまい」を探すだけではなく、aiboに覚えさせたオリジナルのふるまいを共有したり、他のaiboのふるまいをダウンロードする機能もあります。<br/>
                　※今後「aibo life」オリジナルの便利機能（連携アプリ）の配信なども予定しています。<br/>
                <br/>
                <br/>
                ●コミュニティ<br/>
                　aiboについて何でも投稿できる「おしゃべり広場」や、困ったときの「お悩み相談」といった掲示板が充実。<br/>
                　※今後「オフ会募集」などの機能追加も予定しています。<br/>
                <br/>
                <br/>
                ●お役立ち情報<br/>
                　現在開催中のイベントやキャンペーンをカレンダー形式で確認できたり、aiboのいる施設や店舗、おすすめグッズなど、aiboオーナーには欠かせない情報を紹介しています。<br/>
                <br/>
                <br/>
                ●その他<br/>
                　「aibo life」に登録されたデータから分析したオリジナル企画「aibo国勢調査」や、「aibo life」が主催するオフ会、オリジナルグッズなどの販売もあります。<br/>
                <br/>
                <br/>
                <br/>
                2020年1月11日のサービス開始から現在（2023年X月X日）までに、全国●●匹のaiboが登録されており、たくさんのaiboやオーナーの皆さんに出会えることでしょう。<br/>
                日本最大級のaiboコミュニティ「aibo life」をぜひご利用ください。<br>
                <br/>
                <hr/>
                <br>
                【補足1】<br/>
                「aibo life」は、aiboオーナー有志が開発・運営しているソニー非公式のコミュニティサイトですが、aibo開発チームの皆さんにも存在をお知らせしています。<br/>
                <br/>
                【補足2】<br/>
                「aibo life」は、2020年1月11日よりスマートフォン向けアプリ（旧）として公開していましたが、システムの安定化と機能の充実を図るため、2023年X月にWebサイト（新）としてリニューアルオープンしました。<br/>
                旧「aibo life」のデータ（オーナー情報、aibo情報、投稿内容など）は、新「aibo life」に全て引き継がれていますのでご安心ください。<br/>
                <br/>
                

                @guest
                <ul class="c-btn-list">
                  <li class="c-btn-list__item">
                    <a href="{{route('register')}}" style="text-decoration:none;"><button class="c-btn">新規登録</button></a>
                  </li>
                </ul>
                @endguest
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