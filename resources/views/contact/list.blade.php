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
                    <p style="text-align:right;"><a href="{{route('contact.create')}}">新規お問い合わせ</a></p>

                    <table width="100%">
                        <caption style="caption-side:top;">お問い合わせ履歴（過去15日間）</caption>
                        <tr>
                            <td>あああ</td>
                            <td>いいい</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection