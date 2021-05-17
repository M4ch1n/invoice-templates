<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_internal_id' => $this->faker->numerify('###'),
            'description' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'quantity' => $this->faker->randomNumber($nbDigits = 1),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100)
        ];
    }
}
