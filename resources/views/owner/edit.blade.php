@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">オーナー情報変更</div>

                <div class="card-body">
                    オーナー情報の変更です。<br>
                    ログインしているユーザ（{{auth()->user()->id}}）のオーナーID:{{auth()->user()->owner->id}}<br>
                    変更しようとしているオーナーID：{{$owner->id}}<br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                    @if(empty($errors->first('owner_icon')))
                                        <li>オーナーアイコン画像を追加していた場合は、再度選択してください。</li>
                                    @endif
                                @endforeach
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

                    <form method="POST" action="{{route('owner.update', $owner)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="owner_name">オーナー名（本名にしないで）</label>
                            <input type="text" name="owner_name" id="owner_name" value="{{old('owner_name', $owner->owner_name)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="owner_name_kana">オーナー名（よみ）</label>
                            <input type="text" name="owner_name_kana" id="owner_name_kana" value="{{old('owner_name_kana', $owner->owner_name_kana)}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <div>
                                @if($owner->owner_icon)
                                <img src="{{ asset('storage/owner_icon/'.$owner->owner_icon)}}" style="width:300px;">
                                @endif
                            </div>
                            <label for="owner_icon">オーナーアイコン（任意）</label><br>
                            <input type="file" name="owner_icon" id="owner_icon">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                        <label for="owner_pref">都道府県</label>
                            <select id="owner_pref" name="owner_pref">
                                <option disabled="disabled" selected>選択してください</option>
                                @foreach(config('const.pref_list') as $pref)
                                    @php
                                        $pref_echo = mb_substr($pref,3); //数字2桁と_は消す
                                    @endphp
                                    <option value="{{ $pref }}" @if($pref === old('owner_pref', $owner->owner_pref)) selected @endif>{{ $pref_echo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <button>更新</button>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
