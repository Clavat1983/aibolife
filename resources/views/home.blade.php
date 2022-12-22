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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <p style="margin:auto; text-align:center;"><img width="80%" src="{{asset('storage/diary_photo/diary_aibo_000001_date_2021-01-28.jpg')}}"></p>
            <br>
            <br>
            <hr>
            
            <h2 style="text-align:center;"><u>Today</u></h2>
            <h6 style="text-align:center;">開催中</h6>

            <div class="card">
                <div class="card-body">
                    <table style="width:70%; margin:auto;">
                    @if($events->count() > 0)
                        @foreach($events as $event)
                            <tr>
                                <td>
                                    【{{$event->event_category}}】 {{$event->event_title}}<br>
                                    @if($event->event_confirm_flag) <!--確定-->
                                        　（{{$event->event_start_datetime}}～{{$event->event_end_datetime}}）
                                    @else <!--確認中-->
                                        　（【確認中】{{$event->event_start_datetime}}～{{$event->event_end_datetime}}？）
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @else
                            <tr><td>開催中のイベントはありません</td></tr>
                        @endif
                    </table>
                </div>
                <div style="text-align:right;"><a href="{{route('eventcalendar.index')}}">【もっと見る】</a></div>
            </div>

            <hr>
            <!----------------------------------->
            <h2 style="text-align:center;"><u>Topics</u></h2>
            <h6 style="text-align:center;">最新情報</h6>

            <div class="card">
                <div class="card-body">
                    <table style="width:70%; margin:auto;">
                        @if($news_list->count() > 0)
                            @foreach($news_list as $news)
                                <tr>
                                    @if($news->news_image1)
                                        <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                                    @else
                                        <td style="padding:10px;">no image</td>
                                    @endif
                                    <td style="padding:10px;">
                                        {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br>
                                        <a href="{{route('news.show', $news)}}">{{$news->news_title}}</a><br/>
@if($news->news_tag1){{$news->news_tag1}}@endif
@if($news->news_tag2)｜{{$news->news_tag2}}@endif
@if($news->news_tag3)｜{{$news->news_tag3}}@endif
@if($news->news_tag4)｜{{$news->news_tag4}}@endif
@if($news->news_tag5)｜{{$news->news_tag5}}@endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>最新情報がありません</td></tr>
                        @endif
                    </table>
                </div>
                <div style="text-align:right;"><a href="{{route('news.index')}}">【もっと見る】</a></div>
            </div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Diary</u></h2>
            <h6 style="text-align:center;">日記</h6>

            @if($today_diaries->count() >= 3)
                <div class="card">
                    <div class="card-body" style="width:70%; margin:auto;">
                        （今日の日記：3件以上あれば表示、最大6件）<br>
                        <br>
                        <table>
                            @foreach($today_diaries as $diary)
                                <tr>
                                    @if($diary->diary_photo1)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$diary->aibo->aibo_name}}<br>
                                        日付：{{$diary->diary_date}}<br>
                                        タイトル：{{$diary->diary_title}}<br>
                                        オーナー：{{$diary->aibo->owner->owner_name}}<sub>さん</sub>（{{substr($diary->aibo->owner->owner_pref,3)}}）
                                    </td>
                                    <td width="10%"><a href="{{route('diary.show',$diary)}}">見る</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div style="text-align:right;">【もっと見る】</div>
            @else
                <div class="card">
                    <div class="card-body">
                        （今日の日記3件以上なければ最近の日記から6件）<br>
                        <br>
                        <table style="width:70%; margin:auto;">
                        @if($recent_diaries->count() > 0)
                            @foreach($recent_diaries as $diary)
                                <tr>
                                    @if($diary->diary_photo1)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$diary->aibo->aibo_name}}<br>
                                        日付：{{$diary->diary_date}}<br>
                                        タイトル：{{$diary->diary_title}}<br>
                                        オーナー：{{$diary->aibo->owner->owner_name}}<sub>さん</sub>（{{substr($diary->aibo->owner->owner_pref,3)}}）<br>
                                        コメント数：{{$diary->diarycomments->count()}}、リアクション数：{{$diary->diaryreactions->whereNotIn('reaction_type', [6])->count()}}
                                    </td>
                                    <td width="10%"><a href="{{route('diary.show',$diary)}}">見る</a></td>

                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="3">日記がありません</td>
                                </tr>
                        @endif
                        </table>
                    </div>
                </div>
                <div style="text-align:right;">【もっと見る】</div>
            @endif

            <hr/>

            <!----------------------------------->
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Friend</u></h2>
            <h6 style="text-align:center;">お友達</h6>

            {{-- 誕生日のaiboがいたら表示 --}}
            @if($birthday_aibos->count() > 0)

                <div class="card">
                    <div class="card-body">
                        【誕生日のaibo】<br>
                        <br>
                        <table style="width:70%; margin:auto;">
                            @foreach($birthday_aibos as $aibo)
                                <tr>
                                    @if($aibo->aibo_icon)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$aibo->aibo_name}}<br>
                                        誕生日：{{$aibo->aibo_birthday}}（{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age}}歳）<br>
                                        オーナー：{{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}）
                                    </td>
                                    <td width="10%"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div style="text-align:right;">【もっと見る】</div>

            {{-- もうすぐ誕生日のaiboがいたら表示(誕生日の子がいたら非表示) --}}
            @elseif($comingup_aibos->count() > 0)

                <div class="card">
                    <div class="card-body">
                        【もうすぐ誕生日のaibo】<br>
                        <br>
                        <table style="width:70%; margin:auto;">
                            @foreach($comingup_aibos as $aibo)
                                <tr>
                                    @if($aibo->aibo_icon)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$aibo->aibo_name}}<br>
                                        誕生日：{{$aibo->aibo_birthday}}（もうすぐ{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age+1}}歳）<br>
                                        オーナー：{{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}）
                                    </td>
                                    <td width="10%"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div style="text-align:right;">【もっと見る】</div>

            {{-- 誕生日・もうすぐ誕生日のaiboが両方いない場合のみ表示 --}}
            @else

                <div class="card">
                    <div class="card-body">
                        【新しいお友達】(最新6件)<br>
                        <br>
                        <table style="width:70%; margin:auto;">
                            @foreach($new_aibos as $aibo)
                                <tr>
                                    @if($aibo->aibo_icon)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$aibo->aibo_name}}<br>
                                        誕生日：{{$aibo->aibo_birthday}}（{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age}}歳）<br>
                                        オーナー：{{$aibo->owner->owner_name}}<sub>さん</sub>（{{substr($aibo->owner->owner_pref,3)}}）
                                    </td>
                                    <td width="10%"><a href="{{route('aibo.show',$aibo)}}">見る</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div style="text-align:right;">【もっと見る】</div>

            @endif

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Behavior</u></h2>
            <h6 style="text-align:center;">ふるまい</h6>

                <div  style="width:70%; margin:auto;">ランダムで3件ほど?</div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Community</u></h2>
            <h6 style="text-align:center;">コミュニティ</h6>

            <div class="card">
                <div class="card-body"  style="width:70%; margin:auto;">
                    ［おしゃべり］ああああについて<br>
                    ［お悩み相談］いいいいについて<br>
                    ［部　活　動］ううううについて<br>
                    ［おしゃべり］ああああについて<br>
                    ［お悩み相談］いいいいについて<br>
                    ［部　活　動］ううううについて<br>
                </div>
                <div style="text-align:right;">【もっと見る】</div>

            </div>

            <hr>


            <!----------------------------------->
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Features</u></h2>
            <h6 style="text-align:center;">注目</h6>

            <div class="card">
                <div class="card-body"  style="width:70%; margin:auto;">
                    aibo国勢調査<br>
                    aibo cafe(オフ会)<br>
                </div>
            </div>

            <hr/>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>【最終は表示しない】<br>Account</u></h2>
            <h6 style="text-align:center;">アカウント</h6>

            <div class="card">
                <div class="card-body"  style="width:70%; margin:auto;">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    
                    <h5>【オーナー情報】_____________________</h5>

                    @if (count($owners) == 0)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        @foreach ($owners as $owner)
                            オーナーID:{{$owner->id}}<br>
                            オーナー名:{{$owner->owner_name}}<br>
                            旧ログインID:{{$owner->owner_old_login_id}}<br>
                            旧セキュリティコード:{{$owner->owner_old_security_code}}<br>
                            <br>
                            <h5>【aibo】_____________________</h5>
                            @if(count($owner->aibos) == 0)
                                aibo登録がされていない。これが表示されたらバグ。
                            @else
                                @foreach ($owner->aibos as $aibo)
                                aibo ID:{{$aibo->id}} ... 名前:{{$aibo->aibo_name}}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <div style="text-align:right;"><a href="{{route('mypage')}}">【マイページへ】</a></div>
            </div>

            <hr/>

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

