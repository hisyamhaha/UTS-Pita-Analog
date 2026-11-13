<?php

namespace Database\Seeders;

use App\Models\TindakanRestorasi;
use Illuminate\Database\Seeder;

class TindakanRestorasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            [
                'nama_tindakan' => 'Pembersihan Jamur & Spora Ultrasonik',
                'deskripsi' => 'Pembersihan lapisan jamur putih/kuning pada permukaan pita magnetik menggunakan larutan isopropil alkohol murni 99% dan getaran halus tanpa merusak lapisan oksida.',
            ],
            [
                'nama_tindakan' => 'Tape Baking / Inkubasi Dehidrasi Termal',
                'deskripsi' => 'Pemanasan pita dalam oven laboratorium khusus pada suhu 50°C-54°C selama 6-8 jam untuk merekatkan kembali binder polimer yang terhidrolisis (Sticky-Shed Syndrome).',
            ],
            [
                'nama_tindakan' => 'Penyambungan & Penggantian Splicing Tape',
                'deskripsi' => 'Menyambung kembali bagian pita yang putus atau sobek menggunakan metal splicing block presisi dan adhesive tape non-bleeding khusus audio profesional.',
            ],
            [
                'nama_tindakan' => 'Penggantian Bantalan Busa Tekan (Pressure Pad)',
                'deskripsi' => 'Memasang bantalan spons felt baru di belakang pita kaset agar kontak antara permukaan pita dan playback head tetap rapat dan seimbang.',
            ],
            [
                'nama_tindakan' => 'Penggantian Cangkang Kaset (Re-housing / Shell Swap)',
                'deskripsi' => 'Memindahkan spool pita ke cangkang kaset baru bersekrup presisi akibat cangkang lama pecah, melengkung karena panas, atau berderit.',
            ],
            [
                'nama_tindakan' => 'Demagnetisasi Jalur & Kalibrasi Azimuth Head',
                'deskripsi' => 'Menghilangkan residu medan magnet pada audio head dan capstan roller dengan de-magnetizer serta kalibrasi sudut kemiringan head untuk kejernihan frekuensi tinggi.',
            ],
            [
                'nama_tindakan' => 'Re-spooling Manual & Perbaikan Tension Gulungan',
                'deskripsi' => 'Menggulung ulang pita yang kusut, terlipat (cinching), atau longgar menggunakan meja rewinder berkecepatan konstan dengan tegangan terukur.',
            ],
            [
                'nama_tindakan' => 'Lubrikasi Sumbu Spool & Guide Roller Fluoropolimer',
                'deskripsi' => 'Pemberian pelumas kering PTFE/silikon non-minyak pada poros plastik dan roda pemandu agar putaran halus bebas derit suara wow & flutter.',
            ],
            [
                'nama_tindakan' => 'Perbaikan & Penggantian Pita Pembuka (Leader Tape)',
                'deskripsi' => 'Menyambung leader tape transparan atau berwarna di awal dan akhir reel untuk melindungi pita magnetik aktif dari tarikan mendadak saat playback selesai.',
            ],
            [
                'nama_tindakan' => 'Digitalisasi & Mastering Arsip Preservasi 192kHz/24-bit',
                'deskripsi' => 'Konversi audio analog ke format WAV uncompressed Broadcast Wave Format (BWF) dengan converter kelas mastering audiophile untuk pelestarian jangka panjang.',
            ],
            [
                'nama_tindakan' => 'Restorasi Noise & De-click Spectral Audio Digital',
                'deskripsi' => 'Pembersihan desis pita (tape hiss), dengung 50Hz ground loop, dan klik mekanis menggunakan software spectral repair tanpa memangkas harmonik asli suara.',
            ],
        ];

        foreach ($actions as $act) {
            TindakanRestorasi::firstOrCreate(
                ['nama_tindakan' => $act['nama_tindakan']],
                ['deskripsi' => $act['deskripsi']]
            );
        }
    }
}
