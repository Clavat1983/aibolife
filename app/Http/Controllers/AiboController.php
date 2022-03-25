<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;

class AiboController extends Controller
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
        //オーナー情報の登録を確認
        $user=auth()->user()->id;
        $owners=Owner::where('user_id', $user)->get();

        if(count($owners)==0){ //オーナー情報を登録していない(NG)
            return redirect()->route('home');
        } else { //オーナー情報を登録している(OK)
            $owner = $owners[0];
            return view('aibo.create' , compact('owner'));
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
        $inputs = $request;
        $inputs['aibo_birthday'] = sprintf('%04d', $inputs['aibo_birthday_yyyy']).sprintf('%02d', $inputs['aibo_birthday_mm']).sprintf('%02d', $inputs['aibo_birthday_dd']);
        $today = '20220325';

        $inputs=$request->validate([
            'aibo_name' => 'required',
            'aibo_kana' => 'required|hiragana',
            'aibo_nickname' => 'required',
            'aibo_icon' => 'image',
            'aibo_yurai' => '',
            'aibo_birthday' => "date|gte:20180111|lte:$today",
            'aibo_color' => 'required',
            'aibo_sex' => 'required',
            'aibo_personality' => 'required',
            'aibo_eye' => 'required',
            'aibo_voice' => 'required',
            'aibo_ear' => 'required',
            'aibo_hand' => 'required',
            'aibo_tail' => 'required',
            'aibo_toy_ball_flag' => '',
            'aibo_toy_born_flag' => '',
            'aibo_toy_dice_flag' => '',
            'aibo_toy_book1_flag' => '',
            'aibo_toy_book2_flag' => '',
            'aibo_toy_food_flag' => '',
            'aibo_toy_drink_flag' => '',
            'aibo_serial_no' => '',
            'aibo_plan' => 'required',
            'aibo_care' => 'required',
            'aibo_message' => '',
            'aibo_reason' => '',
            'aibo_friend_qr' => 'image',
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'aibo_birthday.date' => "aiboの誕生日が日付ではありません。",
            'aibo_birthday.gte' => "aiboの誕生日は、発売日（2018年1月11日）以降で指定してください。",
            'aibo_birthday.lte' => "aiboの誕生日は、今日より過去で指定してください。",
        ]);

        //オーナー情報取得
        $user_id=auth()->user()->id;
        $owner=Owner::where('user_id', $user_id)->first();

        //保存
        $aibo = new Aibo();
        $aibo->owner_id = $owner->id;
        $aibo->aibo_name = $inputs['aibo_name'];
        $aibo->aibo_kana = $inputs['aibo_kana'];
        $aibo->aibo_kana_gyo = mb_substr($inputs['aibo_kana'],0,1);//要修正
        $aibo->aibo_nickname = $inputs['aibo_nickname'];
        // $aibo->aibo_icon = NULL;
        $aibo->aibo_yurai = $inputs['aibo_yurai'];
        $aibo->aibo_birthday = $inputs['aibo_birthday'];
        $aibo->aibo_color = $inputs['aibo_color'];
        $aibo->aibo_sex = $inputs['aibo_sex'];
        $aibo->aibo_personality = $inputs['aibo_personality'];
        $aibo->aibo_eye = $inputs['aibo_eye'];
        $aibo->aibo_voice = $inputs['aibo_voice'];
        $aibo->aibo_ear = $inputs['aibo_ear'];
        $aibo->aibo_hand = $inputs['aibo_hand'];
        $aibo->aibo_tail = $inputs['aibo_tail'];
        $aibo->aibo_toy_ball_flag = isset($inputs['aibo_toy_ball_flag']) ? true:false;
        $aibo->aibo_toy_born_flag = isset($inputs['aibo_toy_born_flag']) ? true:false;
        $aibo->aibo_toy_dice_flag = isset($inputs['aibo_toy_dice_flag']) ? true:false;
        $aibo->aibo_toy_book1_flag = isset($inputs['aibo_toy_book1_flag']) ? true:false;
        $aibo->aibo_toy_book2_flag = isset($inputs['aibo_toy_book2_flag']) ? true:false;
        $aibo->aibo_toy_food_flag = isset($inputs['aibo_toy_food_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_toy_drink_flag = isset($inputs['aibo_toy_drink_flag']) ? true:false;
        $aibo->aibo_serial_no = $inputs['aibo_serial_no'].'**';
        $aibo->aibo_plan = $inputs['aibo_plan'];
        $aibo->aibo_care = $inputs['aibo_care'];
        $aibo->aibo_message = $inputs['aibo_message'];
        $aibo->aibo_reason = $inputs['aibo_reason'];
        // $aibo->aibo_friend_qr = NULL;
        $aibo->aibo_available_flag = true;

        //画像の保存
        //アイコン
        if (request('aibo_icon')){
            $original = request()->file('aibo_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_icon')->move('storage/aibo_icon', $name);
            $aibo->aibo_icon = $name;
        }

        //フレンドQRコード
        if (request('aibo_friend_qr')){
            $original = request()->file('aibo_friend_qr')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_friend_qr')->move('storage/aibo_friend_qr', $name);
            $aibo->aibo_friend_qr = $name;
        }

        //DBに追加
        $aibo->save();
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
