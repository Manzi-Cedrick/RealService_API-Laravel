<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'Stock_Name'=>fake()->name(),
            'Stock_Quantity'=>fake()->numberBetween(1,100),
            'Registration_Date'=>fake()->date(),
            'Expiration_Date'=>fake()->date(),
        ];
    }
}