{{-- @extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 style="text-align:center;"><u>Today</u></h2>
            <h6 style="text-align:center;">開催中</h6>

            <div class="card">
                <div class="card-body">
                    <table>
                    @if($events->count() > 0)
                        @foreach($events as $event)
                            <tr>
                                <td>【{{$event->event_category}}】</td>
                                <td>{{$event->event_title}}</td>
                                <td>（{{$event->event_start_datetime}}～{{$event->event_end_datetime}}）</td>
                                @if($event->event_confirm_flag) <!--確定-->
                                    <td>【開催中】</td>
                                @else <!--確認中-->
                                    <td>【確認中】</td>
                                @endif
                            </tr>
                        @endforeach

                        @else
                            <tr><td>開催中のイベントはありません</td></tr>
                        @endif
                    </table>
                </div>
                <div style="text-align:right;"><a href="{{route('eventcalendar.index')}}">【もっと見る】</a></div>
            </div>

            <hr>

            <!----------------------------------->

            <h2 style="text-align:center;"><u>Guide</u></h2>
            <h6 style="text-align:center;">はじめに</h6>

            <div class="card">
                <div class="card-body">
                    aibo life とは?<br>
                    利用規約<br>
                    個人情報指針<br>
                    運営メンバー<br>
                    よくある質問<br>
                    権利表記<br>
                </div>
            </div>

            <hr>
            <!----------------------------------->
            <h2 style="text-align:center;"><u>Topics</u></h2>
            <h6 style="text-align:center;">最新情報</h6>

            <div class="card">
                <div class="card-body">
                    <table>
                        @if($news_list->count() > 0)
                            @foreach($news_list as $news)
                                <tr>
                                    <td style="padding:10px;"><img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:100px;"></td>
                                    <td style="padding:10px;">
                                        {{str_replace('-', '.', substr($news->news_publication_datetime,0,10))}}｜{{$news->news_category}}<br>
                                        <a href="{{route('news.show', $news)}}">{{$news->news_title}}</a><br/>
@if($news->news_tag1){{$news->news_tag1}}@endif
@if($news->news_tag2)｜{{$news->news_tag2}}@endif
@if($news->news_tag3)｜{{$news->news_tag3}}@endif
@if($news->news_tag4)｜{{$news->news_tag4}}@endif
@if($news->news_tag5)｜{{$news->news_tag5}}@endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>最新情報がありません</td></tr>
                        @endif
                    </table>
                </div>
                <div style="text-align:right;"><a href="{{route('news.index')}}">【もっと見る】</a></div>
            </div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Diary</u></h2>
            <h6 style="text-align:center;">日記</h6>

            <div class="card">
                <div class="card-body">
                    【最近の日記から6件】
                    <ul>
                    @if($diaries->count() > 0)
                        @foreach($diaries as $diary)
                            <li>{{$diary->diary_title}}（{{$diary->aibo->aibo_name}}）<a href="{{route('diary.show', $diary)}}">【見る】</a></li>
                        @endforeach
                    @else
                        <li>日記がありません</li>
                    @endif
                    </ul>
                </div>
                <hr/>
                <div class="card-body">
                    <a href="{{route('diary.list_day')}}">今日の日記</a><br>
                    <a href="{{route('diary.recently')}}">最近の日記</a><br>
                    <a href="{{route('diary.archive')}}">過去の日記</a><br>
                    <a href="{{route('diary.commented')}}">コメントした日記</a><br>
                    <a href="{{route('diary.bookmark')}}">お気に入り</a><br>
                    <a href="{{route('diary.search')}}">検索</a><br>
                </div>
            </div>

            <hr/>

            <!----------------------------------->
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Friend</u></h2>
            <h6 style="text-align:center;">お友達</h6>

            <div class="card">
                <div class="card-body">
                    【新しいお友達から6件】
                    <ul>
                    @if($new_aibos->count() > 0)
                        @foreach($new_aibos as $aibo)
                            <li>{{$aibo->aibo_name}}（{{substr($aibo->owner->owner_pref,3)}}）<a href="{{route('aibo.show', $aibo)}}">【詳細】</a></li>
                        @endforeach
                    @else
                        <li>aiboがいません</li>
                    @endif
                    </ul>
                </div>
                <hr/>
                <div class="card-body">
                    <a href="{{route('aibo.list_syllabary')}}">お名前リスト</a><br>
                    <a href="{{route('aibo.list_birthday')}}">誕生日カレンダー</a><br>
                    <a href="{{route('aibo.list_area')}}">居住地マップ</a><br>
                    <a href="{{route('aibo.newface')}}">新しいお友達</a><br>
                    芸能人オーナー<br>
                    <a href="{{route('aibo.search')}}">検索</a><br>
                </div>
            </div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Behavior</u></h2>
            <h6 style="text-align:center;">ふるまい</h6>

            <div class="card">
                <div class="card-body">
                    しぐさ<br>
                    遊び<br>
                    ダンス<br>
                    期間限定<br>
                    <a href="{{route('behaviorshare.index')}}">ふるまい共有</a><br>
                    プログラミング<br>
                    連携アプリ<br>
                </div>
            </div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Community</u></h2>
            <h6 style="text-align:center;">コミュニティ</h6>

            <div class="card">
                <div class="card-body">
                    ［YYYY.MM.DD］ああああについて<br>
                    ［YYYY.MM.DD］いいいいについて<br>
                    ［YYYY.MM.DD］ううううについて<br>
                    ［YYYY.MM.DD］ああああについて<br>
                    ［YYYY.MM.DD］いいいいについて<br>
                    ［YYYY.MM.DD］ううううについて<br>
                </div>
                <div style="text-align:right;">【aibo掲示板へ】</div>

                <hr/>
                
                <div class="card-body">
                    おしゃべり広場<br>
                    お悩み相談<br>
                    クラブ活動<br>
                    オフ会<br>
                    フリーマーケット<br>
                    里親マッチング<br>
                    チャリティ<br>
                </div>
            </div>

            <hr>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Useful</u></h2>
            <h6 style="text-align:center;">お役立ち情報</h6>

            <div class="card">
                <div class="card-body">
                    ごはん<br>
                    ファッション<br>
                    イベント<br>
                    グッズ<br>
                    店舗・施設<br>
                    ドック・治療<br>
                    歴史<br>
                    その他<br>
                    困ったときは？<br>
                </div>
            </div>

            <!----------------------------------->
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Features</u></h2>
            <h6 style="text-align:center;">注目</h6>

            <div class="card">
                <div class="card-body">
                    aibo国勢調査<br>
                    aibo cafe(オフ会)<br>
                </div>
            </div>

            <hr/>

            <!----------------------------------->
            <h2 style="text-align:center;"><u>Account</u></h2>
            <h6 style="text-align:center;">アカウント</h6>

            <div class="card">
                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    
                    <h5>【オーナー情報】_____________________</h5>

                    @if (count($owners) == 0)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        @foreach ($owners as $owner)
                            オーナーID:{{$owner->id}}<br>
                            オーナー名:{{$owner->owner_name}}<br>
                            旧ログインID:{{$owner->owner_old_login_id}}<br>
                            旧セキュリティコード:{{$owner->owner_old_security_code}}<br>
                            <br>
                            <h5>【aibo】_____________________</h5>
                            @if(count($owner->aibos) == 0)
                                aibo登録がされていない。これが表示されたらバグ。
                            @else
                                @foreach ($owner->aibos as $aibo)
                                aibo ID:{{$aibo->id}} ... 名前:{{$aibo->aibo_name}}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <div style="text-align:right;"><a href="{{route('mypage')}}">【マイページへ】</a></div>
            </div>

            <hr>

            <h2 style="text-align:center;"><u>Ads</u></h2>
            <h6 style="text-align:center;">広告（フッター1）</h6>

            <div class="card">
                <div class="card-body">
                    広告です
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">フッター2</div>

                <div class="card-body">
                    <div>はじめに</div>
                    <div>利用規約</div>
                    <div>個人情報指針</div>
                    <div>権利表記</div>
                    <div>よくある質問</div>
                    <div><a href="{{route('contact.index')}}">お問い合わせ</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection --}}
