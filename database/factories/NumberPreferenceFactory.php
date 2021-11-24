<?php

namespace Database\Factories;

use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NumberPreference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = ['auto_attendant', 'voicemail_enabled'];
        return [
            'number_id' => Number::factory(),
            'name' => $name[rand(0, 1)],
            'value' => rand(0, 1)
        ];
    }
}
