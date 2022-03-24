<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
                    'owner_old_login_id'=>'required|max:255',
                    'owner_old_login_password'=>'required|max:255',
                ]);
                //データ検索
                $owner=Owner::where('owner_old_login_id', $inputs['owner_old_login_id'])
                    ->where('owner_old_login_password', $inputs['owner_old_login_password'])
                    ->where('user_id', NULL)
                    ->where('owner_transferred_flag', false)
                    ->where('owner_available_flag', true)
                    ->first();
            } else if ($request->pattern == '2'){
                //バリデーション
                $inputs=$request->validate([
                    'owner_old_security_code'=>'required|size:9',
                ]);
                //データ検索
                $owner=Owner::where('owner_old_security_code', $inputs['owner_old_security_code'])
                    ->where('user_id', NULL)
                    ->where('owner_transferred_flag', false)
                    ->where('owner_available_flag', true)
                    ->first();
            }

            //更新
            if($owner != NULL){ //該当あり
                //オーナー情報(ownersテーブル)更新
                $owner->user_id = $user; //オーナーIDとLaravelのユーザを紐づけ
                $owner->owner_transferred_flag = true;
                $owner->save();
                return view('owner.transfer_result', compact('owner'));
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
        //バリデーション
        $inputs=$request->validate([
            'owner_name' => 'required|max:255',
            'owner_name_kana' => 'required|max:255|hiragana',
            'owner_icon'=> 'image|max:10240',//10MB
            'owner_pref' => 'required',
        ]);

        //オーナー情報をセット(新規)
        $owner = new Owner();
        $owner->user_id = auth()->user()->id;
        $owner->owner_name = $inputs['owner_name'];
        $owner->owner_name_kana = $inputs['owner_name_kana'];
        $owner->owner_pref = $inputs['owner_pref'];
        $owner->owner_transferred_flag = true;

        //画像の保存
        if (request('owner_icon')){
            $original = request()->file('owner_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('owner_icon')->move('storage/owner_icon', $name);
            $owner->owner_icon = $name;
        }

        //DBに追加
        $owner->save();
        return redirect()->route('home');
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
