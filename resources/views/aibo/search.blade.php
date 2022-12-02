@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 style="text-align:center;"><u>Search</u></h2>
            <h6 style="text-align:center;">詳細検索</h6>
            <div class="card">
                <div class="card-body">

                    <form method="get" action="{{route('aibo.search')}}">
                    @csrf

                        <label for="aibo_name">aiboの名前：</label>
                        <input type="text" name="aibo_name" id="aibo_name" value="{{old('aibo_name', $aibo_name)}}">
                        <br/>

                        <label for="aibo_birth_year">aiboの誕生日：</label>
                        <input type="text" name="aibo_birth_year" id="aibo_birth_year" value="{{old('aibo_birth_year', $aibo_birth_year)}}">年
                        <input type="text" name="aibo_birth_month" id="aibo_birth_month" value="{{old('aibo_birth_month', $aibo_birth_month)}}">月
                        <input type="text" name="aibo_birth_day" id="aibo_birth_day" value="{{old('aibo_birth_day', $aibo_birth_day)}}">日
                        <br>
                        
                        <label for="aibo_color">aiboのカラー：</label>
                        <input type="text" name="aibo_color" id="aibo_color" value="{{old('aibo_color', $aibo_color)}}">
                        <br/>
                        
                        <label for="aibo_sex">aiboの性別：</label>
                        <input type="text" name="aibo_sex" id="aibo_sex" value="{{old('aibo_sex', $aibo_sex)}}">
                        <br/>

                        <label for="owner_name">オーナー名：</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{old('owner_name', $owner_name)}}">
                        <br/>

                        <label for="owner_pref">都道府県：</label>
                        <input type="text" name="owner_pref" id="owner_pref" value="{{old('owner_pref', $owner_pref)}}">
                        <br/>
                        <br>
                    <button type="submit" class="btn btn-success">検索</button>
                    </form>

                    @if($search_flag)
                        <hr/>
                        <h2>【検索結果（50音順）】 {{$results->total()}}件</h2><br> {{--ページネーション前の合計--}}
                        ※ひらがな・カタカナ・全角・半角・大文字・小文字・濁点・半濁点の違いは無視して検索しているため、検索結果が多めになる場合があります
                        <hr/>
                        @if(count($results))
                            @foreach ($results as $aibo)
                                ID：{{$aibo->id}}、aiboの名前：{{$aibo->aibo_name}}、オーナー名：{{$aibo->owner->owner_name}}　<a href="{{route('aibo.show', $aibo->id)}}">【見る】</a><br>
                            @endforeach
                            {{-- <br>
                            {{$results->appends([
                                'aibo_name' => $aibo_name,
                                'aibo_birth_year' => $aibo_birth_year,
                                'aibo_birth_month' => $aibo_birth_month,
                                'aibo_birth_day' => $aibo_birth_day,
                                'aibo_color' => $aibo_color,
                                'aibo_sex' => $aibo_sex,
                                'owner_name' => $owner_name,
                                'owner_pref' => $owner_pref,
                            ])->onEachSide(1)->links()}}<br> --}}

                            <hr>
                            ▼ページネーション▼
                            <table width="60%" style="margin:auto;">
                                <tr>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                        'aibo_name' => $aibo_name,
                                        'aibo_birth_year' => $aibo_birth_year,
                                        'aibo_birth_month' => $aibo_birth_month,
                                        'aibo_birth_day' => $aibo_birth_day,
                                        'aibo_color' => $aibo_color,
                                        'aibo_sex' => $aibo_sex,
                                        'owner_name' => $owner_name,
                                        'owner_pref' => $owner_pref,
                                    ])->previousPageUrl()}}">Prev</a></td>
                                    <td width="70%" style="text-align:center;">
                                        <div class="pagenation-select">
                                        <select>
                                            @for ($i = 1; $i <= $results->lastPage(); $i++)
                                            <option value="{{$results->appends([
                                                'aibo_name' => $aibo_name,
                                                'aibo_birth_year' => $aibo_birth_year,
                                                'aibo_birth_month' => $aibo_birth_month,
                                                'aibo_birth_day' => $aibo_birth_day,
                                                'aibo_color' => $aibo_color,
                                                'aibo_sex' => $aibo_sex,
                                                'owner_name' => $owner_name,
                                                'owner_pref' => $owner_pref,
                                            ])->url($i)}}" @if($i == $results->currentPage()) selected @endif>{{$i}}ページ目/全{{$results->lastPage()}}ページ</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align:center;"><a href="{{$results->appends([
                                        'aibo_name' => $aibo_name,
                                        'aibo_birth_year' => $aibo_birth_year,
                                        'aibo_birth_month' => $aibo_birth_month,
                                        'aibo_birth_day' => $aibo_birth_day,
                                        'aibo_color' => $aibo_color,
                                        'aibo_sex' => $aibo_sex,
                                        'owner_name' => $owner_name,
                                        'owner_pref' => $owner_pref,
                                    ])->nextPageUrl()}}">Next</a></td>
                                </tr>
                            </table>
                            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                            <script>
                            $('.pagenation-select select').change(function(){
                                location.href = $(this).val();
                            });
                            </script>
                            <hr>

                        @else
                            検索結果がありません
                        @endif
                    @endif

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
