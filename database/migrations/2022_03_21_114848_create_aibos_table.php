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
            $table->string('name');
            $table->string('kana');
            $table->string('kana_gyo');
            $table->string('keisho');
            $table->string('icon')->nullable();
            $table->text('yurai')->nullable();
            $table->date('birthday');
            $table->string('color');
            $table->string('sex');
            $table->string('personality');
            $table->string('eye');
            $table->string('voice');
            $table->string('ear');
            $table->string('hand');
            $table->string('tail');

            $table->boolean('toy_ball_flag');
            $table->boolean('toy_born_flag');
            $table->boolean('toy_dice_flag');
            $table->boolean('toy_book1_flag');
            $table->boolean('toy_book2_flag');
            $table->boolean('toy_food_flag');
            $table->boolean('toy_drink_flag');

            $table->string('plan');
            $table->string('care');
            $table->text('message')->nullable();
            $table->text('reason')->nullable();
            $table->string('friend_code_qr');
            $table->boolean('available_flag')->dafault(true);
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
