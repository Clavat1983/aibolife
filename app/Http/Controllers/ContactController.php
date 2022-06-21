<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
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

        //画面遷移
        return view('contact.thanks');
    }
}
