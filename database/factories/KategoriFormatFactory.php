<?php

namespace Database\Factories;

use App\Models\KategoriFormat;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFormatFactory extends Factory
{
    protected $model = KategoriFormat::class;

    public function definition(): array
    {
        return [
            'nama_format' => $this->faker->unique()->words(3, true),
            'deskripsi' => $this->faker->sentence(10),
        ];
    }
}
