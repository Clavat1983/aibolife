<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Auth;
//use Illuminate\Support\Facades\Storage; //画像削除用
//use Carbon\Carbon; //日付操作

class LivingController extends Controller
{

    //ふるまい
    public function behavior()
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
        return view('living.behavior', compact('bell_count'));
    }


    //あそび
    public function play()
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
        return view('living.play', compact('bell_count'));
    }

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
        return view('living.food', compact('bell_count'));
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
        return view('living.fashion', compact('bell_count'));
    }


    //なかま
    public function colleague()
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
        return view('living.colleague', compact('bell_count'));
    }

    //しつけ
    public function training()
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
        return view('living.training', compact('bell_count'));
    }

    //その他
    public function etc()
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
        return view('living.etc', compact('bell_count'));
    }
}
