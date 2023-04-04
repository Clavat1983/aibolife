<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCalendar;
use App\Models\Notification;
use Carbon\Carbon; //日付操作

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

            //公開可能なイベント かつ 情報解禁後
            $events = EventCalendar::where('event_publication_datetime','<=',date('Y-m-d H:i:s'))->where('event_publication_flag', true)->orderBy('event_start_datetime')->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('eventcalendar.index', compact('bell_count','target','events'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    public function admin(){
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)のみ画面表示

            //公開可能なイベント かつ 情報解禁後
            $events = EventCalendar::orderBy('event_start_datetime', 'DESC')->paginate(10);

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('eventcalendar.admin', compact('bell_count','events'));
        } else { //閲覧不可
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)のみ入力画面表示
            $now = date('Y-m-d').'T'.date('H:i');

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('eventcalendar.create', compact('bell_count','now'));
        } else {
            abort(403);
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
        $inputs=$request->validate([
            'event_publication_datetime' => 'required',
            'event_publication_flag' => 'required',
            'event_confirm_flag' => 'required',
            'event_category' => 'required',
            'event_title' => 'required',
            'event_start_datetime' => 'required',
            'event_end_datetime' => 'required',
            'link_news_id' => 'required',
        ]);

        //値のセット
        $event = new EventCalendar();

            //公開日時
            $event->event_publication_datetime = $inputs['event_publication_datetime'];
            //公開状態
            if($inputs['event_publication_flag'] === '公開'){
                $event->event_publication_flag = true; //公開
            } else {
                $event->event_publication_flag = false; //非公開
            }
            //情報確度
            if($inputs['event_confirm_flag'] === '確定'){
                $event->event_confirm_flag = true; //確定
            } else {
                $event->event_confirm_flag = false; //未確認
            }
            //カテゴリー
            $event->event_category = $inputs['event_category'];
            //タイトル
            $event->event_title = $inputs['event_title'];
            //開始日時
            $event->event_start_datetime = $inputs['event_start_datetime'];
            //終了日時
            $event->event_end_datetime = $inputs['event_end_datetime'];
            //関連ニュースID
            $event->link_news_id = $inputs['link_news_id'];
        
        //DB保存
        $event->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //戻る
        return redirect()->route('home.admin', compact('bell_count'));

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
    public function edit(EventCalendar $event)
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('eventcalendar.edit', compact('bell_count','event'));
        } else { //一般
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventCalendar $event)
    {
        //バリデーション
        $inputs=$request->validate([
            'event_publication_datetime' => 'required',
            'event_publication_flag' => 'required',
            'event_confirm_flag' => 'required',
            'event_category' => 'required',
            'event_title' => 'required',
            'event_start_datetime' => 'required',
            'event_end_datetime' => 'required',
            'link_news_id' => 'required',
        ]);

        //値のセット
        //$event = new EventCalendar();

            //公開日時
            $event->event_publication_datetime = $inputs['event_publication_datetime'];
            //公開状態
            if($inputs['event_publication_flag'] === '公開'){
                $event->event_publication_flag = true; //公開
            } else {
                $event->event_publication_flag = false; //非公開
            }
            //情報確度
            if($inputs['event_confirm_flag'] === '確定'){
                $event->event_confirm_flag = true; //確定
            } else {
                $event->event_confirm_flag = false; //未確認
            }
            //カテゴリー
            $event->event_category = $inputs['event_category'];
            //タイトル
            $event->event_title = $inputs['event_title'];
            //開始日時
            $event->event_start_datetime = $inputs['event_start_datetime'];
            //終了日時
            $event->event_end_datetime = $inputs['event_end_datetime'];
            //関連ニュースID
            $event->link_news_id = $inputs['link_news_id'];
        
        //DB保存
        $event->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //戻る
        return back()->with('message', '更新しました。');
        //redirect()->route('home.admin', compact('bell_count'));
        
        
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
