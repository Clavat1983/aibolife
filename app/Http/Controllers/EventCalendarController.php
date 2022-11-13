<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCalendar;
use App\Models\Notification;

class EventCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //年月のチェック
                //1.いつ？（クエリパラメータの取得＆設定）
                $target_year = $request->year; //クエリパラメータから取得
                $target_month = $request->month; //クエリパラメータから取得

                if(is_null($target_year) || is_null($target_month)){ //年月指定なし
                    //現在の年月とする
                    $target_year = date('Y');
                    $target_month = date('n');//前ゼロなし
                }

                //パラメータのチェック
                if(preg_match('/^[0-9]{4}$/u', $target_year) && preg_match('/^[1-9]{1}$|[1]{1}[0-2]{1}$/u', $target_month)){
                    $target = $target_year.'-'.sprintf('%02d', $target_month).'-01';//表示する年月
                } else {
                    abort(403);
                }


            $events = EventCalendar::orderBy('event_start_datetime')->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('eventcalendar.index', compact('bell_count','target','events'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
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
