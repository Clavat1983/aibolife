<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aibo_id');
            $table->date('diary_date');
            $table->string('diary_title');
            $table->string('diary_photo1');
            $table->string('diary_photo2');
            $table->string('diary_photo3');
            $table->string('diary_photo4');
            $table->text('diary_body');
            $table->string('diary_personality');
            $table->string('diary_weather');
            $table->boolean('diary_share_flag')->default(true);
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
        Schema::dropIfExists('diaries');
    }
}
