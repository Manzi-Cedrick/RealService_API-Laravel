<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Firstname' => $this->faker->firstName(),
            'Lastname' => $this->faker->lastName(),
            'Cash_Paid_Frw' => $this->faker->numberBetween(1, 100),
            'ProductID' => $this->faker->numberBetween(1,10),
            'Status_Payment' => $this->faker->randomElement(['Paid', 'Not Paid']),
            'Quantity_Paid_For' => $this->faker->numberBetween(1, 100),
            'Description_Work' => $this->faker->text(),
        ];
    }
}
