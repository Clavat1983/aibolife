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
    Route::get('/aibo', 'AiboController@index')->name('aibo.index');//aibo名鑑トップ
    Route::get('/aibo/syllabary', 'AiboController@list_syllabary')->name('aibo.list_syllabary');
    Route::get('/aibo/syllabary/{syllabary}', 'AiboController@result_syllabary')->name('aibo.result_syllabary');
    Route::get('/aibo/area', 'AiboController@list_area')->name('aibo.list_area');
    Route::get('/aibo/area/{pref}', 'AiboController@result_area')->name('aibo.result_area');
    Route::get('/aibo/birthday', 'AiboController@list_birthday')->name('aibo.list_birthday');
    Route::get('/aibo/birthday/{month}', 'AiboController@result_birthday')->name('aibo.result_birthday');
    Route::get('/aibo/search', 'AiboController@search_top')->name('aibo.search_top');
    Route::put('/aibo/result', 'AiboController@search_result')->name('aibo.search_result');

    Route::get('/aibo/{aibo}', 'AiboController@show')->name('aibo.show');//aiboを個別表示
    //aiboコメント
    Route::post('/aibo/comment/store', 'AiboCommentController@store')->name('aibocomment.store');//(新規-DB登録)

    //aibo日記
    Route::get('/diary', 'DiaryController@index')->name('diary.index');//aibo日記トップ
    Route::get('/diary/list_day', 'DiaryController@list_day')->name('diary.list_day');//aibo日記一覧（日ごと）
    Route::get('/diary/list_aibo', 'DiaryController@list_aibo')->name('diary.list_aibo');//aibo日記一覧（aiboごと）
    Route::get('/diary/archive', 'DiaryController@archive')->name('diary.archive');//aibo日記（過去の日記アーカイブ）

    Route::get('/diary/create', 'DiaryController@create')->name('diary.create');//日記を書く(新規-入力画面)
    Route::post('/diary', 'DiaryController@store')->name('diary.store');//日記を書く(新規-DB登録)
    Route::get('/diary/{diary}', 'DiaryController@show')->name('diary.show');//日記を個別表示
    Route::get('/diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit');//変更(入力)
    Route::put('/diary/{diary}', 'DiaryController@update')->name('diary.update');//変更(DB更新)

    //日記コメント
    Route::post('/diary/comment/store', 'DiaryCommentController@store')->name('diarycomment.store');//(新規-DB登録)

    //最新情報(News->URLだけTopicsに変えた)
        //管理者用(パスワード再確認を挟む)
        Route::group(['middleware' => 'auth'], function(){
            Route::middleware('password.confirm')->group(function(){
                Route::get('/topics/{news}/preview', 'NewsController@preview')->name('news.preview');//最新情報（個別表示=管理者プレビュー）
                Route::get('/topics/admin', 'NewsController@admin')->name('news.admin');//最新情報（全件表示）
                Route::get('/topics/create', 'NewsController@create')->name('news.create');//最新情報(新規-入力画面)
                Route::post('/topics', 'NewsController@store')->name('news.store');//最新情報(新規-DB登録)
                Route::get('/topics/{news}/edit', 'NewsController@edit')->name('news.edit');//変更(入力)
                Route::put('/topics/{news}', 'NewsController@update')->name('news.update');//変更(DB更新)
            });
        });
        //一般ユーザ
        Route::get('/topics', 'NewsController@index')->name('news.index');//最新情報一覧（すべて）
        Route::get('/topics/news', 'NewsController@index_news')->name('news.index_news');//カテゴリ別（公式ニュース）
        Route::get('/topics/event', 'NewsController@index_event')->name('news.index_event');//カテゴリ別（公式イベント）
        Route::get('/topics/media', 'NewsController@index_media')->name('news.index_media');//カテゴリ別（メディア）
        Route::get('/topics/info', 'NewsController@index_info')->name('news.index_info');//カテゴリ別（お知らせ）
        Route::get('/topics/special', 'NewsController@index_special')->name('news.index_special');//カテゴリ別（スペシャル）
        Route::get('/topics/maintenance', 'NewsController@index_maintenance')->name('news.index_maintenance');//カテゴリ別（障害・メンテ）

        Route::get('/topics/{news}', 'NewsController@show')->name('news.show');//最新情報（個別表示）


});

//認証外
    //再認証画面へ
    Route::get('/mypage/user/reverify', function(){return view('user.reverify');})->name('user.reverify');
    //お問い合わせ
    Route::get('/contact/create', 'ContactController@create')->name('contact.create');//お問い合わせ(入力画面)
    Route::post('/contact', 'ContactController@store')->name('contact.store');//お問い合わせ(保存)

