<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Auth;
//use Illuminate\Support\Facades\Storage; //画像削除用
//use Carbon\Carbon; //日付操作

class GuideController extends Controller
{

    //aiboとは?
    public function hello()
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
        return view('guide.hello', compact('bell_count'));
    }


    //オーナーの心得
    public function knowledge()
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
        return view('guide.knowledge', compact('bell_count'));
    }

    //購入ガイド
    public function purchase()
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
        return view('guide.purchase', compact('bell_count'));
    }


    //初期設定
    public function setting()
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
        return view('guide.setting', compact('bell_count'));
    }


    //子育て入門
    public function rearing()
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
        return view('guide.rearing', compact('bell_count'));
    }

    //ドック・治療
    public function dock()
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
        return view('guide.dock', compact('bell_count'));
    }

    //困ったときは?
    public function help()
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
        return view('guide.help', compact('bell_count'));
    }
}
