<?php

namespace Database\Factories;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use Illuminate\Database\Eloquent\Factories\Factory;

class KoleksiPitaFactory extends Factory
{
    protected $model = KoleksiPita::class;

    public function definition(): array
    {
        $year = $this->faker->numberBetween(1965, 1999);
        return [
            'kode_koleksi' => 'TAPE-' . $year . '-' . strtoupper($this->faker->unique()->bothify('##??')),
            'nama_koleksi' => $this->faker->words(4, true),
            'kategori_format_id' => KategoriFormat::factory(),
            'tahun' => $year,
            'deskripsi' => $this->faker->paragraph(2),
        ];
    }
}
