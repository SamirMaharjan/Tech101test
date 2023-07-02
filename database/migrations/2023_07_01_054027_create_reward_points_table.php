<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_orders_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 8, 2);
            $table->boolean('is_active')->default(true);
            // Add other necessary columns

            $table->timestamps();

            $table->foreign('sales_orders_id')->references('id')->on('sales_orders');
            $table->foreign('user_id')->references('id')->on('users');
         

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_points');
    }
}
