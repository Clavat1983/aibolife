<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BehaviorShare;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class BehaviorShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //このページに来たページネーションのページ数
        $page = $request->page;
        
        if(isset($page)){
            $mes = "ページあり";
            $seed = $request->seed; //乱数は発生させずランダム順は固定
        } else {
            $mes = "ページなし";
            $page = 1;
            $seed = mt_rand(1, 999); //1ページ目(初めて来た)として乱数発生
        }
        

        
        //ふるまい一覧（ランダムで取得）
        $query = BehaviorShare::query();
        $query = $query->select(DB::raw("behavior_shares.*, aibos.aibo_available_flag"));
        $query = $query->leftJoin('aibos', 'behavior_shares.aibo_id', '=', 'aibos.id');
        $query = $query->where('aibo_available_flag', true);
        $behaviors = $query->inRandomOrder($seed)->paginate(10); //inRandomOrderの引数はシード、ランダムだけど順番を固定できるのでぺジネーションで同じ番号が出ない

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('behavior.share_index', compact('bell_count','behaviors','page','seed','mes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('behavior.share_create', compact('bell_count'));
    }

    //共有コード読み込み（分割＆チェック）
    public function confirm(Request $request)
    {

        $my_aibo_code = $request->my_aibo_code;
        $error_message = "";
        
        //バリデーション的なもの
        if(!isset($my_aibo_code) || $my_aibo_code == ""){
            $error_message = 'コードを貼り付けて下さい';
        } else {
            //変な文字列を除去
            //$my_aibo_code = htmlspecialchars($my_aibo_code);
            $my_aibo_code = str_replace(array("\r\n","\r","\n"), "【ここで改行】", $my_aibo_code);
            
            //▼コードチェック(ここから)
                //「#aibotricks」が含まれない
                if(!mb_strpos($my_aibo_code, "【ここで改行】#aibotricks", 0, "UTF-8")){ 
                    $error_message = '「My aibo」の共有コードを最後の「#aibotricks」まで含めてそのまま貼り付けて下さい';
                } else {
                    //最後の#aibotricksを消す
                    $my_aibo_code = str_replace("#aibotricks", "", $my_aibo_code);
                    //文字列を分割する
                    $code_ary = explode("【ここで改行】",$my_aibo_code);
                }
            //▲コードチェック(ここまで)
        }

        //画面遷移
        if($error_message != ""){ //エラー
            return back()->with('message', $error_message); //withの内容はパラメータではなくてセッションに入る
        } else { //正常
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('behavior.share_confirm', compact('bell_count','code_ary'));
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
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('behavior.share_store', compact('bell_count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BehaviorShare $behavior, Request $request)
    {
        $page = $request->page; //このページに来たページネーションのページ数
        $seed = $request->seed; //ページネーションのランダムのSeed値

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('behavior.share_show', compact('bell_count', 'behavior','page','seed'));
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
