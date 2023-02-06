<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  Route::get('/', function () {
//      return view('welcome');
//  });
Route::get('/', 'RootController@root')->name('root'); //トップページにアクセスしたとき

//Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home'); //認証後のリダイレクト判定を含む
    Route::get('/mypage', 'HomeController@mypage')->name('mypage'); //マイページ

    //通知
    Route::get('/mypage/notification', 'NotificationController@index')->name('notification.index'); //通知一覧
    Route::get('/mypage/notification/{notification}', 'NotificationController@redirect')->name('notification.redirect'); //通知一覧

    //ユーザ登録情報
    Route::get('/mypage/user/{user}/edit', 'UserController@edit')->name('user.edit');//変更(入力)
    Route::put('/mypage/user/{user}', 'UserController@update')->name('user.update');//変更(DB更新)

    //オーナー情報
    Route::get('/mypage/owner/transfer', 'OwnerController@transfer')->name('owner.transfer');//オーナー登録(新規か引継ぎか選択)
    Route::get('/mypage/owner/transfer/login', 'OwnerController@transfer_login')->name('owner.transfer_login');//旧ユーザ情報の入力画面
    Route::post('/mypage/owner/transfer/result', 'OwnerController@transfer_result')->name('owner.transfer_result');//旧ユーザ情報の入力画面

    Route::get('/mypage/owner/create', 'OwnerController@create')->name('owner.create');//オーナー登録(新規-入力画面)
    Route::post('/mypage/owner', 'OwnerController@store')->name('owner.store');//オーナー登録(新規-DB登録)
    Route::get('/mypage/owner/{owner}/edit', 'OwnerController@edit')->name('owner.edit');//変更(入力)
    Route::put('/mypage/owner/{owner}', 'OwnerController@update')->name('owner.update');//変更(DB更新)

    //aibo情報(mypage)
    Route::get('/mypage/aibo/create', 'AiboController@create')->name('aibo.create');//aibo登録
    Route::post('/mypage/aibo', 'AiboController@store')->name('aibo.store');//aibo登録・追加(新規-DB登録)
    Route::get('/mypage/aibo/{aibo}/edit', 'AiboController@edit')->name('aibo.edit');//変更(入力)
    Route::put('/mypage/aibo/{aibo}', 'AiboController@update')->name('aibo.update');//変更(DB更新)
    //aibo情報(公開)
    Route::get('/friend', 'AiboController@index')->name('aibo.index');//aibo名鑑トップ
    Route::get('/friend/namelist', 'AiboController@list_syllabary')->name('aibo.list_syllabary');
    Route::get('/friend/namelist/{syllabary}', 'AiboController@result_syllabary')->name('aibo.result_syllabary');
    Route::get('/friend/birthday', 'AiboController@list_birthday')->name('aibo.list_birthday');
    Route::get('/friend/birthday/{month}', 'AiboController@result_birthday')->name('aibo.result_birthday');
    Route::get('/friend/areamap', 'AiboController@list_area')->name('aibo.list_area');
    Route::get('/friend/areamap/{pref}', 'AiboController@result_area')->name('aibo.result_area');
    Route::get('/friend/newface', 'AiboController@newface')->name('aibo.newface');
    Route::get('/friend/search', 'AiboController@search')->name('aibo.search');
//    Route::post('/friend/search/result', 'AiboController@search_result')->name('aibo.search_result');

    Route::get('/friend/{aibo}', 'AiboController@show')->name('aibo.show');//aiboを個別表示
    //aiboコメント
    Route::post('/friend/comment/store', 'AiboCommentController@store')->name('aibocomment.store');//(新規-DB登録)

    //aibo日記
    Route::get('/diary', 'DiaryController@index')->name('diary.index');//【廃止】aibo日記トップ【廃止】⇒今日の一覧へ転送
    Route::get('/diary/list_day', 'DiaryController@list_day')->name('diary.list_day');//aibo日記一覧（日ごと）
    Route::get('/diary/list_aibo', 'DiaryController@list_aibo')->name('diary.list_aibo');//aibo日記一覧（aiboごと）
    Route::get('/diary/archive', 'DiaryController@archive')->name('diary.archive');//aibo日記（過去の日記アーカイブ）
    Route::get('/diary/recently', 'DiaryController@recently')->name('diary.recently');//最新の日記トップ
    Route::get('/diary/commented', 'DiaryCommentController@commented')->name('diary.commented');//コメントを付けた日記一覧
    Route::get('/diary/bookmark', 'DiaryReactionController@bookmark')->name('diary.bookmark');//お気に入り日記一覧
    Route::get('/diary/search', 'DiaryController@search')->name('diary.search');//お気に入り日記一覧

    Route::get('/diary/create', 'DiaryController@create')->name('diary.create');//日記を書く(新規-入力画面)
    Route::post('/diary', 'DiaryController@store')->name('diary.store');//日記を書く(新規-DB登録)
    Route::get('/diary/{diary}', 'DiaryController@show')->name('diary.show');//日記を個別表示
    Route::get('/diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit');//変更(入力)
    Route::put('/diary/{diary}', 'DiaryController@update')->name('diary.update');//変更(DB更新)

    //日記コメント
    Route::post('/diary/comment/store', 'DiaryCommentController@store')->name('diarycomment.store');//(新規-DB登録)

    //日記にリアクション
    Route::post('/diary/reaction/', 'DiaryReactionController@store')->name('diaryreaction.store');//付ける・外すともに

    //ふるまい共有
    Route::get('/behavior/share', 'BehaviorShareController@index')->name('behaviorshare.index'); //一覧画面
    Route::get('/behavior/share/create', 'BehaviorShareController@create')->name('behaviorshare.create'); //登録画面
    Route::post('/behavior/share', 'BehaviorShareController@store')->name('behaviorshare.store'); //新規登録画面
    Route::get('/behavior/share/{behavior}/edit', 'BehaviorShareController@edit')->name('behaviorshare.edit'); //編集画面
    Route::put('/behavior/share/{behavior}', 'BehaviorShareController@update')->name('behaviorshare.update');//変更(DB更新)
    Route::get('/behavior/share/{behavior}', 'BehaviorShareController@show')->name('behaviorshare.show'); //個別画面(表示)

    //コミュニティ(掲示板)
    Route::get('/community/board/talk', 'BoardController@index_talk')->name('board.index_talk'); //一覧画面
    Route::get('/community/board/problem', 'BoardController@index_problem')->name('board.index_problem'); //一覧画面
    Route::get('/community/board/club', 'BoardController@index_club')->name('board.index_club'); //一覧画面
    Route::get('/community/board/talk/create', 'BoardController@create_talk')->name('board.create_talk'); //一覧画面
    Route::get('/community/board/problem/create', 'BoardController@create_problem')->name('board.create_problem'); //一覧画面
    Route::get('/community/board/club/create', 'BoardController@create_club')->name('board.create_club'); //一覧画面
    Route::post('/community/board/store', 'BoardController@store')->name('board.store'); //新規-DB登録
    Route::get('/community/board/{board}', 'BoardController@show')->name('board.show'); //個別画面(表示)

    Route::post('/community/board/comment/store', 'BoardCommentController@store')->name('boardcomment.store'); //(コメント新規-DB登録)


    //イベントカレンダー
    Route::get('/useful/event/calendar', 'EventCalendarController@index')->name('eventcalendar.index');//イベントカレンダー（すべて）

    //最新情報(News->URLだけTopicsに変えた)
        //管理者用(パスワード再確認を挟む)、★が付くのは管理画面トップからリンクあり
        Route::group(['middleware' => 'auth'], function(){
            Route::middleware('password.confirm')->group(function(){
                Route::get('/admin', 'HomeController@admin')->name('home.admin'); //管理者画面トップ
                //▼最新情報(TOPICS)
                Route::get('/topics/{news}/preview', 'NewsController@preview')->name('news.preview');//最新情報（個別表示=管理者プレビュー）
                Route::get('/topics/admin', 'NewsController@admin')->name('news.admin');//最新情報（全件表示）★
                Route::get('/topics/create', 'NewsController@create')->name('news.create');//最新情報(新規-入力画面)★
                Route::post('/topics', 'NewsController@store')->name('news.store');//最新情報(新規-DB登録)
                Route::get('/topics/{news}/edit', 'NewsController@edit')->name('news.edit');//変更(入力)
                Route::put('/topics/{news}', 'NewsController@update')->name('news.update');//変更(DB更新)
                //▼イベントカレンダー
                Route::get('/event/admin', 'EventCalendarController@admin')->name('event.admin');//イベントカレンダー（全件表示）★
                Route::get('/event/create', 'EventCalendarController@create')->name('event.create');//イベントカレンダー(新規-入力画面)★
                Route::post('/event', 'EventCalendarController@store')->name('event.store');//イベントカレンダー(新規-DB登録)
                Route::get('/event/{event}/edit', 'EventCalendarController@edit')->name('event.edit');//変更(入力)
                Route::put('/event/{event}', 'EventCalendarController@update')->name('event.update');//変更(DB更新)
                //▼お問い合わせ
                Route::get('/admin/contact', 'ContactController@list_admin')->name('contact.list_admin');//お問い合わせ(一覧)
            });
        });
        //一般ユーザ
        Route::get('/topics', 'NewsController@index')->name('news.index');//最新情報一覧（すべて）
        Route::get('/topics/news', 'NewsController@index_news')->name('news.index_news');//カテゴリ別（ニュース）
        Route::get('/topics/event', 'NewsController@index_event')->name('news.index_event');//カテゴリ別（イベント）
        Route::get('/topics/media', 'NewsController@index_media')->name('news.index_media');//カテゴリ別（メディア）
        Route::get('/topics/info', 'NewsController@index_info')->name('news.index_info');//カテゴリ別（お知らせ）
        Route::get('/topics/update', 'NewsController@index_update')->name('news.index_update');//カテゴリ別（アップデート）
        Route::get('/topics/maintenance', 'NewsController@index_maintenance')->name('news.index_maintenance');//カテゴリ別（障害・メンテ）
        Route::get('/topics/special', 'NewsController@index_special')->name('news.index_special');//カテゴリ別（スペシャル）
        Route::get('/topics/etc', 'NewsController@index_etc')->name('news.index_etc');//カテゴリ別（その他）

        Route::get('/topics/search', 'NewsController@search')->name('news.search');//検索＆検索結果

        Route::get('/topics/{news}', 'NewsController@show')->name('news.show');//最新情報（個別表示）

        //お問い合わせ
        Route::get('/mypage/contact', 'ContactController@list')->name('contact.list');//お問い合わせ(一覧)
        Route::get('/mypage/contact/{contact}', 'ContactController@show')->name('contact.show');//お問い合わせ(個別画面)
        Route::post('/mypage/contact', 'ContactController@store_res')->name('contact.store_res');//お問い合わせ(既存のお問い合わせへのレス)

});

