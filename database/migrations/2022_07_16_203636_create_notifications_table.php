<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->unsignedBigInteger('user_id'); //宛先:自分(To)
            $table->integer('send_user_id'); //送信元:他人(From)
            $table->string('title');
            $table->text('body')->nullable();
            $table->text('link_url')->nullable();
            $table->text('image_url_1')->nullable();
            $table->text('image_url_2')->nullable();
            $table->text('image_url_3')->nullable();
            $table->text('image_url_4')->nullable();
            $table->text('image_url_5')->nullable();
            $table->datetime('read_at')->nullable();
            $table->datetime('mailed_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
