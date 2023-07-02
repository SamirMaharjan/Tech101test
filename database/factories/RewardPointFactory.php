<?php

namespace Database\Factories;

use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class RewardPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'sales_orders_id' => SalesOrder::inRandomOrder()->first()->id,
        'user_id' => SalesOrder::inRandomOrder()->first()->id,
        'amount' => $this->faker->numberBetween(1, 100),
        ];
    }
}
