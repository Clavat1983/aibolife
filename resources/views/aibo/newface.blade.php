@extends('layouts.app')

@section('notification')
    {{$bell_count}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新しいお友達(7日以内)</div>
                <div class="card-body">
                    @if(count($aibos)>0)
                        @foreach ($aibos as $aibo)
                            {{$aibo->aibo_name}}<br>
                        @endforeach
                    @else
                        いません
                    @endif
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('aibo.index')}}"><button type="button">aibo名鑑に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
