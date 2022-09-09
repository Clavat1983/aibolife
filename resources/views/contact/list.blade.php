@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')

<div class="container">
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
                            @if($contact->kidoku_flag === 0)
                            <td>未読あり</td>
                            @else
                            <td>未読なし</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection