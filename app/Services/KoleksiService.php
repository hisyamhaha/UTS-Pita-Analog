<?php

namespace App\Services;

use App\Models\DetailKondisi;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class KoleksiService
{
    /**
     * Simpan koleksi baru beserta detail kondisi dan pivot tindakan dalam satu DB Transaction.
     */
    public function createKoleksi(array $data): KoleksiPita
    {
        return DB::transaction(function () use ($data) {
            // 1. Simpan Koleksi Pita Utama
            $koleksi = KoleksiPita::create([
                'kode_koleksi' => strtoupper(trim($data['kode_koleksi'])),
                'nama_koleksi' => trim($data['nama_koleksi']),
                'kategori_format_id' => $data['kategori_format_id'],
                'tahun' => $data['tahun'],
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);

            // 2. Simpan Detail Kondisi (Relasi One-to-One)
            $koleksi->detailKondisi()->create([
                'kondisi_awal' => trim($data['kondisi_awal']),
                'tingkat_kerusakan' => $data['tingkat_kerusakan'],
                'catatan' => $data['catatan_kondisi'] ?? null,
            ]);

            // 3. Simpan Relasi Many-to-Many ke Tindakan Restorasi dengan data Pivot
            if (!empty($data['tindakan']) && is_array($data['tindakan'])) {
                $pivotData = $this->formatPivotData($data['tindakan']);
                $koleksi->tindakanRestorasis()->sync($pivotData);
            }

            return $koleksi->load(['kategori', 'detailKondisi', 'tindakanRestorasis']);
        });
    }

    /**
     * Perbarui koleksi, detail kondisi, dan sinkronisasi pivot tindakan dalam satu DB Transaction.
     */
    public function updateKoleksi(KoleksiPita $koleksi, array $data): KoleksiPita
    {
        return DB::transaction(function () use ($koleksi, $data) {
            // 1. Update Koleksi Utama
            $koleksi->update([
                'kode_koleksi' => strtoupper(trim($data['kode_koleksi'])),
                'nama_koleksi' => trim($data['nama_koleksi']),
                'kategori_format_id' => $data['kategori_format_id'],
                'tahun' => $data['tahun'],
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);

            // 2. Update atau Buat Detail Kondisi
            $koleksi->detailKondisi()->updateOrCreate(
                ['koleksi_pita_id' => $koleksi->id],
                [
                    'kondisi_awal' => trim($data['kondisi_awal']),
                    'tingkat_kerusakan' => $data['tingkat_kerusakan'],
                    'catatan' => $data['catatan_kondisi'] ?? null,
                ]
            );

            // 3. Sinkronisasi Tindakan Restorasi (Pivot)
            $pivotData = [];
            if (!empty($data['tindakan']) && is_array($data['tindakan'])) {
                $pivotData = $this->formatPivotData($data['tindakan']);
            }
            $koleksi->tindakanRestorasis()->sync($pivotData);

            return $koleksi->fresh(['kategori', 'detailKondisi', 'tindakanRestorasis']);
        });
    }

    /**
     * Hapus koleksi (cascade otomatis menghapus detail kondisi dan pivot).
     */
    public function deleteKoleksi(KoleksiPita $koleksi): bool
    {
        return DB::transaction(function () use ($koleksi) {
            return (bool) $koleksi->delete();
        });
    }

    /**
     * Mengambil daftar koleksi terfilter dengan pagination.
     */
    public function getFilteredKoleksi(array $filters, int $perPage = 9): LengthAwarePaginator
    {
        $query = KoleksiPita::with(['kategori', 'detailKondisi', 'tindakanRestorasis']);

        // Pencarian teks berdasarkan kode atau nama koleksi
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('kode_koleksi', 'like', "%{$search}%")
                  ->orWhere('nama_koleksi', 'like', "%{$search}%");
            });
        }

        // Filter Kategori Format
        if (!empty($filters['kategori_format_id'])) {
            $query->where('kategori_format_id', $filters['kategori_format_id']);
        }

        // Filter Tingkat Kerusakan (relasi detailKondisi)
        if (!empty($filters['tingkat_kerusakan'])) {
            $query->whereHas('detailKondisi', function ($q) use ($filters) {
                $q->where('tingkat_kerusakan', $filters['tingkat_kerusakan']);
            });
        }

        // Filter Status Restorasi (relasi pivot tindakanRestorasis)
        if (!empty($filters['status'])) {
            $query->whereHas('tindakanRestorasis', function ($q) use ($filters) {
                $q->where('koleksi_tindakan.status', $filters['status']);
            });
        }

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    /**
     * Menghitung statistik lengkap untuk dashboard.
     */
    public function getDashboardStatistics(): array
    {
        $totalKoleksi = KoleksiPita::count();
        $totalKategori = KategoriFormat::count();
        $totalTindakanMaster = TindakanRestorasi::count();

        // Statistik Tingkat Kerusakan
        $kerusakanCounts = DetailKondisi::select('tingkat_kerusakan', DB::raw('count(*) as count'))
            ->groupBy('tingkat_kerusakan')
            ->pluck('count', 'tingkat_kerusakan')
            ->toArray();

        // Statistik Status Tindakan di Pivot
        $statusCounts = DB::table('koleksi_tindakan')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Koleksi terbaru
        $recentKoleksi = KoleksiPita::with(['kategori', 'detailKondisi'])
            ->latest('id')
            ->take(5)
            ->get();

        // Tindakan aktif yang sedang dalam proses
        $activeRestorations = DB::table('koleksi_tindakan')
            ->join('koleksi_pitas', 'koleksi_tindakan.koleksi_pita_id', '=', 'koleksi_pitas.id')
            ->join('tindakan_restorasis', 'koleksi_tindakan.tindakan_restorasi_id', '=', 'tindakan_restorasis.id')
            ->select(
                'koleksi_tindakan.*',
                'koleksi_pitas.nama_koleksi',
                'koleksi_pitas.kode_koleksi',
                'tindakan_restorasis.nama_tindakan'
            )
            ->where('koleksi_tindakan.status', 'proses')
            ->latest('koleksi_tindakan.updated_at')
            ->take(5)
            ->get();

        return [
            'totalKoleksi' => $totalKoleksi,
            'totalKategori' => $totalKategori,
            'totalTindakanMaster' => $totalTindakanMaster,
            'totalTindakanBerjalan' => $statusCounts['proses'] ?? 0,
            'totalTindakanSelesai' => $statusCounts['selesai'] ?? 0,
            'totalTindakanRencana' => $statusCounts['rencana'] ?? 0,
            'ringanCount' => $kerusakanCounts['ringan'] ?? 0,
            'sedangCount' => $kerusakanCounts['sedang'] ?? 0,
            'beratCount' => $kerusakanCounts['berat'] ?? 0,
            'recentKoleksi' => $recentKoleksi,
            'activeRestorations' => $activeRestorations,
        ];
    }

    /**
     * Memformat array data pivot dari form input request.
     */
    protected function formatPivotData(array $tindakanList): array
    {
        $pivot = [];
        foreach ($tindakanList as $item) {
            $tindakanId = $item['tindakan_id'] ?? null;
            if (!$tindakanId) {
                continue;
            }

            $status = in_array($item['status'] ?? '', ['rencana', 'proses', 'selesai'])
                ? $item['status']
                : 'rencana';

            $pivot[$tindakanId] = [
                'status' => $status,
                'tanggal_mulai' => !empty($item['tanggal_mulai']) ? $item['tanggal_mulai'] : null,
                'tanggal_selesai' => !empty($item['tanggal_selesai']) ? $item['tanggal_selesai'] : null,
                'catatan' => !empty($item['catatan']) ? trim($item['catatan']) : null,
            ];
        }

        return $pivot;
    }
}
