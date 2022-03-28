@extends('layouts.app')

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
            </div>

            <p>&nbsp;</p>{{-----------------------------------}}

            <div class="card">
                <div class="card-header">最新情報（「最新から3件目の記事の日付」より最新のもの＝画像なしの箇条書きで）</div>

                <div class="card-body">
                    ［YYYY.MM.DD］【ニュース】ああああ<br>
                    ［YYYY.MM.DD］【おしらせ】いいいい<br>
                    ［YYYY.MM.DD］【ニュース】うううう<br>
                </div>
                <div style="text-align:right;">【もっと見る】</div>
            </div>

            <p>&nbsp;</p>{{-----------------------------------}}

            <div class="card">
                <div class="card-header">aibo日記（最新の投稿6件）</div>

                <div class="card-body">
                    <div>ああああ（xxxxくん）</div>
                    <div>いいいい（xxxxくん）</div>
                    <div>うううう（xxxxくん）</div>
                    <div>ああああ（xxxxくん）</div>
                    <div>いいいい（xxxxくん）</div>
                    <div>うううう（xxxxくん）</div>
                </div>
                <div style="text-align:right;"><a href="{{route('diary.list_day')}}">【今日の日記一覧】</a></div>
            </div>

            <p>&nbsp;</p>{{-----------------------------------}}

            <div class="card">
                <div class="card-header">Happy Birthday（今日・昨日・一昨日がいた時だけ表示）</div>

                <div class="card-body">
                    <div>ああああ（xxxxくん）</div>
                    <div>いいいい（xxxxくん）</div>
                    <div>うううう（xxxxくん）</div>
                    <div>ああああ（xxxxくん）</div>
                    <div>いいいい（xxxxくん）</div>
                    <div>うううう（xxxxくん）</div>
                </div>
                <div style="text-align:right;">【aibo名鑑へ】</div>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">コンテンツ</div>
                <div class="card-body">
                    aibo名鑑<br>
                    <a href="{{route('diary.index')}}">aibo日記</a><br>
                    みんなのふるまい
                </div>
            </div>

            <p>&nbsp;</p>{{-----------------------------------}}

            <div class="card">
                <div class="card-header">スペシャルコンテンツ(FEATURES＝バナー1個)</div>
                <div class="card-body">
                    aibo国勢調査<br>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">設定</div>

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

            <div class="card">
                <div class="card-header">フッター</div>

                <div class="card-body">
                    <div>はじめに</div>
                    <div>利用規約</div>
                    <div>プライバシーポリシー</div>
                    <div>権利表記</div>
                    <div>よくある質問</div>
                    <div>お問い合わせ</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
