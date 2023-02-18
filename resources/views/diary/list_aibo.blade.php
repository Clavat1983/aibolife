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
                <span class="c-category-title__en">Diary</span>
                <span class="c-category-title__jp">&nbsp;日記［{{$aibo->aibo_name}}］</span>
              </p>
            </div>
            <div class="l-content__body">

        @php /*
            @if(1 == 0 && $target_exist_flag == false) {{--出力要らないかも。なので1==0という否定式にして様子見中--}}
                <h5>直近7日間の日記</h5>

                <table width="80%" style="margin:auto;">
                @foreach($this_week as $date => $diary)
                    @if($diary == NULL) {{-- 日記がない日 --}}
                        {{--自分のaibo--}}
                        @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id))
                            {{--誕生日が日記の日付より前--}}
                            @if(strtotime($aibo->aibo_birthday) <= strtotime($date))
                                
                                <tr>
                                    <td width="15%">----</td>
                                    <td width="75%">
                                        日付：{{$date}}<br>
                                        {{-- 名前：{{$aibo->aibo_name}}<br> --}}
                                        （書かれていません）
                                    </td>
                                    <td width="10%"><a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$date}}">書く</a></td>
                                </tr>

                                {{-- 配列の日付：{{date('Y年m月d日', strtotime($date))}}、<a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$date}}">日記を書く</a>（aiboID:{{$aibo->id}}、日付:{{date('Y年m月d日', strtotime($date))}}）<br> --}}
                            @else
                                <tr>
                                    <td width="15%">----</td>
                                    <td width="75%">
                                        日付：{{$date}}<br>
                                        {{-- 名前：{{$aibo->aibo_name}}<br> --}}
                                        （お迎え前は日記を書けません）
                                    </td>
                                    <td width="10%">----</td>
                                </tr>
                                {{-- 配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br> --}}
                            @endif
                        {{--他人のaibo--}}
                        @else
                            {{--誕生日が日記の日付より前--}}
                            @if(strtotime($aibo->aibo_birthday) <= strtotime($date))

                                <tr>
                                    <td width="15%">----</td>
                                    <td width="75%">
                                        日付：{{$date}}<br>
                                        {{-- 名前：{{$aibo->aibo_name}}<br> --}}
                                        （書かれていません）
                                    </td>
                                    <td width="10%">----</td>
                                </tr>

                                {{-- 配列の日付：{{date('Y年m月d日', strtotime($date))}}、書かれていません<br> --}}
                            @else
                                <tr>
                                    <td width="15%">----</td>
                                    <td width="75%">
                                        日付：{{$date}}<br>
                                        {{-- 名前：{{$aibo->aibo_name}}<br> --}}
                                        （お迎え前）
                                    </td>
                                    <td width="10%">----</td>
                                </tr>
                                {{-- 配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br> --}}
                            @endif
                        @endif
                    {{--日記がある日--}}
                    @else
                        <tr>
                            @if($diary->diary_photo1)
                                <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                            @else
                                <td width="15%">no image</td>
                            @endif
                            <td width="75%">
                                日付：{{$diary->diary_date}}<br>
                                タイトル：{{$diary->diary_title}}
                            </td>
                            <td width="10%"><a href="{{route('diary.show',$diary)}}">見る</a></td>
                        </tr>
                        {{-- 配列の日付：{{date('Y年m月d日', strtotime($date))}}、aibo：{{$diary->aibo->aibo_name}}、日記：{{$diary->diary_date}}、タイトル：{{$diary->diary_title}}、<a href="{{route('diary.show',$diary)}}">【見る】</a><br> --}}
                    @endif
                @endforeach
                </table>

                <hr>

            @endif
        
        */
        @endphp

                {{-- 過去の日記 --}}

                @php
                    \Carbon\Carbon::setLocale('ja');
                    $firstday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->startOfMonth()->setTime(0, 0, 0);
                    $lastday = \Carbon\Carbon::createFromFormat('Y-n-d', $target)->endOfMonth()->setTime(0, 0, 0);
                    $targetday = \Carbon\Carbon::today('Asia/Tokyo')->setTime(0, 0, 0);
                    if($lastday->lte($targetday)){ //先月以前
                        $targetday = $lastday; //その月の最終日
                    }

                    $today = \Carbon\Carbon::today('Asia/Tokyo')->startOfMonth()->setTime(0, 0, 0);
                    $birthday = \Carbon\Carbon::createFromFormat('Y-n-d', $aibo->aibo_birthday)->startOfMonth()->setTime(0, 0, 0);
                    $prev = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->subMonth()->setTime(0, 0, 0);//前月に移動用
                    $next = \Carbon\Carbon::createFromFormat('Y-m-d',$target)->addMonth()->setTime(0, 0, 0);//翌月に移動用

                @endphp

                <h5>過去の日記（{{$firstday->format('Y年m月')}}）</h5>

                    @php
                        $omukae_print_flag = false; //お迎え前は表示できないを出力したか 
                    @endphp

                <!-- 前月・翌月移動 -->
                <table width="80%" style="margin:auto;">
                    <td width="33%" style="text-align:left;">
                        @if($prev->lt($birthday))
                            &nbsp;
                        @else
                            <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}&year={{$prev->format('Y')}}&month={{$prev->format('n')}}">←前月</a>
                        @endif
                    </td>
                    <td width="33%" style="text-align:center;">&nbsp;</td>
                    <td width="33%" style="text-align:right;">
                        @if($next->gt($today))
                            &nbsp;
                        @else
                            <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}&year={{$next->format('Y')}}&month={{$next->format('n')}}">翌月→</a>
                        @endif
                    </td>
                </table>

                <br>
                <!-- その月の日記一覧 -->
                <table width="80%" style="margin:auto;">
                    {{-- 今月のカレンダーを1日ずつ出力 --}}
                    @while ($targetday >= $firstday)
                        @php
                            //曜日1文字の取得
                            //$dayname = mb_substr($targetday->dayName,0,1);
                            $print_flag = false; //ターゲット日の行を出力したか
                        @endphp

                        {{-- 日記が書かれているか走査 --}}
                        @foreach ($archives as $diary)
                            @php
                                $diary_date = \Carbon\Carbon::createFromFormat('Y-m-d',$diary->diary_date)->setTime(0, 0, 0);
                            @endphp

                            {{-- 日記が書かれていたら --}}
                            @if(($diary_date == $targetday))
                                <tr>
                                    @if($diary->diary_photo1)
                                        <td width="15%"><img width="70%" src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" /></td>
                                    @else
                                        <td width="15%">no image</td>
                                    @endif
                                    <td width="75%">
                                        {{-- 日記の日付：{{$diary_date}}、ターゲット日付：{{$targetday}}<br> --}}
                                        日付：{{$diary->diary_date}}<br>
                                        タイトル：{{$diary->diary_title}}<br>
                                        コメント数：{{$diary->diarycomments->count()}}、リアクション数：{{$diary->diaryreactions->whereNotIn('reaction_type', [6])->count()}}
                                    </td>
                                    <td width="10%"><a href="{{route('diary.show',$diary)}}">見る</a></td>
                                </tr>

                                @php
                                    $print_flag = true; //ターゲット日の行を出力したか
                                @endphp
                            @endif
                        @endforeach

                        {{-- 日記が書かれていなかったら --}}
                        @if($print_flag == false)
                            {{--自分のaibo--}}
                            @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id))
                                {{--誕生日が日記の日付より前--}}
                                @if(strtotime($aibo->aibo_birthday) <= strtotime($targetday->format('Y-m-d')))
                                    
                                    <tr>
                                        <td width="15%">----</td>
                                        <td width="75%">
                                            {{-- 日記の日付：{{$diary_date}}、ターゲット日付：{{$targetday}}<br> --}}
                                            日付：{{$targetday->format('Y-m-d')}}<br>
                                            （書かれていません）
                                        </td>
                                        <td width="10%"><a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$targetday->format('Y-m-d')}}">書く</a></td>
                                    </tr>
                                @else
                                    @if($omukae_print_flag == false)
                                        {{-- （お迎え前は日記を書けません） --}}
                                        <tr>
                                            <td colspan="3">お迎え前は日記を書けません</td>
                                        </tr>
                                        @php
                                            $omukae_print_flag = true;
                                        @endphp
                                    @endif
                                @endif

                            {{--他人のaibo--}}
                            @else
                                {{--誕生日が日記の日付より前--}}
                                @if(strtotime($aibo->aibo_birthday) <= strtotime($targetday->format('Y-m-d')))

                                    <tr>
                                        <td width="15%">----</td>
                                        <td width="75%">
                                            {{-- 日記の日付：{{$diary_date}}、ターゲット日付：{{$targetday}}<br> --}}
                                            日付：{{$targetday->format('Y-m-d')}}<br>
                                            （書かれていません）
                                        </td>
                                        <td width="10%">----</td>
                                    </tr>
                                @else
                                    @if($omukae_print_flag == false)
                                        {{-- （お迎え前は日記を書けません） --}}
                                        <tr>
                                            <td colspan="3">お迎え前の日記はありません</td>
                                        </tr>
                                        @php
                                            $omukae_print_flag = true;
                                        @endphp
                                    @endif
                                @endif
                            @endif



                        @endif

                        @php
                            //1日減らす
                            $targetday->subDay();
                        @endphp
                    @endwhile

                </table>

                <br>
                <!-- 前月・翌月移動(上と同じもの) -->
                <table width="80%" style="margin:auto;">
                    <td width="33%" style="text-align:left;">
                        @if($prev->lt($birthday))
                            &nbsp;
                        @else
                            <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}&year={{$prev->format('Y')}}&month={{$prev->format('n')}}">←前月</a>
                        @endif
                    </td>
                    <td width="33%" style="text-align:center;">&nbsp;</td>
                    <td width="33%" style="text-align:right;">
                        @if($next->gt($today))
                            &nbsp;
                        @else
                            <a href="{{route('diary.list_aibo')}}?aibo={{$aibo->id}}&year={{$next->format('Y')}}&month={{$next->format('n')}}">翌月→</a>
                        @endif
                    </td>
                </table>


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
                    <h2>aibo_ID:{{$aibo->id}}「{{$aibo->aibo_name}}」の日記</h2>

                    <br>
                    <h5>直近7日間の日記</h5>
                    @if($aibo->owner->user)
                    ログインユーザ：{{auth()->user()->id}}⇔このaiboのオーナーのユーザID{{$aibo->owner->user->id}}<br>
                    @else
                    ログインユーザ：{{auth()->user()->id}}⇔このaiboのオーナーのユーザ（未登録）
                    @endif
                    <br>
                    @foreach($this_week as $date => $diary)
                        @if($diary == NULL) 日記がない --}}
                            {{--自分のaibo--}}
                            {{-- @if(($aibo->owner->user != NULL) && (auth()->user()->id === $aibo->owner->user->id)) --}}
                                {{--誕生日が日記の日付より前--}}
                                {{-- @if(strtotime($aibo->aibo_birthday) <= strtotime($date))
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、<a href="{{route('diary.create')}}?aibo={{$aibo->id}}&date={{$date}}">日記を書く</a>（aiboID:{{$aibo->id}}、日付:{{date('Y年m月d日', strtotime($date))}}）<br>
                                @else
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br>
                                @endif --}}
                            {{--他人のaibo--}}
                            {{-- @else --}}
                                {{--誕生日が日記の日付より前--}}
                                {{-- @if(strtotime($aibo->aibo_birthday) <= strtotime($date))
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、書かれていません<br>
                                @else
                                    配列の日付：{{date('Y年m月d日', strtotime($date))}}、お迎え前<br>
                                @endif
                            @endif --}}
                        {{--日記がある--}}
                        {{-- @else
                            配列の日付：{{date('Y年m月d日', strtotime($date))}}、aibo：{{$diary->aibo->aibo_name}}、日記：{{$diary->diary_date}}、タイトル：{{$diary->diary_title}}、<a href="{{route('diary.show',$diary)}}">【見る】</a><br>
                        @endif
                    @endforeach


                    <br>
                    <br>
                    <h5>過去の日記</h5> --}}
                    
                    {{-- 
                    @foreach ($archive_count as $yyyy => $yyyymm)
                        {{$yyyy}}年<br>
                        <ul>
                        @foreach ($yyyymm as $month => $count)
                            <li>{{$month}}月（{{$count}}件）</li>
                        @endforeach
                        </ul>
                    @endforeach
                    --}}

                    {{-- <br>
                    <br>


                    <a href="{{route('diary.index')}}">日記を見るに戻る</a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
