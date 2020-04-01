<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('general_terms_id')->unsigned()->nullable();
            $table->bigInteger('terms_of_delivery_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('general_terms_id')->references('id')->on('general_terms')->onDelete('set null');
            $table->foreign('terms_of_delivery_id')->references('id')->on('terms_of_delivery')->onDelete('set null');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->bigInteger('dimension_id')->unsigned();
            $table->timestamps();

            $table->unique(['order_id','product_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('dimension_id')->references('id')->on('dimensions');
        });
        
        Schema::create('order_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->timestamps();

            $table->unique(['order_id','status_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
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
    }
}
