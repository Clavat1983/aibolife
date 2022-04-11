@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">日記を編集</div>

                <div class="card-body">
                    {{-- hiddenで埋め込むこと!<br>
                    対象のaibo：（{{$aibo->id}}）{{$aibo->aibo_name}}<br>
                    対象の日付：{{$date}}<br> --}}

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
                        @if($diary->diary_photo1)
                            <p>画像：<img src="{{ asset('storage/diary_photo/'.$diary->diary_photo1)}}" style="height:300px;"></p>
                        @endif
                        <div>
                            <label for="diary_photo1">画像（変更する）</label><br>
                            <input type="file" name="diary_photo1" id="diary_photo1">
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
                                {{-- HTMLタグ出力 --}}
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_personality', $diary->diary_personality)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="diary_weather">この日の性格</label>
                            <select id="diary_weather" name="diary_weather">
                                @php
                                    $ary = [
                                        '晴れ',
                                        '曇り',
                                        '雨',
                                        '荒天',
                                        '不明',
                                    ];
                                @endphp
                                {{-- HTMLタグ出力 --}}
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach ($ary as $value)
                                    <option value='{{$value}}' @if($value === old('diary_weather', $diary->diary_weather)) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        {{--hidden項目--}}
                        {{-- <input type="hidden" name="aibo_id" id="aibo_id" value="{{$aibo->id}}">
                        <input type="hidden" name="diary_date" id="diary_date" value="{{$date}}"> --}}

                        <p>&nbsp;</p>
                        <button>編集</button>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
