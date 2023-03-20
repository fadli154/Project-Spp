<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Kelas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'kelas_id' => $this->faker->bothify('???????####'),
            // 'kelas' => $this->faker->sentence(2),
            // 'angkatan' => $this->faker->numerify('####'),
            // 'id_kk' => $this->faker->numerify('KK####'),
        ];
    }
}
