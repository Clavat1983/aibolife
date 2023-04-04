<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //追加

use App\Models\User;
use App\Models\Owner;
use App\Models\Aibo;
use App\Models\News;
use App\Models\Diary;
use App\Models\BehaviorShare;
use App\Models\Board;
use App\Models\EventCalendar;
use App\Models\Notification;
use Carbon\Carbon; //日付操作
use Illuminate\Support\Str; //文字列操作

class RootController extends Controller
{
    public function root() //トップページにアクセス
    {
        if( Auth::check()){ //ログインしている場合
            return redirect()->route('home');
        } else { //ログインしていない場合
            //return view('welcome');
            return redirect()->route('guest');
        }
    }

    //トップページにアクセスしたとき(未登録)
    public function guest() {
        return view('guest');
    }

    //未登録で認証エリア内にアクセスしたとき
    public function limited() {
        return view('errors.limited');
    }

}
