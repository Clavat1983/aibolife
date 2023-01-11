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
              <p class="c-category-title c-category-title--topics">
                <span class="c-category-title__en">Contact</span>
                <span class="c-category-title__jp">お問い合わせ</span>
              </p>
            </div>
            <div class="l-content__body">

                <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>

                <table width="100%">
                    <caption style="caption-side:top;">お問い合わせ履歴</caption>
                    <tr>
                        <th>ID</th>
                        <th>親番</th>
                        <th>カテゴリー</th>
                        <th>タイトル</th>
                        <th>お問い合わせ日時</th>
                        <th>最終更新日時</th>
                        <th>返信数</th>
                        <th>状態</th>
                    </tr>
                    @foreach ($contacts as $contact)
                    <tr>
                        {{-- <td>{{count($contacts) - $loop->index}}</td> --}}
                        <td>{{$contact->id}}</td>
                        <td>{{$contact->parent_no}}</td>
                        <td>{{$contact->category}}</td>
                        <td><a href="{{route('contact.show', $contact)}}">{{$contact->title}}</a></td>
                        <td>{{$contact->created_at}}</td>
                        <td>{{$contact->updated_at}}</td>
                        <td>{{$contact->child_no}}</td>
                        @if($contact->reply_flag === 0)
                        <td><span style="color:red">未回答</span></td>
                        @else
                        <td>回答済</td>
                        @endif
                    </tr>
                    @endforeach
                </table>

                <hr>
                
                ▼ページネーション▼
                <table width="60%" style="margin:auto;">
                    <tr>
                        <td width="15%" style="text-align:center;"><a href="{{$contacts->previousPageUrl()}}">Prev</a></td>
                        <td width="70%" style="text-align:center;">
                            <div class="pagenation-select">
                            <select>
                                @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                                <option value="{{$contacts->url($i)}}" @if($i == $contacts->currentPage()) selected @endif>{{$i}}ページ目/全{{$contacts->lastPage()}}ページ</option>
                                @endfor
                            </select>
                            </div>
                        </td>
                        <td width="15%" style="text-align:center;"><a href="{{$contacts->nextPageUrl()}}">Next</a></td>
                    </tr>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
                <script>
                $('.pagenation-select select').change(function(){
                    location.href = $(this).val();
                });
                </script>

                <hr>
                <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                <br>
                <br>

                <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>


                
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
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お問い合わせ（一覧）</div>

                <div class="card-body">
                    <p style="text-align:right;"><a href="{{route('contact.new')}}">新規お問い合わせ</a></p>

                    <table width="100%">
                        <caption style="caption-side:top;">お問い合わせ履歴</caption>
                        <tr>
                            <th>ID</th>
                            <th>親番</th>
                            <th>カテゴリー</th>
                            <th>タイトル</th>
                            <th>お問い合わせ日時</th>
                            <th>最終更新日時</th>
                            <th>返信数</th>
                            <th>状態</th>
                        </tr>
                        @foreach ($contacts as $contact)
                        <tr>
                            <!---- <td>{{count($contacts) - $loop->index}}</td> -->
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->parent_no}}</td>
                            <td>{{$contact->category}}</td>
                            <td><a href="{{route('contact.show', $contact)}}">{{$contact->title}}</a></td>
                            <td>{{$contact->created_at}}</td>
                            <td>{{$contact->updated_at}}</td>
                            <td>{{$contact->child_no}}</td>
                            @if($contact->reply_flag === 0)
                            <td><span style="color:red">未回答</span></td>
                            @else
                            <td>回答済</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    <br>
                            <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>

</div>
@endsection --}}