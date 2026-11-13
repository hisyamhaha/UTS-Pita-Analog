<?php

namespace Database\Factories;

use App\Models\DetailKondisi;
use App\Models\KoleksiPita;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailKondisiFactory extends Factory
{
    protected $model = DetailKondisi::class;

    public function definition(): array
    {
        return [
            'koleksi_pita_id' => KoleksiPita::factory(),
            'kondisi_awal' => $this->faker->sentence(12),
            'tingkat_kerusakan' => $this->faker->randomElement(['ringan', 'sedang', 'berat']),
            'catatan' => $this->faker->optional(0.8)->paragraph(1),
        ];
    }
}
