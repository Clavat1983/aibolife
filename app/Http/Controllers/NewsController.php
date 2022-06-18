<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage; //画像削除用
use Carbon\Carbon; //日付操作

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_all = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->paginate(5);//ページネーションあり
        return view('news.index', compact('news_all'));
    }

    //管理者用の全件表示
    public function admin()
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)のみ入力画面表示
            $news_all = News::orderby('news_publication_datetime', 'desc')->paginate(5);//ページネーションあり
            return view('news.admin', compact('news_all'));
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
            return view('news.create', compact('now'));
        } else {
            abort(404);
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

        //現在のニュースの最大ID
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

        //プレビューページへ
        return redirect()->route('news.preview', compact('news'));
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
        $news_all = News::where('news_publication_flag',1)->where('news_publication_datetime','<=',date('Y-m-d H:i:s'))->orderby('news_publication_datetime', 'desc')->get();
        $nth = $news_all->search($news); //ニュース一覧($news_all)内で何番目の記事か
        $prev = $news_all->get($nth+1);//1つ古い記事(descなのでソート順で言うと後)
        $next = $news_all->get($nth-1);//1つ新しい記事(descなのでソート順で言うと前)

        //return
        if($news->news_publication_flag && ($open <= $now)){ //true(公開)
            return view('news.show', compact('news', 'prev', 'next'));
        } else { //false(非公開)
            abort(404);
        }
    }

    //管理者は公開前や非公開の記事もプレビューを確認できる
    public function preview(News $news)
    {
        $role=auth()->user()->role;
        if($role == 'admin'){ //admin(管理者)
            return view('news.preview', compact('news'));
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
        return view('news.edit', compact('news'));
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
