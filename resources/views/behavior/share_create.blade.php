@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（新規登録＝共有コード取り込み）</div>
                <div class="card-body">

                    <form method="post" action="{{route('behaviorshare.store')}}">
                        @csrf

                        【aiboの名前】<br>
                        @if($aibos->count() > 1)
                            このふるまいを共有しているaiboを選択<br>
                            <select id="aibo_id" name="aibo_id">
                            <option disabled="disabled" selected>選択してください</option>
                            @foreach ($aibos as $aibo)
                                <option value='{{$aibo->id}}' @if($aibo->id == old('aibo_id')) selected @endif>{{$aibo->aibo_name}}</option>
                            @endforeach
                            </select>
                        @else
                            ID：{{$aibos->first()->id}}、名前：{{$aibos->first()->aibo_name}}<br>
                            <input type="hidden" name="aibo_id" value="{{$aibos->first()->id}}"/>
                        @endif
                        <br>
                        <br>
                        <label for="my_aibo_code">【My aibo 共有コード貼り付け】</label><br>
                        （My aiboからコピーした共有コードをそのまま編集せずに貼り付けてください）<br>
                        <br>
                        <textarea name="my_aibo_code" id="my_aibo_code" cols="50" rows="12">{{old('my_aibo_code')}}</textarea>
                        <br>

                        @if ($errors->any() || session()->has('code_error_flg') || session()->has('code_exists_flg'))
                        <hr/>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                @if(session()->has('code_error_flg'))
                                <li>{{ session('code_error_flg') }}：「my aibo」で取得したコードをそのまま貼り付けてください。</li>
                                @endif
                                @if(session()->has('code_exists_flg'))
                                <li>{{ session('code_exists_flg') }}：このふるまいは既に登録されています。</li>
                                @endif
                            </ul>
                        </div>
                        <hr/>
                        @endif
                        {{-- @if(session()->has('aiueo'))
                        <li>追加： {{session('aiueo')}}</li>
                        @endif --}}

                        <br>
                        <button type="submit" class="btn btn-success">登録</button>
                    </form>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behaviorshare.index')}}"><button>ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
