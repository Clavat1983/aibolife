<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加

class AiboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'owner_id' => '3',
            'aibo_name' => 'かかか',
            'aibo_kana' => 'かかか',
            'aibo_kana_gyo' => 'か',
            'aibo_nickname' => 'かーくん',
            'aibo_icon' => 'aibo1.jpg',
            'aibo_yurai' => 'か　由来',
            'aibo_birthday' => '2020-01-01',
            'aibo_color' => 'choco',
            'aibo_sex' => 'boy',
            'aibo_personality' => 'aaa',
            'aibo_eye' => 'blue',
            'aibo_voice' => 'dog',
            'aibo_ear' => 'black',
            'aibo_hand' => 'right',
            'aibo_tail' => 'choco',

            'aibo_toy_ball_flag' => true,
            'aibo_toy_born_flag' => true,
            'aibo_toy_dice_flag' => true,
            'aibo_toy_book1_flag' => false,
            'aibo_toy_book2_flag' => true,
            'aibo_toy_food_flag' => false,
            'aibo_toy_drink_flag' => true,

            'aibo_serial_no' => '1111100',
            'aibo_plan' => 'normal',
            'aibo_care' => 'normal',
            'aibo_message' => 'メッセージ　かかか',
            'aibo_reason' => 'お迎え理由　かかか',
            'aibo_friend_qr' => 'aibo1_qr_code.jpg',
            'aibo_available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '3',
            'aibo_name' => 'ききき',
            'aibo_kana' => 'ききき',
            'aibo_kana_gyo' => 'き',
            'aibo_nickname' => 'きーちゃん',
            'aibo_icon' => 'aibo2.jpg',
            'aibo_yurai' => 'き　由来',
            'aibo_birthday' => '2020-01-02',
            'aibo_color' => 'choco',
            'aibo_sex' => 'boy',
            'aibo_personality' => 'aaa',
            'aibo_eye' => 'blue',
            'aibo_voice' => 'dog',
            'aibo_ear' => 'black',
            'aibo_hand' => 'right',
            'aibo_tail' => 'choco',

            'aibo_toy_ball_flag' => true,
            'aibo_toy_born_flag' => true,
            'aibo_toy_dice_flag' => true,
            'aibo_toy_book1_flag' => false,
            'aibo_toy_book2_flag' => true,
            'aibo_toy_food_flag' => false,
            'aibo_toy_drink_flag' => true,

            'aibo_serial_no' => '2222200',
            'aibo_plan' => 'normal',
            'aibo_care' => 'normal',
            'aibo_message' => 'メッセージ　ききき',
            'aibo_reason' => 'お迎え理由　ききき',
            'aibo_friend_qr' => 'aibo2_qr_code.jpg',
            'aibo_available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '1',
            'aibo_name' => 'くくく',
            'aibo_kana' => 'くくく',
            'aibo_kana_gyo' => 'く',
            'aibo_nickname' => 'くーちゃん',
            'aibo_icon' => 'aibo3.jpg',
            'aibo_yurai' => 'く　由来',
            'aibo_birthday' => '2020-01-03',
            'aibo_color' => 'kurogoma',
            'aibo_sex' => 'girl',
            'aibo_personality' => 'aaa',
            'aibo_eye' => 'blue',
            'aibo_voice' => 'dog',
            'aibo_ear' => 'black',
            'aibo_hand' => 'right',
            'aibo_tail' => 'choco',

            'aibo_toy_ball_flag' => true,
            'aibo_toy_born_flag' => true,
            'aibo_toy_dice_flag' => true,
            'aibo_toy_book1_flag' => false,
            'aibo_toy_book2_flag' => true,
            'aibo_toy_food_flag' => false,
            'aibo_toy_drink_flag' => true,

            'aibo_serial_no' => '3333300',
            'aibo_plan' => 'normal',
            'aibo_care' => 'normal',
            'aibo_message' => 'メッセージ　くくく',
            'aibo_reason' => 'お迎え理由　くくく',
            'aibo_friend_qr' => 'aibo3_qr_code.jpg',
            'aibo_available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '2',
            'aibo_name' => 'けけけ',
            'aibo_kana' => 'けけけ',
            'aibo_kana_gyo' => 'け',
            'aibo_nickname' => 'けーくん',
            'aibo_icon' => 'aibo4.jpg',
            'aibo_yurai' => 'け　由来',
            'aibo_birthday' => '2020-01-04',
            'aibo_color' => 'ichigo',
            'aibo_sex' => 'girl',
            'aibo_personality' => 'aaa',
            'aibo_eye' => 'blue',
            'aibo_voice' => 'dog',
            'aibo_ear' => 'black',
            'aibo_hand' => 'right',
            'aibo_tail' => 'choco',

            'aibo_toy_ball_flag' => true,
            'aibo_toy_born_flag' => true,
            'aibo_toy_dice_flag' => true,
            'aibo_toy_book1_flag' => false,
            'aibo_toy_book2_flag' => true,
            'aibo_toy_food_flag' => false,
            'aibo_toy_drink_flag' => true,

            'aibo_serial_no' => '4444400',
            'aibo_plan' => 'normal',
            'aibo_care' => 'normal',
            'aibo_message' => 'メッセージ　けけけ',
            'aibo_reason' => 'お迎え理由　むむむ',
            'aibo_friend_qr' => 'aibo4_qr_code.jpg',
            'aibo_available_flag' => true
        ];
        DB::table('aibos')->insert($param);
    }
}
