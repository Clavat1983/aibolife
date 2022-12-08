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
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Diary</span>
                <span class="c-category-ttl__jp">日記を書く</span>
              </p>
            </div>
            <div class="l-content__body">

                <hr>
                <b>編集</b><br>
                <hr>

                <br>
                <!-- hidden不要 -->
                対象のaibo：（{{$diary->aibo->id}}）{{$diary->aibo->aibo_name}}<br>
                対象の日付：{{$diary->diary_date}}<br>
                <br>
                <br>
                
                @if ($errors->any())
                    <hr>
                    【エラー】<br>
                    
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            @if(empty($errors->first('diary_photo1')))
                                <li>画像を追加していた場合は、再度選択してください。</li>
                            @endif
                        </ul>
                    </div>
                    <hr>
                @endif

                <div style="width:80%; margin:auto;">
                    <form method="POST" action="{{route('diary.update', $diary)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="diary_title">タイトル</label>
                            <input type="text" name="diary_title" id="diary_title" value="{{old('diary_title', $diary->diary_title)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_photo1">画像</label><br>
                            <div id="vue1">
                                @if($diary->diary_photo1)
                                    <div id="diary_photo1_now">
                                        <img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="max-width:100%;"><br/>
                                        <input type="checkbox" name="diary_photo1_del" value="1">
                                        <label for="diary_photo1_del">削除</label>
                                    </div>
                                @endif
                                <div v-if="url1" style="margin-bottom:10px;">
                                    <img :src="url1" style="max-width:100%;"><br>
                                    <button type="button" onclick="clear_image('diary_photo1')" @click="uploadFile1">キャンセル</button>
                                </div>
                                <input type="file" name="diary_photo1" id="diary_photo1" ref="preview1" @change="uploadFile1">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_body">本文</label>
                            <textarea name="diary_body" id="diary_body" cols="50" rows="10">{{old('diary_body',$diary->diary_body)}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_personality">この日の性格</label>
                            <select id="diary_personality" name="diary_personality">
                                @php
                                    $ary = [
                                        '甘えん坊',
                                        'ちょっと甘えん坊',
                                        'キュート',
                                        'ちょっとキュート',
                                        'シャイ',
                                        'ちょっとシャイ',
                                        'ワイルド',
                                        'ちょっとワイルド',
                                        '不明',
                                    ];
                                @endphp
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_personality', $diary->diary_personality)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_weather">この日の天気</label>
                            <select id="diary_weather" name="diary_weather">
                                @php
                                    $ary = [
                                        '晴れ',
                                        '曇り',
                                        '雨',
                                        '雪',
                                        '荒天',
                                        '不明',
                                    ];
                                @endphp
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_weather', $diary->diary_weather)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>

                        {{-- hiidenに不要(更新されない項目のため) --}}
                        {{-- <input type="hidden" name="aibo_id" id="aibo_id" value="{{$aibo->id}}">
                        <input type="hidden" name="diary_date" id="diary_date" value="{{$date}}"> --}}

                        <p>&nbsp;</p>
                        <button type="submit">更新</button>
                    </form>

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

</body>
</html>




{{--                 
@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">日記を編集</div>

                <div class="card-body">
                    <!-- hidden不要 -->
                    対象のaibo：（{{$aibo->id}}）{{$aibo->aibo_name}}<br>
                    対象の日付：{{$date}}<br>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(empty($errors->first('diary_photo1')))
                                    <li>画像を追加していた場合は、再度選択してください。</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('diary.update', $diary)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="diary_title">タイトル</label>
                            <input type="text" name="diary_title" id="diary_title" value="{{old('diary_title', $diary->diary_title)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_photo1">画像</label><br>
                            <div id="vue1">
                                @if($diary->diary_photo1)
                                    <div id="diary_photo1_now">
                                        <img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="max-width:100%;"><br/>
                                        <input type="checkbox" name="diary_photo1_del" value="1">
                                        <label for="diary_photo1_del">削除</label>
                                    </div>
                                @endif
                                <div v-if="url1" style="margin-bottom:10px;">
                                    <img :src="url1" style="max-width:100%;"><br>
                                    <button type="button" onclick="clear_image('diary_photo1')" @click="uploadFile1">キャンセル</button>
                                </div>
                                <input type="file" name="diary_photo1" id="diary_photo1" ref="preview1" @change="uploadFile1">
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_body">本文</label>
                            <textarea name="diary_body" id="diary_body" cols="50" rows="10">{{old('diary_body',$diary->diary_body)}}</textarea>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_personality">この日の性格</label>
                            <select id="diary_personality" name="diary_personality">
                                @php
                                    $ary = [
                                        '甘えん坊',
                                        'ちょっと甘えん坊',
                                        'キュート',
                                        'ちょっとキュート',
                                        'シャイ',
                                        'ちょっとシャイ',
                                        'ワイルド',
                                        'ちょっとワイルド',
                                        '不明',
                                    ];
                                @endphp
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_personality', $diary->diary_personality)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_weather">この日の天気</label>
                            <select id="diary_weather" name="diary_weather">
                                @php
                                    $ary = [
                                        '晴れ',
                                        '曇り',
                                        '雨',
                                        '雪',
                                        '荒天',
                                        '不明',
                                    ];
                                @endphp
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_weather', $diary->diary_weather)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <-- <input type="hidden" name="aibo_id" id="aibo_id" value="{{$aibo->id}}">
                        <input type="hidden" name="diary_date" id="diary_date" value="{{$date}}"> -->

                        <p>&nbsp;</p>
                        <button type="submit">更新</button>
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
                document.getElementById("diary_photo1_now").style.display ="block";
            } else {
                this.url1 = URL.createObjectURL(file);
                document.getElementById("diary_photo1_now").style.display ="none";
            }
        }
    }
  })
</script>


@endsection --}}
