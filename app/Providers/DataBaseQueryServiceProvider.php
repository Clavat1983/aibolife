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

            $ip = $_SERVER['REMOTE_ADDR'];

            Log::channel('sql')->debug('SQL', ['sql' => $sql, 'IP' => $ip]);
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

    // //追加
    // public function getIp(){
    //     foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    //         if (array_key_exists($key, $_SERVER) === true){
    //             foreach (explode(',', $_SERVER[$key]) as $ip){
    //                 $ip = trim($ip); // just to be safe
    //                 if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
    //                     return $ip;
    //                 }
    //             }
    //         }
    //     }
    // }
}
