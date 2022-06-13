@extends('layouts.app')

@section('content')
<div class="container">
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
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="news_publication_datetime">公開日時</label>
                            <input type="datetime-local" id="news_publication_datetime" name="news_publication_datetime" value="{{old('news_publication_datetime',$now)}}">
                        </div>
                        
                        {{--公開状態はデフォルトでtrue--}}

                        <p>&nbsp;</p>
                        <div>
                            <label for="news_category">カテゴリー</label><br>
                            @php
                                $ary = [
                                    '公式ニュース',
                                    'お知らせ',
                                ];
                            @endphp
                            {{-- HTMLタグ出力 --}}
                            @foreach ($ary as $index => $value)
                                <input type="radio" id="news_category_{{$index}}" name="news_category" value="{{$value}}" @if(old('news_category') === $value) checked @endif><label for="news_category_{{$index}}">{{$value}}</label><br>
                            @endforeach
                        </div>

                        <p>&nbsp;</p>
                        <div>
                            <label for="news_title">タイトル</label>
                            <input type="text" name="news_title" id="news_title" value="{{old('news_title')}}">
                        </div>

                        <p>&nbsp;</p>

                        
                        {{--本文--}}
                        <div>
                            <label for="news_body">本文</label>
                            <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                        </div>

                            {{-- ckeditor 4.14.1 --}}
                            {{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                            <div>
                                <label for="news_body">本文</label>
                                <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                            </div>
                            <p>&nbsp;</p> --}}

                            {{-- ckeditor 5.33.0 --}}
                            {{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
                            <div>
                                <label for="news_body">本文</label>
                                <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                            </div>
                            <script>
                                    ClassicEditor
                                            .create( document.querySelector( '#news_body' ) )
                                            .then( editor => {
                                                    console.log( editor );
                                            } )
                                            .catch( error => {
                                                    console.error( error );
                                            } );
                            </script> --}}

                            {{--画像--}}

                            {{--リンク--}}
                            <p>&nbsp;</p>
                            <div>
                                <label for="news_link1_name">リンク01：名称</label>
                                <input type="text" name="news_link1_name" id="news_link1_name" value="{{old('news_link1_name')}}">
                            </div>
                            <div>
                                <label for="news_link1_url">リンク01：URL</label>
                                <input type="text" name="news_link1_url" id="news_link1_url" value="{{old('news_link1_url')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="news_link2_name">リンク02：名称</label>
                                <input type="text" name="news_link2_name" id="news_link2_name" value="{{old('news_link2_name')}}">
                            </div>
                            <div>
                                <label for="news_link2_url">リンク02：URL</label>
                                <input type="text" name="news_link2_url" id="news_link2_url" value="{{old('news_link2_url')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="news_link3_name">リンク03：名称</label>
                                <input type="text" name="news_link3_name" id="news_link3_name" value="{{old('news_link3_name')}}">
                            </div>
                            <div>
                                <label for="news_link3_url">リンク03：URL</label>
                                <input type="text" name="news_link3_url" id="news_link3_url" value="{{old('news_link3_url')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="news_link4_name">リンク04：名称</label>
                                <input type="text" name="news_link4_name" id="news_link4_name" value="{{old('news_link4_name')}}">
                            </div>
                            <div>
                                <label for="news_link4_url">リンク04：URL</label>
                                <input type="text" name="news_link4_url" id="news_link4_url" value="{{old('news_link4_url')}}">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <label for="news_link5_name">リンク05：名称</label>
                                <input type="text" name="news_link5_name" id="news_link5_name" value="{{old('news_link5_name')}}">
                            </div>
                            <div>
                                <label for="news_link5_url">リンク05：URL</label>
                                <input type="text" name="news_link5_url" id="news_link5_url" value="{{old('news_link5_url')}}">
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
@endsection
