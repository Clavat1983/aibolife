<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\Diary;
use App\Models\DiaryReaction;
use App\Models\Notification;
use Carbon\Carbon; //日付操作
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //画像削除用

class DiaryController extends Controller
{
    public function index()
    {
        //「aibo日記」のトップページは廃止。今日の一覧へ転送するように変更。
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            // if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //     $diaries = Diary::orderBy('id', 'desc')->limit(6)->get();

            //     //【全ビュー共通処理】未読通知数
            //     $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            //     return view('diary.index',compact('bell_count','diaries'));
            // } else { //aibo登録まで完了していないと閲覧不可
            //     return redirect()->route('errors.limited');
            // }

        return redirect()->route('diary.list_day');
    }

    public function list_day(Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
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
                $aibos_id=Aibo::select('id')->where('owner_id', $owner->id)->where('aibo_available_flag', true)->get();
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

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.list_day', compact('bell_count', 'owner','my_diaries','other_diaries','before_flag','after_flag','before_string','target_string','target_string_format','after_string'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }


    public function list_aibo(Request $request) //クエリパラメータに日付指定ありでも表示できるようにする
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $aibo_id = $request->aibo; //クエリパラメータから取得
            $aibo=Aibo::where('aibo_available_flag', true)->where('id', $aibo_id)->first();
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


                //2. 過去の日記
                    //1.いつ？（クエリパラメータの取得＆設定）
                    $target_year = $request->year; //クエリパラメータから取得
                    $target_month = $request->month; //クエリパラメータから取得
                    $target_exist_flag = true;

                    if(is_null($target_year) || is_null($target_month)){ //年月指定なし
                        //現在の年月とする
                        $target_year = date('Y');
                        $target_month = date('n');//前ゼロなし
                        $target_exist_flag = false; //年月指定なし
                    }

                    //パラメータのチェック
                    if(preg_match('/^[0-9]{4}$/u', $target_year) && preg_match('/^[1-9]{1}$|[1]{1}[0-2]{1}$/u', $target_month)){
                        $target = $target_year.'-'.sprintf('%02d', $target_month).'-01';//表示する年月
                    } else {
                        abort(403);
                    }

                    // $to_string = $today_carbon->toDateString(); //「2022-03-26」のような文字
                    // $from_string = $aibo->aibo_birthday; //aiboの誕生日
                    // $archive = Diary::where('aibo_id', $aibo_id)->whereBetween('diary_date', [$from_string, $to_string])->orderby('diary_date', 'DESC')->get();
                    $archives = Diary::where('aibo_id', $aibo_id)->orderby('diary_date', 'DESC')->get();

                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('diary.list_aibo', compact('bell_count','aibo', 'target_exist_flag','this_week', 'target', 'archives'));
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    //最近の日記
    public function recently(){
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //3日以内に書かれた日記を新しい順に取得
            $target_carbon = Carbon::now()->subDay(3);
            $diaries = Diary::orderBy('id', 'desc')->where('created_at','>=', $target_carbon->format('Y-m-d H:i:s'))->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.recently', compact('bell_count','diaries'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    //過去の日記
    public function archive(Request $request){
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //1.いつ？（クエリパラメータの取得＆設定）
            $target_year = $request->year; //クエリパラメータから取得
            $target_month = $request->month; //クエリパラメータから取得

            if(is_null($target_year) || is_null($target_month)){ //年月指定なし
                //現在の年月とする
                $target_year = date('Y');
                $target_month = date('n');//前ゼロなし
            }

            //現在の年月
            $now_year = date('Y');
            $now_month = date('n');//前ゼロなし

            //パラメータのチェック
            if(preg_match('/^[0-9]{4}$/u', $target_year) && preg_match('/^[1-9]{1}$|[1]{1}[0-2]{1}$/u', $target_month)){
            //カーボン作成
                //今日
                $today_carbon = new Carbon('today');
                //指定年月(の1日)
                $target_str = $target_year.'-'.sprintf('%02d', $target_month).'-01';
                $target_carbon = new Carbon($target_str);
                //日記の開始年月(2018-01-01) *1/11ではなく月なので1/1とする
                $start_carbon = new Carbon('2018-01-01');
                //指定年月-1ヵ月
                $before_carbon = $target_carbon->copy()->subMonths(1);
                //指定年月+1ヵ月
                $next_carbon = $target_carbon->copy()->addMonths(1);
            } else {
                abort(403);
            }

            //年月のチェック(2018年1月より小さい か 未来だとNG)
            if($target_carbon->lt($start_carbon) || $target_carbon ->isFuture()){
                abort(403);
            } else { //正常な年月
                // 月末日を取得
                $last_day = date('j', mktime(0, 0, 0, $target_month + 1, 0, $target_year));
                
                $calendar = array();
                $j = 0;
                
                // 月末日までループ
                for ($i = 1; $i < $last_day + 1; $i++) {
                    // 曜日を取得
                    $week = date('w', mktime(0, 0, 0, $target_month, $i, $target_year));
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
                    if($target_year == date('Y') && $target_month == date('n') && $i>date('j')){ //今月で明日以降だったら
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

                //日記取得
                $date_from = $target_carbon->toDateString();
                $date_to = $target_carbon->endOfMonth()->toDateString();
                $diaries = Diary::select('diary_date')->selectRaw('count(diary_date) as count')->where('diary_share_flag', 1)->whereBetween('diary_date', [$date_from, $date_to])->groupBy('diary_date')->get();

                //戻り値調整
                $before_year = $before_carbon->year;
                $before_month = $before_carbon->month;
                $before_flg = $before_carbon->gte($start_carbon);//日記開始日(2018-01)より後か
                $next_year = $next_carbon->year;
                $next_month = $next_carbon->month;
                $next_flg = $next_carbon->isPast();//来月が過去か

                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('diary.archive', compact('bell_count','before_year','before_month','before_flg','target_year','target_month','next_year','next_month','next_flg','calendar','diaries'));
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    //検索
    public function search(Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //検索条件を取得
            $keywords = $request->keywords;
            $diary_date_from = $request->diary_date_from;
            $diary_date_to = $request->diary_date_to;
            $aibo_name = $request->aibo_name;

            $search_flag = false;

            //検索（カタカナや濁点まで区別する場合は「like」を「like BINARY」へ変更すること）
            $query = Diary::query();
            $query = $query->select(DB::raw("diaries.*, aibos.aibo_name"));//ownewsのidを取ってこないようにするため
            $query = $query->leftJoin('aibos', 'diaries.aibo_id', '=', 'aibos.id');

            if(isset($keywords)){
                $search_flag = true;
                $keyword_array =  preg_split('/\s+/ui', $keywords, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($keyword_array as $word) {
                    $escape_word = addcslashes($word, '\\_%');//エスケープ処理
                    $query = $query->where(DB::raw("CONCAT(diary_title, ' ', diary_body)"), 'like', '%' . $escape_word . '%');//like検索、タイトルの文字列と本文の文字列を半角スペース「 」で連結して1つのカラムとして検索
                }
            }
            if(isset($diary_date_from)){
                $search_flag = true;
                $query = $query->where('diary_date', '>=' ,$diary_date_from);
            }
            if(isset($diary_date_to)){
                $search_flag = true;
                $query = $query->where('diary_date', '<=', $diary_date_to);
            }
            if(isset($aibo_name)){
                $search_flag = true;
                $aibo_name = addcslashes($aibo_name, '\\_%');//エスケープ処理
                $query = $query->where(DB::raw("CONCAT(aibo_name, '|', aibo_kana)"), 'like', '%' . $aibo_name . '%');//like検索、aibo名とaibo名(よみ)の文字列を半角「|」で連結して1つのカラムとして検索
            }
            $query->where('aibo_available_flag', true)->where('diary_share_flag', true)->orderby('diary_date','desc')->orderby('id');
            $results = $query->paginate(10); //クエリ文字列(検索キーワード)をつけて返す

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.search',compact('bell_count','search_flag', 'results', 'keywords','diary_date_from','diary_date_to','aibo_name'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
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
                    $aibo=Aibo::where('id', $aibo_id)->where('owner_id', $owner->id)->where('aibo_available_flag', true)->first();
                    if($aibo === NULL){ //自分のaiboではないなら
                        abort(403); //エラーページへ転送
                    }

                    //誕生日以降かチェック
                    $date_carbon = new Carbon($date);
                    $birthday_carbon = new Carbon($aibo->aibo_birthday);
                    if($date_carbon->lt($birthday_carbon)){ //指定日 < 誕生日なら
                        abort(403); //エラーページへ転送
                    }

                    //明日以降ならNG(未来の日記は書けない)
                    $tomorrow_carbon = Carbon::tomorrow('Asia/Tokyo');
                    if($date_carbon->gte($tomorrow_carbon)){ //指定日 > 明日なら
                        abort(403); //エラーページへ転送
                    }
                    

                //まだ書いていないか確認
                $diary = Diary::where('aibo_id', $aibo_id)->where('diary_date', $date)->first();

                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                if($diary === NULL){ //まだ書いていない
                    return view('diary.create' , compact('bell_count','aibo','date'));//新規投稿へ
                } else { //既に書いている
                    return redirect()->route('diary.edit', ['diary' => $diary])->with('bell_count', $bell_count);//該当の日記の編集画面へ
                }
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
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

        //【全ビュー共通処理】未読通知数
        //$bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return redirect()->route('diary.show',['diary' => $diary]);//書いた日記の個別表示へ
        //return redirect()->route('diary.show',['diary' => $diary])->with('bell_count', $bell_count); //書いた日記の個別表示へ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //既に自分が何かリアクションをつけているか
            $my_reaction = DiaryReaction::where('diary_id', $diary->id)->where('owner_id', auth()->user()->owner->id)->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.show', compact('my_reaction','bell_count','diary'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $this->authorize('update', $diary); //ポリシー適用(自分だけ編集可能)

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.edit', compact('bell_count','diary'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
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
            'diary_photo1_del' => '',
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
        ////$diary = new Diary();
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

        //画像の削除フラグ確認
        $del_flg = 0;//削除したかどうか
        $checkbox_diary_photo1_del = 0; //削除チェックボックスの値
        if(isset($inputs['diary_photo1_del'])){ //非表示の時は取得できないのでisset
            $checkbox_diary_photo1_del = $inputs['diary_photo1_del'];
        }
        if ($diary->diary_photo1!=='default.jpg' &&  $checkbox_diary_photo1_del == '1') {
            $old='public/diary_photo/'.$diary->diary_photo1;
            Storage::delete($old);
            $diary->diary_photo1 = NULL; //デフォルト(NULL)をセット
            $del_flg = 1;//削除後
        }

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

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //今書いた日記を取り出して、表示画面へ転送
        //$diary = Diary::where('aibo_id', $inputs['aibo_id'])->where('diary_date', $inputs['diary_date'])->first();
        //return redirect()->route('diary.show',['diary' => $diary])->with('bell_count', $bell_count); //書いた日記の個別表示へ
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
