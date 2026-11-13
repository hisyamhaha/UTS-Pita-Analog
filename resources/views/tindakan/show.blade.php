@extends('layouts.app')

@section('title', 'Tindakan: ' . $tindakan->nama_tindakan)

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-[10px] font-bold tracking-widest uppercase">
                DETAIL TINDAKAN
            </span>
            <span class="font-mono text-xs text-[#54392b]">#{{ $tindakan->id }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            {{ $tindakan->nama_tindakan }}
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Daftar pita yang menggunakan atau dijadwalkan tindakan ini (Relasi belongsToMany).
        </p>
    </div>
    <div class="flex items-center gap-2.5">
        <x-button href="{{ route('tindakan.index') }}" variant="cream" size="md">
            ← Daftar Tindakan
        </x-button>
        <x-button href="{{ route('tindakan.edit', $tindakan) }}" variant="olive" size="md">
            Edit Tindakan
        </x-button>
    </div>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Info Card Tindakan -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6">
            <div class="border-b-2 border-[#241a14] pb-3 mb-4 flex items-center justify-between">
                <span class="font-mono text-xs font-bold text-[#54392b] uppercase">Deskripsi Prosedur Operasional Laboratorium</span>
                <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] font-mono text-xs font-bold text-[#241a14]">
                    {{ $tindakan->koleksiPitas->count() }} Pita Terkait
                </span>
            </div>
            <p class="text-sm text-[#241a14] leading-relaxed">
                {{ $tindakan->deskripsi ?: 'Belum ada uraian prosedur teknis untuk tindakan ini.' }}
            </p>
        </div>

        <!-- Koleksi Terkait -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro">
            <div class="px-5 py-3.5 bg-[#e7d8c0] border-b-2 border-[#241a14]">
                <h3 class="font-bold text-[#241a14] text-base">Pita Koleksi Terkait Tindakan Ini</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-[#e7d8c0]/70 border-b-2 border-[#241a14] font-mono text-[11px] uppercase tracking-wider text-[#3a251b]">
                            <th class="px-4 py-3">Kode Pita</th>
                            <th class="px-4 py-3">Judul Rekaman</th>
                            <th class="px-4 py-3">Format</th>
                            <th class="px-4 py-3">Status Tindakan</th>
                            <th class="px-4 py-3">Jadwal Tanggal</th>
                            <th class="px-4 py-3">Catatan Pivot</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-[#241a14]">
                        @forelse ($tindakan->koleksiPitas as $koleksi)
                            <tr class="hover:bg-[#f9f5ed] transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-[#241a14] whitespace-nowrap">
                                    <a href="{{ route('koleksi.show', $koleksi) }}" class="text-[#c96b1b] hover:underline">
                                        {{ $koleksi->kode_koleksi }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 font-bold text-[#241a14]">
                                    {{ $koleksi->nama_koleksi }}
                                </td>
                                <td class="px-4 py-3 text-xs font-mono text-[#54392b]">
                                    {{ $koleksi->kategori->nama_format ?? '-' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $st = $koleksi->pivot->status ?? 'rencana';
                                        $stBadge = match($st) {
                                            'selesai' => 'bg-[#4f5d2f] text-white',
                                            'proses' => 'bg-[#c96b1b] text-white',
                                            default => 'bg-[#54392b] text-white',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold uppercase border border-[#241a14] {{ $stBadge }}">
                                        {{ $st }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs font-mono text-[#54392b] whitespace-nowrap">
                                    {{ $koleksi->pivot->tanggal_mulai ? date('d/m/Y', strtotime($koleksi->pivot->tanggal_mulai)) : '-' }}
                                    →
                                    {{ $koleksi->pivot->tanggal_selesai ? date('d/m/Y', strtotime($koleksi->pivot->tanggal_selesai)) : '-' }}
                                </td>
                                <td class="px-4 py-3 text-xs text-[#54392b] italic max-w-xs truncate">
                                    {{ $koleksi->pivot->catatan ?: '-' }}
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
                                <td colspan="7" class="px-4 py-8 text-center text-sm font-mono text-[#54392b]">
                                    Belum ada pita koleksi yang terhubung dengan tindakan restorasi ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
