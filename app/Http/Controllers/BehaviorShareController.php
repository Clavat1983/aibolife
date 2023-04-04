<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BehaviorShare;
use App\Models\Notification;
use App\Models\Aibo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //画像削除用

class BehaviorShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //このページに来たページネーションのページ数
            $page = $request->page;
            
            if(isset($page)){
                $mes = "ページあり";
                $seed = $request->seed; //乱数は発生させずランダム順は固定
            } else {
                $mes = "ページなし";
                $page = 1;
                $seed = mt_rand(1, 999); //1ページ目(初めて来た)として乱数発生
            }
            
            //ふるまい一覧（ランダムで取得）
            $query = BehaviorShare::query();
            $query = $query->select(DB::raw("behavior_shares.*, aibos.aibo_available_flag"));
            $query = $query->leftJoin('aibos', 'behavior_shares.aibo_id', '=', 'aibos.id');
            $query = $query->where('aibo_available_flag', true);
            $behaviors = $query->inRandomOrder($seed)->paginate(10); //inRandomOrderの引数はシード、ランダムだけど順番を固定できるのでぺジネーションで同じ番号が出ない

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('behavior.share_index', compact('bell_count','behaviors','page','seed','mes'));
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
    }

    //ふるまい共有コード貼り付け画面
    public function create()
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            //どのaiboのふるまいか選択用
            $aibos = Aibo::where('owner_id', auth()->user()->owner->id)->where('aibo_available_flag', true)->orderBy('id')->get();

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('behavior.share_create', compact('bell_count','aibos'));
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
        $inputs = $request->validate([
            'aibo_id' => 'required',
            'my_aibo_code' => 'required',
        ]);

        $my_aibo_code = $inputs['my_aibo_code'];

        //my_aibo_codeのチェック
        $code_error_flg = false;
            $my_aibo_code = str_replace(array("\r\n","\r","\n"), "【ここで改行】", $my_aibo_code);
                
            //▼コードチェック(ここから)
                //「#aibotricks」が含まれない
                if(!mb_strpos($my_aibo_code, "【ここで改行】#aibotricks", 0, "UTF-8")){ 
                    $code_error_flg = true;
                } else {
                    //最後の#aibotricksを消す
                    $my_aibo_code = str_replace("#aibotricks", "", $my_aibo_code);
                    //文字列を分割する
                    $code_ary = explode("【ここで改行】",$my_aibo_code);

                    //ふるまいの名前チェック
                    if(mb_strlen(trim($code_ary[0])) == 0){ //ふるまいの名前がない
                        $code_error_flg = true;
                    } else {
                        //URLのチェック(正規表現1)
                        preg_match('/^https:\/\/myaibo\.aibo\.sony\.jp\/#\/tricks\//', $code_ary[1], $m);//先頭
                        if($m){ //1がtrueなら、さらに(正規表現2を)チェック
                            preg_match('/&via=public_share$/', $code_ary[1], $m);//最後
                        } 
                        if(!$m){ //正規表現1または2が（先頭か最後）がfalseなら
                            $code_error_flg = true;
                        }
                    }
                }
           
        if($code_error_flg){
            //貼り付けたコードに問題あり
            return back()->with('code_error_flg', 'コード不備')->withInput(); //セッションの「code_error_flg」に「コード不備」の文字列を入れ、Input内容を保持して戻る
        } else if (BehaviorShare::where('behavior_dl_url', $code_ary[1])->exists()) {
            //既に登録されているふるまい(URLチェック)
            return back()->with('code_exists_flg', '登録済')->withInput(); //セッションの「code_exists_flg」に「登録済」の文字列を入れ、Input内容を保持して戻る
        } else {
            //問題なし（新規登録する）
            $behavior = new BehaviorShare();
            $behavior->aibo_id = $inputs['aibo_id'];
            $behavior->behavior_name = $code_ary[0];
            $behavior->behavior_dl_url = $code_ary[1];
            $behavior->behavior_info = "";

            for ($i = 2; $i < count($code_ary); $i++){
                if($code_ary[$i] != ""){
                    if($i >= 3){
                        $behavior->behavior_info .= "\n";//次の行
                    }
                    $behavior->behavior_info .= $code_ary[$i];
                }
            }

            $behavior->behavior_photo = NULL;
            $behavior->behavior_tweet = NULL;
            $behavior->behavior_youtube = NULL;
            $behavior->behavior_share_status = true;
            $behavior->save();//DBへ登録


            //今登録したふるまいを取得
            $insert_behavior = BehaviorShare::where('aibo_id', $behavior->aibo_id)->where('behavior_dl_url', $code_ary[1])->first();

            //遷移元が新規登録であることを示して、編集画面へ転送
            $process = "insert";
            return redirect()->route('behaviorshare.edit',['behavior' => $insert_behavior])->with('process', $process);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BehaviorShare $behavior, Request $request)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $page = $request->page; //このページに来たページネーションのページ数
            $seed = $request->seed; //ページネーションのランダムのSeed値

            //【全ビュー共通処理】未読通知数
            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            return view('behavior.share_show', compact('bell_count', 'behavior','page','seed'));
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
    public function edit(BehaviorShare $behavior)
    {
        $this->authorize('update', $behavior); //ポリシー適用(自分だけ編集可能)

        $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
        return view('behavior.share_edit', compact('bell_count', 'behavior'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BehaviorShare $behavior)
    {
        //「ログイン済」かつ「オーナー登録済」かつ「aibo登録済」
        if((auth()->user()->owner != NULL) && (auth()->user()->owner->aibos->firstWhere('aibo_available_flag', true) != NULL)){
            $this->authorize('update', $behavior); //ポリシー適用(自分だけ編集可能)

            $inputs=$request->validate([
                'process' => 'required',
                'behavior_info' => 'required',
                'behavior_photo' => 'nullable|image',
                'behavior_photo_del' => '',
    //            'behavior_tweet' => 'nullable|url',
    //            'behavior_youtube' => 'nullable|url',
            ],
            [ //第2引数はバリエーションメッセージのカスタマイズ
                'behavior_info.required' => "ふるまいの説明は必ず入力してください。",
            ]
            );

            //更新(変更対象の項目のみ、リクエストから取得してセット)
                $behavior->behavior_info = $inputs['behavior_info'];
    //            $behavior->behavior_tweet = $inputs['behavior_tweet'];
    //            $behavior->behavior_youtube = $inputs['behavior_youtube'];

                //画像部分
                    //画像の削除フラグ確認
                    $del_flg = 0;//削除したかどうか
                    $checkbox_behavior_photo_del = 0; //削除チェックボックスの値
                    if(isset($inputs['behavior_photo_del'])){ //非表示の時は取得できないのでisset
                        $checkbox_behavior_photo_del = $inputs['behavior_photo_del'];
                    }
                    if ($behavior->behavior_photo!=='default.jpg' &&  $checkbox_behavior_photo_del == '1') {
                        $old='public/behavior_photo/'.$behavior->behavior_photo;
                        Storage::delete($old);
                        $behavior->behavior_photo = NULL; //デフォルト(NULL)をセット
                        $del_flg = 1;//削除後
                    }

                    //保存
                    if (request('behavior_photo')){
                        //古い画像は削除
                        if ($behavior->behavior_photo!=='default.jpg') {
                            $old='public/behavior_photo/'.$behavior->behavior_photo;
                            Storage::delete($old);
                        }
                        //新しい画像を保管
                        $original = request()->file('behavior_photo')->getClientOriginalName();
                        $name = date('Ymd_His').'_'.$original;
                        request()->file('behavior_photo')->move('storage/behavior_photo', $name);
                        $behavior->behavior_photo = $name;
                    }
                
                //DBを更新
                $behavior->save();

            //新規登録か更新か
            $process = $inputs['process'];

            $bell_count = Notification::where('user_id', auth()->user()->id)->where('read_at', NULL)->count();
            //return view('behavior.share_show', compact('bell_count', 'behavior', 'process'));
            return redirect()->route('behaviorshare.show',['behavior' => $behavior])->with('process', $process); //個別表示へ
        } else { //aibo登録まで完了していないと閲覧不可
            return redirect()->route('errors.limited');
        }
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
