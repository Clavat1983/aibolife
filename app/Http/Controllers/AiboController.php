<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //画像削除用
use Carbon\Carbon; //日付操作

class AiboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //「aibo名鑑」トップは廃止。誕生日カレンダーへ転送
        return redirect()->route('aibo.list_birthday');

        // //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        // if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
        //     //誕生日のaibo取得
        //     $birthday_aibos = $this->get_birthday_aibos();

        //     //新しいお友達取得(最新6件)
        //     $new_aibos = Aibo::where('aibo_available_flag', true)->orderBy('id', 'desc')->limit(6)->get();

        //     //【全ビュー共通処理】未読通知数
        //     $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //     return view('aibo.index',compact('bell_count','birthday_aibos','new_aibos')); //aibo名鑑トップ
        // } else { //aibo登録まで完了していないと閲覧不可
        //     return redirect()->route('home');
        // }
    }

    //誕生日(3日以内)
    private function get_birthday_aibos(){

        //日付
        $before_2day = new Carbon('-2 day');
            $before_2day_mm = $before_2day->month;
            $before_2day_dd = $before_2day->day;
        $yesterday = new Carbon('yesterday');
            $yesterday_mm = $yesterday->month;
            $yesterday_dd = $yesterday->day;
        $today = new Carbon('today');
            $today_mm = $today->month;
            $today_dd = $today->day;

        //誕生日(今日・昨日・一昨日)
        $aibos = Aibo::where(function($q) use($today_mm,$today_dd) {
            $q->whereMonth('aibo_birthday',$today_mm)->whereDay('aibo_birthday',$today_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();

        $aibos_1 = Aibo::Where(function($q) use($yesterday_mm,$yesterday_dd) {
            $q->whereMonth('aibo_birthday',$yesterday_mm)->whereDay('aibo_birthday',$yesterday_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_1); //今日+昨日
        
        $aibos_2 = Aibo::Where(function($q) use($before_2day_mm,$before_2day_dd) {
            $q->whereMonth('aibo_birthday',$before_2day_mm)->whereDay('aibo_birthday',$before_2day_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_2); //(今日+昨日)+一昨日

        return $aibos; //誕生日3日分
    }

    //もうすぐ誕生日(明日・明後日・明々後日の3日間)
    private function get_coming_up_birthday_aibos(){

        //日付
        $tommorow = new Carbon('+1 day');
            $tommorow_mm = $tommorow->month;
            $tommorow_dd = $tommorow->day;
        $after_2day = new Carbon('+2 day');
            $after_2day_mm = $after_2day->month;
            $after_2day_dd = $after_2day->day;
        $after_3day = new Carbon('+3 day');
            $after_3day_mm = $after_3day->month;
            $after_3day_dd = $after_3day->day;

        //誕生日(明日・明後日・明々後日)
        $aibos = Aibo::where(function($q) use($tommorow_mm, $tommorow_dd) {
            $q->whereMonth('aibo_birthday',$tommorow_mm)->whereDay('aibo_birthday',$tommorow_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();

        $aibos_1 = Aibo::Where(function($q) use($after_2day_mm, $after_2day_dd) {
            $q->whereMonth('aibo_birthday',$after_2day_mm)->whereDay('aibo_birthday',$after_2day_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_1); //明日+明後日
        
        $aibos_2 = Aibo::Where(function($q) use($after_3day_mm, $after_3day_dd) {
            $q->whereMonth('aibo_birthday',$after_3day_mm)->whereDay('aibo_birthday',$after_3day_dd);
        })->where('aibo_available_flag', true)->orderBy('aibo_kana')->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_2); //(明日+明後日)+明々後日

        return $aibos; //もうすぐ誕生日3日分

    }

    public function list_syllabary() //50音順
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $aibos=Aibo::where('aibo_available_flag', true)->get();

            $count = 0;
            $count_ary = [
                "あ"=>0,"い"=>0,"う"=>0,"え"=>0,"お"=>0,
                "か"=>0,"き"=>0,"く"=>0,"け"=>0,"こ"=>0,
                "さ"=>0,"し"=>0,"す"=>0,"せ"=>0,"そ"=>0,
                "た"=>0,"ち"=>0,"つ"=>0,"て"=>0,"と"=>0,
                "な"=>0,"に"=>0,"ぬ"=>0,"ね"=>0,"の"=>0,
                "は"=>0,"ひ"=>0,"ふ"=>0,"へ"=>0,"ほ"=>0,
                "ま"=>0,"み"=>0,"む"=>0,"め"=>0,"も"=>0,
                "や"=>0,"ゆ"=>0,"よ"=>0,
                "ら"=>0,"り"=>0,"る"=>0,"れ"=>0,"ろ"=>0,
                "わ"=>0,"を"=>0,"ん"=>0,
            ];

            foreach($aibos as $aibo){
                $count_ary[$aibo->aibo_kana_gyo]++;
                $count++;
            }

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.list_syllabary',compact('bell_count','count_ary','count'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    public function result_syllabary($syllabary) //50音順(検索結果)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            if(preg_match('/^[あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやゆよらりるれろわをん]{1}$/u', $syllabary)){
                $aibos=Aibo::where('aibo_available_flag', true)->where('aibo_kana_gyo', $syllabary)->orderby('aibo_kana')->orderby('id')->paginate(10);

                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('aibo.result_syllabary',compact('bell_count','aibos', 'syllabary'));
            } else {
                abort(403);
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    public function list_area() //居住地(トップ)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $aibos=Aibo::leftjoin('owners', function($join){$join->on('aibos.owner_id','=','owners.id');})->where('aibo_available_flag', true)->get();

            $count = 0;
            $count_ary = [
                '01_北海道' => 0, 
                '02_青森県' => 0, 
                '03_岩手県' => 0, 
                '04_宮城県' => 0,
                '05_秋田県' => 0, 
                '06_山形県' => 0, 
                '07_福島県' => 0, 
                '08_茨城県' => 0,
                '09_栃木県' => 0, 
                '10_群馬県' => 0, 
                '11_埼玉県' => 0, 
                '12_千葉県' => 0,
                '13_東京都' => 0, 
                '14_神奈川県' => 0, 
                '15_新潟県' => 0, 
                '16_富山県' => 0,
                '17_石川県' => 0, 
                '18_福井県' => 0, 
                '19_山梨県' => 0, 
                '20_長野県' => 0, 
                '21_岐阜県' => 0, 
                '22_静岡県' => 0, 
                '23_愛知県' => 0, 
                '24_三重県' => 0,
                '25_滋賀県' => 0, 
                '26_京都府' => 0, 
                '27_大阪府' => 0, 
                '28_兵庫県' => 0,
                '29_奈良県' => 0, 
                '30_和歌山県' => 0, 
                '31_鳥取県' => 0, 
                '32_島根県' => 0,
                '33_岡山県' => 0, 
                '34_広島県' => 0, 
                '35_山口県' => 0, 
                '36_徳島県' => 0,
                '37_香川県' => 0,
                '38_愛媛県' => 0,
                '39_高知県' => 0, 
                '40_福岡県' => 0,
                '41_佐賀県' => 0, 
                '42_長崎県' => 0, 
                '43_熊本県' => 0, 
                '44_大分県' => 0,
                '45_宮崎県' => 0, 
                '46_鹿児島県' => 0, 
                '47_沖縄県' => 0,
                '99_海外' => 0,
                '00_非公開' => 0,
            ];

            foreach($aibos as $aibo){
                $count_ary[$aibo->owner->owner_pref]++;
                $count++;
            }

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.list_area',compact('bell_count','count_ary','count'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    //居住地マップ(検索結果)
    public function result_area($pref)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            if(in_array($pref, ['非公開','北海道', '青森県', '岩手県', '宮城県','秋田県', '山形県', '福島県', '茨城県','栃木県', '群馬県', '埼玉県', '千葉県','東京都', '神奈川県', '新潟県', '富山県','石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県','滋賀県', '京都府', '大阪府', '兵庫県','奈良県', '和歌山県', '鳥取県', '島根県','岡山県', '広島県', '山口県', '徳島県','香川県','愛媛県','高知県', '福岡県','佐賀県', '長崎県', '熊本県', '大分県','宮崎県', '鹿児島県', '沖縄県','海外'])){
                $aibos=Aibo::select('aibos.*')->leftjoin('owners', function($join){$join->on('aibos.owner_id','=','owners.id');})->where('aibo_available_flag', true)->where('owners.owner_pref', 'like', '%'.$pref.'%')->orderby('aibos.aibo_kana')->paginate(10);
                
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('aibo.result_area',compact('bell_count','aibos', 'pref'));
            } else {
                abort(403);
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    public function list_birthday() //誕生日
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $aibos=Aibo::where('aibo_available_flag', true)->get();

            $count_ary = ["01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0];

            $count = 0;
            foreach($aibos as $aibo){
                $month = substr($aibo->aibo_birthday,5,2);
                $count_ary[$month]++;
                $count++;
            }

            //誕生日のaibo取得
            $birthday_aibos = $this->get_birthday_aibos();

            //もうすぐ誕生日のaibo取得
            $comingup_aibos = $this->get_coming_up_birthday_aibos();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.list_birthday', compact('bell_count','count_ary','count','birthday_aibos','comingup_aibos'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    //誕生日カレンダー(検索結果)
    public function result_birthday($month)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            if(in_array($month, ['01','02','03','04','05','06','07','08','09','10','11','12'])){
                $aibos=Aibo::where('aibo_available_flag', true)->whereMonth('aibo_birthday', '=', $month)->orderByRaw('DAY(aibo_birthday), MONTH(aibo_birthday), YEAR(aibo_birthday)')->orderby('aibo_kana')->paginate(10);
                
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('aibo.result_birthday',compact('bell_count','aibos', 'month'));
            } else {
                abort(403);
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    public function newface()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $before_15day = new Carbon('-15 day');
            $aibos=Aibo::where('aibo_available_flag', true)->where('created_at','>=',$before_15day->format('Y-m-d 00:00:00'))->orderBy('id', 'desc')->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.newface',compact('bell_count','aibos'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    public function search(Request $request) //検索条件入力画面
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $aibo_name = $request->aibo_name;
            $aibo_birth_year = $request->aibo_birth_year;
            $aibo_birth_month = $request->aibo_birth_month;
            $aibo_birth_day = $request->aibo_birth_day;
            $aibo_color = $request->aibo_color;
            $aibo_sex = $request->aibo_sex;
            $owner_name = $request->owner_name;
            $owner_pref = $request->owner_pref;

            $search_flag = false;

            //検索（カタカナや濁点まで区別する場合は「like」を「like BINARY」へ変更すること）
            $query = Aibo::query();
            $query = $query->select(DB::raw("aibos.*, owners.owner_name, owners.owner_name_kana, owners.owner_pref"));//ownewsのidを取ってこないようにするため
            $query = $query->leftJoin('owners', 'aibos.owner_id', '=', 'owners.id');
            if(isset($aibo_name)){
                $search_flag = true;
                $aibo_name = addcslashes($aibo_name, '\\_%');//エスケープ処理
                $query = $query->where(DB::raw("CONCAT(aibo_name, '|', aibo_kana)"), 'like', '%' . $aibo_name . '%');//like検索、aibo名とaibo名(よみ)の文字列を半角「|」で連結して1つのカラムとして検索
            }
            if(isset($aibo_birth_year)){
                $search_flag = true;
                $query = $query->whereYear('aibo_birthday',$aibo_birth_year);
            }
            if(isset($aibo_birth_month)){
                $search_flag = true;
                $query = $query->whereMonth('aibo_birthday',$aibo_birth_month);
            }
            if(isset($aibo_birth_day)){
                $search_flag = true;
                $query = $query->whereDay('aibo_birthday',$aibo_birth_day);
            }
            if(isset($aibo_color)){
                $search_flag = true;
                $query = $query->where('aibo_color',$aibo_color);
            }
            if(isset($aibo_sex)){
                $search_flag = true;
                $query = $query->where('aibo_sex',$aibo_sex);
            }
            if(isset($owner_name)){
                $search_flag = true;
                $owner_name = addcslashes($owner_name, '\\_%');//エスケープ処理
                $query = $query->where(DB::raw("CONCAT(owner_name, '|', owner_name_kana)"), 'like', '%' . $owner_name . '%');//like検索、オーナー名とオーナー名(よみ)の文字列を半角「|」で連結して1つのカラムとして検索
            }
            if(isset($owner_pref)){
                $search_flag = true;
                $query = $query->where('owner_pref',$owner_pref);
            }
            $query->where('aibo_available_flag', true)->orderby('aibo_kana');
            $results = $query->paginate(10); //クエリ文字列(検索キーワード)をつけて返す


            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.search',compact('bell_count','results','search_flag','aibo_name','aibo_birth_year','aibo_birth_month','aibo_birth_day','aibo_color','aibo_sex','owner_name', 'owner_pref'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    // public function search_result() //検索結果画面
    // {
    //     //【全ビュー共通処理】未読通知数
    //     $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

    //     return view('aibo.search_result',compact('bell_count'));
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        } else { //オーナー情報を登録している(OK)
            $owner = $owners[0];

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.create' , compact('bell_count','owner'));
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
        //バリデーション
        $inputs = $request;
        $inputs['aibo_birthday'] = sprintf('%04d', $inputs['aibo_birthday_yyyy']).sprintf('%02d', $inputs['aibo_birthday_mm']).sprintf('%02d', $inputs['aibo_birthday_dd']);
        $today = date('Ymd'); //YYYYMMDDの形で8桁（ex:20220326）

        $inputs=$request->validate([
            'aibo_name' => 'required',
            'aibo_kana' => 'required|hiragana',
            'aibo_nickname' => 'required',
            'aibo_icon' => 'image',
            'aibo_yurai' => '',
            'aibo_birthday' => "date|gte:20180111|lte:$today",
            'aibo_color' => 'required',
            'aibo_sex' => 'required',
            'aibo_personality' => 'required',
            'aibo_eye' => 'required',
            'aibo_voice' => 'required',
            'aibo_ear_left' => 'required',
            'aibo_ear_right' => 'required',
            'aibo_hand' => 'required',
            'aibo_tail' => 'required',
            'aibo_toy_ball_flag' => '',
            'aibo_toy_born_flag' => '',
            'aibo_toy_dice_flag' => '',
            'aibo_toy_book1_flag' => '',
            'aibo_toy_book2_flag' => '',
            'aibo_toy_food_flag' => '',
            'aibo_toy_drink_flag' => '',
            'aibo_serial_no' => '',
            'aibo_plan' => 'required',
            'aibo_care' => 'required',
            'aibo_message' => '',
            'aibo_reason' => '',
            'aibo_friend_qr' => 'image',
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'aibo_birthday.date' => "aiboの誕生日が日付ではありません。",
            'aibo_birthday.gte' => "aiboの誕生日は、発売日（2018年1月11日）以降で指定してください。",
            'aibo_birthday.lte' => "aiboの誕生日は、今日より過去で指定してください。",
        ]);

        //オーナー情報取得
        $user_id=auth()->user()->id;
        $owner=Owner::where('user_id', $user_id)->first();

        //保存
        $aibo = new Aibo();
        $aibo->owner_id = $owner->id;
        $aibo->aibo_name = $inputs['aibo_name'];
        $aibo->aibo_kana = $inputs['aibo_kana'];
        $aibo->aibo_kana_gyo = mb_substr($inputs['aibo_kana'],0,1);//要修正
            $aibo->aibo_kana_gyo = mb_convert_kana($aibo->aibo_kana_gyo, "h", "utf-8");//全角ひらがなを半角カタカナに変換
            $aibo->aibo_kana_gyo = mb_convert_kana($aibo->aibo_kana_gyo, "H", "utf-8"); // 半角カタカナを全角ひらがなに変換する
            if (mb_strlen($aibo->aibo_kana_gyo, "utf-8") > 1) {
                $aibo->aibo_kana_gyo = mb_substr($aibo->aibo_kana_gyo, 0, 1, "utf-8");// 濁点を除いた文字列を取得する
            }
        $aibo->aibo_nickname = $inputs['aibo_nickname'];
        // $aibo->aibo_icon = NULL;
        $aibo->aibo_yurai = $inputs['aibo_yurai'];
        $aibo->aibo_birthday = $inputs['aibo_birthday'];
        $aibo->aibo_color = $inputs['aibo_color'];
        $aibo->aibo_sex = $inputs['aibo_sex'];
        $aibo->aibo_personality = $inputs['aibo_personality'];
        $aibo->aibo_eye = $inputs['aibo_eye'];
        $aibo->aibo_voice = $inputs['aibo_voice'];
        $aibo->aibo_ear_left = $inputs['aibo_ear_left'];
        $aibo->aibo_ear_right = $inputs['aibo_ear_right'];
        $aibo->aibo_hand = $inputs['aibo_hand'];
        $aibo->aibo_tail = $inputs['aibo_tail'];
        $aibo->aibo_toy_ball_flag = isset($inputs['aibo_toy_ball_flag']) ? true:false;
        $aibo->aibo_toy_born_flag = isset($inputs['aibo_toy_born_flag']) ? true:false;
        $aibo->aibo_toy_dice_flag = isset($inputs['aibo_toy_dice_flag']) ? true:false;
        $aibo->aibo_toy_book1_flag = isset($inputs['aibo_toy_book1_flag']) ? true:false;
        $aibo->aibo_toy_book2_flag = isset($inputs['aibo_toy_book2_flag']) ? true:false;
        $aibo->aibo_toy_food_flag = isset($inputs['aibo_toy_food_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_serial_no = $inputs['aibo_serial_no'];
        $aibo->aibo_plan = $inputs['aibo_plan'];
        $aibo->aibo_care = $inputs['aibo_care'];
        $aibo->aibo_message = $inputs['aibo_message'];
        $aibo->aibo_reason = $inputs['aibo_reason'];
        // $aibo->aibo_friend_qr = NULL;
        $aibo->aibo_available_flag = true;

        //画像の保存
        //アイコン
        if (request('aibo_icon')){
            $original = request()->file('aibo_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_icon')->move('storage/aibo_icon', $name);
            $aibo->aibo_icon = $name;
        }

        //フレンドQRコード
        if (request('aibo_friend_qr')){
            $original = request()->file('aibo_friend_qr')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_friend_qr')->move('storage/aibo_friend_qr', $name);
            $aibo->aibo_friend_qr = $name;
        }

        //DBに追加
        $aibo->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return view('aibo.create_result', compact('bell_count','owner')); //aibo情報ではなく、親であるオーナー情報を引き継いで完了画面へ遷移
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aibo $aibo)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //aiboが公開状態ではない
            if(!$aibo->aibo_available_flag){
                abort(404); //エラーページへ転送
            }

            $age = Carbon::parse($aibo->aibo_birthday)->age;

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('aibo.show', compact('bell_count', 'aibo', 'age'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aibo $aibo)
    {
        $this->authorize('update', $aibo); //ポリシー適用(自分だけ編集可能)

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return view('aibo.edit', compact('bell_count','aibo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aibo $aibo)
    {
        $this->authorize('update', $aibo); //ポリシー適用(自分だけ編集可能)

        //バリデーション
        $inputs = $request;
        $inputs['aibo_birthday'] = sprintf('%04d', $inputs['aibo_birthday_yyyy']).sprintf('%02d', $inputs['aibo_birthday_mm']).sprintf('%02d', $inputs['aibo_birthday_dd']);
        $today = date('Ymd'); //YYYYMMDDの形で8桁（ex:20220326）

        $inputs=$request->validate([
            'aibo_name' => 'required',
            'aibo_kana' => 'required|hiragana',
            'aibo_nickname' => 'required',
            'aibo_icon' => 'image',
            'aibo_icon_del' => '',//削除チェック
            'aibo_yurai' => '',
            'aibo_birthday' => "date|gte:20180111|lte:$today",
            'aibo_color' => 'required',
            'aibo_sex' => 'required',
            'aibo_personality' => 'required',
            'aibo_eye' => 'required',
            'aibo_voice' => 'required',
            'aibo_ear_left' => 'required',
            'aibo_ear_right' => 'required',
            'aibo_hand' => 'required',
            'aibo_tail' => 'required',
            'aibo_toy_ball_flag' => '',
            'aibo_toy_born_flag' => '',
            'aibo_toy_dice_flag' => '',
            'aibo_toy_book1_flag' => '',
            'aibo_toy_book2_flag' => '',
            'aibo_toy_food_flag' => '',
            'aibo_toy_drink_flag' => '',
            'aibo_serial_no' => '',
            'aibo_plan' => 'required',
            'aibo_care' => 'required',
            'aibo_message' => '',
            'aibo_reason' => '',
            'aibo_friend_qr' => 'image',
            'aibo_friend_qr_del' => '',//削除チェック
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'aibo_birthday.date' => "aiboの誕生日が日付ではありません。",
            'aibo_birthday.gte' => "aiboの誕生日は、発売日（2018年1月11日）以降で指定してください。",
            'aibo_birthday.lte' => "aiboの誕生日は、今日より過去で指定してください。",
        ]);

        //オーナー情報取得
        // $user_id=auth()->user()->id;
        // $owner=Owner::where('user_id', $user_id)->first();

        //保存
        // $aibo = new Aibo();
        // $aibo->owner_id = $owner->id;
        $aibo->aibo_name = $inputs['aibo_name'];
        $aibo->aibo_kana = $inputs['aibo_kana'];
        $aibo->aibo_kana_gyo = mb_substr($inputs['aibo_kana'],0,1);
            $aibo->aibo_kana_gyo = mb_convert_kana($aibo->aibo_kana_gyo, "h", "utf-8");//全角ひらがなを半角カタカナに変換
            $aibo->aibo_kana_gyo = mb_convert_kana($aibo->aibo_kana_gyo, "H", "utf-8"); // 半角カタカナを全角ひらがなに変換する
            if (mb_strlen($aibo->aibo_kana_gyo, "utf-8") > 1) {
                $aibo->aibo_kana_gyo = mb_substr($aibo->aibo_kana_gyo, 0, 1, "utf-8");// 濁点を除いた文字列を取得する
            }
        $aibo->aibo_nickname = $inputs['aibo_nickname'];
        // $aibo->aibo_icon = NULL;
        $aibo->aibo_yurai = $inputs['aibo_yurai'];
        $aibo->aibo_birthday = $inputs['aibo_birthday'];
        $aibo->aibo_color = $inputs['aibo_color'];
        $aibo->aibo_sex = $inputs['aibo_sex'];
        $aibo->aibo_personality = $inputs['aibo_personality'];
        $aibo->aibo_eye = $inputs['aibo_eye'];
        $aibo->aibo_voice = $inputs['aibo_voice'];
        $aibo->aibo_ear_left = $inputs['aibo_ear_left'];
        $aibo->aibo_ear_right = $inputs['aibo_ear_right'];
        $aibo->aibo_hand = $inputs['aibo_hand'];
        $aibo->aibo_tail = $inputs['aibo_tail'];
        $aibo->aibo_toy_ball_flag = isset($inputs['aibo_toy_ball_flag']) ? true:false;
        $aibo->aibo_toy_born_flag = isset($inputs['aibo_toy_born_flag']) ? true:false;
        $aibo->aibo_toy_dice_flag = isset($inputs['aibo_toy_dice_flag']) ? true:false;
        $aibo->aibo_toy_book1_flag = isset($inputs['aibo_toy_book1_flag']) ? true:false;
        $aibo->aibo_toy_book2_flag = isset($inputs['aibo_toy_book2_flag']) ? true:false;
        $aibo->aibo_toy_food_flag = isset($inputs['aibo_toy_food_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_serial_no = $inputs['aibo_serial_no'];
        $aibo->aibo_plan = $inputs['aibo_plan'];
        $aibo->aibo_care = $inputs['aibo_care'];
        $aibo->aibo_message = $inputs['aibo_message'];
        $aibo->aibo_reason = $inputs['aibo_reason'];
        // $aibo->aibo_friend_qr = NULL;
        $aibo->aibo_available_flag = true;

        //画像の削除
        $del_flg = 0;//削除したかどうか
        $checkbox_aibo_icon_del = 0; //削除チェックボックスの値
        if(isset($inputs['aibo_icon_del'])){ //非表示の時は取得できないのでisset
            $checkbox_aibo_icon_del = $inputs['aibo_icon_del'];
        }
        if ($aibo->aibo_icon!=='default.jpg' &&  $checkbox_aibo_icon_del == '1') {
            $old='public/aibo_icon/'.$aibo->aibo_icon;
            Storage::delete($old);
            $aibo->aibo_icon = NULL; //デフォルト(NULL)をセット
            $del_flg = 1;//削除後
        }

        //画像の保存
        //アイコン
        if (request('aibo_icon')){
            //古い画像は削除
            if ($aibo->aibo_icon!=='default.jpg' && $del_flg == 0) {
                $old='public/aibo_icon/'.$aibo->aibo_icon;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('aibo_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_icon')->move('storage/aibo_icon', $name);
            $aibo->aibo_icon = $name;
        }

        //QRコードの削除
        $del_flg = 0;//削除したかどうか
        $checkbox_aibo_friend_qr_del = 0; //削除チェックボックスの値
        if(isset($inputs['aibo_friend_qr_del'])){ //非表示の時は取得できないのでisset
            $checkbox_aibo_friend_qr_del = $inputs['aibo_friend_qr_del'];
        }
        if ($aibo->aibo_friend_qr!=='default.jpg' &&  $checkbox_aibo_friend_qr_del == '1') {
            $old='public/aibo_friend_qr/'.$aibo->aibo_friend_qr;
            Storage::delete($old);
            $aibo->aibo_friend_qr = NULL; //デフォルト(NULL)をセット
            $del_flg = 1;//削除後
        }

        //フレンドQRコード
        if (request('aibo_friend_qr')){
            //古い画像は削除
            if ($aibo->aibo_friend_qr!=='default.jpg' && $del_flg == 0) {
                $old='public/aibo_friend_qr/'.$aibo->aibo_friend_qr;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('aibo_friend_qr')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_friend_qr')->move('storage/aibo_friend_qr', $name);
            $aibo->aibo_friend_qr = $name;
        }

        //DBに追加
        $aibo->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return redirect()->route('aibo.show', $aibo)->with('message', 'aibo情報を更新しました。')->with('bell_count', $bell_count);
        //return back()->with('message', 'aibo情報を更新しました。');

        //return view('aibo.show', compact('aibo')); //これはNG。URLが/mypage/aiboとなってしまうため。
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
