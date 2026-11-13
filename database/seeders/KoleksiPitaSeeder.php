<?php

namespace Database\Seeders;

use App\Models\DetailKondisi;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KoleksiPitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoris = KategoriFormat::all();
        $tindakans = TindakanRestorasi::all();

        if ($kategoris->isEmpty() || $tindakans->isEmpty()) {
            return;
        }

        $curatedCollections = [
            [
                'kode' => 'TAPE-1977-KPL4',
                'nama' => 'Koes Plus - Master Pita Rekaman Vol. 4 (Remata Studio)',
                'tahun' => 1977,
                'deskripsi' => 'Pita rekaman master studio album legendaris Koes Plus berisi track instrumental dan vokal asli sesi rekaman Jakarta.',
                'kondisi_awal' => 'Pita agak berdebu tebal, terdapat bintik jamur putih tipis di tepi pita Side A, spons penekan mulai rapuh dan menghitam.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Harap jangan diputar sebelum pembersihan dan penggantian pressure pad agar lapisan oksida tidak tergores.',
            ],
            [
                'nama' => 'Chrisye - Badai Pasti Berlalu Sesi Demo Akustik 1977',
                'kode' => 'TAPE-1977-CHRS',
                'tahun' => 1977,
                'deskripsi' => 'Rekaman pita kaset Type II berisi take vokal awal dan aransemen akustik mentah karya Eros Djarot dan Chrisye.',
                'kondisi_awal' => 'Pita kusut di bagian tengah akibat mekanisme capstan deck macet, cangkang kaset retak di sudut baut.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Perlu re-spooling manual dengan meja pemutar presisi dan pemindahan ke cangkang kaset baru.',
            ],
            [
                'nama' => 'Gamelan Sekaten Kyai Kanyut Mesem Kraton Surakarta Live 1981',
                'kode' => 'TAPE-1981-GMLS',
                'tahun' => 1981,
                'deskripsi' => 'Rekaman pita Reel-to-Reel 1/4 inch prosesi Sekaten di Alun-Alun Utara Surakarta menggunakan microphone binaural stereo vintage.',
                'kondisi_awal' => 'Pita mengalami sticky-shed syndrome akut (lapisan pengikat binder luruh), desis lengket berderit saat reel diputar manual.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Wajib melalui inkubator tape baking 52 derajat Celcius selama 8 jam sebelum proses playback digitalisasi.',
            ],
            [
                'nama' => 'Fariz RM - Sakura Track Eksperimen Synthesizer & Drum Machine',
                'kode' => 'TAPE-1980-FRZM',
                'tahun' => 1980,
                'deskripsi' => 'Kaset master 4-track berisi track rhythm guide Roland CR-78 dan Minimoog bassline era awal city-pop Nusantara.',
                'kondisi_awal' => 'Kondisi fisik luar sangat mulus tersimpan dalam sleeve mika asli, hanya ada sedikit oksidasi pada lead tape awal.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Hanya membutuhkan de-magnetizing head, pembersihan roller, dan langsung siap dipindahkan ke master digital.',
            ],
            [
                'nama' => 'Dara Puspita - Live Session Surabaya Tour Reel 1969',
                'kode' => 'TAPE-1969-DPUR',
                'tahun' => 1969,
                'deskripsi' => 'Pita gulung 7.5 ips rekaman panggung band garage rock perempuan legendaris Indonesia saat konser di Surabaya.',
                'kondisi_awal' => 'Pita putus di awal menit ke-4, jamur menyebar di sekeliling lapisan dalam gulungan spool, bau asam cuka terasa pekat.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Bahaya sindrom cuka (vinegar syndrome). Butuh isolasi ruang kering, penyambungan splicing tape baru, dan pembersihan spora menyeluruh.',
            ],
            [
                'nama' => 'Pidato Kebudayaan Sutan Takdir Alisjahbana di TIM Jakarta 1979',
                'kode' => 'TAPE-1979-STAB',
                'tahun' => 1979,
                'deskripsi' => 'Arsip pita kaset jurnalisme kebudayaan Taman Ismail Marzuki perdebatan pemikiran sastra dan modernisasi Indonesia.',
                'kondisi_awal' => 'Bantalan busa spons telah mengeras jadi debu hitam, label kertas terkelupas terkena noda air.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Pasang bantalan felt spons pengganti dan bersihkan debu kertas agar tidak masuk ke celah housing.',
            ],
            [
                'nama' => 'Iwan Fals - Rekaman Kasar Demo Sarjana Muda & Umar Bakri',
                'kode' => 'TAPE-1981-IWNF',
                'tahun' => 1981,
                'deskripsi' => 'Kaset pita Type I dengan coretan tulisan spidol asli di label samping, berisi demo gitar akustik dan harmonika kamar kos.',
                'kondisi_awal' => 'Pita tertarik molor (stretched) di bagian reff Umar Bakri, gulungan pita agak kendor.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Perlu kalibrasi tension rewind agar putaran seimbang, bagian molor diproses de-wow / pitch-correction digital.',
            ],
            [
                'nama' => 'Keroncong Moritsko Asli Solo Maestro Gesang 1975',
                'kode' => 'TAPE-1975-GSNG',
                'tahun' => 1975,
                'deskripsi' => 'Pita Reel-to-Reel 1/4 inch rekaman langsung vokal Gesang diiringi orkes keroncong asli Solo dengan selo cak-cuk akustik.',
                'kondisi_awal' => 'Jamur tebal merata di lingkar luar reel, pita menempel satu sama lain saat dibuka perlahan.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Pembersihan ultrasonik alkohol 99%, perlakuan pelepasan perlahan dengan pemandu silikon.',
            ],
            [
                'nama' => 'Wayang Golek Asep Sunandar Sunarya - Lakon Dorna Gugur 1984',
                'kode' => 'TAPE-1984-ASPS',
                'tahun' => 1984,
                'deskripsi' => 'Koleksi 8-Track Cartridge rekaman semalam suntuk pagelaran wayang golek sunda Giri Harja 3.',
                'kondisi_awal' => 'Karet pinch roller internal kartrid 8-track telah meleleh lengket, sambungan pita foil loop lepas.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Bongkar bodi 8-track, ganti karet roller dengan suku cadang polyurethane baru, sambung ulang metallic sensor tape.',
            ],
            [
                'nama' => 'Benyamin Sueb & Ida Royani - Sesi Latihan Duet Gambang Kromong 1974',
                'kode' => 'TAPE-1974-BYSB',
                'tahun' => 1974,
                'deskripsi' => 'Master pita kaset analog humor dan lagu tradisional gambang kromong modern dengan celetukan spontan di sela rekaman.',
                'kondisi_awal' => 'Secara umum kondisi stabil, sedikit desis kotor pada 2 menit pertama, housing kaset berdebu wajar.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Pembersihan standar housing dan demagnetisasi jalur sebelum transfer digital 96kHz.',
            ],
            [
                'nama' => 'Arsip Wawancara Tokoh Proklamasi 1945 oleh RRI Pusat 1972',
                'kode' => 'TAPE-1972-RRIB',
                'tahun' => 1972,
                'deskripsi' => 'Pita open reel 7.5 ips rekaman wawancara sejarah lisan seputar detik-detik kemerdekaan bersama kurir pemuda Menteng 31.',
                'kondisi_awal' => 'Leader tape di ujung pita putus dan hilang, spool aluminium sedikit bengkok di lingkar pinggir.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Pasang leader tape baru dengan color coding hijau-putih, ratakan bibir spool aluminium.',
            ],
            [
                'nama' => 'God Bless - Huma di Atas Bukit Studio Multi-Track Outtake 1976',
                'kode' => 'TAPE-1976-GDBL',
                'tahun' => 1976,
                'deskripsi' => 'Pita Reel-to-Reel 1/2" 4-track berisi track solo organ Hammond Yockie Suryo Prayogo dan distorsi gitar Ian Antono.',
                'kondisi_awal' => 'Oksida terkelupas tipis di 10 detik awal, selebihnya kondisi fisik pita masih lentur dan elastis.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Periksa konsistensi binder, lakukan pembersihan jalur magnetik secara steril.',
            ],
            [
                'nama' => 'Ria Angelia - Pop Minang Ratok Pasaman Master Kaset 1988',
                'kode' => 'TAPE-1988-RPAS',
                'tahun' => 1988,
                'deskripsi' => 'Pita kaset tipe C-60 rilisan Tanama Records Padang rekaman vokal khas Minang dengan instrumen saluang dan talempong.',
                'kondisi_awal' => 'Pita agak kusut di bagian lipatan akhir, pelumas roda pemandu kering membuat bunyi mencicit.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Oleskan silikon grease aman pada sumbu roda pemandu dan luruskan bagian kusut.',
            ],
            [
                'nama' => 'Gong 2000 - Bara Timur Pre-Production DAT Session 1991',
                'kode' => 'TAPE-1991-GGTT',
                'tahun' => 1991,
                'deskripsi' => 'Pita DAT (Digital Audio Tape) 4mm kaset mini berputar berkecepatan tinggi berisi master lagu rock etnik.',
                'kondisi_awal' => 'Tutup pengunci mekanis cartridge macet, magnetic head deck mengalami drop-out digital sesaat.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Servis gerigi pengunci slider dan bersihkan pita 4mm dengan cairan pembersih DAT khusus.',
            ],
            [
                'nama' => 'Si Doel Anak Sekolahan - Efek Suara Oplet & Lingkungan Betawi 1993',
                'kode' => 'TAPE-1993-SDAS',
                'tahun' => 1993,
                'deskripsi' => 'Pita Microcassette dokumentasi audio lingkungan (foley/ambience) deru mesin oplet Morris dan obrolan pasar.',
                'kondisi_awal' => 'Bodi microcassette sangat kecil dan mulus, suara stabil tanpa distorsi berarti.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Lakukan playback pada microcassette transcriber calibrated dan rekam langsung ke audio interface pro.',
            ],
            [
                'nama' => 'Trio Bimbo - Qasidah Balada Seorang Biduan 1978',
                'kode' => 'TAPE-1978-BIMB',
                'tahun' => 1978,
                'deskripsi' => 'Master kaset pita normal bias Type I karya harmoni vokal syahdu Bimbo bersaudara rekaman Polydor/Irama Tara.',
                'kondisi_awal' => 'Busa bantalan hilang sepenuhnya hanya tersisa lempengan tembaga, cangkang kaset agak kusam berdebu.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Pasang spons bantalan baru ukuran 7mm x 5mm, bersihkan selongsong luar kaset.',
            ],
            [
                'nama' => 'Waldjinah - Walang Kekek Master Keroncong Asli Lokananta 1971',
                'kode' => 'TAPE-1971-WLDJ',
                'tahun' => 1971,
                'deskripsi' => 'Pita Reel-to-Reel 1/4 inch produksi Perum Lokananta Solo, rekaman cengkok langgam keroncong legendaris Waldjinah.',
                'kondisi_awal' => 'Pita menunjukkan tanda kerapuhan (brittle tape base), serpihan oksida cokelat rontok jika disentuh kasar.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Tindakan sangat genting! Perlu rehidrasi pelindung, oven dehidrasi bertahap, dan single-pass digital transfer.',
            ],
            [
                'nama' => 'Guruh Gipsy - Master Rekaman Studio Cikini 1976',
                'kode' => 'TAPE-1976-GGPS',
                'tahun' => 1976,
                'deskripsi' => 'Pita master 1/4 inch open reel magnum opus peleburan rock progresif Barat dengan gamelan Bali karya Guruh Sukarnoputra.',
                'kondisi_awal' => 'Splicing tape antar trek lagu sudah mengering dan lemnya menembus (bleed through) ke lapisan pita bawahnya.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Bersihkan sisa lem getah pohon dengan pelarut hidrokarbon aman, sambung ulang dengan splicing tape kelas arsip.',
            ],
            [
                'nama' => 'Slank - Demo Cikini Stones Kompleks Kampus Gang Potlot 1989',
                'kode' => 'TAPE-1989-SLNK',
                'tahun' => 1989,
                'deskripsi' => 'Kaset tape bootleg bersejarah sebelum rilis album Suit-Suit... He-He (Gadis Sexy), distorsi gitar mentah khas era 80an.',
                'kondisi_awal' => 'Pita kaset berbelit di sumbu sebelah kiri, putaran reel terhambat gesekan plastik pembatas.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Buka casing, luruskan jalur pita yang terjepit, ganti lembar slip sheet teflon di dalam housing.',
            ],
            [
                'nama' => 'Rekaman Suara Burung Endemik Hutan Lore Lindu Sulawesi 1986',
                'kode' => 'TAPE-1986-BURU',
                'tahun' => 1986,
                'deskripsi' => 'Pita kaset Type II dokumentasi bioakustik suara Maleo dan Tarsius oleh peneliti biogeografi Wallacea.',
                'kondisi_awal' => 'Kondisi fisik prima, tersimpan rapi dalam kotak kedap udara silica gel, bebas jamur.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Langsung lakukan proses digitalisasi audio frekuensi tinggi untuk analisis spektrogram suara satwa.',
            ],
            [
                'nama' => 'Kidung Suci Gereja Blenduk Semarang Paduan Suara 1973',
                'kode' => 'TAPE-1973-BLND',
                'tahun' => 1973,
                'deskripsi' => 'Rekaman pita kaset reel terbuka suasana akustik gereja kubah kuno Semarang dengan gaung reverbrasi alami mengagumkan.',
                'kondisi_awal' => 'Permukaan pita kusam berdebu spora, desis latar cukup tinggi di frekuensi 3kHz.',
                'tingkat_kerusakan' => 'sedang',
                'catatan_kondisi' => 'Pembersihan mekanis dengan kain microfiber mikroskopis dan restorasi pengurangan noise digital.',
            ],
            [
                'nama' => 'Harry Roesli - Titik Api Rock Teatrikal Bandung 1976',
                'kode' => 'TAPE-1976-HRSL',
                'tahun' => 1976,
                'deskripsi' => 'Rekaman pita master analog eksperimental menggabungkan gamelan Sunda, brass section, dan monolog teatrikal Bandung.',
                'kondisi_awal' => 'Sambungan sambung pita (splice) terlepas pada lagu instrumental utama, housing kaset retak di punggung.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Penyambungan darurat dengan tape presisi 1/4 inci dan penggantian housing kaset utuh.',
            ],
            [
                'nama' => 'Orkes Melayu El Sitara - Pengantin Baru Dangdut Klasik 1977',
                'kode' => 'TAPE-1977-ELST',
                'tahun' => 1977,
                'deskripsi' => 'Koleksi pita kaset dangdut klasik era keemasan melayu dengan petikan mandolin dan ketukan kendang tak-tung tajam.',
                'kondisi_awal' => 'Busa bantalan hilang, label sedikit terkelupas, pita masih dalam kondisi elastisitas baik.',
                'tingkat_kerusakan' => 'ringan',
                'catatan_kondisi' => 'Ganti bantalan busa spons baru dan rekatkan kembali label kaset yang terlepas dengan lem acid-free.',
            ],
            [
                'nama' => 'Radio Sandiwara Misteri Gunung Merapi Episode 01-05 1989',
                'kode' => 'TAPE-1989-MRGP',
                'tahun' => 1989,
                'deskripsi' => 'Pita kaset master siaran radio sandiwara Mak Lampir yang disiarkan serentak di ratusan radio swasta nasional.',
                'kondisi_awal' => 'Pita pernah putus dan disambung sembarangan memakai selotip bening biasa yang meninggalkan lem lengket.',
                'tingkat_kerusakan' => 'berat',
                'catatan_kondisi' => 'Lepaskan selotip lama dengan hati-hati, bersihkan residu perekat kimiawi, sambung ulang dengan splicing tape standar arsip.',
            ],
        ];

        $now = Carbon::now();

        foreach ($curatedCollections as $idx => $data) {
            // Assign category based on index
            $kategori = $kategoris[$idx % $kategoris->count()];

            $koleksi = KoleksiPita::create([
                'kode_koleksi' => $data['kode'],
                'nama_koleksi' => $data['nama'],
                'kategori_format_id' => $kategori->id,
                'tahun' => $data['tahun'],
                'deskripsi' => $data['deskripsi'],
            ]);

            // Create DetailKondisi
            DetailKondisi::create([
                'koleksi_pita_id' => $koleksi->id,
                'kondisi_awal' => $data['kondisi_awal'],
                'tingkat_kerusakan' => $data['tingkat_kerusakan'],
                'catatan' => $data['catatan_kondisi'],
            ]);

            // Attach 1 to 4 restoration actions with varied statuses and dates
            $assignedCount = $faker->numberBetween(1, 4);
            $randomTindakans = $tindakans->random($assignedCount);

            foreach ($randomTindakans as $tIndex => $tindakan) {
                // Determine status distribution: selesai, proses, rencana
                $status = $faker->randomElement(['rencana', 'proses', 'selesai']);

                $tglMulai = null;
                $tglSelesai = null;
                $catatanTindakan = null;

                if ($status === 'selesai') {
                    $tglMulai = $now->copy()->subDays($faker->numberBetween(20, 60))->format('Y-m-d');
                    $tglSelesai = Carbon::parse($tglMulai)->addDays($faker->numberBetween(2, 10))->format('Y-m-d');
                    $catatanTindakan = 'Telah selesai dikerjakan dengan hasil optimal tanpa distorsi pada sinyal audio asli.';
                } elseif ($status === 'proses') {
                    $tglMulai = $now->copy()->subDays($faker->numberBetween(1, 10))->format('Y-m-d');
                    $tglSelesai = null;
                    $catatanTindakan = 'Sedang dalam pengerjaan tahap lanjutan di ruang isolasi laboratorium konservasi.';
                } else {
                    $tglMulai = null;
                    $tglSelesai = null;
                    $catatanTindakan = 'Dijadwalkan masuk antrean meja kerja konservator minggu mendatang.';
                }

                $koleksi->tindakanRestorasis()->attach($tindakan->id, [
                    'status' => $status,
                    'tanggal_mulai' => $tglMulai,
                    'tanggal_selesai' => $tglSelesai,
                    'catatan' => $catatanTindakan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
