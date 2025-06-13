<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     * Podemos definir un estado del model por defecto
     * El modelo por defecto es tomado de los modelos ya creado y que tengan el nombre de este factori
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Aca es donde se define la informacion que se va a generar automaticamente para los testting
            //automatizamos la insercion de informacion en la base de datos y para generar estos datos utilizamos
            //una libreria que incluye laravel, FAKER (T1).

            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => 'placeholder.png',
            'user_id' => $this->faker->randomElement([16,17,18,19,20])

        ];
    }
}
