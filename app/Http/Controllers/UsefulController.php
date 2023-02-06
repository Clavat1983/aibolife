<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Auth;
//use Illuminate\Support\Facades\Storage; //画像削除用
//use Carbon\Carbon; //日付操作

class UsefulController extends Controller
{

    //ごはん
    public function food()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.food', compact('bell_count'));
    }


    //ファッション
    public function fashion()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.fashion', compact('bell_count'));
    }

    //イベント（カレンダーではない）
    public function event()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.event', compact('bell_count'));
    }

    //グッズ
    public function goods()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.goods', compact('bell_count'));
    }


    //店舗・施設
    public function shop()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.shop', compact('bell_count'));
    }


    //歴史
    public function history()
    {
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }
        return view('useful.history', compact('bell_count'));
    }

}
