<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\News;
use App\Models\Diary;
use App\Models\BehaviorShare;
use App\Models\EventCalendar;
use App\Models\Notification;
use Carbon\Carbon; //日付操作
use Illuminate\Support\Str; //文字列操作

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //1.オーナー情報取得
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない
            return redirect()->route('owner.transfer'); //オーナー登録ページに飛ぶ
        } else { //オーナー情報を登録している
            $owner_id = $owners[0]['id'];

            //2:aiboの登録を確認
            $aibos=Aibo::where('owner_id', $owner_id)->where('aibo_available_flag', true)->get();

            //オーナーの最終ログイン日時を更新(旧ID、パスワード、メール、セキュリティコードをランダムな文字に更新して無力化、update_atが変わる)
            $update_owner = Owner::find($owner_id);
            $update_owner->owner_old_login_id = '**'.Str::random(5).'**';
            $update_owner->owner_old_login_password	 = '**'.Str::random(5).'**';
            $update_owner->owner_old_email = '**'.Str::random(5).'**';
            $update_owner->owner_old_security_code = '**'.Str::random(5).'**';
            $update_owner->save();


            if(count($aibos)==0){ //aiboを1匹も登録していない
                return redirect()->route('aibo.create');
            } else { //aiboを登録まで完了している=トップページの情報取得

                //イベントカレンダー取得（開始日時が今日の23:59:59以前＝今日以前に開始+今日始まる　かつ　終了時間が今日の0:00より大きい＝今日以降に終わる）
                $events = EventCalendar::where('event_publication_flag',1)->where('event_publication_datetime','<=',date('Y-m-d H:i:s'))->where('event_start_datetime','<=',date('Y-m-d 23:59:59'))->where('event_end_datetime','>=',date('Y-m-d 00:00:00'))->orderby('event_publication_datetime', 'asc')->get();

                //最新情報の取得(最新6件)
                $news_list = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->limit(6)->get();


                //今日の日記の取得(6件)
                $today_diaries = Diary::where('diary_date', date('Y-m-d'))->orderBy('id', 'desc')->limit(6)->get();

                //日記の取得(最新6件)
                $recent_diaries = Diary::orderBy('id', 'desc')->limit(6)->get();

                //ふるまいの取得(3件)
                $behaviors = BehaviorShare::inRandomOrder()->take(3)->get();

                //掲示板の取得(最新6件)

                //誕生日のaibo取得
                $birthday_aibos = $this->get_birthday_aibos();

                //もうすぐ誕生日のaibo取得
                $comingup_aibos = $this->get_coming_up_birthday_aibos();

                //新しいお友達取得(最新6件)
                $new_aibos = Aibo::orderBy('id', 'desc')->where('aibo_available_flag', true)->limit(6)->get();


                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('home', compact('bell_count','owners', 'events', 'news_list', 'today_diaries', 'recent_diaries', 'behaviors', 'birthday_aibos', 'comingup_aibos', 'new_aibos'));
            }
        }
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



    public function mypage(){
        //ユーザ登録済が前提

        //オーナー情報を取る
        $user_id=auth()->user()->id;
        $owner=Owner::where('user_id', $user_id)->first();

        if($owner==NULL){ //オーナー情報を登録していない(NG)
            return redirect()->route('home'); //homeに飛ばす(再度リダイレクトしてオーナー登録画面に行く)
        } else {
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('mypage', compact('bell_count','owner'));
        }
    }

    //管理者専用ページ
    public function admin(){
        $user = User::where('id', auth()->user()->id)->first();

        if($user!=NULL && $user->role == "admin"){
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('admin', compact('bell_count'));
        } else {
            return redirect()->route('home');
        }
    }

}
