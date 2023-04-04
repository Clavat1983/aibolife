<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Auth;
//use Illuminate\Support\Facades\Storage; //画像削除用
//use Carbon\Carbon; //日付操作

class UnionController extends Controller
{

    //aibo lifeとは?
    public function about()
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
        return view('union.about', compact('bell_count'));
    }


    //利用ガイド
    public function manual()
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
        return view('union.manual', compact('bell_count'));
    }

    //利用規約
    public function rule()
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
        return view('union.rule', compact('bell_count'));
    }


    //プライバシーポリシー
    public function policy()
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
        return view('union.policy', compact('bell_count'));
    }


    //運営メンバー
    public function staff()
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
        return view('union.staff', compact('bell_count'));
    }

    //よくある質問
    public function faq()
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
        return view('union.faq', compact('bell_count'));
    }

    //権利表記
    public function copyright()
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
        return view('union.copyright', compact('bell_count'));
    }
}
