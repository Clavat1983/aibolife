<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaryReaction;
use App\Models\Notification;

class DiaryReactionController extends Controller
{
    public function store(Request $request)
    {
        $diary_id = $request->diary_id;
        $owner_id = auth()->user()->owner->id;
        $reaction_type = $request->reaction_type;

        //0-5(リアクション)は既に付いているリアクションを消去、6-7(お気に入り)はお気に入りだけ消す
        if($reaction_type <= 5){
            //6(お気に入り)以外を消す)
            $like = DiaryReaction::where('diary_id', $diary_id)->where('reaction_type', '!=', 6)->where('owner_id', $owner_id)->delete();
        } else {
            //6(お気に入り)のみ消す
            $like = DiaryReaction::where('diary_id', $diary_id)->where('reaction_type', 6)->where('owner_id', $owner_id)->delete();
        }

        //リアクションをDBに保存
        if($request->reaction_type > 0 && $request->reaction_type != 7){
            $reaction= new DiaryReaction();
            $reaction->diary_id = $diary_id;
            $reaction->owner_id = $owner_id;
            $reaction->reaction_type = $reaction_type;
            $reaction->save();
        }

        
        // //通知作成
        //     //1. この日記を書いた人に対して
        //     $target_diary = Diary::where('id', $request->diary_id)->first();
        //     if(($target_diary->aibo->owner->user != NULL) && ($target_diary->aibo->owner->user->id != auth()->user()->id)){ //日記を書いた人が自分ではない場合 
        //         $notification = new Notification();
        //         $notification->category = 'diary';
        //         $notification->user_id = $target_diary->aibo->owner->user->id;
        //         $notification->send_user_id = auth()->user()->id;
        //         $notification->title = '日記にcommentがついたよ[1]';
        //         $notification->link_url = $target_diary->id;
        //         $notification->save();
        //     }

        //     //2. この日記にコメントをつけている人に対して（「自分」と「日記を書いた人(1.で通知済)」を除く）
        //     $comment_owners = DiaryComment::select('owner_id')->where('diary_id', $request->diary_id)->whereNotIn('owner_id', [$target_diary->aibo->owner->id, auth()->user()->owner->id])->distinct()->get();
        //     if($comment_owners){ //他にコメントをつけた人
        //         foreach($comment_owners as $comment_owner){
        //             if($comment_owner->owner->user != NULL){ //コメントを付けたオーナーのユーザID(空の場合、新aibolife未登録状態となり通知できない)
        //                 $notification = new Notification();
        //                 $notification->category = 'diary';
        //                 $notification->user_id = $comment_owner->owner->user->id; //他にコメントをつけたオーナーのユーザID
        //                 $notification->send_user_id = auth()->user()->id;
        //                 $notification->title = '日記にcommentがついたよ[2]';
        //                 $notification->link_url = $target_diary->id;
        //                 $notification->save();
        //             }
        //         }
        //     }

        return back();
    }

    
    //お気に入りの日記
    public function bookmark()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $owner_id = auth()->user()->owner->id;
            //reaction_type=6がお気に入り
            $bookmarks = DiaryReaction::where('owner_id', $owner_id)->where('reaction_type', 6)->orderBy('created_at', 'desc')->paginate(10);

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('diary.bookmark', compact('bell_count','bookmarks'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }
}
