<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('slug')->unique();
            $table->string('user_img')->nullable();
            $table->integer('type')->nullable();
            $table->integer('club_id')->nullable();
            $table->integer('user_is_active')->nullable();
            $table->integer('our_is_active')->nullable();
            $table->string('active_code')->nullable();
            $table->string('password')->nullable();
            $table->string('verify')->nullable();
            $table->boolean('verified')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
