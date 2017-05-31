<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price')->nullable();
            $table->integer('user_id');
            $table->foreign('user_id')->references('users')->on('id')->onDelete('cascade');
            $table->integer('state_id');
            $table->foreign('state_id')->references('states')->on('id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->integer('order_id');
            $table->foreign('order_id')->references('orders')->on('id')->onDelete('cascade');
            $table->integer('product_id');
            $table->foreign('product_id')->references('products')->on('id')->onDelete('cascade');
            $table->integer('quantity');
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
}
