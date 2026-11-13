@extends('layouts.app')

@section('title', 'Kategori: ' . $kategori->nama_format)

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-[10px] font-bold tracking-widest uppercase">
                DETAIL FORMAT
            </span>
            <span class="font-mono text-xs text-[#54392b]">#{{ $kategori->id }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            {{ $kategori->nama_format }}
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Daftar pita arsip yang menggunakan format media ini (Relasi hasMany).
        </p>
    </div>
    <div class="flex items-center gap-2.5">
        <x-button href="{{ route('kategori.index') }}" variant="cream" size="md">
            ← Daftar Format
        </x-button>
        <x-button href="{{ route('kategori.edit', $kategori) }}" variant="olive" size="md">
            Edit Format
        </x-button>
    </div>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Info Card Kategori -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6">
            <div class="border-b-2 border-[#241a14] pb-3 mb-4 flex items-center justify-between">
                <span class="font-mono text-xs font-bold text-[#54392b] uppercase">Deskripsi & Spesifikasi Audio</span>
                <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] font-mono text-xs font-bold text-[#241a14]">
                    {{ $kategori->koleksiPitas->count() }} Koleksi Terdaftar
                </span>
            </div>
            <p class="text-sm text-[#241a14] leading-relaxed">
                {{ $kategori->deskripsi ?: 'Belum ada deskripsi teknis untuk format ini.' }}
            </p>
        </div>

        <!-- Koleksi dengan Format Ini -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro">
            <div class="px-5 py-3.5 bg-[#e7d8c0] border-b-2 border-[#241a14]">
                <h3 class="font-bold text-[#241a14] text-base">Koleksi Pita Berformat {{ $kategori->nama_format }}</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-[#e7d8c0]/70 border-b-2 border-[#241a14] font-mono text-[11px] uppercase tracking-wider text-[#3a251b]">
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Nama Koleksi</th>
                            <th class="px-4 py-3">Tahun</th>
                            <th class="px-4 py-3">Kondisi Awal</th>
                            <th class="px-4 py-3">Tingkat Kerusakan</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-[#241a14]">
                        @forelse ($kategori->koleksiPitas as $koleksi)
                            <tr class="hover:bg-[#f9f5ed] transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-[#241a14]">
                                    <a href="{{ route('koleksi.show', $koleksi) }}" class="text-[#c96b1b] hover:underline">
                                        {{ $koleksi->kode_koleksi }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 font-bold text-[#241a14]">
                                    {{ $koleksi->nama_koleksi }}
                                </td>
                                <td class="px-4 py-3 font-mono text-xs text-[#241a14]">
                                    {{ $koleksi->tahun }}
                                </td>
                                <td class="px-4 py-3 text-xs text-[#54392b] line-clamp-1 max-w-xs">
                                    {{ $koleksi->detailKondisi->kondisi_awal ?? '-' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $tk = $koleksi->detailKondisi->tingkat_kerusakan ?? 'sedang';
                                        $tkBadge = match($tk) {
                                            'ringan' => 'bg-[#4f5d2f] text-white',
                                            'berat' => 'bg-[#9e3820] text-white',
                                            default => 'bg-[#c96b1b] text-white',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold uppercase border border-[#241a14] {{ $tkBadge }}">
                                        {{ $tk }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a
                                        href="{{ route('koleksi.show', $koleksi) }}"
                                        class="px-2 py-1 bg-[#241a14] text-[#f9f5ed] font-mono text-xs font-bold uppercase shadow-retro-sm"
                                    >
                                        Buka
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-sm font-mono text-[#54392b]">
                                    Belum ada pita koleksi yang terdaftar dengan format ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
