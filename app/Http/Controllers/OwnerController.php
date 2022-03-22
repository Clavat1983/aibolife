<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{

    public function transfer()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)
            return view('owner.transfer');
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        }
    }

    public function transfer_login()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)
            return view('owner.transfer_login');
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        }
    }

    public function transfer_result(Request $request)
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)

            if($request->pattern == '1'){
                //バリデーション
                $inputs=$request->validate([
                    'old_login_id'=>'required',
                    'old_login_password'=>'required',
                ]);
                //データ検索
                $owner_info=Owner::where('old_login_id', $inputs['old_login_id'])
                    ->where('old_login_password', $inputs['old_login_password'])
                    ->where('user_id', NULL)
                    ->where('transferred_flag', false)
                    ->where('available_flag', true)
                    ->first();
            } else if ($request->pattern == '2'){
                //バリデーション
                $inputs=$request->validate([
                    'old_security_code'=>'required|size:9',
                ]);
                //データ検索
                $owner_info=Owner::where('old_security_code', $inputs['old_security_code'])
                    ->where('user_id', NULL)
                    ->where('transferred_flag', false)
                    ->where('available_flag', true)
                    ->first();
            }

            //更新
            if($owner_info != NULL){ //該当あり
                return back()->with('message', '該当あり')->withInput();
                //$owner_info->user_id = $user;
            } else { //該当なし
                return back()->withErrors('該当するユーザが見つかりません')->withInput();
            }

        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)
            return view('owner.create');
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
