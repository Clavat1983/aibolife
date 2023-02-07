<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAiboEarRightToAibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aibos', function (Blueprint $table) {
            $table->string('aibo_ear_right')->after('aibo_ear'); //追加
            $table->renameColumn('aibo_ear', 'aibo_ear_left'); //カラム名変更
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aibos', function (Blueprint $table) {
            $table->dropColumn('aibo_ear_right');
            $table->renameColumn('aibo_ear_left', 'aibo_ear'); //カラム名戻す
        });
    }
}
