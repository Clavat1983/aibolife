<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Contact;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        if (Auth::check()) { //ログインしている場合
            return redirect()->route('contact.list');
        } else { //ログインしていない場合
            return redirect()->route('contact.new');
        }

    }

    public function list()
    {
        if(auth()->user()->role == 'admin'){
            return redirect()->route('contact.list_admin');
        } else {
            //自分or自分がレスをつけた問い合わせ
            $sub = Contact::select('parent_no')->where('owner_id', auth()->user()->owner->id)->get();
            $contacts = Contact::select('parent_no','category','title',DB::raw("MIN(id) as id, MAX(child_no) as child_no, MIN(kidoku_flag) as kidoku_flag, MIN(created_at) as created_at, MAX(updated_at) as updated_at"))->whereIn('parent_no', $sub)->groupBy('parent_no','category','title')->orderby('updated_at','desc')->paginate(10);

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('contact.list', compact('contacts','bell_count'));
        }
    }

    public function list_admin()
    {
        if(auth()->user()->role == 'admin'){
            //問い合わせ(全て)
            $contacts = Contact::select('parent_no','category','title',DB::raw("MIN(id) as id, MAX(child_no) as child_no, MIN(reply_flag) as reply_flag, MIN(created_at) as created_at, MAX(updated_at) as updated_at"))->groupBy('parent_no','category','title')->orderby('updated_at','desc')->paginate(10);

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('contact.list_admin', compact('contacts','bell_count'));
        } else {
            return redirect()->route('contact.list');
        }
    }

    public function show(Contact $contact)
    {
        //問い合わせしたのが自分自身か
        $access_flag = Contact::select('parent_no')->where('parent_no', $contact->parent_no)->where('owner_id', auth()->user()->owner->id)->first();

        //ただし管理者ならどの問い合わせにもアクセス可能とする
        if(auth()->user()->role == 'admin'){
            $access_flag = true;
        }

        if(!$access_flag){ //他人の問い合わせは閲覧できない
            abort(403); //エラーページへ転送
        } else { //自分の問い合わせ

            //「$contact」のidは単体なので、親番に紐づくレスも含めて全て取ってくる
            $contacts = Contact::where('parent_no', $contact->parent_no)->orderBy('id')->get();

            //ユーザの場合（管理者ではない）、個別のやりとりを閲覧したとして問い合わせ・レスを全て既読にする
            if(auth()->user()->role != 'admin'){
                foreach($contacts as $contact){
                    $contact->kidoku_flag = 1;
                    $contact->save();
                }
            }

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('contact.show', compact('access_flag','contacts','bell_count'));
        }
    }

    //新規投稿（ログイン外・ログイン中 両方）
    public function new()
    {
        if (Auth::check()) { //ログインしている場合
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        } else { //ログインしていない場合
            $bell_count = 0;
        }
        return view('contact.new', compact('bell_count'));

    }

    public function store_new(Request $request)
    {
        $inputs = $request->validate([
            'category' => 'required',
            'title'=>'required|max:255',
            'body'=>'required',
            'owner_id' => 'required',
            'name' => 'required|max:255',
            'email'=>'required|email|max:255',
        ],[
            //第2引数はバリエーションメッセージのカスタマイズ
            'category.required' => 'カテゴリーは必ず指定してください。',
        ]);

        $parent_no = Contact::max('parent_no');

        //保存
        $contact = new Contact();
            $contact->parent_no = $parent_no + 1;
            $contact->child_no = 0;
            $contact->category = $inputs['category'];
            $contact->title = $inputs['title'];
            $contact->body = $inputs['body'];
            $contact->owner_id = $inputs['owner_id'];
            $contact->name = $inputs['name'];
            $contact->email = $inputs['email'];
            if(Auth::check() && auth()->user()->role == 'admin'){ //管理者が質問を投稿したら(基本ありえない)
                $contact->kidoku_flag = 0; //利用者は未読状態にする
                $contact->reply_flag = 1; //管理者によるレスはついたことにする
            } else { //ユーザー
                $contact->kidoku_flag = 1; //自分は見たことにする
                $contact->reply_flag = 0; //まだレスはついていないことにする
            }
        $contact->save();

        //管理者への通知
        $new_contact = Contact::where('parent_no',$contact->parent_no)->where('child_no', 0)->first(); //今発生した問い合わせ

        $notification = new Notification();
        $notification->category = 'contact';
        $notification->user_id = 1; //通知先は管理者のユーザID(1)固定
        if (Auth::check()) { //ログインしている場合
            $notification->send_user_id = auth()->user()->id; //投稿した人のユーザID(オーナーIDではないので注意)
        } else {
            $notification->send_user_id = 0;
        }
        $notification->title = '新たなお問い合わせがありました';
        $notification->link_url = $new_contact->id;
        $notification->save();
        
        if (Auth::check()) { //ログインしている場合
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        } else { //ログインしていない場合
            $bell_count = 0;
        }

        //画面遷移
        return view('contact.thanks', compact('bell_count'));
    }

    public function store_res(Request $request)
    {
        $inputs = $request->validate([
            'body'=>'required',
        ],[
            //第2引数はバリエーションメッセージのカスタマイズ
        ]);

        $child_no = Contact::where('parent_no', $request['parent_no'])->max('child_no');

        //保存
        $contact = new Contact();
            $contact->parent_no = $request['parent_no'];
            $contact->child_no = $child_no+1;
            $contact->category = $request['category'];
            $contact->title = $request['title'];
            $contact->body = $request['body'];
            $contact->owner_id = $request['owner_id'];
            $contact->name = $request['name'];
            $contact->email = $request['email'];
            if(auth()->user()->role != 'admin'){ //通常
                $contact->kidoku_flag = 1; //自分は見たことにする
                $contact->reply_flag = 0; //まだレスはついていないことにする
            } else { //管理者
                $contact->kidoku_flag = 0; //利用者は未読状態にする
                $contact->reply_flag = 1; //管理者によるレスはついたことにする
            }
        $contact->save();
        
        //管理者によるレスのときは、親に紐づくレスは全て返信済とする
        if(auth()->user()->role == 'admin'){
            $contacts = Contact::where('parent_no', $request['parent_no'])->get();
            foreach($contacts as $child){
                $child->reply_flag = 1;
                $child->save();
            }
        }

        //レスを通知（利用者→管理者 / 管理者→利用者)
        if($request['owner_id_from'] != 0){ //0は登録外のユーザからの問い合わせなので通知しない
        $new_contact = Contact::where('parent_no',$contact->parent_no)->where('child_no', $contact->child_no)->first(); //今発生したレス

            //投稿した人についてオーナーIDからユーザIDへ変換
            $owner_2_user = Owner::where('id', $request['owner_id_from'])->first();

            //通知生成
            $notification = new Notification();
            $notification->category = 'contact';
            if(auth()->user()->role == 'admin'){ //管理者からのレス → 元のオーナーに通知
                $notification->user_id = $owner_2_user->user_id; //通知先は問い合わせ元のユーザID(通知の宛先はオーナーIDではないので注意)
                $notification->send_user_id = 1; //投稿した人(管理人のユーザID)
            } else { //元のオーナーからのレス → 管理者に通知
                $notification->user_id = 1; //通知先は管理者(1)固定
                $notification->send_user_id = $owner_2_user->user_id; //問い合わせ元のユーザID(通知の宛先はオーナーIDではないので注意)
            }
            $notification->title = 'お問い合わせに返答ありました';
            $notification->link_url = $new_contact->id;
            $notification->save();
        }

        if (Auth::check()) { //ログインしている場合
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        } else { //ログインしていない場合
            $bell_count = 0;
        }

        //画面遷移
        return back()->with('bell_count', $bell_count);
    }


    //バナー広告確認用
    public function banner(){
        return view('banner');
    }
}
