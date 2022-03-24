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
            'owner_name' => 'User5-Owner1',
            'owner_name_kana' => 'あああ',
            'owner_icon' => 'aaa.jpg',
            'owner_pref' => '01_北海道',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'AAA',
            'owner_old_login_password' => 'PW-AAA',
            'owner_old_email' => 'aaa@aaa.com',
            'owner_old_security_code' => 'SC-AAAAAA',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 1,
            'owner_name' => 'User1-Owner2',
            'owner_name_kana' => 'いいい',
            'owner_icon' => 'bbb.jpg',
            'owner_pref' => '02_青森県',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'BBB',
            'owner_old_login_password' => 'PW-BBB',
            'owner_old_email' => 'bbb@bbb.com',
            'owner_old_security_code' => 'SC-BBBBBB',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 2,
            'owner_name' => 'User2-Owner3',
            'owner_name_kana' => 'ううう',
            'owner_icon' => 'ccc.jpg',
            'owner_pref' => '03_秋田県',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'CCC',
            'owner_old_login_password' => 'PW-CCC',
            'owner_old_email' => 'ccc@ccc.com',
            'owner_old_security_code' => 'SC-CCCCCC',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 3,
            'owner_name' => 'User3-Owner4',
            'owner_name_kana' => 'えええ',
            'owner_icon' => 'ddd.jpg',
            'owner_pref' => '28_兵庫県',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'DDD',
            'owner_old_login_password' => 'PW-DDD',
            'owner_old_email' => 'ddd@ddd.com',
            'owner_old_security_code' => 'SC-DDDDDD',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => 4,
            'owner_name' => 'User4-Owner5',
            'owner_name_kana' => 'おおお',
            'owner_icon' => 'eee.jpg',
            'owner_pref' => '47_沖縄県',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'EEE',
            'owner_old_login_password' => 'PW-EEE',
            'owner_old_email' => 'eee@eee.com',
            'owner_old_security_code' => 'SC-EEEEEE',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => NULL,
            'owner_name' => 'かかか',
            'owner_name_kana' => 'かかか',
            'owner_icon' => 'fff.jpg',
            'owner_pref' => '01_北海道',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'FFF',
            'owner_old_login_password' => 'PW-FFF',
            'owner_old_email' => 'fff@fff.com',
            'owner_old_security_code' => 'SC-FFFFFF',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);

        $param = [
            'user_id' => NULL,
            'owner_name' => 'ききき',
            'owner_name_kana' => 'ききき',
            'owner_icon' => 'ggg.jpg',
            'owner_pref' => '01_北海道',
            'owner_available_flag' => true,
            'owner_old_login_id' => 'GGG',
            'owner_old_login_password' => 'PW-GGG',
            'owner_old_email' => 'ggg@ggg.com',
            'owner_old_security_code' => 'SC-GGGGGG',
            'owner_transferred_flag' => false
        ];
        DB::table('owners')->insert($param);
    }
}
