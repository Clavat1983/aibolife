<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //未読も既読も全て
            $notifications = Notification::selectRaw('* , notifications.id as number, notifications.created_at as created_datetime')->leftjoin('owners', function($join){$join->on('notifications.send_user_id','=','owners.user_id');})->where('notifications.user_id', auth()->user()->id)->orderBy('created_datetime', 'desc')->orderBy('number', 'desc')->paginate(2);//ページネーションあり;

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('notification.index', compact('bell_count','notifications'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }


    //通知を既読にして、該当のページへリダイレクトする
    public function redirect(Notification $notification)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //自分の通知しか見れないように制御
            if($notification->user_id != auth()->user()->id){
                abort(403);
            } else { //自分の通知の場合
                //通知を既読にする
                if($notification->read_at == NULL){
                    $notification->read_at = now();
                    $notification->save();
                }
                //通知元のページに遷移する
                if($notification->category == 'aibo'){ //aiboのページ
                    return redirect()->route('aibo.show',$notification->link_url);
                } else if($notification->category == 'diary'){//日記のページ
                    return redirect()->route('diary.show',$notification->link_url);
                } else if($notification->category == 'contact'){//お問い合わせのページ
                    return redirect()->route('contact.show',$notification->link_url);
                } else { //転送先がない
                    abort(404);
                }
            }
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('home');
        }
    }
}
