<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aibos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('aibo_name');
            $table->string('aibo_kana');
            $table->string('aibo_kana_gyo');
            $table->string('aibo_keisho');
            $table->string('aibo_icon')->nullable();
            $table->text('aibo_yurai')->nullable();
            $table->date('aibo_birthday');
            $table->string('aibo_color');
            $table->string('aibo_sex');
            $table->string('aibo_personality');
            $table->string('aibo_eye');
            $table->string('aibo_voice');
            $table->string('aibo_ear');
            $table->string('aibo_hand');
            $table->string('aibo_tail');

            $table->boolean('aibo_toy_ball_flag');
            $table->boolean('aibo_toy_born_flag');
            $table->boolean('aibo_toy_dice_flag');
            $table->boolean('aibo_toy_book1_flag');
            $table->boolean('aibo_toy_book2_flag');
            $table->boolean('aibo_toy_food_flag');
            $table->boolean('aibo_toy_drink_flag');

            $table->string('aibo_plan');
            $table->string('aibo_care');
            $table->text('aibo_message')->nullable();
            $table->text('aibo_reason')->nullable();
            $table->string('aibo_friend_code_qr');
            $table->boolean('aibo_available_flag')->dafault(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
     public function down()
    {
        Schema::dropIfExists('aibos');
    }
}
