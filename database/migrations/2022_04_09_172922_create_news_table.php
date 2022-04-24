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
            $table->text('news_category');//「公式ニュース」か「お知らせ】か
            $table->text('news_title');
            $table->longText('news_body');

            $table->text('news_photo1')->default('default.jpg');
            $table->text('news_photo2')->nullable();
            $table->text('news_photo3')->nullable();
            $table->text('news_photo4')->nullable();
            $table->text('news_photo5')->nullable();

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

            //タグ
            $table->boolean('news_tag1')->default(false);
            $table->boolean('news_tag2')->default(false);
            $table->boolean('news_tag3')->default(false);
            $table->boolean('news_tag4')->default(false);
            $table->boolean('news_tag5')->default(false);
            
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
