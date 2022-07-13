<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiboCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aibo_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aibo_id');
            $table->unsignedBigInteger('owner_id');//コメントを書いたオーナー
            $table->text('aibo_comment_body');
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
        Schema::dropIfExists('aibo_comments');
    }
}
