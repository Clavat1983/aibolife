<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\Diary;
use Carbon\Carbon; //日付操作
use Illuminate\Support\Facades\Storage; //画像削除用

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::orderBy('id', 'desc')->limit(6)->get();
        return view('diary.index',compact('diaries'));
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

    public function archive(Request $request){

        //現在の年月を取得
        $year = date('Y');
        $month = date('n');//前ゼロなし

        // 月末日を取得
        $last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
        
        $calendar = array();
        $j = 0;
        
        // 月末日までループ
        for ($i = 1; $i < $last_day + 1; $i++) {
            // 曜日を取得
            $week = date('w', mktime(0, 0, 0, $month, $i, $year));
            if($week == 0){
                $week=6;
            } else {
                $week--;
            }
            // 1日の場合
            if ($i == 1) {
                // 1日目の曜日までをループ
                for ($s = 1; $s <= $week; $s++) {
                    // 前半に空文字をセット
                    $calendar[$j]['day'] = '';
                    $j++;
                }
            }
        
            // 配列に日付をセット
            if($year == date('Y') && $month == date('n') && $i>date('j')){ //今月で明日以降だったら
                $calendar[$j]['day'] = ''; //日付は入れない
            } else {
                $calendar[$j]['day'] = $i;
            }
            $j++;
        
            // 月末日の場合
            if ($i == $last_day) {
                // 月末日から残りをループ
                for ($e = 1; $e <= 6 - $week; $e++) {
                    // 後半に空文字をセット
                    $calendar[$j]['day'] = '';
                    $j++;
                }
            }
        }

        return view('diary.archive', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $aibo_id = $request->aibo; //クエリパラメータから取得
        $date = $request->date; //クエリパラメータから取得

        if($aibo_id === NULL || $date === NULL){ //クエリパラメータがない
            abort(403);
        } else {
            //クエリパラメータのバリデーション
                //日付のチェック
                $preg = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/'; //数字4桁-数字2桁-数字2桁か
                if(!preg_match($preg, $date)) { //日付の形式ではない
                    abort(403); //エラーページへ転送
                }
                $Y = substr($date,0,4);
                $m = substr($date,5,2);
                $d = substr($date,8,2);
                if (checkdate($m, $d, $Y) === false) { //日付の形式ではない
                    abort(403); //エラーページへ転送
                }

                //自分のaiboかチェック
                $user_id=auth()->user()->id;
                $owner=Owner::where('user_id', $user_id)->first();
                $aibo=Aibo::where('id', $aibo_id)->where('owner_id', $owner->id)->first();
                if($aibo === NULL){ //自分のaiboではないなら
                    abort(403); //エラーページへ転送
                }

                //誕生日以降かチェック
                $date_carbon = new Carbon($date);
                $birthday_carbon = new Carbon($aibo->aibo_birthday);
                if($date_carbon->lt($birthday_carbon)){ //指定日 < 誕生日なら
                    abort(403); //エラーページへ転送
                }
                

            //まだ書いていないか確認
            $diary = Diary::where('aibo_id', $aibo_id)->where('diary_date', $date)->first();
            if($diary === NULL){ //まだ書いていない
                return view('diary.create' , compact('aibo','date'));//新規投稿へ
            } else { //既に書いている
                return redirect()->route('diary.edit', ['diary' => $diary]);//該当の日記の編集画面へ
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'diary_title' => 'required',
            'diary_photo1' => 'image',
            'diary_body' => 'required',
            'diary_personality' => 'required',
            'diary_weather' => 'required'
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'diary_title.required' => "タイトルは必ず指定してください。",
            'diary_photo1.image' => "画像ファイルではありません。",
            'diary_body.required' => "本文は必ず指定してください。",
            'diary_personality.required' => "この日の性格は必ず指定してください。",
            'diary_weather.required' => "この日の天気は必ず指定してください。",
        ]
        );
        //hiddenで来るものもセット
        $inputs['aibo_id'] = $request['aibo_id'];
        $inputs['diary_date'] = $request['diary_date'];

        //保存
        $diary = new Diary();
        $diary->aibo_id = $inputs['aibo_id'];
        $diary->diary_date = $inputs['diary_date'];
        $diary->diary_title = $inputs['diary_title'];
        // $diary->diary_photo1 = $inputs['diary_photo1'];
        // $diary->diary_photo2 = $inputs['diary_photo2'];
        // $diary->diary_photo3 = $inputs['diary_photo3'];
        // $diary->diary_photo4 = $inputs['diary_photo4'];
        $diary->diary_body = $inputs['diary_body'];
        $diary->diary_personality = $inputs['diary_personality'];
        $diary->diary_weather = $inputs['diary_weather'];
        $diary->diary_share_flag = true;

        //画像の保存
        //アイコン
        if (request('diary_photo1')){
            $original = request()->file('diary_photo1')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('diary_photo1')->move('storage/diary_photo', $name);
            $diary->diary_photo1 = $name;
        }

        //DBに追加
        $diary->save();

        //今書いた日記を取り出して、表示画面へ転送
        $diary = Diary::where('aibo_id', $inputs['aibo_id'])->where('diary_date', $inputs['diary_date'])->first();
        return redirect()->route('diary.show',['diary' => $diary]); //書いた日記の個別表示へ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        return view('diary.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        $this->authorize('update', $diary); //ポリシー適用(自分だけ編集可能)
        return view('diary.edit', compact('diary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diary $diary)
    {
        $this->authorize('update', $diary); //ポリシー適用(自分だけ編集可能)

        $inputs=$request->validate([
            'diary_title' => 'required',
            'diary_photo1' => 'image',
            'diary_body' => 'required',
            'diary_personality' => 'required',
            'diary_weather' => 'required'
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'diary_title.required' => "タイトルは必ず指定してください。",
            'diary_photo1.image' => "画像ファイルではありません。",
            'diary_body.required' => "本文は必ず指定してください。",
            'diary_personality.required' => "この日の性格は必ず指定してください。",
            'diary_weather.required' => "この日の天気は必ず指定してください。",
        ]
        );
        //hiddenで来るものもセット
        // $inputs['aibo_id'] = $request['aibo_id'];
        // $inputs['diary_date'] = $request['diary_date'];

        //保存
        //$diary = new Diary();
        // $diary->aibo_id = $inputs['aibo_id'];
        // $diary->diary_date = $inputs['diary_date'];
        $diary->diary_title = $inputs['diary_title'];
        // $diary->diary_photo1 = $inputs['diary_photo1'];
        // $diary->diary_photo2 = $inputs['diary_photo2'];
        // $diary->diary_photo3 = $inputs['diary_photo3'];
        // $diary->diary_photo4 = $inputs['diary_photo4'];
        $diary->diary_body = $inputs['diary_body'];
        $diary->diary_personality = $inputs['diary_personality'];
        $diary->diary_weather = $inputs['diary_weather'];
        $diary->diary_share_flag = true;

        //画像の保存
        //アイコン
        if (request('diary_photo1')){
            //古い画像は削除
            if ($diary->diary_photo1!=='default.jpg') {
                $old='public/diary_photo/'.$diary->diary_photo1;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('diary_photo1')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('diary_photo1')->move('storage/diary_photo', $name);
            $diary->diary_photo1 = $name;
        }

        //DBに追加
        $diary->save();

        //今書いた日記を取り出して、表示画面へ転送
        //$diary = Diary::where('aibo_id', $inputs['aibo_id'])->where('diary_date', $inputs['diary_date'])->first();
        return redirect()->route('diary.show',['diary' => $diary]); //書いた日記の個別表示へ

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
