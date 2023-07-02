<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'user_id' => User::factory(),
        'status' => $this->faker->randomElement([1,2,3]),
        'amount' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
