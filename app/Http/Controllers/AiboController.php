<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Aibo;
use Illuminate\Support\Facades\Storage; //画像削除用
use Carbon\Carbon; //日付操作

class AiboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //誕生日のaibo取得
        $birthday_aibos = $this->get_birthday_aibos();

        //新しいお友達取得(最新6件)
        $new_aibos = Aibo::orderBy('id', 'desc')->limit(6)->get();

        return view('aibo.index',compact('birthday_aibos','new_aibos')); //aibo名鑑トップ
    }

    private function get_birthday_aibos(){

        //日付
        $before_2day = new Carbon('-2 day');
            $before_2day_mm = $before_2day->month;
            $before_2day_dd = $before_2day->day;
        $yesterday = new Carbon('yesterday');
            $yesterday_mm = $yesterday->month;
            $yesterday_dd = $yesterday->day;
        $today = new Carbon('today');
            $today_mm = $today->month;
            $today_dd = $today->day;

        //誕生日(今日・昨日・一昨日)
        $aibos = Aibo::where(function($q) use($today_mm,$today_dd) {
            $q->whereMonth('aibo_birthday',$today_mm)->whereDay('aibo_birthday',$today_dd);
        })->orderBy('id', 'asc')->get();

        $aibos_1 = Aibo::Where(function($q) use($yesterday_mm,$yesterday_dd) {
            $q->whereMonth('aibo_birthday',$yesterday_mm)->whereDay('aibo_birthday',$yesterday_dd);
        })->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_1); //今日+昨日
        
        $aibos_2 = Aibo::Where(function($q) use($before_2day_mm,$before_2day_dd) {
            $q->whereMonth('aibo_birthday',$before_2day_mm)->whereDay('aibo_birthday',$before_2day_dd);
        })->orderBy('id', 'asc')->get();
        $aibos = $aibos->merge($aibos_2); //(今日+昨日)+一昨日

        return $aibos; //誕生日3日分
    }

    public function list_syllabary() //50音順
    {
        return view('list_syllabary');
    }

    public function list_area() //居住地
    {
        return view('list_area');
    }

    public function list_birthday() //誕生日
    {
        // $aibos=Aibo::where('aibo_available_flag', true)->get();

        // $month_ary = ["01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0];

        // foreach($aibos as $aibo){
        //     $month = substr($aibo->aibo_birthday,5,2);
        //     $month_ary[$month]++;
        // }
        // return view('aibo.index', compact('month_ary')); //aibo名鑑トップ
        return view('list_birthday');
    }

    public function search_top() //検索条件入力画面
    {
        return view('search_top');
    }

    public function search_result() //検索結果画面
    {
        return view('search_result');
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
        $today = date('Ymd'); //YYYYMMDDの形で8桁（ex:20220326）

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
        $aibo->aibo_serial_no = $inputs['aibo_serial_no'];
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
        return view('aibo.create_result', compact('owner')); //aibo情報ではなく、親であるオーナー情報を引き継いで完了画面へ遷移
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aibo $aibo)
    {
        return view('aibo.show', compact('aibo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aibo $aibo)
    {
        $this->authorize('update', $aibo); //ポリシー適用(自分だけ編集可能)
        return view('aibo.edit', compact('aibo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aibo $aibo)
    {
        $this->authorize('update', $aibo); //ポリシー適用(自分だけ編集可能)

        //バリデーション
        $inputs = $request;
        $inputs['aibo_birthday'] = sprintf('%04d', $inputs['aibo_birthday_yyyy']).sprintf('%02d', $inputs['aibo_birthday_mm']).sprintf('%02d', $inputs['aibo_birthday_dd']);
        $today = date('Ymd'); //YYYYMMDDの形で8桁（ex:20220326）

        $inputs=$request->validate([
            'aibo_name' => 'required',
            'aibo_kana' => 'required|hiragana',
            'aibo_nickname' => 'required',
            'aibo_icon' => 'image',
            'aibo_icon_del' => '',//削除チェック
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
            'aibo_friend_qr_del' => '',//削除チェック
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'aibo_birthday.date' => "aiboの誕生日が日付ではありません。",
            'aibo_birthday.gte' => "aiboの誕生日は、発売日（2018年1月11日）以降で指定してください。",
            'aibo_birthday.lte' => "aiboの誕生日は、今日より過去で指定してください。",
        ]);

        //オーナー情報取得
        // $user_id=auth()->user()->id;
        // $owner=Owner::where('user_id', $user_id)->first();

        //保存
        // $aibo = new Aibo();
        // $aibo->owner_id = $owner->id;
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
        $aibo->aibo_serial_no = $inputs['aibo_serial_no'];
        $aibo->aibo_plan = $inputs['aibo_plan'];
        $aibo->aibo_care = $inputs['aibo_care'];
        $aibo->aibo_message = $inputs['aibo_message'];
        $aibo->aibo_reason = $inputs['aibo_reason'];
        // $aibo->aibo_friend_qr = NULL;
        $aibo->aibo_available_flag = true;

        //画像の削除
        $del_flg = 0;//削除したかどうか
        $checkbox_aibo_icon_del = 0; //削除チェックボックスの値
        if(isset($inputs['aibo_icon_del'])){ //非表示の時は取得できないのでisset
            $checkbox_aibo_icon_del = $inputs['aibo_icon_del'];
        }
        if ($aibo->aibo_icon!=='default.jpg' &&  $checkbox_aibo_icon_del == '1') {
            $old='public/aibo_icon/'.$aibo->aibo_icon;
            Storage::delete($old);
            $aibo->aibo_icon = NULL; //デフォルト(NULL)をセット
            $del_flg = 1;//削除後
        }

        //画像の保存
        //アイコン
        if (request('aibo_icon')){
            //古い画像は削除
            if ($aibo->aibo_icon!=='default.jpg') {
                $old='public/aibo_icon/'.$aibo->aibo_icon;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('aibo_icon')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_icon')->move('storage/aibo_icon', $name);
            $aibo->aibo_icon = $name;
        }

        //QRコードの削除
        $del_flg = 0;//削除したかどうか
        $checkbox_aibo_friend_qr_del = 0; //削除チェックボックスの値
        if(isset($inputs['aibo_friend_qr_del'])){ //非表示の時は取得できないのでisset
            $checkbox_aibo_friend_qr_del = $inputs['aibo_friend_qr_del'];
        }
        if ($aibo->aibo_friend_qr!=='default.jpg' &&  $checkbox_aibo_friend_qr_del == '1') {
            $old='public/aibo_friend_qr/'.$aibo->aibo_friend_qr;
            Storage::delete($old);
            $aibo->aibo_friend_qr = NULL; //デフォルト(NULL)をセット
            $del_flg = 1;//削除後
        }

        //フレンドQRコード
        if (request('aibo_friend_qr')){
            //古い画像は削除
            if ($aibo->aibo_friend_qr!=='default.jpg') {
                $old='public/aibo_friend_qr/'.$aibo->aibo_friend_qr;
                Storage::delete($old);
            }
            //新しい画像を保管
            $original = request()->file('aibo_friend_qr')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('aibo_friend_qr')->move('storage/aibo_friend_qr', $name);
            $aibo->aibo_friend_qr = $name;
        }

        //DBに追加
        $aibo->save();
        return redirect()->route('aibo.show', $aibo)->with('message', 'aibo情報を更新しました。');
        //return back()->with('message', 'aibo情報を更新しました。');

        //return view('aibo.show', compact('aibo')); //これはNG。URLが/mypage/aiboとなってしまうため。
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
