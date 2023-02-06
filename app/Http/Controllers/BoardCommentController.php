<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardComment;
use App\Models\Board;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class BoardCommentController extends Controller
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
        $board_id = $request->board_id;
        $owner_id = auth()->user()->owner->id;
        $submit_no = $request->submit_no; //押されたsubmitボタンの中身
        $body_no = "body_".$submit_no;
        $body = $request->$body_no;

        //どのボタンが押されたか
        list($xxx,$child_no,$mago_no) = preg_split('/-/', $submit_no);

        if($child_no == "x"){
            //子としてコメントを投稿するので、何番目の子にするか調べる
            $max = BoardComment::where('board_id',$board_id)->max('child_no');
            $child_no = $max + 1;
        } else if ($mago_no == "x") {
            //子に紐づく孫としてコメントを投稿するので、何番目の孫にするか調べる
            $max = BoardComment::where('board_id',$board_id)->where('child_no',$child_no)->max('mago_no');
            $mago_no = $max + 1;
        }

        //コメントをDBに保存
        $comment= new BoardComment();
        $comment->board_id = $board_id;
        $comment->child_no = $child_no;
        $comment->mago_no = $mago_no;
        $comment->owner_id = $owner_id;
        $comment->body = $submit_no."のボタンが押されて投稿。［".$body."］";
        $comment->image1 = NULL;
        $comment->image2 = NULL;
        $comment->image3 = NULL;
        $comment->image4 = NULL;
        $comment->image5 = NULL;
        $comment->open_flag = 1;
        $comment->save();

        //Board自体の最終更新日時を変更
        $target_board = Board::where('id', $board_id)->first();
        $target_board->last_res_dt = date("Y-m-d H:i:s");
        $target_board->save();

        return back();
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
