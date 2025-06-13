<?php

namespace Database\Factories;

use App\Models\Seguir;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SeguirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        

        return [
            'user_id' => $user = $this->faker->randomElement([16, 17, 18, 19, 20]),
            'seguidor_id' => $this->faker->randomElement(
                array_diff([16, 17, 18, 19, 20], [$user]) // Evita que un usuario se siga a sí mismo
            ),
        ];
    }
}
