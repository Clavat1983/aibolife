<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->datetime('news_publication_datetime');//公開日時
            $table->boolean('news_publication_flag')->dafault(true);//公開フラグ
            $table->text('news_category');
            $table->text('news_title');
            $table->longText('news_body');

            //画像
            $table->string('news_image1')->nullable();
            $table->string('news_image2')->nullable();
            $table->string('news_image3')->nullable();
            $table->string('news_image4')->nullable();
            $table->string('news_image5')->nullable();

            //タグ
            $table->text('news_tag1')->nullable();
            $table->text('news_tag2')->nullable();
            $table->text('news_tag3')->nullable();
            $table->text('news_tag4')->nullable();
            $table->text('news_tag5')->nullable();

            //リンク
            $table->text('news_link1_name')->nullable();
            $table->text('news_link1_url')->nullable();
            $table->text('news_link2_name')->nullable();
            $table->text('news_link2_url')->nullable();
            $table->text('news_link3_name')->nullable();
            $table->text('news_link3_url')->nullable();
            $table->text('news_link4_name')->nullable();
            $table->text('news_link4_url')->nullable();
            $table->text('news_link5_name')->nullable();
            $table->text('news_link5_url')->nullable();

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
        Schema::dropIfExists('news');
    }
}
