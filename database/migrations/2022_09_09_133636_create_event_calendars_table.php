<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_calendars', function (Blueprint $table) {
            $table->id();
            $table->datetime('event_publication_datetime');//情報公開日時
            $table->boolean('event_publication_flag')->dafault(true);//公開フラグ
            $table->boolean('event_confirm_flag')->dafault(true);//確定フラグ
            $table->text('event_category');
            $table->text('event_title');
            $table->datetime('event_start_datetime');//開始日時
            $table->datetime('event_end_datetime');//終了日時
            $table->integer('link_news_id')->nullable;
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
        Schema::dropIfExists('event_calendars');
    }
}
