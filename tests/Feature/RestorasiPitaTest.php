<?php

namespace Tests\Feature;

use App\Models\DetailKondisi;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use App\Services\KoleksiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestorasiPitaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test Dashboard page responds with OK 200.
     */
    public function test_dashboard_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Preservasi', false);
        $response->assertSee('PITA ANALOG REEL', false);
    }

    /**
     * Test Koleksi index page loads and shows collections.
     */
    public function test_koleksi_index_loads_successfully(): void
    {
        $response = $this->get('/koleksi');
        $response->assertStatus(200);
        $response->assertSee('Daftar Koleksi Pita Analog', false);
    }

    /**
     * Test Koleksi detail page shows specific collection.
     */
    public function test_koleksi_show_page_loads_successfully(): void
    {
        $koleksi = KoleksiPita::first();
        $response = $this->get("/koleksi/{$koleksi->id}");
        $response->assertStatus(200);
        $response->assertSee($koleksi->kode_koleksi, false);
    }

    /**
     * Test Service createKoleksi with DB Transaction, DetailKondisi, and Pivot.
     */
    public function test_service_creates_koleksi_with_detail_and_pivot(): void
    {
        $kategori = KategoriFormat::first();
        $tindakan = TindakanRestorasi::first();

        $service = app(KoleksiService::class);

        $data = [
            'kode_koleksi' => 'TEST-1979-UNIT',
            'nama_koleksi' => 'Unit Test Album Master Pita Analog',
            'kategori_format_id' => $kategori->id,
            'tahun' => 1979,
            'deskripsi' => 'Pita uji coba relasi database lengkap.',
            'kondisi_awal' => 'Kondisi fisik uji coba berjamur ringan pada tape leader.',
            'tingkat_kerusakan' => 'sedang',
            'catatan_kondisi' => 'Instruksi uji coba laboratorium.',
            'tindakan' => [
                [
                    'tindakan_id' => $tindakan->id,
                    'status' => 'proses',
                    'tanggal_mulai' => '2026-11-01',
                    'tanggal_selesai' => null,
                    'catatan' => 'Uji coba pivot status proses.',
                ],
            ],
        ];

        $koleksi = $service->createKoleksi($data);

        $this->assertDatabaseHas('koleksi_pitas', [
            'kode_koleksi' => 'TEST-1979-UNIT',
            'nama_koleksi' => 'Unit Test Album Master Pita Analog',
            'tahun' => 1979,
        ]);

        $this->assertDatabaseHas('detail_kondisis', [
            'koleksi_pita_id' => $koleksi->id,
            'tingkat_kerusakan' => 'sedang',
        ]);

        $this->assertDatabaseHas('koleksi_tindakan', [
            'koleksi_pita_id' => $koleksi->id,
            'tindakan_restorasi_id' => $tindakan->id,
            'status' => 'proses',
        ]);
    }

    /**
     * Test Master Kategori Format CRUD.
     */
    public function test_kategori_format_crud(): void
    {
        $response = $this->post('/kategori', [
            'nama_format' => 'Test Format Tape 1/4 IPS 30 Unique',
            'deskripsi' => 'Format pita audio berkecepatan 30 ips audiophile.',
        ]);

        $response->assertRedirect('/kategori');
        $this->assertDatabaseHas('kategori_formats', [
            'nama_format' => 'Test Format Tape 1/4 IPS 30 Unique',
        ]);
    }

    /**
     * Test Master Tindakan Restorasi CRUD.
     */
    public function test_tindakan_restorasi_crud(): void
    {
        $response = $this->post('/tindakan', [
            'nama_tindakan' => 'Test Prosedur Ozone Disinfection Unique',
            'deskripsi' => 'Disinfeksi jamur menggunakan ruang gas ozon terkontrol.',
        ]);

        $response->assertRedirect('/tindakan');
        $this->assertDatabaseHas('tindakan_restorasis', [
            'nama_tindakan' => 'Test Prosedur Ozone Disinfection Unique',
        ]);
    }
}
