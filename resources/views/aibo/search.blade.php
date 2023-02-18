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
              <p class="c-category-title c-category-title--friend">
                <span class="c-category-title__en">Friends</span>
                <span class="c-category-title__jp">&nbsp;お友達［検索］</span>
              </p>
            </div>

            <div class="l-content__body">

                @if(!$search_flag && strstr(url()->full(),'?'))
                    <span style="color:red;">1つ以上は検索条件を設定してください</span><br>
                @endif
                <br>

                <form method="get" action="{{route('aibo.search')}}">
                @csrf

                    <label for="aibo_name">aiboの名前：</label>
                    <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                    <br/>
                    ※部分一致でも可。ひらがな・カタカナ・全角・半角・大文字・小文字・濁点・半濁点の違いは無視して検索します。<br>
                    <br/>

                    <label for="aibo_birth_year">aiboの誕生日：</label>
                    <select id="aibo_birth_year" name="aibo_birth_year">
                            <option value="0000" selected>指定なし</option>
                        @for($y=2018; $y<=date('Y'); $y++)
                            <option value="{{ $y }}" @if($y == old('aibo_birth_year', $aibo_birth_year)) selected @endif>{{ $y }}</option>
                        @endfor
                    </select>年

                    <select id="aibo_birth_month" name="aibo_birth_month">
                            <option value="00" selected>指定なし</option>
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ $m }}" @if($m == old('aibo_birth_month', $aibo_birth_month)) selected @endif>{{ $m }}</option>
                        @endfor
                    </select>月

                    <select id="aibo_birth_day" name="aibo_birth_day">
                            <option value="00" selected>指定なし</option>
                        @for($d=1; $d<=31; $d++)
                            <option value="{{ $d }}" @if($d == old('aibo_birth_day', $aibo_birth_day)) selected @endif>{{ $d }}</option>
                        @endfor
                    </select>日
                    <br>
                    ※「年のみ」「月のみ」「日のみ」の指定でも検索可能です。<br>
                    <br/>
                    
                    {{-- <label for="aibo_color">aiboのカラー：</label>
                    <input type="text" name="aibo_color" id="aibo_color" value="{{old('aibo_color', $aibo_color)}}"> --}}
                    <label for="aibo_color">aiboのカラー</label>
                    <select id="aibo_color" name="aibo_color">
                        <option value="指定なし" selected>指定なし</option>
                        @foreach (config('const.aibo_color_list') as $value)
                            <option value='{{$value}}' @if($value == old('aibo_color', $aibo_color)) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <br/>
                    <br/>
                    
                    {{-- <label for="aibo_sex">aiboの性別：</label>
                    <input type="text" name="aibo_sex" id="aibo_sex" value="{{old('aibo_sex', $aibo_sex)}}"> --}}
                    <label for="aibo_sex">aiboの性別：</label>
                    <select id="aibo_sex" name="aibo_sex">
                        <option value="指定なし" selected>指定なし</option>
                        @php
                            $ary = [
                                '男の子',
                                '女の子',
                                '決めていない',
                            ];
                        @endphp
                        @foreach ($ary as $index => $value)
                            <option value="{{$value}}" @if(old('aibo_sex', $aibo_sex ) == $value) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                    <br/>
                    <br/>

                    <label for="owner_name">オーナー名：</label>
                    <input type="text" name="owner_name" id="owner_name" value="{{old('owner_name', $owner_name)}}">
                    <br/>
                    ※部分一致でも可。ひらがな・カタカナ・全角・半角・大文字・小文字・濁点・半濁点の違いは無視して検索します。<br>
                    <br/>

                    <label for="owner_pref">都道府県：</label>
                    <select id="owner_pref" name="owner_pref">
                        <option value="00_指定なし" selected>指定なし</option>
                        @foreach(config('const.pref_list') as $pref)
                            @php
                                $pref_echo = mb_substr($pref,3); //数字2桁と_は消す
                            @endphp
                            <option value="{{ $pref }}" @if($pref === old('owner_pref', $owner_pref)) selected @endif>{{ $pref_echo }}</option>
                        @endforeach
                    </select>
                    <br/>
                    <br>
                <button type="submit" class="btn btn-success">検索</button>
                </form>

                <!-- 検索結果を表示 -->
                @if($search_flag)
                    <hr/>
                    <h2>【検索結果（50音順）】 {{$results->total()}}件</h2><!--ページネーション前の合計-->
                    <hr/>
                    @if(count($results))

                        <table width="80%" style="margin:auto;">
                            @if(count($results) == 0)
                                <tr>
                                <td colspan="3">（該当するaiboが見つかりません）</td>
                                </tr>
                            @else
                                @foreach ($results as $aibo)
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
                            @endif
                        </table>

                        <hr>

                        ▼ページネーション▼
                        <table width="60%" style="margin:auto;">
                            <tr>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'aibo_name' => $aibo_name,
                                    'aibo_birth_year' => $aibo_birth_year,
                                    'aibo_birth_month' => $aibo_birth_month,
                                    'aibo_birth_day' => $aibo_birth_day,
                                    'aibo_color' => $aibo_color,
                                    'aibo_sex' => $aibo_sex,
                                    'owner_name' => $owner_name,
                                    'owner_pref' => $owner_pref,
                                ])->previousPageUrl()}}">Prev</a></td>
                                <td width="70%" style="text-align:center;">
                                    <div class="pagenation-select">
                                    <select>
                                        @for ($i = 1; $i <= $results->lastPage(); $i++)
                                        <option value="{{$results->appends([
                                            'aibo_name' => $aibo_name,
                                            'aibo_birth_year' => $aibo_birth_year,
                                            'aibo_birth_month' => $aibo_birth_month,
                                            'aibo_birth_day' => $aibo_birth_day,
                                            'aibo_color' => $aibo_color,
                                            'aibo_sex' => $aibo_sex,
                                            'owner_name' => $owner_name,
                                            'owner_pref' => $owner_pref,
                                        ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                        @endfor
                                    </select>
                                    </div>
                                </td>
                                <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                    'aibo_name' => $aibo_name,
                                    'aibo_birth_year' => $aibo_birth_year,
                                    'aibo_birth_month' => $aibo_birth_month,
                                    'aibo_birth_day' => $aibo_birth_day,
                                    'aibo_color' => $aibo_color,
                                    'aibo_sex' => $aibo_sex,
                                    'owner_name' => $owner_name,
                                    'owner_pref' => $owner_pref,
                                ])->nextPageUrl()}}">Next</a></td>
                            </tr>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                        <script>
                        $('.pagenation-select select').change(function(){
                            location.href = $(this).val();
                        });
                        </script>
                        <hr>

                    @else
                        検索結果がありません
                    @endif
                @endif



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
            <h2 style="text-align:center;"><u>Search</u></h2>
            <h6 style="text-align:center;">詳細検索</h6>
            <div class="card">
                <div class="card-body">

                    <form method="get" action="{{route('aibo.search')}}">
                    @csrf

                        <label for="aibo_name">aiboの名前：</label>
                        <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                        <br/>

                        <label for="aibo_birth_year">aiboの誕生日：</label>
                        <input type="text" name="aibo_birth_year" id="aibo_birth_year" value="{{old('aibo_birth_year', $aibo_birth_year)}}">年
                        <input type="text" name="aibo_birth_month" id="aibo_birth_month" value="{{old('aibo_birth_month', $aibo_birth_month)}}">月
                        <input type="text" name="aibo_birth_day" id="aibo_birth_day" value="{{old('aibo_birth_day', $aibo_birth_day)}}">日
                        <br>
                        
                        <label for="aibo_color">aiboのカラー：</label>
                        <input type="text" name="aibo_color" id="aibo_color" value="{{old('aibo_color', $aibo_color)}}">
                        <br/>
                        
                        <label for="aibo_sex">aiboの性別：</label>
                        <input type="text" name="aibo_sex" id="aibo_sex" value="{{old('aibo_sex', $aibo_sex)}}">
                        <br/>

                        <label for="owner_name">オーナー名：</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{old('owner_name', $owner_name)}}">
                        <br/>

                        <label for="owner_pref">都道府県：</label>
                        <input type="text" name="owner_pref" id="owner_pref" value="{{old('owner_pref', $owner_pref)}}">
                        <br/>
                        <br>
                    <button type="submit" class="btn btn-success">検索</button>
                    </form>

                    @if($search_flag)
                        <hr/>
                        <h2>【検索結果（50音順）】 {{$results->total()}}件</h2><br> <!--ページネーション前の合計-->
                        ※ひらがな・カタカナ・全角・半角・大文字・小文字・濁点・半濁点の違いは無視して検索しているため、検索結果が多めになる場合があります
                        <hr/>
                        @if(count($results))
                            @foreach ($results as $aibo)
                                ID：{{$aibo->id}}、aiboの名前：{{$aibo->aibo_name}}、オーナー名：{{$aibo->owner->owner_name}}　<a href="{{route('aibo.show', $aibo->id)}}">【見る】</a><br>
                            @endforeach
                            <!-- <br>
                            $results->appends([
                                'aibo_name' => $aibo_name,
                                'aibo_birth_year' => $aibo_birth_year,
                                'aibo_birth_month' => $aibo_birth_month,
                                'aibo_birth_day' => $aibo_birth_day,
                                'aibo_color' => $aibo_color,
                                'aibo_sex' => $aibo_sex,
                                'owner_name' => $owner_name,
                                'owner_pref' => $owner_pref,
                            ])->onEachSide(1)->links()}}<br> -->

                            <hr>
                            ▼ページネーション▼
                            <table width="60%" style="margin:auto;">
                                <tr>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                        'aibo_name' => $aibo_name,
                                        'aibo_birth_year' => $aibo_birth_year,
                                        'aibo_birth_month' => $aibo_birth_month,
                                        'aibo_birth_day' => $aibo_birth_day,
                                        'aibo_color' => $aibo_color,
                                        'aibo_sex' => $aibo_sex,
                                        'owner_name' => $owner_name,
                                        'owner_pref' => $owner_pref,
                                    ])->previousPageUrl()}}">Prev</a></td>
                                    <td width="70%" style="text-align:center;">
                                        <div class="pagenation-select">
                                        <select>
                                            @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends([
                                                'aibo_name' => $aibo_name,
                                                'aibo_birth_year' => $aibo_birth_year,
                                                'aibo_birth_month' => $aibo_birth_month,
                                                'aibo_birth_day' => $aibo_birth_day,
                                                'aibo_color' => $aibo_color,
                                                'aibo_sex' => $aibo_sex,
                                                'owner_name' => $owner_name,
                                                'owner_pref' => $owner_pref,
                                            ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                        'aibo_name' => $aibo_name,
                                        'aibo_birth_year' => $aibo_birth_year,
                                        'aibo_birth_month' => $aibo_birth_month,
                                        'aibo_birth_day' => $aibo_birth_day,
                                        'aibo_color' => $aibo_color,
                                        'aibo_sex' => $aibo_sex,
                                        'owner_name' => $owner_name,
                                        'owner_pref' => $owner_pref,
                                    ])->nextPageUrl()}}">Next</a></td>
                                </tr>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                            <script>
                            $('.pagenation-select select').change(function(){
                                location.href = $(this).val();
                            });
                            </script>
                            <hr>

                        @else
                            検索結果がありません
                        @endif
                    @endif

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
