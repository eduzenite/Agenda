<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Number::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'number' => $this->faker->tollFreePhoneNumber,
            'status' => rand(1, 3)
        ];
    }
}
