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
        //お問い合わせを取得
        //$contacts = Contact::select('parent_no','category','title',DB::raw("MIN(id) as id, MAX(child_no) as child_no, MIN(kidoku_flag) as kidoku_flag, MIN(created_at) as created_at, MAX(updated_at) as updated_at"))->where('owner_id', auth()->user()->id)->groupBy('parent_no','category','title')->orderBy('id', 'desc')->paginate(10);

        $sub = Contact::select('parent_no')->where('owner_id', auth()->user()->owner->id)->get(); //自分の問い合わせ
        $contacts = Contact::select('parent_no','category','title',DB::raw("MIN(id) as id, MAX(child_no) as child_no, MIN(kidoku_flag) as kidoku_flag, MIN(created_at) as created_at, MAX(updated_at) as updated_at"))->whereIn('parent_no', $sub)->groupBy('parent_no','category','title')->paginate(10);

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('contact.list', compact('contacts','bell_count'));
    }

    public function show(Contact $contact)
    {
        $access_flag = Contact::select('parent_no')->where('parent_no', $contact->parent_no)->where('owner_id', auth()->user()->owner->id)->first();

        if(!$access_flag){ //他人の問い合わせは閲覧できない
            abort(403); //エラーページへ転送
        } else { //自分の問い合わせ

            //「$contact」のidは単体なので、親番に紐づくレスも含めて全て取ってくる
            $contacts = Contact::where('parent_no', $contact->parent_no)->orderBy('id')->get();


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
            $contact->kidoku_flag = 1; //自分は見たことにする
            $contact->reply_flag = 0; //まだレスはついていないことにする
        $contact->save();
        

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
            $contact->kidoku_flag = 1; //自分は見たことにする
            $contact->reply_flag = 0; //まだレスはついていないことにする
        $contact->save();
        

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
