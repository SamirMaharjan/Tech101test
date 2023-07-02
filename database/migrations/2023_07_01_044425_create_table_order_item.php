<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_orders_id');
            $table->integer('quantity');
            // Add other necessary columns

            $table->timestamps();

            $table->foreign('sales_orders_id')->references('id')->on('sales_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_order_item');
    }
}
