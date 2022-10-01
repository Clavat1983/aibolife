@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有</div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(empty($errors->first('behavior_photo')))
                                    <li>ふるまいの画像を追加していた場合は、再度選択してください。</li>
                                @endif
                            </ul>
                        </div>
                    @endif



                    <form method="POST" action="{{route('behaviorshare.update', $behavior)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <hr/>
                        @if(session('process') == "insert")
                            新規登録から来た：insert<br>
                            コード読み取りOK。以下の内容を入力してください。
                            <input type="hidden" name="process" value="insert"/>
                        @elseif(session('process') == "update")
                            更新からきた：update
                            <input type="hidden" name="process" value="update"/>
                        @else
                            直接きた：update
                            <input type="hidden" name="process" value="update"/>
                        @endif
                        <hr/>

                        ［aiboの名前］<br>
                        ID：{{$behavior->aibo->id}}、名前：{{$behavior->aibo->aibo_name}}<br>

                        <hr/>
                        ［ふるまいの名前］ *変更不可<br>
                        {{$behavior->behavior_name}}

                        <hr/>
                        
                        ［ふるまいのURL］ *変更不可<br>
                        {{$behavior->behavior_dl_url}}
                        <hr/>
                        ［ふるまいの説明］ *変更可能<br>
                        変更は「My aibo」には反映されず、「aibo life」に表示する説明文にのみ反映されます。<br>
                        {{-- <textarea name="behavior_info" id="behavior_info" cols="50" rows="10">{!!e($behavior->behavior_info)!!}</textarea> --}}
                        <textarea name="behavior_info" id="behavior_info" cols="50" rows="10">{{old('behavior_info', $behavior->behavior_info)}}</textarea>
                        
                        <hr/>
                        ［ふるまいのイメージ写真］ 任意<br>
                        <div id="vue1">
                            @if($behavior->behavior_photo)
                                <div id="behavior_photo">
                                    <img src="{{ asset('storage/behavior_photo/'.$behavior->behavior_photo)}}" style="max-width:50%;"><br/>
                                    <input type="checkbox" name="behavior_photo_del" value="1">
                                    <label for="behavior_photo_del">削除</label>
                                </div>
                            @endif
                            <div v-if="url1" style="margin-bottom:10px;">
                                <img :src="url1" style="max-width:50%;"><br>
                                <button type="button" onclick="clear_image('behavior_photo')" @click="uploadFile1">キャンセル</button>
                            </div>
                            <input type="file" name="behavior_photo" id="behavior_photo" ref="preview1" @change="uploadFile1">
                        </div>


                        {{-- <hr/>
                        ［ふるまいのツイート］ 任意<br>
                        <div>
                            <label for="behavior_tweet">URL</label>
                            <input type="text" name="behavior_tweet" id="behavior_tweet" value="{{old('behavior_tweet', $behavior->behavior_tweet)}}">
                        </div>

                        <hr/>
                        ［ふるまいのYoutube］ 任意<br>
                        <div>
                            <label for="behavior_youtube">URL</label>
                            <input type="text" name="behavior_youtube" id="behavior_youtube" value="{{old('behavior_youtube', $behavior->behavior_youtube)}}">
                        </div> --}}

                        <hr/>

                        <table>
                            <tr>
                                <td width="33.3%" style="text-align:center;">
                                    @if(session('process') == "insert")
                                    <button type="submit" class="btn btn-success">登録</button>
                                    @else
                                    <button type="submit" class="btn btn-success">更新</button>
                                    @endif
                                </td>
                                <td width="33.3%" style="text-align:center;">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                    </form>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behaviorshare.index')}}"><button type="button">ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
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


@endsection
