<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Notification;

class ContactController extends Controller
{
    public function create()
    {
        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

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

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //画面遷移
        return view('contact.thanks', compact('bell_count'));
    }
}
