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

        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「おしゃべり広場(category:1)」の投稿で、公開状態(open_flag:1)を更新日時順に取得
            $category_id = 1;
            $boards = Board::where('category_id', $category_id)->where('open_flag', 1)->orderby('last_res_dt','DESC')->paginate(3); //ページネーションあり


            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.index', compact('bell_count', 'category_id','boards'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }

    }

    public function index_problem()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「お悩み相談(category:2)」の投稿で、公開状態(open_flag:1)を更新日時順に取得
            $category_id = 2;
            $boards = Board::where('category_id', $category_id)->where('open_flag', 1)->orderby('last_res_dt','DESC')->paginate(3); //ページネーションあり


            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.index', compact('bell_count', 'category_id','boards'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    public function index_club()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「部活動(category:3)」の投稿で、公開状態(open_flag:1)を更新日時順に取得
            $category_id = 3;
            $boards = Board::where('category_id', $category_id)->where('open_flag', 1)->orderby('last_res_dt','DESC')->paginate(3); //ページネーションあり


            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.index', compact('bell_count', 'category_id','boards'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_talk()
    {
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「おしゃべり広場(category:1)」の新規投稿画面を表示する
            $category_id = 1;

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.create', compact('bell_count', 'category_id'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    public function create_problem()
    {
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「お悩み相談(category:2)」の新規投稿画面を表示する
            $category_id = 2;

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.create', compact('bell_count', 'category_id'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    public function create_club()
    {
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //掲示板の「クラブ活動(category:3)」の新規投稿画面を表示する
            $category_id = 3;

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('board.create', compact('bell_count', 'category_id'));

        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title' => 'required',
            'body' => 'required',
            'image1' => 'image',
            'image2' => 'image',
            'image3' => 'image',
            'image4' => 'image',
            'image5' => 'image',
            'club_name1' => 'required', //部活動以外は「なし」とhiddenで入れる
        ],
        [ //第2引数はバリエーションメッセージのカスタマイズ
            'title.required' => "タイトルは必ず指定してください。",
            'body.required' => "本文は必ず指定してください。",
            'image1.image' => "画像1が画像ファイルではありません。",
            'image2.image' => "画像2が画像ファイルではありません。",
            'image3.image' => "画像3が画像ファイルではありません。",
            'image4.image' => "画像4が画像ファイルではありません。",
            'image5.image' => "画像5が画像ファイルではありません。",
            'club_name1.required' => '部活名1は必ず指定してください。',
        ]
        );
        //hiddenで来るものもセット
        $inputs['category_id'] = $request['category_id'];

        //保存
        $board = new Board();
        $board->category_id = $inputs['category_id'];
        $board->owner_id = auth()->user()->owner->id;
        $board->title = $inputs['title'];
        $board->body = $inputs['body'];

        if($inputs['category_id'] == 3){
            $board->club_name1 = $inputs['club_name1'];
            $board->club_name2 = $request['club_name2'];
            $board->club_name3 = $request['club_name3'];
            $board->club_name4 = $request['club_name4'];
            $board->club_name5 = $request['club_name5'];
        }
        $board->open_flag = 1;
        $board->last_res_dt = date("Y-m-d H:i:s");

        //画像の保存
        if (request('image1')){
            $original = request()->file('image1')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image1')->move('storage/board_image', $name);
            $board->image1 = $name;
        }
        if (request('image2')){
            $original = request()->file('image2')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image2')->move('storage/board_image', $name);
            $board->image2 = $name;
        }
        if (request('image3')){
            $original = request()->file('image3')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image3')->move('storage/board_image', $name);
            $board->image3 = $name;
        }
        if (request('image4')){
            $original = request()->file('image4')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image4')->move('storage/board_image', $name);
            $board->image4 = $name;
        }
        if (request('image5')){
            $original = request()->file('image5')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image5')->move('storage/board_image', $name);
            $board->image5 = $name;
        }

        //DBに追加
        $board->save();

        //今書いた日記を取り出して、表示画面へ転送
        $board = Board::where('owner_id', auth()->user()->owner->id)->orderBy('id', 'DESC')->first();

        //【全ビュー共通処理】未読通知数
        //$bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return redirect()->route('board.show',['board' => $board]);//書いた日記の個別表示へ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('board.show', compact('bell_count','board'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
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
