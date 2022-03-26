<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //追加

class RootController extends Controller
{
    public function root() //トップページにアクセス
    {
        if( Auth::check()){ //ログインしている場合
            return redirect()->route('home');
        } else { //ログインしていない場合
            return view('welcome');
        }
    }
}
