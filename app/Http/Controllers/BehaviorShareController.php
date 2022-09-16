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
