<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'email' => $this->faker->unique()->email(),
            'userName' => $this->faker->name(),
            'password' => bcrypt(Str::random(6)),
            'address' => $this->faker->address()
        ];
    }
}
