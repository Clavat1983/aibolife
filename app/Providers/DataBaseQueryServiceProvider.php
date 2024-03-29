<?php

namespace App\Providers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

// use Illuminate\Support\Facades\Auth;
use Request;

class DataBaseQueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (config('logging.sql.enable') === false) {
            return;
        }

        DB::listen(function ($query): void {
            $sql = $query->sql;

            foreach ($query->bindings as $binding) {
                if (is_string($binding)) {
                    $binding = "'{$binding}'";
                } elseif (is_bool($binding)) {
                    $binding = $binding ? '1' : '0';
                } elseif (is_int($binding)) {
                    $binding = (string) $binding;
                } elseif ($binding === null) {
                    $binding = 'NULL';
                } elseif ($binding instanceof Carbon) {
                    $binding = "'{$binding->toDateTimeString()}'";
                } elseif ($binding instanceof DateTime) {
                    $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                }

                $sql = preg_replace('/\\?/', $binding, $sql, 1);
            }

            // Auth::id(); //何故かものすごく処理が重たくなったのでログには入れず
            //IPアドレス取得
            $ip = Request::ip();
            // //ログに吐き出し
            Log::channel('sql')->debug('SQL', ['sql' => $sql, 'IP' => $ip, 'HOST' => gethostbyaddr($ip)]);
        });

        Event::listen(TransactionBeginning::class, function (TransactionBeginning $event): void {
            Log::channel('sql')->debug('START TRANSACTION');
        });

        Event::listen(TransactionCommitted::class, function (TransactionCommitted $event): void {
            Log::channel('sql')->debug('COMMIT');
        });

        Event::listen(TransactionRolledBack::class, function (TransactionRolledBack $event): void {
            Log::channel('sql')->debug('ROLLBACK');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
