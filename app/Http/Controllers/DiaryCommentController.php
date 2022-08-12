<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaryComment;
use App\Models\Diary;
use App\Models\Notification;

class DiaryCommentController extends Controller
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
        $inputs=request()->validate([
            'diary_comment_body'=>'required',
        ],
        //エラーメッセージ
        [
            'diary_comment_body.required' => "コメントは必ず指定してください。",
        ]);

        //コメントをDBに保存
        $comment= new DiaryComment();

        $comment->diary_id = $request->diary_id;
        $comment->owner_id = auth()->user()->owner->id;
        $comment->diary_comment_body = $inputs['diary_comment_body'];

        $comment->save();

        
        //通知作成
            //1. この日記を書いた人に対して
            $target_diary = Diary::where('id', $request->diary_id)->first();
            if($target_diary->aibo->owner->user->id != auth()->user()->id){ //日記を書いた人が自分ではない場合 
                $notification = new Notification();
                $notification->category = 'diary';
                $notification->user_id = $target_diary->aibo->owner->user->id;
                $notification->send_user_id = auth()->user()->id;
                $notification->title = '日記にcommentがついたよ[1]';
                $notification->link_url = $target_diary->id;
                $notification->save();
            }

            //2. この日記にコメントをつけている人に対して（「自分」と「日記を書いた人(1.で通知済)」を除く）
            $comment_owners = DiaryComment::select('owner_id')->where('diary_id', $request->diary_id)->whereNotIn('owner_id', [$target_diary->aibo->owner->id, auth()->user()->owner->id])->distinct()->get();
            if($comment_owners){ //他にコメントをつけた人
                foreach($comment_owners as $comment_owner){
                    $notification = new Notification();
                    $notification->category = 'diary';
                    $notification->user_id = $comment_owner->owner->user->id; //他にコメントをつけたオーナーのユーザID
                    $notification->send_user_id = auth()->user()->id;
                    $notification->title = '日記にcommentがついたよ[2]';
                    $notification->link_url = $target_diary->id;
                    $notification->save();
                }
            }

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
