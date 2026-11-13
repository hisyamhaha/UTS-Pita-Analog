<?php

namespace Database\Seeders;

use App\Models\KategoriFormat;
use Illuminate\Database\Seeder;

class KategoriFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_format' => 'Cassette Tape Type I (Ferric Oxide / Normal Bias)',
                'deskripsi' => 'Format pita kaset standar 3.81 mm (C-60/C-90) dengan formulasi besi oksida (Fe2O3), EQ 120µs, umum digunakan untuk rekaman musik populer dan siaran radio.',
            ],
            [
                'nama_format' => 'Cassette Tape Type II (CrO2 / High Bias)',
                'deskripsi' => 'Kaset pita chromium dioxide dengan respon frekuensi tinggi lebih baik, noise lantai rendah, EQ 70µs untuk rekaman master demo akustik dan studio.',
            ],
            [
                'nama_format' => 'Cassette Tape Type IV (Metal Audio Tape)',
                'deskripsi' => 'Pita partikel metal murni dengan koersivitas tinggi dan dinamika suara audiophile maksimal, sangat rentan terhadap aus magnetic head.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 1/4" Open Reel (15 ips Studio Master)',
                'deskripsi' => 'Pita gulung terbuka 1/4 inci kecepatan 15 inci per detik (ips), standar emas rekaman master album studio musik dekade 1960-1980an.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 1/4" Open Reel (7.5 ips Radio & Field Archive)',
                'deskripsi' => 'Pita reel 1/4 inci kecepatan 7.5 ips, banyak digunakan untuk rekaman wawancara lapangan, arsip siaran radio pemerintah, dan pidato kenegaraan.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 1/2" 4-Track Multitrack Tape',
                'deskripsi' => 'Format studio analog multi-kanal 4 track terpisah pada pita selebar setengah inci untuk proses rekaman overdubbing instrumen musik.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 2-Inch 24-Track Large Master Tape',
                'deskripsi' => 'Format master studio rekaman kelas atas terbesar (2 inci, 24 track), membutuhkan penanganan suhu terkendali dan rawan sticky-shed syndrome.',
            ],
            [
                'nama_format' => '8-Track Cartridge (Stereo 8 Endless Loop)',
                'deskripsi' => 'Kartrid pita magnetik continuous loop populer era 1965-1980an untuk audio mobil, rawan selip sambungan foil sensor dan rollers getas.',
            ],
            [
                'nama_format' => 'Microcassette Voice Dictation (1.2 / 2.4 cm/s)',
                'deskripsi' => 'Pita kaset mikro mini yang biasa dipakai oleh wartawan untuk rekaman suara jurnalisme investigasi, riset sejarah lisan, dan notula pengadilan.',
            ],
            [
                'nama_format' => 'DAT (Digital Audio Tape) 4mm Helical Scan',
                'deskripsi' => 'Pita magnetik rekaman digital uncompressed 48kHz/16-bit dengan head berputar, transisi antara era analog pita dan digital modern.',
            ],
            [
                'nama_format' => 'Sony Elcaset Large Audiophile Cassette',
                'deskripsi' => 'Format pita hybrid tahun 1976 dengan ukuran kaset besar berkecepatan 9.5 cm/s, menggabungkan kualitas reel-to-reel dengan kepraktisan kaset.',
            ],
        ];

        foreach ($categories as $cat) {
            KategoriFormat::firstOrCreate(
                ['nama_format' => $cat['nama_format']],
                ['deskripsi' => $cat['deskripsi']]
            );
        }
    }
}
