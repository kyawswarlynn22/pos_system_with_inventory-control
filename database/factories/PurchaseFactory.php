<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sup_country' =>$this->faker->numberBetween(0,1),
            'p_date' =>$this->faker->date(),
            'ship_status' => $this->faker->numberBetween(0,1),
        ];
    }
}
