<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4ColumnToContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->integer('parent_no')->after('id');
            $table->integer('child_no')->after('parent_no');
            $table->unsignedBigInteger('owner_id')->after('body');
            $table->boolean('kidoku_flag')->default(0)->after('email');
            $table->boolean('reply_flag')->default(0)->after('kidoku_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('parent_no');
            $table->dropColumn('child_no');
            $table->dropColumn('owner_id');
            $table->dropColumn('kidoku_flag');
            $table->dropColumn('reply_flag');
        });
    }
}
