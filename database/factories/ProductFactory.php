<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' =>$this->faker->country(),
            'p_code' =>$this->faker->countryCode(),
            'categories_id' =>$this->faker->numberBetween(0,10),
            'sub_categories_id' => $this->faker->numberBetween(0,10),
            'p_one' =>$this->faker->imageUrl(),
            'p_two' => $this->faker->imageUrl(),
            'p_three' => $this->faker->imageUrl(),
            'p_four' => $this->faker->imageUrl(),
            'price' =>$this->faker->numberBetween(100,500),
            'quantity' =>$this->faker->numberBetween(10,50),
            'stock_confrim' =>$this->faker->numberBetween(0,1),
            'description' => $this->faker->sentence(5),

                ];
    }
}
