<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage; //画像削除用
use Carbon\Carbon; //日付操作
use Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //すべて
    {
        $category = 'すべて';
        $news_all = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり

        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));

    }

    public function index_news() //ニュース
    {
        $category = 'ニュース';
        $news_all = News::where('news_category',$category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));

    }

    public function index_event() //イベント
    {
        $category = 'イベント';
        $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));

    }

    public function index_media() //メディア
    {
        $category = 'メディア';
        $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));
    }

    public function index_app() //Myaibo
    {
        $category = 'My aibo';
        $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));
    }

    public function index_store() //ストア
    {
        $category = 'ストア';
        $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));
    }

    public function index_maintenance() //メンテナンス
    {
        $category = 'メンテナンス';
        $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
        
        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.index', compact('bell_count','category','news_all'));
    }

    public function index_special() //特別企画
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            $category = '特別企画';
            $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
            
            if (Auth::check()) { //ログインしている
                //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
                if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                    //【全ビュー共通処理】未読通知数
                    $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
                } else {
                    $bell_count = 0;
                }
            } else { //ログインしていない
                $bell_count = 0;
            }

            return view('news.index', compact('bell_count','category','news_all'));
    }

    public function index_etc() //その他
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            $category = 'その他';
            $news_all = News::where('news_category', $category)->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり
            
            if (Auth::check()) { //ログインしている
                //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
                if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                    //【全ビュー共通処理】未読通知数
                    $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
                } else {
                    $bell_count = 0;
                }
            } else { //ログインしていない
                $bell_count = 0;
            }

            return view('news.index', compact('bell_count','category','news_all'));
    }

    public function search(Request $request) //検索
    {
        $keywords = $request->keywords;
        $cat_news = $request->cat_news;
        $cat_app = $request->cat_app;
        $cat_event = $request->cat_event;
        $cat_media = $request->cat_media;
        $cat_store = $request->cat_store;
        $cat_special = $request->cat_special;
        $cat_maintenance = $request->cat_maintenance;
        $cat_etc = $request->cat_etc;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        
        if($keywords == ""){ //キーワードがない場合は検索しない
            $results = NULL;
        } else {
            //検索
            $query = News::query();

            //キーワード検索（カタカナや濁点まで区別する場合は「like」を「like BINARY」へ変更すること）
            if(isset($keywords)){
                $keyword_array =  preg_split('/\s+/ui', $keywords, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($keyword_array as $word) {
                    $escape_word = addcslashes($word, '\\_%');//エスケープ処理
                    $query = $query->where(DB::raw("CONCAT(news_title, ' ', news_body)"), 'like BINARY', '%' . $escape_word . '%');//like検索、タイトルの文字列と本文の文字列を半角スペース「 」で連結して1つのカラムとして検索
                }
            }

            //カテゴリー（チェックがあれば追加ではなく、チェック無いものを除外する）
            if($cat_news != 1){
                $query = $query->where('news_category','!=','ニュース');
            }
            if($cat_app != 1){
                $query = $query->where('news_category','!=','My aibo');
            }
            if($cat_event != 1){
                $query = $query->where('news_category','!=','イベント');
            }
            if($cat_media != 1){
                $query = $query->where('news_category','!=','メディア');
            }
            if($cat_store != 1){
                $query = $query->where('news_category','!=','ストア');
            }
            if($cat_special != 1){
                $query = $query->where('news_category','!=','特別企画');
            }
            if($cat_maintenance != 1){
                $query = $query->where('news_category','!=','メンテナンス');
            }
            if($cat_etc != 1){
                $query = $query->where('news_category','!=','その他');
            }
            $query = $query->where('news_category','!=','不要');

            //期間（開始）
            if($date_from != ''){
                $query = $query->where('news_publication_datetime','>=',$date_from.' 00:00:00');
            }

            //期間（終了）
            if($date_to != ''){
                $query = $query->where('news_publication_datetime','<=',$date_to.' 23:59:59');
            }

            $results = $query->where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10); //クエリ文字列(検索キーワード)をつけて返す
        }

        if (Auth::check()) { //ログインしている
            //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
            if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                //【全ビュー共通処理】未読通知数
                $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            } else {
                $bell_count = 0;
            }
        } else { //ログインしていない
            $bell_count = 0;
        }

        return view('news.search', compact('bell_count','keywords','cat_news','cat_app','cat_event','cat_media','cat_store','cat_special','cat_maintenance','cat_etc','date_from','date_to','results'));
    }


    //管理者用の全件表示
    public function admin()
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)のみ入力画面表示
            $news_all = News::orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->paginate(10);//ページネーションあり

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('news.admin', compact('bell_count','news_all'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)のみ入力画面表示
            $now = date('Y-m-d').'T'.date('H:i');

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('news.create', compact('bell_count','now'));
        } else {
            abort(403);
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
        //バリデーション
        $inputs=$request->validate([
            'news_publication_datetime' => 'required',
            'news_publication_flag' => 'required',
            'news_source_name' => 'required',
            'news_source_url' => '',
            'news_category' => 'required',
            'news_title' => 'required',
            'news_image1' => 'image|max:10240',//10MB
            'news_body' => 'required',
            'news_image2' => 'image|max:10240',//10MB
            'news_image3' => 'image|max:10240',//10MB
            'news_image4' => 'image|max:10240',//10MB
            'news_image5' => 'image|max:10240',//10MB
            'news_tag1' => 'required',
            'news_tag2' => '',
            'news_tag3' => '',
            'news_tag4' => '',
            'news_tag5' => '',
            'news_link1_name' => '',
            'news_link1_url' => 'nullable|url',
            'news_link2_name' => '',
            'news_link2_url' => 'nullable|url',
            'news_link3_name' => '',
            'news_link3_url' => 'nullable|url',
            'news_link4_name' => '',
            'news_link4_url' => 'nullable|url',
            'news_link5_name' => '',
            'news_link5_url' => 'nullable|url',
        ]);

        //現在のニュースの最大ID(画像を保存する際の記事IDとして取得)
        $max = News::max('id');
        $news_id = $max + 1; //最大のid+1（今回登録されるNewsのid）

        //値のセット
        $news = new News();

            //公開日時
            $news->news_publication_datetime = $inputs['news_publication_datetime'];
            //公開状態
            if($inputs['news_publication_flag'] === '公開'){
                $news->news_publication_flag = true; //公開
            } else {
                $news->news_publication_flag = false; //非公開
            }
            //情報ソース(名)
            $news->news_source_name = $inputs['news_source_name'];
            //情報ソース(URL)
            $news->news_source_url = $inputs['news_source_url'];
            //カテゴリー
            $news->news_category = $inputs['news_category'];
            //タイトル
            $news->news_title = $inputs['news_title'];
            //メイン(画像1)
            if (request('news_image1')){
                $ext = request()->file('news_image1')->getClientOriginalExtension(); //拡張子
                $name = 'news_' . sprintf('%05d', $news_id) .'_1.' . $ext;
                request()->file('news_image1')->move('storage/news_image', $name);
                $news->news_image1 = $name;
            }
            //本文
            $news->news_body = $inputs['news_body'];
            //サブ(画像2)
            if (request('news_image2')){
                $ext = request()->file('news_image2')->getClientOriginalExtension(); //拡張子
                $name = 'news_' . sprintf('%05d', $news_id) .'_2.' . $ext;
                request()->file('news_image2')->move('storage/news_image', $name);
                $news->news_image2 = $name;
            }
            //サブ(画像3)
            if (request('news_image3')){
                $ext = request()->file('news_image3')->getClientOriginalExtension(); //拡張子
                $name = 'news_' . sprintf('%05d', $news_id) .'_3.' . $ext;
                request()->file('news_image3')->move('storage/news_image', $name);
                $news->news_image3 = $name;
            }
            //サブ(画像4)
            if (request('news_image4')){
                $ext = request()->file('news_image4')->getClientOriginalExtension(); //拡張子
                $name = 'news_' . sprintf('%05d', $news_id) .'_4.' . $ext;
                request()->file('news_image4')->move('storage/news_image', $name);
                $news->news_image4 = $name;
            }
            //サブ(画像5)
            if (request('news_image5')){
                $ext = request()->file('news_image5')->getClientOriginalExtension(); //拡張子
                $name = 'news_' . sprintf('%05d', $news_id) .'_5.' . $ext;
                request()->file('news_image5')->move('storage/news_image', $name);
                $news->news_image5 = $name;
            }

            //タグ
            $news->news_tag1 = $inputs['news_tag1'];
            $news->news_tag2 = $inputs['news_tag2'];
            $news->news_tag3 = $inputs['news_tag3'];
            $news->news_tag4 = $inputs['news_tag4'];
            $news->news_tag5 = $inputs['news_tag5'];

            //リンク
            $news->news_link1_name = $inputs['news_link1_name'];
            $news->news_link1_url = $inputs['news_link1_url'];
            $news->news_link2_name = $inputs['news_link2_name'];
            $news->news_link2_url = $inputs['news_link2_url'];
            $news->news_link3_name = $inputs['news_link3_name'];
            $news->news_link3_url = $inputs['news_link3_url'];
            $news->news_link4_name = $inputs['news_link4_name'];
            $news->news_link4_url = $inputs['news_link4_url'];
            $news->news_link5_name = $inputs['news_link5_name'];
            $news->news_link5_url = $inputs['news_link5_url'];
        
        //DB保存
        $news->save();

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //プレビューページへ
        return redirect()->route('news.preview', compact('bell_count','news'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //通常ユーザは公開状態かつ公開日時が現在時刻より前のものを確認できる
    public function show(News $news)
    {
        $open = new Carbon($news->news_publication_datetime);
        $now = Carbon::now('Asia/Tokyo');

        //前後の記事移動を実現するための処理
        $news_all = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->orderby('id', 'desc')->get();
        $nth = $news_all->search($news); //ニュース一覧($news_all)内で何番目の記事か
        $prev = $news_all->get($nth+1);//1つ古い記事(descなのでソート順で言うと後)
        $next = $news_all->get($nth-1);//1つ新しい記事(descなのでソート順で言うと前)

        //return
        if($news->news_publication_flag && ($open <= $now)){ //true(公開)

            if (Auth::check()) { //ログインしている
                //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
                if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
                    //【全ビュー共通処理】未読通知数
                    $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
                } else {
                    $bell_count = 0;
                }
            } else { //ログインしていない
                $bell_count = 0;
            }

            return view('news.show', compact('bell_count','news', 'prev', 'next'));
        } else { //false(非公開)
            abort(404);
        }
    }

    //管理者は公開前や非公開の記事もプレビューを確認できる
    public function preview(News $news)
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)
            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

            return view('news.preview', compact('bell_count','news'));
        } else { //一般
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $this->authorize('update', $news); //ポリシー適用

        //【全ビュー共通処理】未読通知数
        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        return view('news.edit', compact('bell_count','news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news); //ポリシー適用

        //バリデーション
        $inputs=$request->validate([
            'news_publication_datetime' => 'required',
            'news_publication_flag' => 'required',
            'news_source_name' => 'required',
            'news_source_url' => '',
            'news_category' => 'required',
            'news_title' => 'required',
            'news_image1' => 'image|max:10240',//10MB
            'news_image1_del' => '',
            'news_body' => 'required',
            'news_image2' => 'image|max:10240',//10MB
            'news_image2_del' => '',
            'news_image3' => 'image|max:10240',//10MB
            'news_image3_del' => '',
            'news_image4' => 'image|max:10240',//10MB
            'news_image4_del' => '',
            'news_image5' => 'image|max:10240',//10MB
            'news_image5_del' => '',
            'news_tag1' => 'required',
            'news_tag2' => '',
            'news_tag3' => '',
            'news_tag4' => '',
            'news_tag5' => '',
            'news_link1_name' => '',
            'news_link1_url' => 'nullable|url',
            'news_link2_name' => '',
            'news_link2_url' => 'nullable|url',
            'news_link3_name' => '',
            'news_link3_url' => 'nullable|url',
            'news_link4_name' => '',
            'news_link4_url' => 'nullable|url',
            'news_link5_name' => '',
            'news_link5_url' => 'nullable|url',
        ]);

        $news_id = $news->id;

        // //値のセット
        // $news = new News();

            //公開日時
            $news->news_publication_datetime = $inputs['news_publication_datetime'];
            //公開状態
            if($inputs['news_publication_flag'] === '公開'){
                $news->news_publication_flag = true; //公開
            } else {
                $news->news_publication_flag = false; //非公開
            }
            //情報ソース(名)
            $news->news_source_name = $inputs['news_source_name'];
            //情報ソース(URL)
            $news->news_source_url = $inputs['news_source_url'];
            //カテゴリー
            $news->news_category = $inputs['news_category'];
            //タイトル
            $news->news_title = $inputs['news_title'];
            //メイン(画像1)
                //画像の削除
                $del_flg = 0;//削除したかどうか
                $checkbox_news_image1_del = 0; //削除チェックボックスの値
                if(isset($inputs['news_image1_del'])){ //非表示の時は取得できないのでisset
                    $checkbox_news_image1_del = $inputs['news_image1_del'];
                }
                if ($news->news_image1!=='default.jpg' &&  $checkbox_news_image1_del == '1') {
                    $old='public/news_image/'.$news->news_image1;
                    Storage::delete($old);
                    $news->news_image1 = NULL; //デフォルト(NULL)をセット
                    $del_flg = 1;//削除後
                }
                //保存
                if (request('news_image1')){
                    $ext = request()->file('news_image1')->getClientOriginalExtension(); //拡張子
                    $name = 'news_' . sprintf('%05d', $news_id) .'_1.' . $ext;
                    request()->file('news_image1')->move('storage/news_image', $name);
                    $news->news_image1 = $name;
                }
            //本文
            $news->news_body = $inputs['news_body'];
            //サブ(画像2)
                //画像の削除
                $del_flg = 0;//削除したかどうか
                $checkbox_news_image2_del = 0; //削除チェックボックスの値
                if(isset($inputs['news_image2_del'])){ //非表示の時は取得できないのでisset
                    $checkbox_news_image2_del = $inputs['news_image2_del'];
                }
                if ($news->news_image2!=='default.jpg' &&  $checkbox_news_image2_del == '1') {
                    $old='public/news_image/'.$news->news_image2;
                    Storage::delete($old);
                    $news->news_image2 = NULL; //デフォルト(NULL)をセット
                    $del_flg = 1;//削除後
                }
                //保存
                if (request('news_image2')){
                    $ext = request()->file('news_image2')->getClientOriginalExtension(); //拡張子
                    $name = 'news_' . sprintf('%05d', $news_id) .'_2.' . $ext;
                    request()->file('news_image2')->move('storage/news_image', $name);
                    $news->news_image2 = $name;
                }
            //サブ(画像3)
                //画像の削除
                $del_flg = 0;//削除したかどうか
                $checkbox_news_image3_del = 0; //削除チェックボックスの値
                if(isset($inputs['news_image3_del'])){ //非表示の時は取得できないのでisset
                    $checkbox_news_image3_del = $inputs['news_image3_del'];
                }
                if ($news->news_image3!=='default.jpg' &&  $checkbox_news_image3_del == '1') {
                    $old='public/news_image/'.$news->news_image3;
                    Storage::delete($old);
                    $news->news_image3 = NULL; //デフォルト(NULL)をセット
                    $del_flg = 1;//削除後
                }
                //保存
                if (request('news_image3')){
                    $ext = request()->file('news_image3')->getClientOriginalExtension(); //拡張子
                    $name = 'news_' . sprintf('%05d', $news_id) .'_3.' . $ext;
                    request()->file('news_image3')->move('storage/news_image', $name);
                    $news->news_image3 = $name;
                }
            //サブ(画像4)
                //画像の削除
                $del_flg = 0;//削除したかどうか
                $checkbox_news_image4_del = 0; //削除チェックボックスの値
                if(isset($inputs['news_image4_del'])){ //非表示の時は取得できないのでisset
                    $checkbox_news_image4_del = $inputs['news_image4_del'];
                }
                if ($news->news_image4!=='default.jpg' &&  $checkbox_news_image4_del == '1') {
                    $old='public/news_image/'.$news->news_image4;
                    Storage::delete($old);
                    $news->news_image4 = NULL; //デフォルト(NULL)をセット
                    $del_flg = 1;//削除後
                }
                //保存
                if (request('news_image4')){
                    $ext = request()->file('news_image4')->getClientOriginalExtension(); //拡張子
                    $name = 'news_' . sprintf('%05d', $news_id) .'_4.' . $ext;
                    request()->file('news_image4')->move('storage/news_image', $name);
                    $news->news_image4 = $name;
                }
            //サブ(画像5)
                //画像の削除
                $del_flg = 0;//削除したかどうか
                $checkbox_news_image5_del = 0; //削除チェックボックスの値
                if(isset($inputs['news_image5_del'])){ //非表示の時は取得できないのでisset
                    $checkbox_news_image5_del = $inputs['news_image5_del'];
                }
                if ($news->news_image5!=='default.jpg' &&  $checkbox_news_image5_del == '1') {
                    $old='public/news_image/'.$news->news_image5;
                    Storage::delete($old);
                    $news->news_image5 = NULL; //デフォルト(NULL)をセット
                    $del_flg = 1;//削除後
                }
                //保存
                if (request('news_image5')){
                    $ext = request()->file('news_image5')->getClientOriginalExtension(); //拡張子
                    $name = 'news_' . sprintf('%05d', $news_id) .'_5.' . $ext;
                    request()->file('news_image5')->move('storage/news_image', $name);
                    $news->news_image5 = $name;
                }

            //タグ
            $news->news_tag1 = $inputs['news_tag1'];
            $news->news_tag2 = $inputs['news_tag2'];
            $news->news_tag3 = $inputs['news_tag3'];
            $news->news_tag4 = $inputs['news_tag4'];
            $news->news_tag5 = $inputs['news_tag5'];

            //リンク
            $news->news_link1_name = $inputs['news_link1_name'];
            $news->news_link1_url = $inputs['news_link1_url'];
            $news->news_link2_name = $inputs['news_link2_name'];
            $news->news_link2_url = $inputs['news_link2_url'];
            $news->news_link3_name = $inputs['news_link3_name'];
            $news->news_link3_url = $inputs['news_link3_url'];
            $news->news_link4_name = $inputs['news_link4_name'];
            $news->news_link4_url = $inputs['news_link4_url'];
            $news->news_link5_name = $inputs['news_link5_name'];
            $news->news_link5_url = $inputs['news_link5_url'];
        
        //DB保存
        $news->save();

        //【全ビュー共通処理】未読通知数(不要)
        //$bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();

        //プレビューページへ
        return redirect()->route('news.preview', compact('news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
