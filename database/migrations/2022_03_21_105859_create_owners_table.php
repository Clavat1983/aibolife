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
            $table->string('owner_name');
            $table->string('owner_name_kana');
            $table->string('owner_icon')->nullable();
            $table->string('owner_pref');
            $table->boolean('owner_available_flag')->default(true);
            $table->string('owner_old_login_id')->nullable();
            $table->string('owner_old_login_password')->nullable();
            $table->string('owner_old_email')->nullable();
            $table->string('owner_old_security_code')->nullable();
            $table->boolean('owner_transferred_flag')->default(false);
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
