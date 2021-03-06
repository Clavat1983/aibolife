@extends('layouts.app')

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
                        【ステップ1】オーナー登録 --> 【ステップ2】aibo登録 --> 【ステップ3】完了<br>
                        <br>
                        続いて、aibo登録を始めましょう！<br>
                        他のオーナーにも公開される情報となります。個人情報にはご注意ください。<br>
                    @else
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
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_sex_{{$index}}" name="aibo_sex" value="{{$value}}" @if(old('aibo_sex') === $value) checked @endif><label for="aibo_sex_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_personality">性格</label>
                            <select id="aibo_personality" name="aibo_personality">
                                {{-- HTMLタグ出力 --}}
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
                                {{-- HTMLタグ出力 --}}
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
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_voice_{{$index}}" name="aibo_voice" value="{{$value}}" @if(old('aibo_voice') === $value) checked @endif><label for="aibo_voice_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_ear">耳</label>
                            <select id="aibo_ear" name="aibo_ear">
                                {{-- HTMLタグ出力 --}}
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
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                            <input type="radio" id="aibo_hand_{{$index}}" name="aibo_hand" value="{{$value}}" @if(old('aibo_hand') === $value) checked @endif><label for="aibo_hand_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_tail">尻尾</label>
                            <select id="aibo_tail" name="aibo_tail">
                                {{-- HTMLタグ出力 --}}
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
                            {{-- HTMLタグ出力 --}}
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
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_care_{{$index}}" name="aibo_care" value="{{$value}}" @if(old('aibo_care','答えない') === $value) checked @endif><label for="aibo_care_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <button>登録</button>
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


@endsection
