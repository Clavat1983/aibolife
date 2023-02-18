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
                <span class="c-category-title__en">My Page</span>
                <span class="c-category-title__jp">マイページ</span>
              </p>
            </div>
            <div class="l-content__body">

                <div style="width:80%; margin:auto">
                    @if ($owner == NULL)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        <h4>お知らせ</h4>
                        <p>全員共通のメッセージはここに表示(動的ではなく直書き)する</p>
                        <br>

                        <h4>オーナー情報</h4>
                        <table width="100%">
                            <tr>
                                @if($owner->owner_icon)
                                    <td width="15%"><img width="70%" src="{{ asset('storage/owner_icon/'.$owner->owner_icon)}}" /></td>
                                @else
                                    <td width="15%">no image</td>
                                @endif
                                <td width="60%">
                                    名前：{{$owner->owner_name}}<sub>さん</sub><br>
                                    都道府県：{{substr($owner->owner_pref,3)}}
                                </td>
                                <td width="25%">
                                    <a href="{{ route('owner.edit', $owner->id) }}">【変更】</a>
                                </td>
                        </table>
                        <br>

                        <h4>aibo情報</h4>
                        <table width="100%">
                        @foreach ($owner->aibos->sortBy('aibo_birthday') as $aibo)
                            <tr>
                                @if($aibo->aibo_icon)
                                    <td width="15%"><img width="70%" src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" /></td>
                                @else
                                    <td width="15%">no image</td>
                                @endif
                                <td width="60%">
                                    名前：{{$aibo->aibo_name}}<br>
                                    誕生日：{{$aibo->aibo_birthday}}（{{\Carbon\Carbon::parse($aibo->aibo_birthday)->age}}歳）<br>
                                </td>
                                <td width="25%">
                                    <a href="{{ route('aibo.show', $aibo->id) }}">【表示】</a>　｜　<a href="{{ route('aibo.edit', $aibo->id) }}">【変更】</a>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3"><a href="{{ route('aibo.create') }}">aiboの追加</a></td>
                            </tr>
                        </table>
                        <br>

                        
                        <h4>ログイン情報</h4>
                        <p><a href="{{ route('user.edit', $owner->user_id) }}">メールアドレス・パスワードの変更</a></p>
                        <br>

                        <h4>お問い合わせ</h4>
                        <p><a href="{{ route('contact.list') }}">お問い合わせ履歴</a></p>
                        

                    @endif

                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>

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
                <div class="card-header">マイページ</div>

                <div class="card-body">
                    <h2>マイページ</h2>


                    @if ($owner == NULL)
                        オーナー登録がされていない。これが表示されたらバグ。
                    @else
                        ユーザーID:{{$owner->user_id}}｜オーナーID:{{$owner->id}} ⇒ (オーナー名){{$owner->owner_name}}<br><br><br>


                            <h4>ログイン情報</h4>
                            <ul>
                                <li><a href="{{ route('user.edit', $owner->user_id) }}">メールアドレス・パスワードの変更</a></li>
                            </ul>
                            <br>
                            <h4>オーナー情報</h4>
                            <ul>
                                <li><a href="{{ route('owner.edit', $owner->id) }}">オーナー名・アイコン・都道府県の変更</a></li>
                            </ul>
                            <br>
                            <h4>aibo情報</h4>
                            <ul>
                            @foreach ($owner->aibos as $aibo)
                                <li>aibo ID:{{$aibo->id}} ... 名前:{{$aibo->aibo_name}}　を<a href="{{ route('aibo.show', $aibo->id) }}">【表示】</a>／<a href="{{ route('aibo.edit', $aibo->id) }}">【変更】</a></li>
                            @endforeach
                                <li><a href="{{ route('aibo.create') }}">aiboの追加</a></li>
                            </ul>

                    @endif
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
