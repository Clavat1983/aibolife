<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Board;
use App\Models\Notification;
use Carbon\Carbon; //日付操作
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //画像削除用

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_talk()
    {

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('board.index_talk', compact('bell_count'));
    }

    public function index_problem()
    {
        
        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('board.index_problem', compact('bell_count'));
    }

    public function index_club()
    {
        
        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('board.index_club', compact('bell_count'));
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
