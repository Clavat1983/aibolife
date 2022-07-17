<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Owner;
use App\Models\Aibo;
use App\Models\News;
use App\Models\Diary;
use App\Models\Notification;
use Carbon\Carbon; //日付操作

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
            $aibos=Aibo::where('owner_id', $owner_id)->get();

            if(count($aibos)==0){ //aiboを1匹も登録していない
                return redirect()->route('aibo.create');
            } else { //aiboを登録している=トップページの情報取得

                //最新情報の取得(最新6件)
                $news_list = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->limit(6)->get();

                //日記の取得(最新6件)
                $diaries = Diary::orderBy('id', 'desc')->limit(6)->get();

                //掲示板の取得(最新6件)

                //新しいお友達取得(最新6件)
                $new_aibos = Aibo::orderBy('id', 'desc')->limit(6)->get();


                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', $user)->where('read_at', NULL)->count();
                return view('home', compact('bell_count','owners', 'news_list', 'diaries', 'new_aibos'));
            }
        }
    }

    public function mypage(){
        //ユーザ登録済が前提

        //オーナー情報を取る
        $user_id=auth()->user()->id;
        $owner=Owner::where('user_id', $user_id)->first();

        if($owner==NULL){ //オーナー情報を登録していない(NG)
            return redirect()->route('home'); //homeに飛ばす(再度リダイレクトしてオーナー登録画面に行く)
        } else {
            return view('mypage', compact('owner'));
        }
    }
}
