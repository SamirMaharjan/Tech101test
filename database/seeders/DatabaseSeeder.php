<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\RewardPoint;
use App\Models\SalesOrder;
use App\Models\SalesOrderItems;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(10)->create();
        Product::factory(30)->create();
        // SalesOrder::factory(10)->create();
        // SalesOrderItems::factory(10)->create();
        // RewardPoint::factory(10)->create();
    
    }
}
