<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKoleksiRequest;
use App\Http\Requests\UpdateKoleksiRequest;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use App\Services\KoleksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KoleksiPitaController extends Controller
{
    public function __construct(
        protected KoleksiService $koleksiService
    ) {}

    /**
     * Tampilkan daftar koleksi pita dengan filter dan pencarian.
     */
    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'kategori_format_id', 'tingkat_kerusakan', 'status']);
        $koleksiList = $this->koleksiService->getFilteredKoleksi($filters, 9);
        $kategoriList = KategoriFormat::orderBy('nama_format')->get();

        return view('koleksi.index', compact('koleksiList', 'kategoriList', 'filters'));
    }

    /**
     * Tampilkan form pembuatan koleksi baru.
     */
    public function create(): View
    {
        $kategoriList = KategoriFormat::orderBy('nama_format')->get();
        $tindakanList = TindakanRestorasi::orderBy('nama_tindakan')->get();

        return view('koleksi.create', compact('kategoriList', 'tindakanList'));
    }

    /**
     * Simpan koleksi baru ke database melalui KoleksiService (DB Transaction).
     */
    public function store(StoreKoleksiRequest $request): RedirectResponse
    {
        $koleksi = $this->koleksiService->createKoleksi($request->validated());

        return redirect()
            ->route('koleksi.show', $koleksi)
            ->with('success', "Koleksi '{$koleksi->nama_koleksi}' [{$koleksi->kode_koleksi}] berhasil didaftarkan ke arsip restorasi.");
    }

    /**
     * Tampilkan detail koleksi, kondisi awal, dan daftar tindakan restorasi.
     */
    public function show(KoleksiPita $koleksi): View
    {
        $koleksi->load(['kategori', 'detailKondisi', 'tindakanRestorasis']);

        return view('koleksi.show', compact('koleksi'));
    }

    /**
     * Tampilkan form edit koleksi pita.
     */
    public function edit(KoleksiPita $koleksi): View
    {
        $koleksi->load(['kategori', 'detailKondisi', 'tindakanRestorasis']);
        $kategoriList = KategoriFormat::orderBy('nama_format')->get();
        $tindakanList = TindakanRestorasi::orderBy('nama_tindakan')->get();

        // Map pivot data yang sudah ada untuk memudahkan form edit
        $existingTindakans = $koleksi->tindakanRestorasis->keyBy('id');

        return view('koleksi.edit', compact('koleksi', 'kategoriList', 'tindakanList', 'existingTindakans'));
    }

    /**
     * Perbarui data koleksi melalui KoleksiService (DB Transaction).
     */
    public function update(UpdateKoleksiRequest $request, KoleksiPita $koleksi): RedirectResponse
    {
        $updated = $this->koleksiService->updateKoleksi($koleksi, $request->validated());

        return redirect()
            ->route('koleksi.show', $updated)
            ->with('success', "Data koleksi [{$updated->kode_koleksi}] berhasil diperbarui.");
    }

    /**
     * Hapus data koleksi dari database.
     */
    public function destroy(KoleksiPita $koleksi): RedirectResponse
    {
        $kode = $koleksi->kode_koleksi;
        $nama = $koleksi->nama_koleksi;

        $this->koleksiService->deleteKoleksi($koleksi);

        return redirect()
            ->route('koleksi.index')
            ->with('success', "Koleksi '{$nama}' [{$kode}] berhasil dihapus dari sistem.");
    }
}
