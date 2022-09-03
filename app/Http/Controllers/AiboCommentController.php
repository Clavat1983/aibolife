<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiboComment;
use App\Models\Aibo;
use App\Models\Notification;

class AiboCommentController extends Controller
{
    public function store(Request $request)
    {
        $inputs=request()->validate([
            'aibo_comment_body'=>'required',
        ],
        //エラーメッセージ
        [
            'aibo_comment_body.required' => "コメントは必ず指定してください。",
        ]);

        //コメントをDBに保存
        $comment= new AiboComment();
        $comment->aibo_id = $request->aibo_id;
        $comment->owner_id = auth()->user()->owner->id;
        $comment->aibo_comment_body = $inputs['aibo_comment_body'];
        $comment->save();


        //通知作成
            //1. このaiboのオーナーに対して
            $target_aibo = Aibo::where('id', $request->aibo_id)->first();
            if(($target_aibo->owner->user != NULL) && ($target_aibo->owner->user->id != auth()->user()->id)){ //このaiboのオーナーが自分ではない場合 
                $notification = new Notification();
                $notification->category = 'aibo';
                $notification->user_id = $target_aibo->owner->user->id;
                $notification->send_user_id = auth()->user()->id;
                $notification->title = 'aiboにcommentがついたよ[1]';
                $notification->link_url = $target_aibo->id;
                $notification->save();
            }

            //2. このaiboにコメントをつけている人に対して（「自分」と「このaiboのオーナー(1.で通知済)」を除く）
            $comment_owners = AiboComment::select('owner_id')->where('aibo_id', $request->aibo_id)->whereNotIn('owner_id', [$target_aibo->owner->id, auth()->user()->owner->id])->distinct()->get();
            if($comment_owners){ //他にコメントをつけた人
                foreach($comment_owners as $comment_owner){
                    $notification = new Notification();
                    $notification->category = 'aibo';
                    $notification->user_id = $comment_owner->owner->user->id; //他にコメントをつけたオーナーのユーザID
                    $notification->send_user_id = auth()->user()->id;
                    $notification->title = 'aiboにcommentがついたよ[2]';
                    $notification->link_url = $target_aibo->id;
                    $notification->save();
                }
            }

        return back();
    }
}
