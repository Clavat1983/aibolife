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

                    <form method="post" action="{{route('behavior.share_store')}}">
                        @csrf

                        登録するaibo選択<br>
                        1匹の場合はhidden、2匹以上いる場合はselect<br>
                        <br>
                        説明文編集可、写真などアップ化<br>
                        <br>
                        <br>
                        <hr/>
                        ［ふるまいの名前］ *変更不可<br>
                        {{$code_ary[0]}}
                        <hr/>
                        ［ふるまいのURL］ *変更不可<br>
                        {{$code_ary[1]}}
                        <hr/>
                        ［ふるまいの説明］ *変更可能（変更は「My aibo」には反映されず、「aibo life」に表示する説明文にのみ反映されます）<br>
                        @php
                            $behavior_info = "";
                            for ($i = 2; $i < count($code_ary); $i++){
                                if($code_ary[$i] != ""){
                                    if($i >= 3){
                                        $behavior_info .= "\n";//次の行
                                    }
                                    $behavior_info .= $code_ary[$i];
                                }
                            }
                        @endphp
                        <textarea name="behavior_info" id="behavior_info" cols="50" rows="10">{!!e($behavior_info)!!}</textarea>
                        
                        <hr/>

                        <table>
                            <tr>
                                <td width="33.3%" style="text-align:center;">
                                    <a href="{{route('behavior.share_create')}}"><button type="button" class="btn btn-info">戻る</button></a><br>
                                    (読み込み内容は破棄されます)
                                </td>
                                <td width="33.3%" style="text-align:center;">
                                   <button type="submit" class="btn btn-success">登録</button>
                                </td>
                                <td width="33.3%" style="text-align:center;">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-body">
                    <a href="{{route('behavior.share_index')}}"><button>ふるまい共有に戻る</button></a>
                    <br>
                    <br>
                    <a href="{{route('home')}}"><button>トップに戻る</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
