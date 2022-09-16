<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehaviorSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavior_shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aibo_id');
            $table->string('behavior_name');
            $table->text('behavior_info');
            $table->text('behavior_dl_url');
            $table->string('behavior_photo')->nullable();
            $table->text('behavior_tweet')->nullable();
            $table->text('behavior_youtube')->nullable();
            $table->boolean('behavior_share_status')->default(true);
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
        Schema::dropIfExists('behavior_shares');
    }
}
