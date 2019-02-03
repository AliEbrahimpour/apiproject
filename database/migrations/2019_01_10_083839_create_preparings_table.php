<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreparingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('amount');
            $table->time('for_time');
            $table->boolean('Paid');
            $table->boolean('Posted');
            $table->text('delivery_address');
            $table->boolean('is_rezerv')->default(0);
            $table->tinyInteger('status');
            $table->boolean('withPake');
            $table->double('price_pike');
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
        Schema::dropIfExists('preparings');
    }
}
