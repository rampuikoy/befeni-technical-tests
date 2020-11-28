<?php

namespace Database\Factories;

use App\Models\ShirtOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShirtOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShirtOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1,10000),
            'fabric_id' => $this->faker->numberBetween(1, 10000),
            'collar_size' => $this->faker->numberBetween(15, 18),
            'chest_size' => $this->faker->numberBetween(34, 48),
            'waist_size' => $this->faker->numberBetween(24, 34),
            'wrist_size' => $this->faker->numberBetween(5, 7),
        ];
    }
}
