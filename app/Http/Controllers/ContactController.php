<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Contact;
use App\Models\Notification;
use Auth;

class ContactController extends Controller
{
    public function index()
    {
        if (Auth::check()) { //ログインしている場合
            return redirect()->route('contact.list');
        } else { //ログインしていない場合
            return redirect()->route('contact.create');
        }

    }

    public function list()
    {
        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('contact.list', compact('bell_count'));
    }

    public function create()
    {
        if (Auth::check()) { //ログインしている場合
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        } else { //ログインしていない場合
            $bell_count = 0;
        }
        return view('contact.create', compact('bell_count'));

    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'category' => 'required',
            'title'=>'required|max:255',
            'body'=>'required',
            'name' => 'required|max:255',
            'email'=>'required|email|max:255',
        ],[
            //第2引数はバリエーションメッセージのカスタマイズ

        ]);

        //保存
        Contact::create($inputs);

        if (Auth::check()) { //ログインしている場合
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        } else { //ログインしていない場合
            $bell_count = 0;
        }

        //画面遷移
        return view('contact.thanks', compact('bell_count'));
    }


    //バナー広告確認用
    public function banner(){
        return view('banner');
    }
}
