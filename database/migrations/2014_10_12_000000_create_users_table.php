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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile',10)->unique();
            $table->string('latitude')->default(0);
            $table->string('longitude')->default(0);
            $table->double('credit')->default(0);
            $table->boolean('is_seller')->default(0);
            $table->string('avatar')->default(0);
            $table->boolean('isBan')->default(0);
            $table->text('address')->nullable();
            $table->string('email')->unique()->default(0);
            $table->string('password');
            $table->string('api_token')->unique();
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
