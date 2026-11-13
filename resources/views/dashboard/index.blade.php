@extends('layouts.app')

@section('title', 'Dashboard Statistik Preservasi')

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] font-mono text-[10px] font-bold tracking-widest uppercase">
                STUDIO TELEMETRY
            </span>
            <span class="text-xs font-mono text-[#54392b]">PITA ANALOG REEL & CASSETTE</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Dashboard Preservasi & Restorasi
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Pantauan inventaris arsip audio magnetik, diagnostik kerusakan fisik, dan status tindakan teknis laboratorium.
        </p>
    </div>
    <div class="flex items-center gap-2.5">
        <x-button href="{{ route('koleksi.create') }}" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Registrasi Pita
        </x-button>
        <x-button href="{{ route('koleksi.index') }}" variant="cream" size="md">
            Semua Arsip
        </x-button>
    </div>
@endsection

@section('content')
    <!-- Top Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Total Koleksi -->
        <div class="p-5 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="font-mono text-xs font-bold uppercase tracking-wider text-[#54392b]">TOTAL KOLEKSI</span>
                <span class="w-7 h-7 rounded-full bg-[#c96b1b] border-2 border-[#241a14] flex items-center justify-center text-white text-xs font-bold reel-spin">
                    ●
                </span>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-4xl font-extrabold text-[#241a14] font-mono tracking-tight">{{ $totalKoleksi }}</span>
                <span class="text-xs font-mono text-[#54392b] bg-[#e7d8c0] px-2 py-0.5 border border-[#241a14]">PITA ARSIP</span>
            </div>
            <div class="mt-4 pt-3 border-t border-[#d2c0a5] flex items-center justify-between text-[11px] font-mono text-[#54392b]">
                <span>Terdokumentasi</span>
                <a href="{{ route('koleksi.index') }}" class="font-bold text-[#c96b1b] hover:underline">Lihat Semua →</a>
            </div>
        </div>

        <!-- Master Kategori Format -->
        <div class="p-5 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="font-mono text-xs font-bold uppercase tracking-wider text-[#54392b]">FORMAT MASTER</span>
                <span class="w-7 h-7 bg-[#4f5d2f] border-2 border-[#241a14] flex items-center justify-center text-white text-xs font-bold">
                    ≡
                </span>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-4xl font-extrabold text-[#241a14] font-mono tracking-tight">{{ $totalKategori }}</span>
                <span class="text-xs font-mono text-[#54392b] bg-[#e7d8c0] px-2 py-0.5 border border-[#241a14]">KATEGORI</span>
            </div>
            <div class="mt-4 pt-3 border-t border-[#d2c0a5] flex items-center justify-between text-[11px] font-mono text-[#54392b]">
                <span>Reel, Cassette, DAT</span>
                <a href="{{ route('kategori.index') }}" class="font-bold text-[#4f5d2f] hover:underline">Kelola Format →</a>
            </div>
        </div>

        <!-- Tindakan Restorasi Berjalan (Proses) -->
        <div class="p-5 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="font-mono text-xs font-bold uppercase tracking-wider text-[#54392b]">SEDANG DIRESTURASI</span>
                <span class="w-3 h-3 rounded-full bg-[#c96b1b] animate-ping"></span>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-4xl font-extrabold text-[#c96b1b] font-mono tracking-tight">{{ $totalTindakanBerjalan }}</span>
                <span class="text-xs font-mono text-[#c96b1b] bg-[#c96b1b]/15 px-2 py-0.5 border border-[#c96b1b] font-bold">DALAM PROSES</span>
            </div>
            <div class="mt-4 pt-3 border-t border-[#d2c0a5] flex items-center justify-between text-[11px] font-mono text-[#54392b]">
                <span>{{ $totalTindakanRencana }} Terencana</span>
                <span class="font-bold text-[#54392b]">Di Meja Kerja</span>
            </div>
        </div>

        <!-- Tindakan Restorasi Selesai -->
        <div class="p-5 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="font-mono text-xs font-bold uppercase tracking-wider text-[#54392b]">TINDAKAN SELESAI</span>
                <span class="w-7 h-7 bg-[#4f5d2f] border-2 border-[#241a14] flex items-center justify-center text-white text-xs font-bold">
                    ✓
                </span>
            </div>
            <div class="flex items-baseline justify-between">
                <span class="text-4xl font-extrabold text-[#4f5d2f] font-mono tracking-tight">{{ $totalTindakanSelesai }}</span>
                <span class="text-xs font-mono text-[#4f5d2f] bg-[#4f5d2f]/15 px-2 py-0.5 border border-[#4f5d2f] font-bold">TERPRESERVASI</span>
            </div>
            <div class="mt-4 pt-3 border-t border-[#d2c0a5] flex items-center justify-between text-[11px] font-mono text-[#54392b]">
                <span>Dari {{ $totalTindakanMaster }} Jenis Tindakan</span>
                <a href="{{ route('tindakan.index') }}" class="font-bold text-[#4f5d2f] hover:underline">Detail Tindakan →</a>
            </div>
        </div>
    </div>

    <!-- Diagnostic Meters Section (Damage Level & Status Breakdown) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Physical Condition Breakdown (1-to-1 DetailKondisi) -->
        <div class="lg:col-span-1 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5">
            <div class="flex items-center justify-between pb-3 mb-4 border-b-2 border-[#241a14]">
                <div>
                    <h2 class="font-bold text-[#241a14] text-base">Tingkat Kerusakan Fisik</h2>
                    <p class="text-xs font-mono text-[#54392b]">Diagnostik Kondisi Awal Pita</p>
                </div>
                <span class="font-mono text-xs px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14]">TOTAL: {{ $totalKoleksi }}</span>
            </div>

            <div class="space-y-4">
                <!-- Kerusakan Ringan -->
                <div>
                    <div class="flex justify-between items-center text-xs font-mono mb-1">
                        <span class="font-bold text-[#4f5d2f] flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#4f5d2f]"></span>
                            RINGAN (Stabil / Jamur Tipis)
                        </span>
                        <span class="font-bold text-[#241a14]">{{ $ringanCount }} Pita</span>
                    </div>
                    @php $pRingan = $totalKoleksi > 0 ? round(($ringanCount / $totalKoleksi) * 100) : 0; @endphp
                    <div class="h-3 bg-[#e7d8c0] border-2 border-[#241a14] overflow-hidden">
                        <div class="h-full bg-[#4f5d2f]" style="width: {{ $pRingan }}%"></div>
                    </div>
                    <p class="text-[10px] font-mono text-[#54392b] text-right mt-0.5">{{ $pRingan }}% dari koleksi</p>
                </div>

                <!-- Kerusakan Sedang -->
                <div>
                    <div class="flex justify-between items-center text-xs font-mono mb-1">
                        <span class="font-bold text-[#c96b1b] flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#c96b1b]"></span>
                            SEDANG (Kusut / Spons Rusak / Berisik)
                        </span>
                        <span class="font-bold text-[#241a14]">{{ $sedangCount }} Pita</span>
                    </div>
                    @php $pSedang = $totalKoleksi > 0 ? round(($sedangCount / $totalKoleksi) * 100) : 0; @endphp
                    <div class="h-3 bg-[#e7d8c0] border-2 border-[#241a14] overflow-hidden">
                        <div class="h-full bg-[#c96b1b]" style="width: {{ $pSedang }}%"></div>
                    </div>
                    <p class="text-[10px] font-mono text-[#54392b] text-right mt-0.5">{{ $pSedang }}% dari koleksi</p>
                </div>

                <!-- Kerusakan Berat -->
                <div>
                    <div class="flex justify-between items-center text-xs font-mono mb-1">
                        <span class="font-bold text-[#9e3820] flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#9e3820]"></span>
                            BERAT (Sticky-Shed / Putus / Jamur Akut)
                        </span>
                        <span class="font-bold text-[#241a14]">{{ $beratCount }} Pita</span>
                    </div>
                    @php $pBerat = $totalKoleksi > 0 ? round(($beratCount / $totalKoleksi) * 100) : 0; @endphp
                    <div class="h-3 bg-[#e7d8c0] border-2 border-[#241a14] overflow-hidden">
                        <div class="h-full bg-[#9e3820]" style="width: {{ $pBerat }}%"></div>
                    </div>
                    <p class="text-[10px] font-mono text-[#54392b] text-right mt-0.5">{{ $pBerat }}% dari koleksi</p>
                </div>
            </div>

            <div class="mt-5 p-3 bg-[#f9f5ed] border border-[#241a14] text-xs font-mono text-[#54392b]">
                <p class="font-bold text-[#241a14] mb-1">Keterangan Prioritas:</p>
                Koleksi dengan kerusakan berat harus diisolasi di ruang ber-AC rendah kelembapan (RH < 30%) untuk mencegah migrasi spora jamur.
            </div>
        </div>

        <!-- Active Workstation Queue (Restorasi Sedang Berlangsung) -->
        <div class="lg:col-span-2 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 mb-4 border-b-2 border-[#241a14]">
                    <div>
                        <h2 class="font-bold text-[#241a14] text-base">Aktivitas Restorasi di Meja Kerja</h2>
                        <p class="text-xs font-mono text-[#54392b]">Tindakan teknis yang saat ini berstatus 'PROSES'</p>
                    </div>
                    <span class="px-2.5 py-0.5 bg-[#c96b1b] text-white font-mono text-xs font-bold border border-[#241a14]">
                        {{ $activeRestorations->count() }} ANTREAN
                    </span>
                </div>

                @if ($activeRestorations->isEmpty())
                    <div class="p-8 text-center bg-[#f9f5ed] border-2 border-dashed border-[#d2c0a5]">
                        <p class="text-sm font-mono text-[#54392b]">Tidak ada tindakan yang berstatus aktif saat ini.</p>
                        <p class="text-xs font-mono text-[#54392b]/70 mt-1">Semua tindakan sedang dalam status rencana atau sudah selesai.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($activeRestorations as $active)
                            <div class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-mono text-xs font-bold px-1.5 py-0.5 bg-[#241a14] text-[#f9f5ed]">
                                            {{ $active->kode_koleksi }}
                                        </span>
                                        <span class="text-xs font-bold text-[#241a14] truncate max-w-xs">
                                            {{ $active->nama_koleksi }}
                                        </span>
                                    </div>
                                    <p class="text-xs font-mono text-[#c96b1b] font-bold">
                                        ↳ {{ $active->nama_tindakan }}
                                    </p>
                                    @if ($active->catatan)
                                        <p class="text-[11px] text-[#54392b] italic mt-0.5 line-clamp-1">
                                            "{{ $active->catatan }}"
                                        </p>
                                    @endif
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="inline-block px-2 py-0.5 text-[11px] font-mono font-bold bg-[#c96b1b] text-white border border-[#241a14] uppercase">
                                        PROSES
                                    </span>
                                    <p class="text-[10px] font-mono text-[#54392b] mt-1">
                                        Mulai: {{ $active->tanggal_mulai ? date('d/m/Y', strtotime($active->tanggal_mulai)) : '-' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mt-4 pt-3 border-t border-[#d2c0a5] flex items-center justify-between text-xs font-mono">
                <span class="text-[#54392b]">Manajemen alur kerja pita magnetik</span>
                <a href="{{ route('koleksi.index') }}" class="font-bold text-[#c96b1b] hover:underline">
                    Periksa Alur Kerja Koleksi →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Collections Table -->
    <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro">
        <div class="px-5 py-3.5 bg-[#e7d8c0] border-b-2 border-[#241a14] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-[#241a14] text-base">Arsip Koleksi Pita Terbaru</h2>
                <p class="text-xs font-mono text-[#54392b]">5 pita rekaman analog terakhir yang didaftarkan ke sistem</p>
            </div>
            <a href="{{ route('koleksi.index') }}" class="font-mono text-xs font-bold text-[#c96b1b] hover:underline flex items-center gap-1">
                Buka Katalog Lengkap →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-[#e7d8c0]/70 border-b-2 border-[#241a14] font-mono text-[11px] uppercase tracking-wider text-[#3a251b]">
                        <th class="px-4 py-3">Kode Koleksi</th>
                        <th class="px-4 py-3">Judul Rekaman</th>
                        <th class="px-4 py-3">Format Pita</th>
                        <th class="px-4 py-3">Tahun</th>
                        <th class="px-4 py-3">Kerusakan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-[#241a14]">
                    @forelse ($recentKoleksi as $item)
                        <tr class="hover:bg-[#f9f5ed] transition-colors">
                            <td class="px-4 py-3 font-mono font-bold text-[#241a14] whitespace-nowrap">
                                <a href="{{ route('koleksi.show', $item) }}" class="text-[#c96b1b] hover:underline">
                                    {{ $item->kode_koleksi }}
                                </a>
                            </td>
                            <td class="px-4 py-3 font-semibold text-[#241a14]">
                                {{ $item->nama_koleksi }}
                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-[#54392b]">
                                {{ $item->kategori->nama_format ?? '-' }}
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-[#241a14]">
                                {{ $item->tahun }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                    $tk = $item->detailKondisi->tingkat_kerusakan ?? 'sedang';
                                    $tkBadge = match($tk) {
                                        'ringan' => 'bg-[#4f5d2f] text-white',
                                        'berat' => 'bg-[#9e3820] text-white',
                                        default => 'bg-[#c96b1b] text-white',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 text-[10px] font-mono font-bold uppercase tracking-wider border border-[#241a14] {{ $tkBadge }}">
                                    {{ $tk }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <a
                                    href="{{ route('koleksi.show', $item) }}"
                                    class="inline-block px-2.5 py-1 bg-[#e7d8c0] hover:bg-[#c96b1b] hover:text-white border border-[#241a14] font-mono text-xs font-bold uppercase tracking-wider shadow-retro-sm transition-colors"
                                >
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm font-mono text-[#54392b]">
                                Belum ada koleksi pita yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
