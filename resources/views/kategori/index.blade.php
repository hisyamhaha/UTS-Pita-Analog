@extends('layouts.app')

@section('title', 'Master Kategori Format Pita')

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-[10px] font-bold tracking-widest uppercase">
                MASTER FORMAT
            </span>
            <span class="text-xs font-mono text-[#54392b]">SPESIFIKASI MEDIA ANALOG</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Master Kategori Format Pita
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Daftar standar format media pita magnetik analog (Cassette Tape, Reel-to-Reel, 8-Track, DAT, dsb).
        </p>
    </div>
    <div>
        <x-button href="{{ route('kategori.create') }}" variant="olive" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Format Baru
        </x-button>
    </div>
@endsection

@section('content')
    <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro">
        <div class="px-5 py-3.5 bg-[#e7d8c0] border-b-2 border-[#241a14] flex items-center justify-between">
            <h2 class="font-bold text-[#241a14] text-base">Tabel Spesifikasi Format Pita</h2>
            <span class="font-mono text-xs px-2 py-0.5 bg-[#f9f5ed] border border-[#241a14]">
                TOTAL: {{ $kategoriList->total() }} FORMAT
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-[#e7d8c0]/70 border-b-2 border-[#241a14] font-mono text-[11px] uppercase tracking-wider text-[#3a251b]">
                        <th class="px-4 py-3 w-16">No</th>
                        <th class="px-4 py-3">Nama Format Pita</th>
                        <th class="px-4 py-3">Deskripsi Karakteristik & EQ</th>
                        <th class="px-4 py-3 text-center">Jumlah Koleksi</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-[#241a14]">
                    @forelse ($kategoriList as $index => $kat)
                        <tr class="hover:bg-[#f9f5ed] transition-colors">
                            <td class="px-4 py-3.5 font-mono text-xs text-[#54392b]">
                                {{ $kategoriList->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3.5 font-bold text-[#241a14]">
                                <a href="{{ route('kategori.show', $kat) }}" class="hover:text-[#c96b1b] transition-colors">
                                    {{ $kat->nama_format }}
                                </a>
                            </td>
                            <td class="px-4 py-3.5 text-xs text-[#54392b] leading-relaxed max-w-md">
                                {{ $kat->deskripsi ?: 'Tidak ada deskripsi' }}
                            </td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                <span class="px-2.5 py-1 bg-[#e7d8c0] border border-[#241a14] font-mono text-xs font-bold text-[#241a14]">
                                    {{ $kat->koleksi_pitas_count }} Pita
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a
                                        href="{{ route('kategori.show', $kat) }}"
                                        class="px-2 py-1 bg-[#f9f5ed] hover:bg-[#e7d8c0] text-[#241a14] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm"
                                    >
                                        Lihat
                                    </a>
                                    <a
                                        href="{{ route('kategori.edit', $kat) }}"
                                        class="px-2 py-1 bg-[#e7d8c0] hover:bg-[#c96b1b] hover:text-white text-[#241a14] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm transition-colors"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('kategori.destroy', $kat) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori format {{ $kat->nama_format }}? Koleksi yang menggunakan format ini akan ikut terhapus.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="px-2 py-1 bg-[#9e3820] hover:bg-[#b9452a] text-white border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm cursor-pointer"
                                            title="Hapus Kategori"
                                        >
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-sm font-mono text-[#54392b]">
                                Belum ada master kategori format pita yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t-2 border-[#241a14] bg-[#e7d8c0]/50">
            {{ $kategoriList->links() }}
        </div>
    </div>
@endsection