//認証外

    //再認証画面へ
    //Route::get('/mypage/user/reverify', function(){return view('user.reverify');})->name('user.reverify');
    Route::get('/mypage/user/reverify', 'UserController@reverify')->name('user.reverify');

    //はじめに
    Route::get('/guide/about', 'GuideController@about')->name('guide.about');//aibo lifeとは?
    Route::get('/guide/rule', 'GuideController@rule')->name('guide.rule');//利用規約
    Route::get('/guide/manual', 'GuideController@manual')->name('guide.manual');//利用ガイド
    Route::get('/guide/policy', 'GuideController@policy')->name('guide.policy');//プライバシーポリシー
    Route::get('/guide/staff', 'GuideController@staff')->name('guide.staff');//運営メンバー
    Route::get('/guide/faq', 'GuideController@faq')->name('guide.faq');//よくある質問
    Route::get('/guide/copyright', 'GuideController@copyright')->name('guide.copyright');//権利表記

    //お役立ち情報(一部)
    Route::get('/useful/food', 'UsefulController@food')->name('useful.food');//ごはん
    Route::get('/useful/fashion', 'UsefulController@fashion')->name('useful.fashion');//ファッション
    Route::get('/useful/event', 'UsefulController@event')->name('useful.event');//イベント概要（カレンダーではない）
    Route::get('/useful/goods', 'UsefulController@goods')->name('useful.goods');//グッズ
    Route::get('/useful/shop', 'UsefulController@shop')->name('useful.shop');//店舗・施設
    Route::get('/useful/history', 'UsefulController@history')->name('useful.history');//歴史


    //お問い合わせ
    Route::get('/contact', 'ContactController@index')->name('contact.index');//お問い合わせ(トップ)
//    Route::get('/mypage/contact', 'ContactController@list')->name('contact.list');//お問い合わせ(一覧)：要ログイン
    Route::get('/contact/new', 'ContactController@new')->name('contact.new');//お問い合わせ(入力画面)
    Route::post('/contact', 'ContactController@store_new')->name('contact.store_new');//お問い合わせ(新規お問い合わせの保存)

    //バナー広告一覧（確認用）
    Route::get('/banner', 'ContactController@banner')->name('contact.banner');

