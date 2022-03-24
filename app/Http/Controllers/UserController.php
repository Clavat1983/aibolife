<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;//パスワードをハッシュ化
use Illuminate\Validation\Rule;//メールアドレスの登録済(重複)を防ぐ

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(User $user)
    {
        $this->authorize('update', $user); //ポリシー適用(自分だけ編集可能)
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user); //ポリシー適用(自分だけ編集可能)

        $inputs=request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],//メールアドレスの重複がない(自分を除く)
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //保存(更新)
        if($user->email != $inputs['email']){ //メールアドレスが変わった
            $user->email = $inputs['email'];
            $user->password = Hash::make($inputs['password']);//パスワードのハッシュ化
            $user->email_verified_at = NULL;//メール認証を解除して認証していない状態にする
            $user->save();
            $user->sendEmailVerificationNotification();//認証メールを再送付
            return redirect()->route('user.reverify'); //この時点で「認証済」ではなくなるので、viewで遷移できない。認証外のルートにリダイレクトする。
        } else { //メールアドレスがそのまま
            //$user->email = $inputs['email']; メールアドレスは変更しない
            $user->password = Hash::make($inputs['password']);//パスワードのハッシュ化
            $user->save();
            return back()->with('message', '変更が完了しました');
        }
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
