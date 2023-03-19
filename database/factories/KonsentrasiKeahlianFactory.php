<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\KonsentrasiKeahlian;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KonsentrasiKeahlian>
 */
class KonsentrasiKeahlianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_kk' => $this->faker->numerify('KK####'),
            'konsentrasi_keahlian' => $this->faker->sentence(2),
            'tahun_program' => $this->faker->randomElement(["3", "4"]),
        ];
    }
}
