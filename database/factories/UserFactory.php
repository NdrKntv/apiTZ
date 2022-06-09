<?php

namespace Database\Factories;

use App\Models\Positions;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    public function definition()
    {
        $name = $this->faker->unique()->firstName;
        return [
            'position_id' => Positions::get('id')->random()->id,
            'name' => $name,
            'email' => $name . '@mail.com',
            'phone' => '+380' . $this->faker->unique()->numerify('#########'),
            'photo' => 'users/000000000_70x70.jpg'
        ];
    }
}
