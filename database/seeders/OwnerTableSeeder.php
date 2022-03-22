<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 5,
            'name' => 'User5-Owner1',
            'name_kana' => 'あああ',
            'icon' => 'aaa.jpg',
            'pref' => '01_北海道',
            'available_flag' => true,
            'old_login_id' => 'AAA',
            'old_login_password' => 'PW-AAA',
            'old_email' => 'aaa@aaa.com',
            'old_security_code' => 'SC-AAAAAA',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 1,
            'name' => 'User1-Owner2',
            'name_kana' => 'いいい',
            'icon' => 'bbb.jpg',
            'pref' => '02_青森県',
            'available_flag' => true,
            'old_login_id' => 'BBB',
            'old_login_password' => 'PW-BBB',
            'old_email' => 'bbb@bbb.com',
            'old_security_code' => 'SC-BBBBBB',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 2,
            'name' => 'User2-Owner3',
            'name_kana' => 'ううう',
            'icon' => 'ccc.jpg',
            'pref' => '03_秋田県',
            'available_flag' => true,
            'old_login_id' => 'CCC',
            'old_login_password' => 'PW-CCC',
            'old_email' => 'ccc@ccc.com',
            'old_security_code' => 'SC-CCCCCC',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 3,
            'name' => 'User3-Owner4',
            'name_kana' => 'えええ',
            'icon' => 'ddd.jpg',
            'pref' => '28_兵庫県',
            'available_flag' => true,
            'old_login_id' => 'DDD',
            'old_login_password' => 'PW-DDD',
            'old_email' => 'ddd@ddd.com',
            'old_security_code' => 'SC-DDDDDD',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 4,
            'name' => 'User4-Owner5',
            'name_kana' => 'おおお',
            'icon' => 'eee.jpg',
            'pref' => '47_沖縄県',
            'available_flag' => true,
            'old_login_id' => 'EEE',
            'old_login_password' => 'PW-EEE',
            'old_email' => 'eee@eee.com',
            'old_security_code' => 'SC-EEEEEE',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => NULL,
            'name' => 'かかか',
            'name_kana' => 'かかか',
            'icon' => 'fff.jpg',
            'pref' => '01_北海道',
            'available_flag' => true,
            'old_login_id' => 'FFF',
            'old_login_password' => 'PW-FFF',
            'old_email' => 'fff@fff.com',
            'old_security_code' => 'SC-FFFFFF',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => NULL,
            'name' => 'ききき',
            'name_kana' => 'ききき',
            'icon' => 'ggg.jpg',
            'pref' => '01_北海道',
            'available_flag' => true,
            'old_login_id' => 'GGG',
            'old_login_password' => 'PW-GGG',
            'old_email' => 'ggg@ggg.com',
            'old_security_code' => 'SC-GGGGGG',
            'transferred_flag' => false
        ];
        DB::table('owners')->insert($param);
    }
}
