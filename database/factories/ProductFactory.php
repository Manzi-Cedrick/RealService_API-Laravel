<?php

namespace Database\Factories;

use App\Models\Stock;
use Database\Factories\Helpers\FactoryHelper;
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
    public function definition()
    {
        return [
            'ProductName' => $this->faker->name(),
            'ProductPrice' => $this->faker->numberBetween(1,100),
            'StockID'=> FactoryHelper::getRandomModelId(Stock::class),
            'ProductQRCode' => $this->faker->numberBetween(1,100),
            'Quantity' => $this->faker->numberBetween(1, 100),
            'Description' => $this->faker->text(),
        ];
    }
}
