<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Owner;
use App\Models\Aibo;

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
        //1:オーナー情報の登録を確認
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
            } else { //aiboを登録している
                return view('home', compact('owners'));
            }
        }
    }
}
