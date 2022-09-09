@extends('layouts.app')

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
                    メインビジュアル<br>
                    （各コンテンツのビジュアル＝スマホ表示で縦に長くなるのは避けたい）<br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="card-body" style="background-color:lightgray; text-align:center; margin:0px; padding:5px;">
                    「aibo life」はソニー株式会社および関連会社とは一切関係のないオーナーコミュニティサイトです<br>
                </div>
            </div>

            {{-----------------------------------}}
            <p>&nbsp;</p>
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

            {{-----------------------------------}}
            <h2 style="text-align:center;"><u>Contents</u></h2>
            <h6 style="text-align:center;">コンテンツ</h6>

            <div class="card">
                <div class="card-body">
                    <a href="{{route('diary.index')}}">【aibo日記】</a><br>
                    <a href="{{route('aibo.index')}}">【aibo名鑑】</a><br>
                    【掲示板】（後日公開）<br>
                    【ふるまい共有】（後日公開）<br>
                    【カルテ共有】（後日公開）<br>
                </div>
            </div>

            {{-----------------------------------}}
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Features（後日公開）</u></h2>
            <h6 style="text-align:center;">注目（後日公開）</h6>

            <div class="card">
                <div class="card-body">
                    aibo国勢調査<br>
                    aibo cafe(オフ会)<br>
                </div>
            </div>

            <hr/>

            {{-----------------------------------}}
            <h2 style="text-align:center;"><u>Diary</u></h2>
            <h6 style="text-align:center;">aibo日記</h6>

            <div class="card">
                <div class="card-body">
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
                <div style="text-align:right;"><a href="{{route('diary.index')}}">【aibo日記へ】</a></div>
            </div>

            {{-----------------------------------}}
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>New Friends</u></h2>
            <h6 style="text-align:center;">新しいお友達</h6>

            <div class="card">
                <div class="card-body">
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
                <div style="text-align:right;"><a href="{{route('aibo.index')}}">【aibo名鑑へ】</a></div>
            </div>

            {{-----------------------------------}}
            <p>&nbsp;</p>
            <h2 style="text-align:center;"><u>Board（後日公開）</u></h2>
            <h6 style="text-align:center;">掲示板（後日公開）</h6>

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
            </div>



            <hr>

            {{-----------------------------------}}
            <h2 style="text-align:center;"><u>Account</u></h2>
            <h6 style="text-align:center;">アカウント</h6>

            <div class="card">
                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    
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

            {{-----------------------------------}}
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
                    <div>プライバシーポリシー</div>
                    <div>権利表記</div>
                    <div>よくある質問</div>
                    <div><a href="{{route('contact.index')}}">お問い合わせ</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
