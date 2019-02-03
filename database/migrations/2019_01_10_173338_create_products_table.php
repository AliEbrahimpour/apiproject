<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Seller_id')->unsigned()->index();
            $table->foreign('Seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->string('icon');
            $table->string('product_name');
            $table->text('product_description');
            $table->double('price');
            $table->double('discount');
            $table->integer('privilege');
            $table->integer('buying_count');
            $table->integer('inventory');
            $table->double('pake_price');
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
        Schema::dropIfExists('products');
    }
}
