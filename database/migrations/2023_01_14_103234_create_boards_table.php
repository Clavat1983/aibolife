<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id'); //1:おしゃべり、2:お悩み相談、3:部活動
            $table->unsignedBigInteger('owner_id');
            $table->string('title');
            $table->text('body');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('club_name1')->nullable(); //部活名
            $table->string('club_name2')->nullable(); //部活名
            $table->string('club_name3')->nullable(); //部活名
            $table->string('club_name4')->nullable(); //部活名
            $table->string('club_name5')->nullable(); //部活名
            $table->integer('open_flag')->default(1);
            $table->datetime('last_res_dt'); //最後にレスが付いた日時
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
        Schema::dropIfExists('boards');
    }
}
