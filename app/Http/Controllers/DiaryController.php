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


    public function list_day(Request $request)
    {
        //1.いつ？（クエリパラメータの取得＆設定）
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

        //2.自分のaiboの日記を取得
            $user_id=auth()->user()->id;
            $owner=Owner::where('user_id', $user_id)->first();
            $aibos_id=Aibo::select('id')->where('owner_id', $owner->id)->get();
            $my_diaries = Diary::where('diary_date', $target_string)->whereIn('aibo_id', $aibos_id)->get();

        //3.他人のaiboの日記を取得(自分のaibo以外)
            $other_diaries = Diary::where('diary_date', $target_string)->whereNotIn('aibo_id', $aibos_id)->get();

        //4.前日・翌日のリンク処理
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

        return view('diary.list_day', compact('owner','my_diaries','other_diaries','before_flag','after_flag','before_string','target_string','target_string_format','after_string'));
    }


    public function list_aibo(Request $request) //クエリパラメータに日付指定ありでも表示できるようにする
    {
        $aibo_id = $request->aibo; //クエリパラメータから取得
        $aibo=Aibo::where('id', $aibo_id)->first();
        if($aibo==null){
            abort(404); //エラーページへ転送
        }else{
            //1.今週（7日間）の日記
                //1-1.今週（7日間）の保管用配列作成
                $this_week = [];
                $timestamp = time();
                for ($i = 0 ; $i < 7 ; $i++) {
                    $date = date('Y-m-d', $timestamp);
                    $this_week[$date] = NULL; //取りあえず空で
                    $timestamp -= 24 * 3600; //24時間ずつ引く
                }

                //1-2.今週(7日間)の日記を取得
                $today_carbon = new Carbon('today');
                $to_string = $today_carbon->toDateString(); //「2022-03-26」のような文字
                $from_string = $today_carbon->copy()->subDays(7)->toDateString(); //7日前「2022-03-26」のような文字
                $diaries = Diary::where('aibo_id', $aibo_id)->whereBetween('diary_date', [$from_string, $to_string])->get();

                //1-3.配列に対象の日記(オブジェクト)を保管
                foreach($this_week as $date => $value)
                    if($diaries->contains('diary_date', $date)){ //その日に書かれている日記があるか(true/falseしかわからない)
                        foreach($diaries as $diary) { //日記の数だけループ
                            if($diary->diary_date == $date) { //その日に書かれている日記があれば
                                $this_week[$date] = $diary; //配列にその日記のオブジェクトごと保管
                            }
                    }
                }

        /*
            //2.過去の年月アーカイブ(年月-件数)

                //2-1.誕生月～今月までの日記「月別カウント用」配列を作る
                $begin_y = substr($aibo->aibo_birthday,0,4); //「2019」みたいな感じ
                $begin_ym = $begin_y.substr($aibo->aibo_birthday,5,2); //「201904」みたいな感じ
                $year = date('Y'); //今年
                
                $archive_count = [];
                while($year >= $begin_y) {
                    for ($month = 12; $month >= 1; $month--) {
                        if (sprintf('%04d%02d', $year, $month) > date('Ym') || sprintf('%04d%02d', $year, $month) < date($begin_ym)) {
                            //今月より後の月は表示しない
                        }
                        else {
                            $archive_count[$year][sprintf('%02d',$month)] = 0;
                        }
                    }
                    $year--;//増やしているのを減らす
                }

                //2-2.月ごとの件数を保管
                    //そのaiboの日記全件を取得
                    $diaries = Diary::where('aibo_id', $aibo_id)->get();

                    foreach($diaries as $diary){
                        $year = substr($diary->diary_date,0,4);
                        $month = substr($diary->diary_date,5,2);
                        $archive_count[$year][$month]++;
                    }
            */
            
            return view('diary.list_aibo', compact('aibo','this_week'));
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
