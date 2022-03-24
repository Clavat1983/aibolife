@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【ステップ1】オーナー登録</div>

                <div class="card-body">
                    オーナー登録を始めましょう！<br>
                    こちらは他のオーナー様への公開情報となります。

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div style="margin-left:50px; margin-bottom:50px;">

                    <form method="POST" action="{{route('owner.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="owner_name">オーナー名（本名にしないで）</label>
                            <input type="text" name="owner_name" id="owner_name" value="{{old('owner_name')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="owner_name_kana">オーナー名（よみ）</label>
                            <input type="text" name="owner_name_kana" id="owner_name_kana" value="{{old('owner_name_kana')}}">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                            <label for="icon">オーナーアイコン（任意）</label><br>
                            <input type="file" name="icon" id="icon">
                        </div>
                        <p>&nbsp;</p>
                        <div>
                        <label for="owner_pref">都道府県</label>
                            <select id="owner_pref" name="owner_pref">
                                <option disabled="disabled" selected>選択してください</option>
                                <option value="01_北海道" @if('01_北海道' === old('owner_pref')) selected @endif>北海道</option>
                                <option value="02_青森県" @if('02_青森県' === old('owner_pref')) selected @endif>青森県</option>
                                <option value="03_秋田県" @if('03_秋田県' === old('owner_pref')) selected @endif>秋田県</option>
                                <option value="28_兵庫県" @if('28_兵庫県' === old('owner_pref')) selected @endif>兵庫県</option>
                                <option value="47_沖縄県" @if('47_沖縄県' === old('owner_pref')) selected @endif>沖縄県</option>
                                <option value="99_海外" @if('99_海外' === old('owner_pref')) selected @endif>海外</option>
                                <option value="00_非公開" @if('00_非公開' === old('owner_pref')) selected @endif>非公開</option>
                            </select>
                        </div>
                        <p>&nbsp;</p>
                        <button>登録</button>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
