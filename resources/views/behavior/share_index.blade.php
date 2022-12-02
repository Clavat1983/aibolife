@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ふるまい共有（ページ：{{$page}}、乱数:{{$seed}}、mes：{{$mes}}）</div>
                <div class="card-body">

                    @foreach ($behaviors as $behavior)
                        ID：{{$behavior->id}}、タイトル：{{$behavior->behavior_name}}、aiboの名前：{{$behavior->aibo->aibo_name}}　<a href="{{route('behaviorshare.show', $behavior)}}?seed={{$seed}}&page={{$page}}">【見る】</a><br>
                    @endforeach
                    <br>

                    <hr>
                    {{-- {{$behaviors->appends(['seed' => $seed])->onEachSide(1)->links()}} --}}
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$behaviors->appends(['seed' => $seed])->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $behaviors->lastPage(); $i++)
                                    <option value="{{$behaviors->appends(['seed' => $seed])->url($i)}}" @if($i == $behaviors->currentPage()) selected @endif>{{$i}}ページ目/全{{$behaviors->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$behaviors->appends(['seed' => $seed])->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <hr>
                    <br>
                    <p style="text-align:center;"><a href="{{route('behaviorshare.create')}}">ふるまいを登録する</a></p>

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
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script>
$('.pagenation-select select').change(function(){
    location.href = $(this).val();
});
</script>
@endsection
