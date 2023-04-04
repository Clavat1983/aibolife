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
              <p class="c-category-title c-category-title--diary">
                <span class="c-category-title__en">Daily</span>
                <span class="c-category-title__jp">&nbsp;日記［@if(!$after_flag)今日の日記@else{{$target_string_format}}@endif］</span>
              </p>
            </div>

            <p style="border:1px solid red; background-color:#fff; width:80%; margin:-20px auto 20px auto; padding:10px;">ああああああああああああああああああああああああああああああああああああああああああああああ</p>


            <div class="l-content__body">
                <table width="100%">
                    <tr>
                        <td width="25%">
                            @if($before_flag)
                                <a href="{{route('diary.list_day')}}?date={{$before_string}}">←前日の日記を見る</a>
                            @else
                                &nbsp;
                            @endif
                        </td>
                        <td style="text-align:center;"><b>{{$target_string_format}}</b></td>
                        <td width="25%" style="text-align:right;">
                            @if($after_flag)
                                <a href="{{route('diary.list_day')}}?date={{$after_string}}">翌日の日記を見る→</a>
                            @else
                                &nbsp;
                            @endif
                        </td>
                    </tr>
                </table>

                    

                <br>
                    <hr>
                    <h5>この日の出来事（今後実装）</h5>
                    <br>

                    {{-- ---------------------------- --}}
                    <hr>
                    <h5>自分の日記</h5>
                    <table width="80%" style="margin:auto;">
                    @foreach($owner->aibos as $aibo)
                        @php
                            $wrote = NULL;
                        @endphp
                        @foreach($my_diaries as $diary)
                            @if($aibo->id == $diary->aibo_id)
                                @php
                                    $wrote = $diary;
                                    break;
                                @endphp
                            @endif
                        @endforeach

                        @if($aibo->aibo_available_flag == 1) {{-- 有効なaiboだけ表示 --}}
                            @if($wrote == NULL)
                                @if(strtotime($aibo->aibo_birthday) <= strtotime($target_string)) {{-- 誕生日が日記の指定日より前なら書ける --}}
                                    <tr>
                                        <td width="15%">----</td>
                                        <td width="75%">
                                            名前：{{$aibo->aibo_name}}<br>
                                            タイトル：書かれていません
                                        </td>
                                        <td width="10%"><a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$target_string}}">書く</a></td>
                                    </tr>
                                @else {{-- お迎え前は書けない --}}
                                    <tr>
                                        <td width="15%">----</td>
                                        <td width="75%">
                                            名前：{{$aibo->aibo_name}}<br>
                                            ★お迎え前の日記を書くことは出来ません★
                                        </td>
                                        <td width="10%">----</td>
                                    </tr>
                                @endif
                            @else {{--既に書いている--}}
                                <tr>
                                    @if($wrote->diary_photo1)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$wrote->diary_photo1)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        名前：{{$aibo->aibo_name}}<br>
                                        タイトル：{{$wrote->diary_title}}<br>
                                        コメント数：{{$wrote->diarycomments->count()}}、リアクション数：{{$wrote->diaryreactions->whereNotIn('reaction_type', [6])->count()}}
                                    </td>
                                    <td width="10%"><a href="{{route('diary.show',$wrote)}}">見る</a></td>
                                </tr>
                            @endif
                        @endif
                        
                    @endforeach
                    </table>

                    {{-- ---------------------------- --}}

                    <hr>
                    <h5>みんなの日記</h5>

                    <table width="80%" style="margin:auto;">
                    @if(count($other_diaries) == 0)
                        <tr>
                            <td colspan="3">（この日に書かれた日記はありません）</td>
                        </tr>
                    @else
                        @foreach($other_diaries as $diary)
                        <tr>
                                <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                                <td width="75%">
                                    名前：{{$diary->aibo->aibo_name}}<br>
                                    タイトル：{{$diary->diary_title}}<br>
                                    オーナー：{{$diary->aibo->owner->owner_name}}<sub>さん</sub>（{{substr($diary->aibo->owner->owner_pref,3)}}）
                                </td>
                                <td width="10%"><a href="{{route('diary.show',$diary)}}">見る</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </table>

                    <br>
                    <hr/>
                    {{-- (上と同じようにナビゲーションを入れる) --}}
                    <table width="100%">
                        <tr>
                            <td width="25%">
                                @if($before_flag)
                                    <a href="{{route('diary.list_day')}}?date={{$before_string}}">←前日の日記を見る</a>
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center;"><b>{{$target_string_format}}</b></td>
                            <td width="25%" style="text-align:right;">
                                @if($after_flag)
                                    <a href="{{route('diary.list_day')}}?date={{$after_string}}">翌日の日記を見る→</a>
                                @else
                                    &nbsp;
                                @endif
                            </td>
                        </tr>
                    </table>


                    <hr>
                    <br>
                    <p style="text-align:center;"><a href="{{route('diary.list_day')}}">今日の日記</a></p>
                    <p style="text-align:center;"><a href="{{route('diary.archive')}}">過去の日記</a></p>
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
                <div class="card-header">aibo日記</div>

                <div class="card-body">
                    <h2>{{$target_string_format}}の日記</h2>

                    @if($before_flag)
                    <a href="{{route('diary.list_day')}}?date={{$before_string}}">←前日の日記を見る</a><br>
                    @endif

                    @if($after_flag)
                    <a href="{{route('diary.list_day')}}?date={{$after_string}}">翌日の日記を見る→</a><br>
                    @endif

                    <br>
                    <hr>
                    <h5>今日は何の日？（当面は非表示）</h5>
                    <br>
                    <hr>
                    <h5>自分の日記</h5>
                    <ul>
                    @foreach($owner->aibos as $aibo)
                        @php
                            $wrote = NULL;
                        @endphp
                        @foreach($my_diaries as $diary)
                            @if($aibo->id == $diary->aibo_id)
                                @php
                                    $wrote = $diary;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if($wrote == NULL) --}}
                            {{-- 誕生日が日記の指定日より前 --}}
                            {{-- @if(strtotime($aibo->aibo_birthday) <= strtotime($target_string))
                                <li>名前：{{$aibo->aibo_name}}.........<a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$target_string}}">日記を書く</a>（aiboID:{{$aibo->id}}、日付:{{date('Y年m月d日', strtotime($target_string))}}）</li>
                            @else
                                <li>名前：{{$aibo->aibo_name}}.........お迎え前</li>
                            @endif
                        @else
                            <li>名前：{{$aibo->aibo_name}}.........aiboID：{{$wrote->aibo->id}}、日記ID：{{$wrote->id}}、日記のaibo：{{$wrote->aibo->aibo_name}}、タイトル：{{$wrote->diary_title}}、<a href="{{route('diary.show',$wrote)}}">【見る】</a></li>
                        @endif
                    @endforeach
                    </ul>
                    <hr>
                    <h5>みんなの日記</h5>
                    <ul>
                    @if(count($other_diaries) == 0)
                        <li>この日の日記はまだありません</li>
                    @else
                        @foreach($other_diaries as $diary)
                            <li>名前：{{$diary->aibo->aibo_name}}.........aiboID：{{$diary->aibo->id}}、日記ID：{{$diary->id}}、日記のaibo：{{$diary->aibo->aibo_name}}、タイトル：{{$diary->diary_title}}、<a href="{{route('diary.show',$diary)}}">【見る】</a></li>
                        @endforeach
                    @endif
                    </ul>
                    <br>
                    <hr>
                    <a href="{{route('diary.index')}}">aibo日記に戻る</a>
                    <br>
                    <br>
                    <a href="{{route('root')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
