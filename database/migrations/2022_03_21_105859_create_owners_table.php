<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('name_kana');
            $table->string('icon')->nullable();
            $table->string('pref');
            $table->boolean('available_flag')->default(true);
            $table->string('old_login_id')->nullable();
            $table->string('old_login_password')->nullable();
            $table->string('old_email')->nullable();
            $table->string('old_security_code')->nullable();
            $table->boolean('transferred_flag')->default(false);
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
        Schema::dropIfExists('owners');
    }
}
