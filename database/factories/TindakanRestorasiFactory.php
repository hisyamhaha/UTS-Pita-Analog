<?php

namespace Database\Factories;

use App\Models\TindakanRestorasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TindakanRestorasiFactory extends Factory
{
    protected $model = TindakanRestorasi::class;

    public function definition(): array
    {
        return [
            'nama_tindakan' => $this->faker->unique()->sentence(3),
            'deskripsi' => $this->faker->paragraph(2),
        ];
    }
}
