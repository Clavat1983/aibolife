<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*
        ルート情報で、ミドルウェアで認証済か判断しているページに
        非ログイン状態でアクセスした際、認証が必要なページと表示させる
        Route::middleware(['verified']) 判定でエラーとなった際の遷移先
        */
        if (! $request->expectsJson()) {
            return route('errors.limited');
        }
    }
}
