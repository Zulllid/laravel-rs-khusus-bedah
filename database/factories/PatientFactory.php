<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_rm' => 'RM-' . $this->faker->unique()->numerify('#####'),
            'nik' => $this->faker->unique()->numerify('################'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_date' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
