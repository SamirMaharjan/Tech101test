<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'sales_orders_id' => SalesOrder::factory(),
        'product_id' => Product::factory(),
        'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
