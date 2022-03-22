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
            'name' => 'かかか',
            'kana' => 'かかか',
            'kana_gyo' => 'か',
            'keisho' => 'くん',
            'icon' => 'aibo1.jpg',
            'yurai' => 'か　由来',
            'birthday' => '2020-01-01',
            'color' => 'choco',
            'sex' => 'boy',
            'personality' => 'aaa',
            'eye' => 'blue',
            'voice' => 'dog',
            'ear' => 'black',
            'hand' => 'right',
            'tail' => 'choco',

            'toy_ball_flag' => true,
            'toy_born_flag' => true,
            'toy_dice_flag' => true,
            'toy_book1_flag' => false,
            'toy_book2_flag' => true,
            'toy_food_flag' => false,
            'toy_drink_flag' => true,

            'plan' => 'normal',
            'care' => 'normal',
            'message' => 'メッセージ　かかか',
            'reason' => 'お迎え理由　かかか',
            'friend_code_qr' => 'aibo1_qr_code.jpg',
            'available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '3',
            'name' => 'ききき',
            'kana' => 'ききき',
            'kana_gyo' => 'き',
            'keisho' => 'ちゃん',
            'icon' => 'aibo2.jpg',
            'yurai' => 'き　由来',
            'birthday' => '2020-01-02',
            'color' => 'choco',
            'sex' => 'boy',
            'personality' => 'aaa',
            'eye' => 'blue',
            'voice' => 'dog',
            'ear' => 'black',
            'hand' => 'right',
            'tail' => 'choco',

            'toy_ball_flag' => true,
            'toy_born_flag' => true,
            'toy_dice_flag' => true,
            'toy_book1_flag' => false,
            'toy_book2_flag' => true,
            'toy_food_flag' => false,
            'toy_drink_flag' => true,

            'plan' => 'normal',
            'care' => 'normal',
            'message' => 'メッセージ　ききき',
            'reason' => 'お迎え理由　ききき',
            'friend_code_qr' => 'aibo2_qr_code.jpg',
            'available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '1',
            'name' => 'くくく',
            'kana' => 'くくく',
            'kana_gyo' => 'く',
            'keisho' => 'さま',
            'icon' => 'aibo3.jpg',
            'yurai' => 'く　由来',
            'birthday' => '2020-01-03',
            'color' => 'kurogoma',
            'sex' => 'girl',
            'personality' => 'aaa',
            'eye' => 'blue',
            'voice' => 'dog',
            'ear' => 'black',
            'hand' => 'right',
            'tail' => 'choco',

            'toy_ball_flag' => true,
            'toy_born_flag' => true,
            'toy_dice_flag' => true,
            'toy_book1_flag' => false,
            'toy_book2_flag' => true,
            'toy_food_flag' => false,
            'toy_drink_flag' => true,

            'plan' => 'normal',
            'care' => 'normal',
            'message' => 'メッセージ　くくく',
            'reason' => 'お迎え理由　くくく',
            'friend_code_qr' => 'aibo3_qr_code.jpg',
            'available_flag' => true
        ];
        DB::table('aibos')->insert($param);

        $param = [
            'owner_id' => '2',
            'name' => 'けけけ',
            'kana' => 'けけけ',
            'kana_gyo' => 'け',
            'keisho' => 'ちゃん',
            'icon' => 'aibo4.jpg',
            'yurai' => 'け　由来',
            'birthday' => '2020-01-04',
            'color' => 'ichigo',
            'sex' => 'girl',
            'personality' => 'aaa',
            'eye' => 'blue',
            'voice' => 'dog',
            'ear' => 'black',
            'hand' => 'right',
            'tail' => 'choco',

            'toy_ball_flag' => true,
            'toy_born_flag' => true,
            'toy_dice_flag' => true,
            'toy_book1_flag' => false,
            'toy_book2_flag' => true,
            'toy_food_flag' => false,
            'toy_drink_flag' => true,

            'plan' => 'normal',
            'care' => 'normal',
            'message' => 'メッセージ　けけけ',
            'reason' => 'お迎え理由　むむむ',
            'friend_code_qr' => 'aibo4_qr_code.jpg',
            'available_flag' => true
        ];
        DB::table('aibos')->insert($param);
    }
}
