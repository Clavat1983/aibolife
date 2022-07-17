@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">aibo情報変更</div>

                <div class="card-body">
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
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('aibo.update', $aibo)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="aibo_name">aiboの名前</label>
                            <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo->aibo_name)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_kana">aiboの名前（よみ）</label>
                            <input type="text" name="aibo_kana" id="aibo_kana" value="{{old('aibo_kana', $aibo->aibo_kana)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_nickname">ニックネーム（呼び方）</label>
                            <input type="text" name="aibo_nickname" id="aibo_nickname" value="{{old('aibo_nickname', $aibo->aibo_nickname)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_icon">aiboアイコン（任意）</label><br>
                            <div id="vue1">
                                @if($aibo->aibo_icon)
                                    <div id="aibo_icon_now">
                                        <img src="{{ asset('storage/aibo_icon/'.$aibo->aibo_icon)}}" style="max-width:100%;"><br/>
                                        <input type="checkbox" name="aibo_icon_del" value="1">
                                        <label for="aibo_icon_del">削除</label>
                                    </div>
                                @endif
                                <div v-if="url1" style="margin-bottom:10px;">
                                    <img :src="url1" style="max-width:100%;"><br>
                                    <button type="button" onclick="clear_image('aibo_icon')" @click="uploadFile1">キャンセル</button>
                                </div>
                                <input type="file" name="aibo_icon" id="aibo_icon" ref="preview1" @change="uploadFile1">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            @php
                                $aibo_birthday_yyyy = substr($aibo->aibo_birthday,0,4); //YYYY-MM-DDから年だけ
                                $aibo_birthday_mm = substr($aibo->aibo_birthday,5,2); //YYYY-MM-DDから月だけ
                                $aibo_birthday_dd = substr($aibo->aibo_birthday,8,2); //YYYY-MM-DDから日だけ
                            @endphp
                            <label for="aibo_birthday">aiboの誕生日</label><br>
                            <input type="text" size="4" maxlength="4" name="aibo_birthday_yyyy" id="aibo_birthday_yyyy" value="{{old('aibo_birthday_yyyy',$aibo_birthday_yyyy)}}">年
                            <input type="text" size="2" maxlength="2" name="aibo_birthday_mm" id="aibo_birthday_mm" value="{{old('aibo_birthday_mm',$aibo_birthday_mm)}}">月
                            <input type="text" size="2" maxlength="2" name="aibo_birthday_dd" id="aibo_birthday_dd" value="{{old('aibo_birthday_dd',$aibo_birthday_dd)}}">日
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_color">aiboのカラー</label>
                            <select id="aibo_color" name="aibo_color">
                                {{-- HTMLタグ出力 --}}
                                <option disabled="disabled">選択してください</option>
                                @foreach (config('const.aibo_color_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_color', $aibo->aibo_color)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_sex">aiboの性別</label><br>
                            @php
                                $ary = [
                                    '男の子',
                                    '女の子',
                                    '決めていない',
                                ];
                            @endphp
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_sex_{{$index}}" name="aibo_sex" value="{{$value}}" @if(old('aibo_sex', $aibo->aibo_sex ) === $value) checked @endif><label for="aibo_sex_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_personality">aiboの性格</label>
                            <select id="aibo_personality" name="aibo_personality">
                                <option disabled="disabled">選択してください</option>
                                @foreach (config('const.aibo_personality_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_personality',$aibo->aibo_personality)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_eye">aiboの瞳</label>
                            <select id="aibo_eye" name="aibo_eye">
                                <option disabled="disabled">選択してください</option>
                                @foreach (config('const.aibo_eye_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_eye',$aibo->aibo_eye)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_voice">aiboの声</label><br>
                            @php
                                $ary = [
                                    'aiboオリジナル',
                                    '犬の鳴きごえ',
                                ];
                            @endphp
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="aibo_voice_{{$index}}" name="aibo_voice" value="{{$value}}" @if(old('aibo_voice', $aibo->aibo_voice) === $value) checked @endif><label for="aibo_voice_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_ear">aiboの耳</label>
                            <select id="aibo_ear" name="aibo_ear">
                                <option disabled="disabled">選択してください</option>
                                @foreach (config('const.aibo_ear_tail_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_ear', $aibo->aibo_ear)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_hand">aiboの利き手</label><br>
                            @php
                                $ary = [
                                    '左',
                                    '右',
                                ];
                            @endphp
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                            <input type="radio" id="aibo_hand_{{$index}}" name="aibo_hand" value="{{$value}}" @if(old('aibo_hand', $aibo->aibo_hand) === $value) checked @endif><label for="aibo_hand_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_tail">aiboの尻尾</label>
                            <select id="aibo_tail" name="aibo_tail">
                                <option disabled="disabled">選択してください</option>
                                @foreach (config('const.aibo_ear_tail_list') as $value)
                                    <option value='{{$value}}' @if($value === old('aibo_tail',$aibo->aibo_tail)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        おもちゃの保有状況<br>
                        <div>
                            @foreach (config('const.aibo_toy_list') as $key => $value)
                                <input type="checkbox" name="{{$key}}" value="1" @if(old($key) || $aibo->$key) checked @endif>
                                <label for="{{$key}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_yurai">名前の由来</label><br>
                            <textarea name="aibo_yurai" id="aibo_yurai" cols="50" rows="10">{{old('aibo_yurai', $aibo->aibo_yurai)}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_reason">お迎え理由</label><br>
                            <textarea name="aibo_reason" id="aibo_reason" cols="50" rows="10">{{old('aibo_reason', $aibo->aibo_reason)}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_message">皆さんにメッセージ</label><br>
                            <textarea name="aibo_message" id="aibo_message" cols="50" rows="10">{{old('aibo_message', $aibo->aibo_message)}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="aibo_friend_qr">aiboのなかまQRコード（任意）</label><br>
                            <div id="vue2">
                                @if($aibo->aibo_friend_qr)
                                    <div id="aibo_friend_qr_now">
                                        <img src="{{ asset('storage/aibo_friend_qr/'.$aibo->aibo_friend_qr)}}" style="max-width:100%;"><br/>
                                        <input type="checkbox" name="aibo_friend_qr_del" value="1">
                                        <label for="aibo_friend_qr_del">削除</label>
                                    </div>
                                @endif
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
                        <div>
                            @php
                                $aibo_serial_no = substr($aibo->aibo_serial_no,0,5); //5文字
                            @endphp
                            <label for="aibo_serial_no">aiboのシリアル番号（非公開）</label><br>
                            <input type="text" size="5" maxlength="5" name="aibo_serial_no" id="aibo_serial_no" value="{{old('aibo_serial_no', $aibo_serial_no)}}">＊＊<br>
                            ※それぞれのカラー販売台数を100匹単位で把握したいと思います。<br>
                            先頭1文字がカラー、残り6文字が製造番号ですので、「先頭から5文字のみ」を教えて下さい。<br>
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
                                <input type="radio" id="aibo_plan_{{$index}}" name="aibo_plan" value="{{$value}}" @if(old('aibo_plan', $aibo->aibo_plan) === $value) checked @endif><label for="aibo_plan_{{$index}}">{{$value}}</label><br>
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
                                <input type="radio" id="aibo_care_{{$index}}" name="aibo_care" value="{{$value}}" @if(old('aibo_care', $aibo->aibo_care) === $value) checked @endif><label for="aibo_care_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <button>更新</button>
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
                document.getElementById("aibo_icon_now").style.display ="block";
            } else {
                this.url1 = URL.createObjectURL(file);
                document.getElementById("aibo_icon_now").style.display ="none";
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
                   document.getElementById("aibo_friend_qr_now").style.display ="block";
               } else {
                   this.url2 = URL.createObjectURL(file);
                   document.getElementById("aibo_friend_qr_now").style.display ="none";
               }
           }
       }
    })
</script>


@endsection
