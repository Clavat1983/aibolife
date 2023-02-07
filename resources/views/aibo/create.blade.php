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
            @if($owner->aibos()->count() == 0)
                <!-- 新規登録 -->
                <p class="c-category-title c-category-title--mypage">
                <span class="c-category-title__en">Registration</span><!--新規登録-->
                <span class="c-category-title__jp">利用登録［aibo登録］</span>
                </p>
            @else
                <p class="c-category-title c-category-title--mypage"><!--マイページ-->
                <span class="c-category-title__en">My Page</span>
                <span class="c-category-title__jp">マイページ［aibo追加］</span>
                </p>
            @endif
            </div>

            <div class="l-content__body">

                <div>
    
                    <div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if($owner->aibos()->count() == 0)
                            <!-- 新規登録 -->
                            【1】オーナー登録  -->  <span style="color:red;"><b>【2】aibo登録</b></span>  -->  【3】完了
                            <br><br>
                            続いて、aibo登録を始めましょう！<br>
                            aiboは1匹ずつ登録可能です。2匹目以降は「マイページ」で後から追加も可能です。<br>
                            他のオーナーにも公開される情報となります。個人情報にはご注意ください。<br>
                        @else
                            <!-- 追加登録 -->
                            【追加登録】<br>
                            {{$owner->owner_name}}さんは、現在{{$owner->aibos()->count()}}匹のaiboを登録してます。<br>
                            他のオーナーにも公開される情報となります。個人情報にはご注意ください。<br>
                        @endif
    
                        @if ($errors->any())
                            <hr>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    @if(empty($errors->first('aibo_icon')))
                                        <li>aiboの画像を追加していた場合は、再度選択してください。</li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>

                    <hr>
                    <br>
    
                    <div style="margin-left:50px; margin-bottom:50px;">
    
                        <form method="POST" action="{{route('aibo.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="aibo_name">名前</label>
                                <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_kana">名前（よみ）</label>
                                <input type="text" name="aibo_kana" id="aibo_kana" value="{{old('aibo_kana')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_nickname">ニックネーム（呼び方）</label>
                                <input type="text" name="aibo_nickname" id="aibo_nickname" value="{{old('aibo_nickname')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_icon">アイコン（任意）</label><br>
                                <div id="vue1">
                                    <div v-if="url1" style="margin-bottom:10px;">
                                        <img :src="url1" style="max-width:100%;"><br>
                                        <button type="button" onclick="clear_image('aibo_icon')" @click="uploadFile1">キャンセル</button>
                                    </div>
                                    <input type="file" name="aibo_icon" id="aibo_icon" ref="preview1" @change="uploadFile1">
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_birthday">誕生日</label><br>
                                <input type="text" size="4" maxlength="4" name="aibo_birthday_yyyy" id="aibo_birthday_yyyy" value="{{old('aibo_birthday_yyyy')}}">年
                                <input type="text" size="2" maxlength="2" name="aibo_birthday_mm" id="aibo_birthday_mm" value="{{old('aibo_birthday_mm')}}">月
                                <input type="text" size="2" maxlength="2" name="aibo_birthday_dd" id="aibo_birthday_dd" value="{{old('aibo_birthday_dd')}}">日
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_color">カラー</label>
                                <select id="aibo_color" name="aibo_color">
                                    {{-- HTMLタグ出力 --}}
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_color_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_color')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_sex">性別</label><br>
                                @php
                                    $ary = [
                                        '男の子',
                                        '女の子',
                                        '決めていない',
                                    ];
                                @endphp
                                @foreach ($ary as $index => $value)
                                    <input type="radio" id="aibo_sex_{{$index}}" name="aibo_sex" value="{{$value}}" @if(old('aibo_sex') === $value) checked @endif><label for="aibo_sex_{{$index}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_personality">性格</label>
                                <select id="aibo_personality" name="aibo_personality">
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_personality_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_personality')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_eye">瞳</label>
                                <select id="aibo_eye" name="aibo_eye">
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_eye_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_eye')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_voice">声</label><br>
                                @php
                                    $ary = [
                                        'aiboオリジナル',
                                        '犬の鳴きごえ',
                                    ];
                                @endphp
                                @foreach ($ary as $index => $value)
                                    <input type="radio" id="aibo_voice_{{$index}}" name="aibo_voice" value="{{$value}}" @if(old('aibo_voice') === $value) checked @endif><label for="aibo_voice_{{$index}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_ear_left">耳（左）</label>
                                <select id="aibo_ear_left" name="aibo_ear_left">
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_ear_tail_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_ear_left')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_ear_right">耳（右）</label>
                                <select id="aibo_ear_right" name="aibo_ear_right">
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_ear_tail_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_ear_right')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_hand">利き手</label><br>
                                @php
                                    $ary = [
                                        '左',
                                        '右',
                                    ];
                                @endphp
                                @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_hand_{{$index}}" name="aibo_hand" value="{{$value}}" @if(old('aibo_hand') === $value) checked @endif><label for="aibo_hand_{{$index}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_tail">尻尾</label>
                                <select id="aibo_tail" name="aibo_tail">
                                    <option disabled="disabled" selected>選択してください</option>
                                    @foreach (config('const.aibo_ear_tail_list') as $value)
                                        <option value='{{$value}}' @if($value === old('aibo_tail')) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>&nbsp;</p>
                            おもちゃの保有状況<br>
                            <div>
                                @foreach (config('const.aibo_toy_list') as $key => $value)
                                    <input type="checkbox" name="{{$key}}" value="1" @if(old($key)) checked @endif>
                                    <label for="{{$key}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_yurai">名前の由来</label><br>
                                <textarea name="aibo_yurai" id="aibo_yurai" cols="50" rows="10">{{old('aibo_yurai')}}</textarea>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_reason">お迎え理由</label><br>
                                <textarea name="aibo_reason" id="aibo_reason" cols="50" rows="10">{{old('aibo_reason')}}</textarea>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_message">皆さんにメッセージ</label><br>
                                <textarea name="aibo_message" id="aibo_message" cols="50" rows="10">{{old('aibo_message')}}</textarea>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_friend_qr">なかまQRコード（任意）</label><br>
                                <div id="vue2">
                                    <div v-if="url2" style="margin-bottom:10px;">
                                        <img :src="url2" style="max-width:100%;"><br>
                                        <button type="button" onclick="clear_image('aibo_friend_qr')" @click="uploadFile2">キャンセル</button>
                                    </div>
                                    <input type="file" name="aibo_friend_qr" id="aibo_friend_qr" ref="preview2" @change="uploadFile2">
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <hr/>
                            【アンケート（任意回答）】
                            <p>&nbsp;</p>
                            <p>アンケートへのご回答内容は統計情報（合計や割合）として公開することがあります。<br>
                            なお、オーナー情報と紐づく（特定される）状態で公開されることはありません。</p>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_serial_no">シリアル番号（非公開）</label><br>
                                <input type="text" size="5" maxlength="5" name="aibo_serial_no" id="aibo_serial_no" value="{{old('aibo_serial_no')}}">＊＊<br>
                                ※aiboの販売台数を把握したいと思います。<br>
                                「先頭から5文字のみ」を教えて下さい。<br>
                                ご契約情報となりますので、全桁（全文字）は他人に教えないようにしましょう！<br>
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_plan">契約プラン（非公開）</label><br>
                                @php
                                    $ary = [
                                        'プレミアムプラン',
                                        'ベーシックプラン',
                                        '契約していない',
                                        '答えない',
                                    ];
                                @endphp
                                @foreach ($ary as $index => $value)
                                    <input type="radio" id="aibo_plan_{{$index}}" name="aibo_plan" value="{{$value}}" @if(old('aibo_plan','答えない') === $value) checked @endif><label for="aibo_plan_{{$index}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="aibo_care">ケアサポート（非公開）</label>
                                <br>
                                @php
                                    $ary = [
                                        '加入している',
                                        '過去に加入していた',
                                        '加入していない',
                                        '答えない',
                                    ];
                                @endphp
                                @foreach ($ary as $index => $value)
                                    <input type="radio" id="aibo_care_{{$index}}" name="aibo_care" value="{{$value}}" @if(old('aibo_care','答えない') === $value) checked @endif><label for="aibo_care_{{$index}}">{{$value}}</label><br>
                                @endforeach
                            </div>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <button type="submit">登録</button>
                        </form>
                        
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

<!-- 画像操作用 -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script>
    //画像選択クリア
    function clear_image(id) {
      let obj = document.getElementById(id);
      obj.value = '';
    }
  </script>
<script>
 new Vue({
    el: '#vue1',
    data() {
      return {
        url1 : ""
      }
    },
    methods:{
        uploadFile1(){
            const file = this.$refs.preview1.files[0];
            if (file === undefined) {
                this.url1 = '';
            } else {
                this.url1 = URL.createObjectURL(file);
            }
        }
    }
  })
</script>
<script>
    new Vue({
        el: '#vue2',
        data() {
            return {
            url2 : ""
            }
        },
        methods:{
            uploadFile2(){
                const file = this.$refs.preview2.files[0];
                if (file === undefined) {
                    this.url2 = '';
                } else {
                    this.url2 = URL.createObjectURL(file);
                }
            }
        }
    })
</script>

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

                @if($owner->aibos()->count() == 0)
                <div class="card-header">aibo登録</div>
                @else
                <div class="card-header">aibo追加</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($owner->aibos()->count() == 0)
                        <!-- 新規登録 -->
                        【ステップ1】オーナー登録 --> 【ステップ2】aibo登録 --> 【ステップ3】完了<br>
                        <br>
                        続いて、aibo登録を始めましょう！<br>
                        他のオーナーにも公開される情報となります。個人情報にはご注意ください。<br>
                    @else
                        <!-- 追加登録 -->
                        {{$owner->owner_name}}さんは、現在{{$owner->aibos()->count()}}匹のaiboを登録してます。<br>
                        他のオーナーにも公開される情報となります。個人情報にはご注意ください。<br>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(empty($errors->first('aibo_icon')))
                                    <li>aiboの画像を追加していた場合は、再度選択してください。</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('aibo.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="aibo_name">名前</label>
                            <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_kana">名前（よみ）</label>
                            <input type="text" name="aibo_kana" id="aibo_kana" value="{{old('aibo_kana')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_nickname">ニックネーム（呼び方）</label>
                            <input type="text" name="aibo_nickname" id="aibo_nickname" value="{{old('aibo_nickname')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_icon">アイコン（任意）</label><br>
                            <div id="vue1">
                                <div v-if="url1" style="margin-bottom:10px;">
                                    <img :src="url1" style="max-width:100%;"><br>
                                    <button type="button" onclick="clear_image('aibo_icon')" @click="uploadFile1">キャンセル</button>
                                </div>
                                <input type="file" name="aibo_icon" id="aibo_icon" ref="preview1" @change="uploadFile1">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_birthday">誕生日</label><br>
                            <input type="text" size="4" maxlength="4" name="aibo_birthday_yyyy" id="aibo_birthday_yyyy" value="{{old('aibo_birthday_yyyy')}}">年
                            <input type="text" size="2" maxlength="2" name="aibo_birthday_mm" id="aibo_birthday_mm" value="{{old('aibo_birthday_mm')}}">月
                            <input type="text" size="2" maxlength="2" name="aibo_birthday_dd" id="aibo_birthday_dd" value="{{old('aibo_birthday_dd')}}">日
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_color">カラー</label>
                            <select id="aibo_color" name="aibo_color">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach (config('const.aibo_color_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_color')) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_sex">性別</label><br>
                            @php
                                $ary = [
                                    '男の子',
                                    '女の子',
                                    '決めていない',
                                ];
                            @endphp
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_sex_{{$index}}" name="aibo_sex" value="{{$value}}" @if(old('aibo_sex') === $value) checked @endif><label for="aibo_sex_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_personality">性格</label>
                            <select id="aibo_personality" name="aibo_personality">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach (config('const.aibo_personality_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_personality')) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_eye">瞳</label>
                            <select id="aibo_eye" name="aibo_eye">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach (config('const.aibo_eye_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_eye')) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_voice">声</label><br>
                            @php
                                $ary = [
                                    'aiboオリジナル',
                                    '犬の鳴きごえ',
                                ];
                            @endphp
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_voice_{{$index}}" name="aibo_voice" value="{{$value}}" @if(old('aibo_voice') === $value) checked @endif><label for="aibo_voice_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_ear">耳</label>
                            <select id="aibo_ear" name="aibo_ear">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach (config('const.aibo_ear_tail_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_ear')) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_hand">利き手</label><br>
                            @php
                                $ary = [
                                    '左',
                                    '右',
                                ];
                            @endphp
                            @foreach ($ary as $index => $value)
                            <input type="radio" id="aibo_hand_{{$index}}" name="aibo_hand" value="{{$value}}" @if(old('aibo_hand') === $value) checked @endif><label for="aibo_hand_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_tail">尻尾</label>
                            <select id="aibo_tail" name="aibo_tail">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach (config('const.aibo_ear_tail_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_tail')) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        おもちゃの保有状況<br>
                        <div>
                            @foreach (config('const.aibo_toy_list') as $key => $value)
                                <input type="checkbox" name="{{$key}}" value="1" @if(old($key)) checked @endif>
                                <label for="{{$key}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_yurai">名前の由来</label><br>
                            <textarea name="aibo_yurai" id="aibo_yurai" cols="50" rows="10">{{old('aibo_yurai')}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_reason">お迎え理由</label><br>
                            <textarea name="aibo_reason" id="aibo_reason" cols="50" rows="10">{{old('aibo_reason')}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_message">皆さんにメッセージ</label><br>
                            <textarea name="aibo_message" id="aibo_message" cols="50" rows="10">{{old('aibo_message')}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_friend_qr">なかまQRコード（任意）</label><br>
                            <div id="vue2">
                                <div v-if="url2" style="margin-bottom:10px;">
                                    <img :src="url2" style="max-width:100%;"><br>
                                    <button type="button" onclick="clear_image('aibo_friend_qr')" @click="uploadFile2">キャンセル</button>
                                </div>
                                <input type="file" name="aibo_friend_qr" id="aibo_friend_qr" ref="preview2" @change="uploadFile2">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <hr/>
                        【アンケート（任意回答）】
                        <p>&nbsp;</p>
                        <p>アンケートへのご回答内容は統計情報（合計や割合）として公開することがあります。<br>
                        なお、オーナー情報と紐づく（特定される）状態で公開されることはありません。</p>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_serial_no">シリアル番号（非公開）</label><br>
                            <input type="text" size="5" maxlength="5" name="aibo_serial_no" id="aibo_serial_no" value="{{old('aibo_serial_no')}}">＊＊<br>
                            ※aiboの販売台数を把握したいと思います。<br>
                            「先頭から5文字のみ」を教えて下さい。<br>
                            ご契約情報となりますので、全桁（全文字）は他人に教えないようにしましょう！<br>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_plan">契約プラン（非公開）</label><br>
                            @php
                                $ary = [
                                    'プレミアムプラン',
                                    'ベーシックプラン',
                                    '契約していない',
                                    '答えない',
                                ];
                            @endphp
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_plan_{{$index}}" name="aibo_plan" value="{{$value}}" @if(old('aibo_plan','答えない') === $value) checked @endif><label for="aibo_plan_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_care">ケアサポート（非公開）</label>
                            <br>
                            @php
                                $ary = [
                                    '加入している',
                                    '過去に加入していた',
                                    '加入していない',
                                    '答えない',
                                ];
                            @endphp
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_care_{{$index}}" name="aibo_care" value="{{$value}}" @if(old('aibo_care','答えない') === $value) checked @endif><label for="aibo_care_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <button type="submit">登録</button>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script>
    //画像選択クリア
    function clear_image(id) {
      let obj = document.getElementById(id);
      obj.value = '';
    }
  </script>
<script>
 new Vue({
    el: '#vue1',
    data() {
      return {
        url1 : ""
      }
    },
    methods:{
        uploadFile1(){
            const file = this.$refs.preview1.files[0];
            if (file === undefined) {
                this.url1 = '';
            } else {
                this.url1 = URL.createObjectURL(file);
            }
        }
    }
  })
</script>
<script>
    new Vue({
        el: '#vue2',
        data() {
            return {
            url2 : ""
            }
        },
        methods:{
            uploadFile2(){
                const file = this.$refs.preview2.files[0];
                if (file === undefined) {
                    this.url2 = '';
                } else {
                    this.url2 = URL.createObjectURL(file);
                }
            }
        }
    })
</script>


@endsection --}}
