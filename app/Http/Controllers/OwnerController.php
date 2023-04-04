<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Owner;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage; //画像削除用

class OwnerController extends Controller
{

    public function transfer()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            
            return view('owner.transfer',compact('bell_count'));
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('root');
        }
    }

    public function transfer_login()
    {
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(OK)

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('owner.transfer_login', compact('bell_count'));
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('root');
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
                $owner=Owner::where('owner_old_login_password', $inputs['owner_old_login_password'])
                    ->where('user_id', NULL)
                    ->where('owner_transferred_flag', false)
                    ->where('owner_available_flag', true)
                    ->where(function($query) use ($inputs){
                        $query->where('owner_old_login_id', $inputs['owner_old_login_id'])
                        ->orWhere('owner_old_email', $inputs['owner_old_login_id']); //旧ログインIDか旧メールアドレスが一致
                      })
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

                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

                return view('owner.transfer_result', compact('owner', 'bell_count'));
            } else { //該当なし
                return back()->withErrors('該当するユーザが見つかりません。旧「aibo life」のログイン情報が不明な方は、お問い合わせください。')->withInput();
            }

        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('root');
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

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('owner.create', compact('bell_count'));
        } else { //オーナー情報を登録していない(NG)
            return redirect()->route('root');
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
            'owner_icon'=> 'image|max:10240',//10240=10MB
            'owner_pref' => 'required',
        ],
        //エラーメッセージ
        [
            'owner_icon.max' => "オーナーアイコンのファイルサイズは10MB以下にしてください。",
        ]
        );

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
        return redirect()->route('root');
        //return view('owner.create_result', compact('owner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        $owner_available_flag = Owner::where('id', $owner->id)->where('owner_available_flag', true)->count();

        if($owner_available_flag > 0){
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('owner.show', compact('bell_count','owner'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        $this->authorize('update', $owner); //ポリシー適用(自分だけ編集可能)

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return view('owner.edit', compact('bell_count','owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $this->authorize('update', $owner); //ポリシー適用(自分だけ編集可能)

        //バリデーション
        $inputs=$request->validate([
            'owner_name' => 'required|max:255',
            'owner_name_kana' => 'required|max:255|hiragana',
            'owner_icon'=> 'image|max:10240',//10MB
            'owner_icon_del' => '',//削除チェック
            'owner_pref' => 'required',
        ]);

        //オーナー情報をセット(新規)
        //$owner->user_id = auth()->user()->id; //変更しない
        $owner->owner_name = $inputs['owner_name'];
        $owner->owner_name_kana = $inputs['owner_name_kana'];
        $owner->owner_pref = $inputs['owner_pref'];
        //$owner->owner_transferred_flag = true; //変更しない

        //画像の削除
            $del_flg = 0;//削除したかどうか
            $checkbox_owner_icon_del = 0; //削除チェックボックスの値
            if(isset($inputs['owner_icon_del'])){ //非表示の時は取得できないのでisset
                $checkbox_owner_icon_del = $inputs['owner_icon_del'];
            }
            if ($owner->owner_icon!=='default.jpg' &&  $checkbox_owner_icon_del == '1') {
                $old='public/owner_icon/'.$owner->owner_icon;
                Storage::delete($old);
                $owner->owner_icon = NULL; //デフォルト(NULL)をセット
                $del_flg = 1;//削除後
            }
        //画像の保存
        if (request('owner_icon')){
            //古い画像は削除
            if ($owner->owner_icon!=='default.jpg' && $del_flg == 0) {
                $old='public/owner_icon/'.$owner->owner_icon;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('owner_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('owner_icon')->move('storage/owner_icon', $name);
            $owner->owner_icon = $name;
        }

        //DBに追加
        $owner->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        
        return back()->with('message', 'オーナー情報を更新しました。')->with('bell_count', $bell_count);
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
