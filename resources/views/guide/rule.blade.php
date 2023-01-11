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
                <span class="c-category-title__en">Rule</span>
                <span class="c-category-title__jp">利用規約</span>
              </p>
            </div>
            <div class="l-content__body">

              <div style="width:70%; margin:auto;">

                <div class="gray_sub_header"><b>第1条（適用）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 本規約は、ユーザー（利用者）と当方（aibo life）との間のサービスの利用に関わる一切の関係に適用されるものとします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方はサービスに関し、本規約のほか、ご利用にあたってのルール等を個別規定することがあります。これら個別規定はその名称のいかんに関わらず、本規約の一部を構成するものとします。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 本規約の規定が前条の個別規定の規定と矛盾する場合には、個別規定において特段の定めがない限り、個別規定の規定が優先されるものとします。</p>
                  </div>
    
                <div class="gray_sub_header"><b>第2条（利用登録）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. サービスにおいては、登録希望者が本規約に同意の上、当方の定める方法によって利用登録を申請し、当方がこの承認を登録希望者に通知することによって、利用登録が完了するものとします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方は、利用登録の申請者に以下の事由があると判断した場合、利用登録の申請を承認しない（承認後であっても予告なく承認を取り消す）ことがあり、その理由については一切の開示義務を負わないものとします。</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 利用登録の申請に際して虚偽の事項を届け出た場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 同一人物が複数の利用登録の申請をした場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 本規約に違反したことがある者からの申請である場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 保護者の同意がない未成年者など、本規約の理解・同意が困難と判断される者からの申請である場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 日本の法律が及ばない国や地域からの利用であると判断した場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- その他、当方が利用登録を相当でないと判断した場合</p>
                  </div>  
    
                <div class="gray_sub_header"><b>第3条（ユーザーIDおよびパスワードの管理）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、自己の責任において、サービスのユーザーIDおよびパスワード（これらを特定するための登録情報を含みます。）、サービスを利用する端末等を適切に管理するものとします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. ユーザーは、いかなる場合にも、ユーザーIDおよびパスワードを第三者に譲渡または貸与し、もしくは第三者と共用することはできません。当方は、ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には、そのユーザーIDを登録しているユーザー自身による利用とみなします。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. ユーザーID及びパスワードが第三者によって使用されたことによって生じた損害は、当方に故意又は重大な過失がある場合を除き、当方は一切の責任を負わないものとします。</p>
                  </div>
    
                <div class="gray_sub_header"><b>第4条（利用料金および支払方法）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、別途定め表示する有料サービスを除き、サービスを無料で利用することができます。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. ユーザーは、当方が別途定め表示する有料サービス（広告出稿を含みます。）の利用を希望する場合、その対価として、利用料金を当方が指定する方法により支払うものとします。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. ユーザーが利用料金の支払を遅滞した場合には、ユーザーは年14.6％の割合（関連する法律等に従うものとします。）による遅延損害金を合わせて支払うものとします。 </p>
                  </div>
    
                <div class="gray_sub_header"><b>第5条（禁止事項）</b></div>
      
                  <div>
                    <p class="kiyaku_1st">ユーザーは、サービスの利用にあたり、以下の行為をしてはなりません。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;1. 法令または公序良俗に違反する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 犯罪行為に関連する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 当方、サービスを利用するユーザー、または第三者のサーバーまたはネットワークの機能を破壊したり、妨害したりする行為、およびプログラムや端末への記録情報を含むソースコード等の参照・改変・配布</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;4. 当方のサービスの運営を妨害するおそれのある行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;5. 他のユーザーに関する個人情報等を収集または蓄積する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;6. 不正アクセス、またはこれを試みる行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;7. 他のユーザーに成りすます行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;8. 当方のサービスに関連して、反社会的勢力に対して直接または間接に利益を供与する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;9. 当方、サービスの他のユーザーまたは第三者の知的財産権、肖像権、プライバシー、名誉その他の権利または利益を侵害する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">10. 以下の表現を含み、または含むと当方が判断する内容をサービス上に投稿、または送信する行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 過度に暴力的な表現</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 露骨な性的表現</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 人種、国籍、信条、性別、社会的身分、門地等による差別につながる表現</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 自殺、自傷行為、薬物乱用を誘引または助長する表現</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- その他、他人に不快感を与える表現</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">11. 以下を目的とし、または目的とすると当方が判断する行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 営業、宣伝、広告、勧誘、その他営利を目的とする行為（当方の認めたものを除きます。）</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 性行為やわいせつな行為を目的とする行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 面識のない異性との出会いや交際を目的とする行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 他のユーザーに対する嫌がらせや誹謗中傷を目的とする行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 当方、サービスの他のユーザー、または第三者に不利益、損害または不快感を与えることを目的とする行為</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- その他サービスが予定している利用目的と異なる目的でサービスを利用する行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">12. 宗教活動または宗教団体への勧誘行為</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">13. その他、当方が不適切と判断する行為</p>
                  </div>
    
                <div class="gray_sub_header"><b>第6条（サービスの提供の停止等）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、以下のいずれかの事由があると判断した場合、ユーザーに事前に通知することなくサービスの全部または一部の提供を停止または中断することができるものとします。</p><!-- 先頭 -->
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- サービスにかかるコンピュータシステムの保守点検または更新を行う場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 地震、落雷、火災、停電または天災などの不可抗力により、サービスの提供が困難となった場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- コンピュータまたは通信回線等が事故により停止した場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- その他、当方がサービスの提供が困難と判断した場合</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方は、サービスの提供の停止または中断により、ユーザーまたは第三者が被ったいかなる不利益または損害についても、一切の責任を負わないものとします。ただし、当月分以降の有料サービスの利用料金（広告出稿等）を既に受領している場合は、当月分以降に相当する金額を返金するものとします。</p>
                  </div> 
    
                <div class="gray_sub_header"><b>第7条（著作権）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、自ら著作権等の必要な知的財産権を有するか、または必要な権利者の許諾を得た文章、画像や映像等の情報に関してのみ、サービスを利用し、投稿ないしアップロードすることができるものとします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. ユーザーがサービスを利用して投稿ないしアップロードした文章、画像、映像等の著作権については、当該ユーザーその他既存の権利者に留保されるものとします。ただし、当方は、サービスを利用して投稿ないしアップロードされた文章、画像、映像等について、サービスの改良、品質の向上、または不備の是正等ならびにサービスの周知宣伝等に必要な範囲で利用できるものとし、ユーザーは、この利用に関して、著作者人格権を行使しないものとします。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 前項本文の定めるもの、著作権およびその他の知的財産権を本来有する個人・企業・団体を除き、サービスおよびサービスに関連する一切の情報についての著作権およびその他の知的財産権はすべて当方または当方にその利用を許諾した権利者に帰属し、ユーザーは無断で複製、譲渡、貸与、翻訳、改変、転載、公衆送信（送信可能化）、伝送、配布、出版、営業使用等をしてはならないものとします。</p>
                  </div>
    
                <div class="gray_sub_header"><b>第8条（利用制限および登録抹消）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、ユーザーが以下のいずれかに該当する場合には、事前の通知なく、登録情報や投稿データ等を削除し、ユーザーに対してサービスの全部もしくは一部の利用を制限しまたはユーザーとしての登録を抹消することができるものとします。</p><!-- 先頭 -->
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 本規約のいずれかの条項に違反した場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 登録事項に虚偽の事実があることが判明した場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 料金等の支払債務の不履行があった場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- 当方からの連絡に対し、一定期間返答がない場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- サービスについて、最終の利用から一定期間利用がない場合</p>
                      <p class="kiyaku_2nd kiyaku_chu_komoku">- その他、当方がサービスの利用を適当でないと判断した場合</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 前項各号のいずれかに該当した場合、ユーザーは、当然に当方に対する一切の債務について期限の利益を失い、その時点において負担する一切の債務を直ちに一括して弁済しなければなりません。 </p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 当方は、本条に基づき当方が行った行為によりユーザーに生じた損害について、一切の責任を負いません。</p>
                  </div>
    
                <div class="gray_sub_header"><b>第9条（退会）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、当方の定める退会手続により、サービスから退会できるものとします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方は、ユーザーから特段の申し入れなき場合、ユーザーの退会後も期間を定めることなく、退会までに投稿された内容の公開・利用を継続できるものとします。</p>
                  </div>
    
                <div class="gray_sub_header"><b>第10条（保証の否認および免責事項）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、サービスに事実上または法律上の瑕疵（安全性、信頼性、正確性、完全性、有効性、特定の目的への適合性、セキュリティなどに関する欠陥、エラーやバグ、権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. 当方は、サービスに起因してユーザーに生じたあらゆる損害について一切の責任を負いません。ただし、サービスに関する当方とユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合、この免責規定は適用されません。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;3. 前項ただし書に定める場合であっても、当方は、当方の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害のうち特別な事情から生じた損害（当方またはユーザーが損害発生につき予見し、または予見し得た場合を含みます。）について一切の責任を負いません。また、当方の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害の賠償は、ユーザーから当該損害が発生した月に受領した利用料の額を上限とします。</p>
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;4. 当方は、サービスに関して、ユーザーと他のユーザーまたは第三者との間において生じた取引、連絡または紛争等について一切責任を負いません。</p>
                  </div>  
    
                <div class="gray_sub_header"><b>第11条（サービス内容の変更等）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、ユーザーに通知することなく、サービスの内容を変更しまたはサービスの提供を中止することができるものとし、これによってユーザーに生じた損害について一切の責任を負いません。</p><!-- 先頭 -->
                  </div>
    
                <div class="gray_sub_header"><b>第12条（利用規約の変更）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、必要と判断した場合には、ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお、本規約の変更から7日を経過した後もサービスの利用を継続した場合には、当該ユーザーは変更後の規約にも同意したものとみなします。</p><!-- 先頭 -->
                  </div>
    
                <div class="gray_sub_header"><b>第13条（個人情報の取扱い）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 当方は、サービスの利用によって取得する個人情報については、別途「プライバシーポリシー」を定め、同ポリシーに従い適切に取り扱うものとします。</p><!-- 先頭 -->
                  </div>
    
                <div class="gray_sub_header"><b>第14条（通知または連絡）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーと当方との間の通知または連絡は、当方の定める方法によって行うものとします。当方は、ユーザーから、当方が別途定める方式に従った変更届け出がない限り、現在登録されている連絡先が有効なものとみなして当該連絡先へ通知または連絡を行い、これらは、発信時にユーザーへ到達したものとみなします。</p><!-- 先頭 -->
                  </div> 
    
                <div class="gray_sub_header"><b>第15条（権利義務の譲渡の禁止）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. ユーザーは、当方の書面による事前の承諾なく、利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し、または担保に供することはできません。</p><!-- 先頭 -->
                  </div>
    
                <div class="gray_sub_header"><b>第16条（準拠法・裁判管轄）</b></div>
      
                  <div>
                    <p class="kiyaku_1st kiyaku_dai_komoku">&nbsp;1. 本規約の解釈にあたっては、日本の法律を準拠法とします。</p><!-- 先頭 -->
                    <p class="kiyaku_2nd kiyaku_dai_komoku">&nbsp;2. サービスに関して紛争が生じた場合には、当方の指定する裁判所を専属的合意管轄とします。</p>
                  </div>
    
                <div class="gray_sub_header"><b>施行・改定</b></div>
      
                  <div>
                    <div class="kiyaku_1st kiyaku_dai_komoku" style="text-align:right; padding-right:1em;">施行日：2020年01月11日</div><!-- 先頭 -->
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