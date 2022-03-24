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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function(){

    Route::get('/', 'HomeController@index')->name('home'); //認証後のリダイレクト判定を含む

    //ユーザ登録情報
    Route::get('/mypage/user/{user}/edit', 'UserController@edit')->name('user.edit');//変更(入力)
    Route::put('/mypage/user/{user}', 'UserController@update')->name('user.update');//変更(DB更新)

    //オーナー情報
    Route::get('/mypage/owner/transfer', 'OwnerController@transfer')->name('owner.transfer');//オーナー登録(新規か引継ぎか選択)
    Route::get('/mypage/owner/transfer/login', 'OwnerController@transfer_login')->name('owner.transfer_login');//旧ユーザ情報の入力画面
    Route::post('/mypage/owner/transfer/result', 'OwnerController@transfer_result')->name('owner.transfer_result');//旧ユーザ情報の入力画面

    Route::get('/mypage/owner/create', 'OwnerController@create')->name('owner.create');//オーナー登録(新規-入力画面)
    Route::post('/mypage/owner/store', 'OwnerController@store')->name('owner.store');//オーナー登録(新規-DB登録)

    Route::get('/mypage/owner/{owner}/edit', 'OwnerController@edit')->name('owner.edit');//変更(入力)
    Route::put('/mypage/owner/{owner}', 'OwnerController@update')->name('owner.update');//変更(DB更新)

    //aibo情報
    Route::get('/mypage/aibo/create', 'AiboController@create')->name('aibo.create');//aibo登録

});

//認証外
Route::get('/mypage/user/reverify', function(){return view('user.reverify');})->name('user.reverify');


