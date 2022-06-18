<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; //追加
use Illuminate\Support\Facades\Validator; //追加

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ページネーションはbootstrapを使用するように追加
        Paginator::useBootstrap();

        //バリデーション追加
        Validator::extend('hiragana', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[ぁ-んー]+$/u', $value);
        });
    }
}
