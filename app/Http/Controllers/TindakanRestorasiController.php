<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTindakanRequest;
use App\Http\Requests\UpdateTindakanRequest;
use App\Models\TindakanRestorasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TindakanRestorasiController extends Controller
{
    /**
     * Tampilkan daftar master tindakan restorasi.
     */
    public function index(): View
    {
        $tindakanList = TindakanRestorasi::withCount('koleksiPitas')
            ->orderBy('nama_tindakan')
            ->paginate(10);

        return view('tindakan.index', compact('tindakanList'));
    }

    /**
     * Tampilkan form pembuatan tindakan baru.
     */
    public function create(): View
    {
        return view('tindakan.create');
    }

    /**
     * Simpan tindakan restorasi baru.
     */
    public function store(StoreTindakanRequest $request): RedirectResponse
    {
        $tindakan = TindakanRestorasi::create($request->validated());

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan restorasi '{$tindakan->nama_tindakan}' berhasil ditambahkan.");
    }

    /**
     * Tampilkan detail tindakan beserta koleksi yang menggunakannya.
     */
    public function show(TindakanRestorasi $tindakan): View
    {
        $tindakan->load(['koleksiPitas.kategori', 'koleksiPitas.detailKondisi']);

        return view('tindakan.show', compact('tindakan'));
    }

    /**
     * Tampilkan form edit tindakan restorasi.
     */
    public function edit(TindakanRestorasi $tindakan): View
    {
        return view('tindakan.edit', compact('tindakan'));
    }

    /**
     * Perbarui tindakan restorasi.
     */
    public function update(UpdateTindakanRequest $request, TindakanRestorasi $tindakan): RedirectResponse
    {
        $tindakan->update($request->validated());

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan restorasi '{$tindakan->nama_tindakan}' berhasil diperbarui.");
    }

    /**
     * Hapus tindakan restorasi.
     */
    public function destroy(TindakanRestorasi $tindakan): RedirectResponse
    {
        $nama = $tindakan->nama_tindakan;
        $tindakan->delete();

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan restorasi '{$nama}' berhasil dihapus.");
    }
}
