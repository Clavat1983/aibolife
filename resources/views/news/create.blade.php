@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ニュース登録</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                <li>★エラーがあった場合、画像は全て再度アップロードすること！！★</li>
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                        @csrf
                        
                        <table width="100%" style="border:solid 1px;">
                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="news_publication_datetime">公開日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="news_publication_datetime" name="news_publication_datetime" value="{{old('news_publication_datetime',$now)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_publication_flag">公開状態</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '下書き（非公開・終了）',
                                            '公開',
                                        ];
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="news_publication_flag_{{$index}}" name="news_publication_flag" value="{{$value}}" @if(old('news_publication_flag') === $value) checked @endif><label for="news_publication_flag_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_source_name">情報源</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="news_source_name" id="news_source_name" value="{{old('news_source_name')}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_source_url">情報源URL</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="news_source_url" id="news_source_url" value="{{old('news_source_url')}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_category">カテゴリー</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            'ニュース',
                                            'My aibo',
                                            'イベント',
                                            'メディア',
                                            'ストア',
                                            '特別企画',
                                            'メンテナンス',
                                            'その他',
                                            '未分類',
                                            '不要'
                                        ];
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="news_category_{{$index}}" name="news_category" value="{{$value}}" @if(old('news_category') === $value) checked @endif><label for="news_category_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>


                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_title">タイトル</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="news_title" id="news_title" value="{{old('news_title')}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;">メイン画像</th>
                                <td style="border:solid 1px;">
                                    <div id="vue1">
                                        <div v-if="url1" style="margin-bottom:10px;">
                                            <img :src="url1" style="max-width:100%;"><br>
                                            <button type="button" onclick="clear_image('news_image1')" @click="uploadFile1">キャンセル</button>
                                        </div>
                                        <input type="file" name="news_image1" id="news_image1" ref="preview1" @change="uploadFile1">
                                    </div>
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <td colspan="2" style="border:solid 1px; padding:10px;">
                                    <b>本文</b><br>
                                    &nbsp;&nbsp;&nbsp;・見出しは「標準」を「見出し2（h2）」に変更すれば適用される。<br>
                                    &nbsp;&nbsp;&nbsp;・太字→〇、下線→○、リンク→○
                                    <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th rowspan="4" style="border:solid 1px; padding:10px;">サブ画像（4枚まで）</th>
                                <td style="border:solid 1px; padding:10px;">
                                    <div id="vue2">
                                        <div v-if="url2" style="margin-bottom:10px;">
                                            <img :src="url2" style="max-width:100%;"><br>
                                            <button type="button" onclick="clear_image('news_image2')" @click="uploadFile2">キャンセル</button>
                                        </div>
                                        <input type="file" name="news_image2" id="news_image2" ref="preview2" @change="uploadFile2">
                                    </div>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <div id="vue3">
                                        <div v-if="url3" style="margin-bottom:10px;">
                                            <img :src="url3" style="max-width:100%;"><br>
                                            <button type="button" onclick="clear_image('news_image3')" @click="uploadFile3">キャンセル</button>
                                        </div>
                                        <input type="file" name="news_image3" id="news_image3" ref="preview3" @change="uploadFile3">
                                    </div>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <div id="vue4">
                                        <div v-if="url4" style="margin-bottom:10px;">
                                            <img :src="url4" style="max-width:100%;"><br>
                                            <button type="button" onclick="clear_image('news_image4')" @click="uploadFile4">キャンセル</button>
                                        </div>
                                        <input type="file" name="news_image4" id="news_image4" ref="preview4" @change="uploadFile4">
                                    </div>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <div id="vue5">
                                        <div v-if="url5" style="margin-bottom:10px;">
                                            <img :src="url5" style="max-width:100%;"><br>
                                            <button type="button" onclick="clear_image('news_image5')" @click="uploadFile5">キャンセル</button>
                                        </div>
                                        <input type="file" name="news_image5" id="news_image5" ref="preview5" @change="uploadFile5">
                                    </div>
                                </td>
                            </tr>


                            @php
                            $ary = [
                                    'なし',
                                    'あああ',
                                    'いいい',
                                    'ううう'
                            ];
                            @endphp

                            <tr style="border:solid 1px;">
                                <th rowspan="5" style="border:solid 1px; padding:10px;"><label for="news_tag">タグ（5つまで）</label></th>
                                <td style="border:solid 1px; padding:10px; background-color:mistyrose;">
                                    {{-- HTMLタグ出力 --}}
                                    <select id="news_tag1" name="news_tag1">
                                        {{-- HTMLタグ出力 --}}
                                        <option disabled="disabled" selected>選択してください</option>
                                        @foreach ($ary as $value)
                                            <option value='{{$value}}' @if($value === old('news_tag1')) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    {{-- HTMLタグ出力 --}}
                                    <select id="news_tag2" name="news_tag2">
                                        {{-- HTMLタグ出力 --}}
                                        <option value='' selected>選択してください</option>
                                        @foreach ($ary as $value)
                                            <option value='{{$value}}' @if($value === old('news_tag2')) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    {{-- HTMLタグ出力 --}}
                                    <select id="news_tag3" name="news_tag3">
                                        {{-- HTMLタグ出力 --}}
                                        <option value='' selected>選択してください</option>
                                        @foreach ($ary as $value)
                                            <option value='{{$value}}' @if($value === old('news_tag3')) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    {{-- HTMLタグ出力 --}}
                                    <select id="news_tag4" name="news_tag4">
                                        {{-- HTMLタグ出力 --}}
                                        <option value='' selected>選択してください</option>
                                        @foreach ($ary as $value)
                                            <option value='{{$value}}' @if($value === old('news_tag4')) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    {{-- HTMLタグ出力 --}}
                                    <select id="news_tag5" name="news_tag5">
                                        {{-- HTMLタグ出力 --}}
                                        <option value='' selected>選択してください</option>
                                        @foreach ($ary as $value)
                                            <option value='{{$value}}' @if($value === old('news_tag5')) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th rowspan="5" style="border:solid 1px; padding:10px;">関連リンク（5つまで）</th>
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link1_name">名　称</label>
                                    <input type="text" name="news_link1_name" id="news_link1_name" value="{{old('news_link1_name')}}" style="width: 100%;"><br>
                                    <label for="news_link1_url">ＵＲＬ</label>
                                    <input type="text" name="news_link1_url" id="news_link1_url" value="{{old('news_link1_url')}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link2_name">名　称</label>
                                    <input type="text" name="news_link2_name" id="news_link2_name" value="{{old('news_link2_name')}}" style="width: 100%;"><br>
                                    <label for="news_link2_url">ＵＲＬ</label>
                                    <input type="text" name="news_link2_url" id="news_link2_url" value="{{old('news_link2_url')}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link3_name">名　称</label>
                                    <input type="text" name="news_link3_name" id="news_link3_name" value="{{old('news_link3_name')}}" style="width: 100%;"><br>
                                    <label for="news_link3_url">ＵＲＬ</label>
                                    <input type="text" name="news_link3_url" id="news_link3_url" value="{{old('news_link3_url')}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link4_name">名　称</label>
                                    <input type="text" name="news_link4_name" id="news_link4_name" value="{{old('news_link4_name')}}" style="width: 100%;"><br>
                                    <label for="news_link4_url">ＵＲＬ</label>
                                    <input type="text" name="news_link4_url" id="news_link4_url" value="{{old('news_link4_url')}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link5_name">名　称</label>
                                    <input type="text" name="news_link5_name" id="news_link5_name" value="{{old('news_link5_name')}}" style="width: 100%;"><br>
                                    <label for="news_link5_url">ＵＲＬ</label>
                                    <input type="text" name="news_link5_url" id="news_link5_url" value="{{old('news_link5_url')}}" style="width: 100%;">
                                </td>
                            </tr>

                        </table>

                        <p style="margin-top:30px; text-align:center;"><button type="submit">登録</button></p>

                        {{-- 一覧画面へ --}}
                        <p style="text-align:center;">
                            <a href="{{route('news.admin')}}">【一覧画面へ】</a>
                        </p>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


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
<script>
    new Vue({
        el: '#vue3',
        data() {
            return {
            url3 : ""
            }
        },
        methods:{
            uploadFile3(){
                const file = this.$refs.preview3.files[0];
                if (file === undefined) {
                    this.url3 = '';
                } else {
                    this.url3 = URL.createObjectURL(file);
                }
            }
        }
    })
</script>
<script>
    new Vue({
        el: '#vue4',
        data() {
            return {
            url4 : ""
            }
        },
        methods:{
            uploadFile4(){
                const file = this.$refs.preview4.files[0];
                if (file === undefined) {
                    this.url4 = '';
                } else {
                    this.url4 = URL.createObjectURL(file);
                }
            }
        }
    })
</script>
<script>
    new Vue({
        el: '#vue5',
        data() {
            return {
            url5 : ""
            }
        },
        methods:{
            uploadFile5(){
                const file = this.$refs.preview5.files[0];
                if (file === undefined) {
                    this.url5 = '';
                } else {
                    this.url5 = URL.createObjectURL(file);
                }
            }
        }
    })
</script>

@endsection
