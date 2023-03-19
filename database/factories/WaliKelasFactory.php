<?php

namespace Database\Factories;

use app\Models\WaliKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaliKelas>
 */
class WaliKelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nip_wali_kelas' => $this->faker->numerify('##################'),
            'nama_wali_kelas' => $this->faker->name(),
            'jk' => $this->faker->randomElement(["L", "P"]),
            'jabatan' => $this->faker->randomElement(["TP", "TK"]),
            'status_pegawai' => $this->faker->randomElement(["0", "1"]),
        ];
    }
}
