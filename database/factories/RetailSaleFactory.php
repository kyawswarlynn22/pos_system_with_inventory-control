<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RetailSale>
 */
class RetailSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customers_id' => $this->faker->numberBetween(0,10),
            'pur_date' => $this->faker->date(),
            'discount' => $this->faker->numberBetween(50,200),
            'grand_total' => $this->faker->numberBetween(500,2000),
            'remark' => $this->faker->sentence(5),
        ];
    }
}
