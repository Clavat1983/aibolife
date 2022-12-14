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
              <p class="c-category-ttl c-category-ttl--topics">
                <span class="c-category-ttl__en">Behavior</span>
                <span class="c-category-ttl__jp">ふるまい共有［一覧］</span>
              </p>
            </div>

            <div class="l-content__body">

                <h5>※表示順はランダムです</h5>

                @foreach ($behaviors as $behavior)
                    ID：{{$behavior->id}}、タイトル：{{$behavior->behavior_name}}、aiboの名前：{{$behavior->aibo->aibo_name}}　<a href="{{route('behaviorshare.show', $behavior)}}?seed={{$seed}}&page={{$page}}">【見る】</a><br>
                @endforeach
                <br>

                <hr>
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
</body>
</html>




{{-- @extends('layouts.app')

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
@endsection --}}
