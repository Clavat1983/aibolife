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
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Policy</span>
                <span class="c-category-ttl__jp">プライバシーポリシー</span>
              </p>
            </div>
            <div class="l-content__body">


              <div style="width:70%; margin:auto;">
          
                      <div class="gray_sub_header"><b>第1条（個人情報の定義）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 「個人情報」とは、個人情報保護法にいう「個人情報」を指すものとし、生存する個人に関する情報であって、当該情報に含まれる氏名、生年月日、住所、電話番号、連絡先その他の記述等により特定の個人を識別できる情報及び容貌、指紋、声紋にかかるデータ、及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第2条（個人情報の収集方法）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、本サイト（本サイトに付随したサービスおよびイベントも含みます。）において、ユーザーの氏名、生年月日、住所、電話番号、メールアドレスなどの個人情報の提供（登録・記入等）をお願いすることがあります。</p><!-- 先頭 -->
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- ユーザーはこれらの個人情報の提供を拒否することができます。</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 提供を拒否された場合、当方が提供するサービスの一部または全部を利用できないことがあります。</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方の提携先（イベント運営者および広告主等）は、当方からの求めに応じて、ユーザーの利用履歴を含む個人情報（決済情報は除きます。）を当方に提供することがあります。</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- ユーザーは当方の提携先に対し、事前事後を問わず、当方への個人情報の提供を拒否ことができます。</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 提供内容や提供可否は提携先のプライバシーポリシー、またはユーザーから提携先への利用拒否連絡が優先されるため、提供先は当方に対し、ユーザーの同意がない個人情報を提供することはありません。</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 提携先への利用停止連絡をされた場合、当方が提供するサービスの一部または全部を利用できないことがあります。</p>
                        </div>  
          
                      <div class="gray_sub_header"><b>第3条（個人情報を収集・利用する目的）</b></div>
            
                        <div>
                          <p class="kiyaku_1st">当方が個人情報を収集・利用する目的は、以下のとおりです。</p><!-- 先頭 -->
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;1. 当方および提携先でのサービス提供・運営のため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. ユーザーが利用中のサービスの更新情報等及び当方が提供する他のサービスの案内を送付するため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;4. メンテナンス、重要なお知らせなど必要に応じたご連絡のため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;5. 利用規約に違反したユーザーや、不正・不当な目的でサービスを利用しようとするユーザーを特定し、ご利用をお断りするため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;6. ユーザーにご自身の登録情報の閲覧や変更、削除、ご利用状況の閲覧を行っていただくため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;7. 有料サービスにおいて、ユーザーに利用料金を請求するため</p>
                            <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;8. 上記の利用目的に付随する目的</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第4条（利用目的の変更）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、利用目的が変更前と関連性を有すると合理的に認められる場合に限り、個人情報の利用目的を変更することができるものとします。</p><!-- 先頭 -->
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 利用目的の変更を行った場合には、変更後の目的について、本ポリシーを更新し、公表するものとします。</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第5条（個人情報の第三者提供）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、次に掲げる場合を除いて、あらかじめユーザーの同意を得ることなく、第三者に個人情報を提供することはありません。ただし、個人情報保護法その他の法令で認められる場合を除きます。</p><!-- 先頭 -->
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 人の生命、身体または財産の保護のために必要がある場合であって、本人（ユーザー登録の有無を問いません。以下同じ。）の同意を得ることが困難であるとき</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 前項の定めにかかわらず、次に掲げる場合には、当該情報の提供先は第三者に該当しないものとします。</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 当方が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を提携先（イベント運営者および広告主等）に委託する場合</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 個人情報を特定の者との間で共同して利用する場合であって、その旨並びに共同して利用される個人情報の項目、共同して利用する者の範囲、利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について、あらかじめ本人に通知し、または本人が容易に知り得る状態に置いた場合</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第6条（個人情報の開示）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、本人から個人情報の開示を求められたときは、本人に対し、遅滞なくこれを開示します。ただし、開示することにより次のいずれかに該当する場合は、その全部または一部を開示しないこともあり、開示しない決定をした場合には、その旨を遅滞なく通知します。なお、個人情報の開示に際して、サイトで開示していない内容については、1回の請求につき1,000円の手数料を申し受ける場合があります。</p><!-- 先頭 -->
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 本人または第三者の生命、身体、財産その他の権利利益を害するおそれがある場合</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- 当方のサービス提供に著しい支障を及ぼすおそれがある場合</p>
                            <p class="kiyaku_2nd kiyaku_chu_komoku">- その他法令に違反することとなる場合</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 前項の定めにかかわらず、履歴情報および特性情報などの個人情報以外の情報については、原則として開示いたしません。</p>
                        </div> 
          
                      <div class="gray_sub_header"><b>第7条（個人情報の訂正および削除）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、当方の保有する自己の個人情報が誤った情報である場合には、当方が定める手続きにより、当方に対して個人情報の訂正、追加または削除を請求することができます。</p><!-- 先頭 -->
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方は、ユーザーから前項の請求を受けてその請求に応じる必要があると判断した場合には、遅滞なく、当該個人情報の訂正等を行うものとします。</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 当方は、前項の規定に基づき訂正等を行った場合、または訂正等を行わない旨の決定をしたときは遅滞なく、これをユーザーに通知します。</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第8条（個人情報の利用停止等）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、本人から、個人情報が、利用目的の範囲を超えて取り扱われているという理由、または不正の手段により取得されたものであるという理由により、その利用の停止または消去等を求められた場合には、遅滞なく必要な調査を行います。</p><!-- 先頭 -->
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 前項の調査結果に基づき、その請求に応じる必要があると判断した場合には、遅滞なく、当該個人情報の利用停止等を行います。</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 当方は、前項の規定に基づき利用停止等を行った場合、または利用停止等を行わない旨の決定をしたときは、遅滞なく、これを本人に通知します。</p>
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;4. 前2項にかかわらず、利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって、本人の権利利益を保護するために必要なこれに代わるべき措置をとれる場合は、この代替策を講じるものとします。</p>
                        </div>
          
                      <div class="gray_sub_header"><b>第9条（プライバシーポリシーの変更）</b></div>
            
                        <div>
                          <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 本ポリシーの内容は、法令その他本ポリシーに別段の定めのある事項を除いて、ユーザーに通知することなく、変更することができるものとします。</p><!-- 先頭 -->
                          <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方が別途定める場合を除いて、変更後のプライバシーポリシーは、本サイトに掲載したときから効力を生じるものとします。</p>
                        </div>
          
                      <div class="gray_sub_header"><b>規定・改定</b></div>
            
                        <div>
                          <div class="kiyaku_1st kiyaku_dai_komoku" style="text-align:right; padding-right:1em;">規定日：2020年01月11日</div><!-- 先頭 -->
                          <div class="kiyaku_2nd kiyaku_dai_komoku" style="text-align:right; padding-right:1em;">改定日：2020年01月11日</div>
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