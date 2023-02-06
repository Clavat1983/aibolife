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
              <p class="c-category-title c-category-title--community">
                <span class="c-category-title__en">Board</span>
                @if($category_id == 1)
                  <span class="c-category-title__jp">おしゃべり広場［新規投稿］</span>
                @elseif($category_id == 2)
                  <span class="c-category-title__jp">お悩み相談［新規投稿］</span>
                @elseif($category_id == 3)
                  <span class="c-category-title__jp">クラブ活動［新規投稿］</span>
                @endif
              </p>
            </div>

            <div class="l-content__body">

              @if ($errors->any())
                  <hr>
                  【エラー】<br>
                  
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                          @if(empty($errors->first('image1')))
                              <li>画像を追加していた場合は、再度選択してください。</li>
                          @endif
                      </ul>
                  </div>
                  <hr>
              @endif


              <form method="POST" action="{{route('board.store')}}" enctype="multipart/form-data">
                @csrf

                <div>
                  <label for="title">タイトル</label>
                  <input type="text" name="title" id="title" value="{{old('title')}}">
                </div>
                <p>&nbsp;</p>
                <div>
                    <label for="body">本文</label>
                    <textarea name="body" id="body" cols="50" rows="10">{{old('body')}}</textarea>
                </div>
                <p>&nbsp;</p>

                <div>
                  <label for="image1">画像1</label><br>
                  <div id="vue1">
                      <div v-if="url1" style="margin-bottom:10px;">
                          <img :src="url1" style="max-width:100%;"><br>
                          <button type="button" onclick="clear_image('image1')" @click="uploadFile1">キャンセル</button>
                      </div>
                      <input type="file" name="image1" id="image1" ref="preview1" @change="uploadFile1">
                  </div>
                </div>
                <p>&nbsp;</p>
                <div>
                  <label for="image2">画像2</label><br>
                  <div id="vue2">
                      <div v-if="url2" style="margin-bottom:10px;">
                          <img :src="url2" style="max-width:100%;"><br>
                          <button type="button" onclick="clear_image('image2')" @click="uploadFile2">キャンセル</button>
                      </div>
                      <input type="file" name="image2" id="image2" ref="preview2" @change="uploadFile2">
                  </div>
                </div>
                <p>&nbsp;</p>
                <div>
                  <label for="image3">画像3</label><br>
                  <div id="vue3">
                      <div v-if="url3" style="margin-bottom:10px;">
                          <img :src="url3" style="max-width:100%;"><br>
                          <button type="button" onclick="clear_image('image3')" @click="uploadFile3">キャンセル</button>
                      </div>
                      <input type="file" name="image3" id="image3" ref="preview3" @change="uploadFile3">
                  </div>
                </div>
                <p>&nbsp;</p>
                <div>
                  <label for="image4">画像4</label><br>
                  <div id="vue4">
                      <div v-if="url4" style="margin-bottom:10px;">
                          <img :src="url4" style="max-width:100%;"><br>
                          <button type="button" onclick="clear_image('image4')" @click="uploadFile4">キャンセル</button>
                      </div>
                      <input type="file" name="image4" id="image4" ref="preview4" @change="uploadFile4">
                  </div>
                </div>
                <p>&nbsp;</p>
                <div>
                  <label for="image5">画像5</label><br>
                  <div id="vue5">
                      <div v-if="url5" style="margin-bottom:10px;">
                          <img :src="url5" style="max-width:100%;"><br>
                          <button type="button" onclick="clear_image('image5')" @click="uploadFile5">キャンセル</button>
                      </div>
                      <input type="file" name="image5" id="image5" ref="preview5" @change="uploadFile5">
                  </div>
                </div>
                <p>&nbsp;</p>
              
                @if($category_id == 3)
                  <div>
                    <label for="club_name1">部活名1</label>
                    <input type="text" name="club_name1" id="club_name1" value="{{old('club_name1')}}">
                  </div>
                  <p>&nbsp;</p>
                  <div>
                    <label for="club_name1">部活名2</label>
                    <input type="text" name="club_name2" id="club_name2" value="{{old('club_name2')}}">
                  </div>
                  <p>&nbsp;</p>
                  <div>
                    <label for="club_name1">部活名3</label>
                    <input type="text" name="club_name3" id="club_name3" value="{{old('club_name3')}}">
                  </div>
                  <p>&nbsp;</p>
                  <div>
                    <label for="club_name1">部活名4</label>
                    <input type="text" name="club_name4" id="club_name4" value="{{old('club_name4')}}">
                  </div>
                  <p>&nbsp;</p>
                  <div>
                    <label for="club_name1">部活名5</label>
                    <input type="text" name="club_name5" id="club_name5" value="{{old('club_name5')}}">
                  </div>
                  <p>&nbsp;</p>
                @else
                  <input type="hidden" name="club_name1" id="club_name1" value="なし">
                  <input type="hidden" name="club_name2" id="club_name2" value="">
                  <input type="hidden" name="club_name3" id="club_name3" value="">
                  <input type="hidden" name="club_name4" id="club_name4" value="">
                  <input type="hidden" name="club_name5" id="club_name5" value="">
                @endif

                <p>&nbsp;</p>
                <input type="hidden" name="category_id" id="category_id" value="{{$category_id}}">

                <p>&nbsp;</p>
                <button type="submit">投稿</button>
                  
              </form>

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

<!-- 画像処理 -->
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

</body>
</html>