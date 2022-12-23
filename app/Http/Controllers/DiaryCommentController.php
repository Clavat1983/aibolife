<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaryComment;
use App\Models\Diary;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

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
            if(($target_diary->aibo->owner->user != NULL) && ($target_diary->aibo->owner->user->id != auth()->user()->id)){ //日記を書いた人が自分ではない場合 
                $notification = new Notification();
                $notification->category = 'diary';
                $notification->user_id = $target_diary->aibo->owner->user->id;
                $notification->send_user_id = auth()->user()->id;
                $notification->title = $target_diary->aibo->aibo_name . 'の日記「'. $target_diary->diary_title .'」にコメントがつきました';
                $notification->link_url = $target_diary->id;
                $notification->save();
            }

            //2. この日記にコメントをつけている人に対して（「自分」と「日記を書いた人(1.で通知済)」を除く）
            $comment_owners = DiaryComment::select('owner_id')->where('diary_id', $request->diary_id)->whereNotIn('owner_id', [$target_diary->aibo->owner->id, auth()->user()->owner->id])->distinct()->get();
            if($comment_owners){ //他にコメントをつけた人
                foreach($comment_owners as $comment_owner){
                    if($comment_owner->owner->user != NULL){ //コメントを付けたオーナーのユーザID(空の場合、新aibolife未登録状態となり通知できない)
                        $notification = new Notification();
                        $notification->category = 'diary';
                        $notification->user_id = $comment_owner->owner->user->id; //他にコメントをつけたオーナーのユーザID
                        $notification->send_user_id = auth()->user()->id;
                        $notification->title = $target_diary->aibo->aibo_name . 'の日記「'. $target_diary->diary_title .'」へのコメントにレスがつきました';
                        $notification->link_url = $target_diary->id;
                        $notification->save();
                    }
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

    public function commented()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $owner_id = auth()->user()->owner->id;
            //コメントを付けた日記のIDを重複なしで、ページネーションありで取得
            //$comments = DiaryComment::select('diary_id')->where('owner_id', $owner_id)->groupby('diary_id')->orderby('diary_id','desc')->paginate(10);

            $comments = DiaryComment::select('diary_id',DB::raw('MAX(created_at) AS max_dt'))->where('owner_id', $owner_id)->groupby('diary_id')->orderby('max_dt','desc')->paginate(10);

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.commented', compact('bell_count','comments'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }
}
