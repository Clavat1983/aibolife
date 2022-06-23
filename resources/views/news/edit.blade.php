@extends('layouts.app')

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

                    <form method="POST" action="{{route('news.update', $news)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        @php
                            $date_time = substr($news->news_publication_datetime,0,10).'T'.substr($news->news_publication_datetime,11,5);
                        @endphp

                        <table width="100%" style="border:solid 1px;">
                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px; width:25%;"><label for="news_publication_datetime">公開日時</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="datetime-local" id="news_publication_datetime" name="news_publication_datetime" value="{{old('news_publication_datetime', $date_time)}}"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_publication_flag">公開状態</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '下書き（非公開・終了）',
                                            '公開',
                                        ];

                                        $news_publication_flag = '';
                                        if ($news->news_publication_flag === 1){
                                            $news_publication_flag = '公開';
                                        } else {
                                            $news_publication_flag = '下書き（非公開・終了）';
                                        }
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="news_publication_flag_{{$index}}" name="news_publication_flag" value="{{$value}}" @if(old('news_publication_flag', $news_publication_flag) === $value) checked @endif><label for="news_publication_flag_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_category">カテゴリー</label></th>
                                <td style="border:solid 1px; padding:10px;">
                                    @php
                                        $ary = [
                                            '公式ニュース',
                                            'お知らせ',
                                            'メンテナンス'
                                        ];
                                    @endphp
                                    {{-- HTMLタグ出力 --}}
                                    @foreach ($ary as $index => $value)
                                        <input type="radio" id="news_category_{{$index}}" name="news_category" value="{{$value}}" @if(old('news_category', $news->news_category) === $value) checked @endif><label for="news_category_{{$index}}">{{$value}}</label><br>
                                    @endforeach
                                </td>
                            </tr>


                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;"><label for="news_title">タイトル</label></th>
                                <td style="border:solid 1px; padding:10px;"><input type="text" name="news_title" id="news_title" value="{{old('news_title', $news->news_title)}}" style="width: 100%;"></td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th style="border:solid 1px; padding:10px;">メイン画像</th>
                                <td style="border:solid 1px; padding:10px;">
                                    @if($news->news_image1)
                                        <img src="{{ asset('storage/news_image/'.$news->news_image1)}}" style="width:300px;"><br/><br/>
                                    @endif
                                    <input type="file" name="news_image1" id="news_image1">
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <td colspan="2" style="border:solid 1px; padding:10px;">
                                    <b>本文</b><br>
                                    &nbsp;&nbsp;&nbsp;・見出しは「スタイル」→「Special Container」を使用。<br>
                                    &nbsp;&nbsp;&nbsp;・太字→×、下線→○、リンク→○
                                    <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body', $news->news_body)}}</textarea>
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th rowspan="4" style="border:solid 1px; padding:10px;">サブ画像（4枚まで）</th>
                                <td style="border:solid 1px; padding:10px;">
                                    @if($news->news_image2)
                                        <img src="{{ asset('storage/news_image/'.$news->news_image2)}}" style="width:300px;"><br/><br/>
                                    @endif
                                    <input type="file" name="news_image2" id="news_image2">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    @if($news->news_image3)
                                        <img src="{{ asset('storage/news_image/'.$news->news_image3)}}" style="width:300px;"><br/><br/>
                                    @endif
                                    <input type="file" name="news_image3" id="news_image3">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    @if($news->news_image4)
                                        <img src="{{ asset('storage/news_image/'.$news->news_image4)}}" style="width:300px;"><br/><br/>
                                    @endif
                                    <input type="file" name="news_image4" id="news_image4">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    @if($news->news_image5)
                                        <img src="{{ asset('storage/news_image/'.$news->news_image5)}}" style="width:300px;"><br/><br/>
                                    @endif
                                    <input type="file" name="news_image5" id="news_image5">
                                </td>
                            </tr>


                            @php
                            $ary = [
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
                                            <option value='{{$value}}' @if($value === old('news_tag1', $news->news_tag1)) selected @endif>{{$value}}</option>
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
                                            <option value='{{$value}}' @if($value === old('news_tag2', $news->news_tag2)) selected @endif>{{$value}}</option>
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
                                            <option value='{{$value}}' @if($value === old('news_tag3', $news->news_tag3)) selected @endif>{{$value}}</option>
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
                                            <option value='{{$value}}' @if($value === old('news_tag4', $news->news_tag4)) selected @endif>{{$value}}</option>
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
                                            <option value='{{$value}}' @if($value === old('news_tag5', $news->news_tag5)) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr style="border:solid 1px;">
                                <th rowspan="5" style="border:solid 1px; padding:10px;">関連リンク（5つまで）</th>
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link1_name">名　称</label>
                                    <input type="text" name="news_link1_name" id="news_link1_name" value="{{old('news_link1_name', $news->news_link1_name)}}" style="width: 100%;"><br>
                                    <label for="news_link1_url">ＵＲＬ</label>
                                    <input type="text" name="news_link1_url" id="news_link1_url" value="{{old('news_link1_url', $news->news_link1_url)}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link2_name">名　称</label>
                                    <input type="text" name="news_link2_name" id="news_link2_name" value="{{old('news_link2_name', $news->news_link2_name)}}" style="width: 100%;"><br>
                                    <label for="news_link2_url">ＵＲＬ</label>
                                    <input type="text" name="news_link2_url" id="news_link2_url" value="{{old('news_link2_url', $news->news_link2_url)}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link3_name">名　称</label>
                                    <input type="text" name="news_link3_name" id="news_link3_name" value="{{old('news_link3_name', $news->news_link3_name)}}" style="width: 100%;"><br>
                                    <label for="news_link3_url">ＵＲＬ</label>
                                    <input type="text" name="news_link3_url" id="news_link3_url" value="{{old('news_link3_url', $news->news_link3_url)}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link4_name">名　称</label>
                                    <input type="text" name="news_link4_name" id="news_link4_name" value="{{old('news_link4_name', $news->news_link4_name)}}" style="width: 100%;"><br>
                                    <label for="news_link4_url">ＵＲＬ</label>
                                    <input type="text" name="news_link4_url" id="news_link4_url" value="{{old('news_link4_url', $news->news_link4_url)}}" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="border:solid 1px;">
                                <td style="border:solid 1px; padding:10px;">
                                    <label for="news_link5_name">名　称</label>
                                    <input type="text" name="news_link5_name" id="news_link5_name" value="{{old('news_link5_name', $news->news_link5_name)}}" style="width: 100%;"><br>
                                    <label for="news_link5_url">ＵＲＬ</label>
                                    <input type="text" name="news_link5_url" id="news_link5_url" value="{{old('news_link5_url', $news->news_link5_url)}}" style="width: 100%;">
                                </td>
                            </tr>

                        </table>

                        <p style="margin-top:30px; text-align:center;"><button>更　　　新</button></p>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection
