<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\Diary;
use Carbon\Carbon; //日付操作

class DiaryController extends Controller
{
    public function index()
    {
        $user_id=auth()->user()->id;
        $owner=Owner::where('user_id', $user_id)->first();
        return view('diary.index', compact('owner')); //aibo一覧を表示するため
    }


    public function list_day(Request $request) //クエリパラメータに日付指定ありでも表示できるようにする
    {
        $target = $request->date; //クエリパラメータから取得

        //今日
        $today_carbon = new Carbon('today');
        $today_string = $today_carbon->toDateString(); //「2022-03-26」のような文字

        if(is_null($target)){ //日付指定なし
            //指定日を今日の日付にする
            $target_carbon = $today_carbon->copy();
            $target_string = $target_carbon->toDateString();
            $target_string_format = $target_carbon->isoFormat('YYYY年MM月DD日（ddd）');
        } else { //日付指定あり
            
            //日付の判定
                $preg = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/'; //数字4桁-数字2桁-数字2桁か
                if(!preg_match($preg, $target)) {
                    abort(403); //エラーページへ転送
                }
                $Y = substr($target,0,4);
                $m = substr($target,5,2);
                $d = substr($target,8,2);
                if (checkdate($m, $d, $Y) === false) { //日付の形式か
                    abort(403); //エラーページへ転送
                }

            //指定日
            $target_carbon = new Carbon($target); 
            $target_string = $target_carbon->toDateString();
            $target_string_format = $target_carbon->isoFormat('YYYY年MM月DD日（ddd）');

        }

        //日記の開始日(2018-01-11)
        $start_carbon = new Carbon('2018-01-11');

        //未来ならNG
        if($target_carbon->lt($start_carbon) || $target_carbon ->isFuture()){
            abort(403);
        }

        //前日と翌日
        $before_string = $target_carbon->copy()->subDays(1)->toDateString();
        $after_string = $target_carbon->copy()->addDays(1)->toDateString();

        //前日・翌日の判定
        $before_flag = true;
        $after_flag = true;
        if($target_carbon->eq($start_carbon)){ //日記の開始日(2018-01-11)なら前日はない
            $before_flag = false;
        }
        if($target_carbon->eq($today_carbon)){ //今日なら翌日はない
            $after_flag = false;
        }

        return view('diary.list_day', compact('before_flag','after_flag','before_string','target_string_format','after_string'));
    }


    public function list_aibo(Request $request) //クエリパラメータに日付指定ありでも表示できるようにする
    {
        $aibo_id = $request->aibo; //クエリパラメータから取得
        $aibo=Aibo::where('id', $aibo_id)->first();
        if($aibo==null){
            abort(404); //エラーページへ転送
        }else{
            $today_carbon = new Carbon('today');
            $to_string = $today_carbon->toDateString(); //「2022-03-26」のような文字
            $from_string = $today_carbon->copy()->subDays(7)->toDateString(); //7日前「2022-03-26」のような文字

            $diaries = Diary::where('aibo_id', $aibo_id)->whereBetween('diary_date', [$from_string, $to_string])->get();

            //7日間
            $calendar = [];
            $timestamp = time();
            for ($i = 0 ; $i < 7 ; $i++) {
                $calendar['days'][] = date('Y-m-d', $timestamp);
                $timestamp -= 24 * 3600;
            }


            return view('diary.list_aibo', compact('aibo','diaries','calendar'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
