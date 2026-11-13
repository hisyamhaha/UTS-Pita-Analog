<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\KategoriFormat;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriFormatController extends Controller
{
    /**
     * Tampilkan daftar master kategori format pita.
     */
    public function index(): View
    {
        $kategoriList = KategoriFormat::withCount('koleksiPitas')
            ->orderBy('nama_format')
            ->paginate(10);

        return view('kategori.index', compact('kategoriList'));
    }

    /**
     * Tampilkan form pembuatan kategori baru.
     */
    public function create(): View
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori format baru.
     */
    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $kategori = KategoriFormat::create($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format '{$kategori->nama_format}' berhasil ditambahkan.");
    }

    /**
     * Tampilkan detail kategori beserta daftar koleksinya.
     */
    public function show(KategoriFormat $kategori): View
    {
        $kategori->load(['koleksiPitas.detailKondisi']);

        return view('kategori.show', compact('kategori'));
    }

    /**
     * Tampilkan form edit kategori.
     */
    public function edit(KategoriFormat $kategori): View
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui kategori format.
     */
    public function update(UpdateKategoriRequest $request, KategoriFormat $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format '{$kategori->nama_format}' berhasil diperbarui.");
    }

    /**
     * Hapus kategori format.
     */
    public function destroy(KategoriFormat $kategori): RedirectResponse
    {
        $nama = $kategori->nama_format;
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format '{$nama}' berhasil dihapus.");
    }
}
