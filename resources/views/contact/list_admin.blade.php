@extends('layouts.app')

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
                    <br>
                            <a href="{{route('home')}}"><button type="button">トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p style="background-color:black; color:yellow; text-align:center;">【管理者専用ページ】</p>

</div>
@endsection