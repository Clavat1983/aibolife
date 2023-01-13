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
              <p class="c-category-title c-category-title--mypage">
                <span class="c-category-title__en">Notification</span>
                <span class="c-category-title__jp">通知</span>
              </p>
            </div>
            <div class="l-content__body">

                <table width="80%" style="margin:auto;">
                    <tr>
                        {{-- <th style="padding-left:10px; padding-right:10px;">通知ID</th> --}}
                        <th style="padding-left:10px; padding-right:10px;">カテゴリ</th>
                        {{-- <th style="padding-left:10px; padding-right:10px;">送信者ID</th> --}}
                        <th style="padding-left:10px; padding-right:10px;">送信者名</th>
                        <th style="padding-left:10px; padding-right:10px;">タイトル</th>
                        <th style="padding-left:10px; padding-right:10px;">通知日時</th>
                        <th style="padding-left:10px; padding-right:10px;">状態</th>
                    </tr>
                @foreach($notifications as $notification)
@if($notification->read_at)
                    <tr>
@else
                    <tr style="font-weight:bold; background-color:lemonchiffon;">
@endif
                        {{-- <td style="padding-left:10px; padding-right:10px;">{{$notification->number}}</td> --}}
                        @if($notification->category == 'contact')
                            <td style="padding-left:10px; padding-right:10px;">お問い合わせ</td>
                        @elseif($notification->category == 'diary')
                            <td style="padding-left:10px; padding-right:10px;">日記</td>
                        @elseif($notification->category == 'aibo')
                            <td style="padding-left:10px; padding-right:10px;">お友達</td>
                        @else
                            <td style="padding-left:10px; padding-right:10px;">その他</td>
                        @endif
                        {{-- <td style="padding-left:10px; padding-right:10px;">{{$notification->send_user_id}}</td> --}}
                        <td style="padding-left:10px; padding-right:10px;">{{$notification->owner_name}}<sub>さん</sub></td>
                        <td style="padding-left:10px; padding-right:10px;"><a href="{{ route('notification.redirect', $notification->number) }}">{{$notification->title}}</td>
                        <td style="padding-left:10px; padding-right:10px;">{{$notification->created_datetime}}</td>
@if($notification->read_at)
                        <td style="padding-left:10px; padding-right:10px;">-</td>
@else
                        <td style="padding-left:10px; padding-right:10px;">未</td>
@endif
                    </tr>
                @endforeach
                </table>

                <hr>

                ▼ページネーション▼
                <table width="60%" style="margin:auto;">
                    <tr>
                        <td width="15%" style="text-align:center;"><a href="{{$notifications->previousPageUrl()}}">Prev</a></td>
                        <td width="70%" style="text-align:center;">
                            <div class="pagenation-select">
                            <select>
                                @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                <option value="{{$notifications->url($i)}}" @if($i == $notifications->currentPage()) selected @endif>{{$i}}ページ目/全{{$notifications->lastPage()}}ページ</option>
                                @endfor
                            </select>
                            </div>
                        </td>
                        <td width="15%" style="text-align:center;"><a href="{{$notifications->nextPageUrl()}}">Next</a></td>
                    </tr>
                </table>


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
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script>
$('.pagenation-select select').change(function(){
    location.href = $(this).val();
});
</script>
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
                <div class="card-header">通知一覧（未読：{{$bell_count}}件）</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th style="padding-left:10px; padding-right:10px;">通知ID</th>
                            <th style="padding-left:10px; padding-right:10px;">カテゴリ</th>
                            <th style="padding-left:10px; padding-right:10px;">送信者ID</th>
                            <th style="padding-left:10px; padding-right:10px;">送信者名</th>
                            <th style="padding-left:10px; padding-right:10px;">タイトル</th>
                            <th style="padding-left:10px; padding-right:10px;">通知日時</th>
                            <th style="padding-left:10px; padding-right:10px;">状態</th>
                        </tr>
                    @foreach($notifications as $notification)
@if($notification->read_at)
                        <tr>
@else
                        <tr style="font-weight:bold; background-color:lemonchiffon;">
@endif
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->number}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->category}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->send_user_id}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->owner_name}}</td>
                            <td style="padding-left:10px; padding-right:10px;"><a href="{{ route('notification.redirect', $notification->number) }}">{{$notification->title}}</td>
                            <td style="padding-left:10px; padding-right:10px;">{{$notification->created_datetime}}</td>
@if($notification->read_at)
                            <td style="padding-left:10px; padding-right:10px;">-</td>
@else
                            <td style="padding-left:10px; padding-right:10px;">未</td>
@endif
                        </tr>
                    @endforeach
                    </table> --}}

                    {{-- {{$notifications->onEachSide(1)->links()}} --}}
                    {{-- <hr>
                    ▼ページネーション▼
                    <table width="60%" style="margin:auto;">
                        <tr>
                            <td width="15%" style="text-align:center;"><a href="{{$notifications->previousPageUrl()}}">Prev</a></td>
                            <td width="70%" style="text-align:center;">
                                <div class="pagenation-select">
                                <select>
                                    @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                    <option value="{{$notifications->url($i)}}" @if($i == $notifications->currentPage()) selected @endif>{{$i}}ページ目/全{{$notifications->lastPage()}}ページ</option>
                                    @endfor
                                </select>
                                </div>
                            </td>
                            <td width="15%" style="text-align:center;"><a href="{{$notifications->nextPageUrl()}}">Next</a></td>
                        </tr>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                    <script>
                    $('.pagenation-select select').change(function(){
                        location.href = $(this).val();
                    });
                    </script>
                    <hr>
                    
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
