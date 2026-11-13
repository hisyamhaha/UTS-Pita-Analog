@extends('layouts.app')

@section('title', 'Katalog Koleksi Pita Analog')

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] font-mono text-[10px] font-bold tracking-widest uppercase">
                INVENTORY DECK
            </span>
            <span class="text-xs font-mono text-[#54392b]">ARSIP & KATALOGISASI</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Daftar Koleksi Pita Analog
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Menampilkan seluruh pita rekaman magnetik yang sedang atau telah terdata dalam program preservasi.
        </p>
    </div>
    <div>
        <x-button href="{{ route('koleksi.create') }}" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Registrasi Pita Baru
        </x-button>
    </div>
@endsection

@section('content')
    <!-- Search and Filter Bar -->
    <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5 mb-8">
        <form method="GET" action="{{ route('koleksi.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3.5">
                <!-- Search Box -->
                <div class="md:col-span-4">
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Pencarian Kata Kunci
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="Cari kode pita atau judul rekaman..."
                            class="w-full px-3.5 py-2 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] placeholder-[#54392b]/60 focus:outline-none focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm"
                        />
                        @if (!empty($filters['search']))
                            <a href="{{ route('koleksi.index', array_diff_key($filters, ['search' => ''])) }}" class="absolute right-2.5 top-2 text-xs font-mono text-[#9e3820] font-bold">
                                ✕
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Filter Kategori Format -->
                <div class="md:col-span-3">
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Kategori Format
                    </label>
                    <select
                        name="kategori_format_id"
                        class="w-full px-3.5 py-2 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm cursor-pointer"
                    >
                        <option value="">-- Semua Format Pita --</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat->id }}" {{ ($filters['kategori_format_id'] ?? '') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_format }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tingkat Kerusakan -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Kerusakan
                    </label>
                    <select
                        name="tingkat_kerusakan"
                        class="w-full px-3.5 py-2 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm cursor-pointer"
                    >
                        <option value="">-- Semua --</option>
                        <option value="ringan" {{ ($filters['tingkat_kerusakan'] ?? '') === 'ringan' ? 'selected' : '' }}>Ringan</option>
                        <option value="sedang" {{ ($filters['tingkat_kerusakan'] ?? '') === 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="berat" {{ ($filters['tingkat_kerusakan'] ?? '') === 'berat' ? 'selected' : '' }}>Berat</option>
                    </select>
                </div>

                <!-- Filter Status Restorasi Pivot -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Status Restorasi
                    </label>
                    <select
                        name="status"
                        class="w-full px-3.5 py-2 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm cursor-pointer"
                    >
                        <option value="">-- Semua Status --</option>
                        <option value="rencana" {{ ($filters['status'] ?? '') === 'rencana' ? 'selected' : '' }}>Rencana</option>
                        <option value="proses" {{ ($filters['status'] ?? '') === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ ($filters['status'] ?? '') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- Action Button Filter & Reset -->
                <div class="md:col-span-1 flex items-end gap-1.5">
                    <button
                        type="submit"
                        class="w-full px-3 py-2 bg-[#241a14] hover:bg-[#3a251b] text-white border-2 border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm cursor-pointer active:translate-x-0.5 active:translate-y-0.5"
                        title="Terapkan Filter"
                    >
                        Filter
                    </button>
                </div>
            </div>

            <!-- Active filter chips -->
            @if (!empty($filters['search']) || !empty($filters['kategori_format_id']) || !empty($filters['tingkat_kerusakan']) || !empty($filters['status']))
                <div class="pt-2 border-t border-[#d2c0a5] flex flex-wrap items-center gap-2">
                    <span class="text-xs font-mono text-[#54392b]">Filter aktif:</span>
                    @if (!empty($filters['search']))
                        <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] text-xs font-mono">
                            Cari: "{{ $filters['search'] }}"
                        </span>
                    @endif
                    @if (!empty($filters['kategori_format_id']))
                        @php $foundKat = $kategoriList->firstWhere('id', $filters['kategori_format_id']); @endphp
                        <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] text-xs font-mono">
                            Format: {{ $foundKat->nama_format ?? $filters['kategori_format_id'] }}
                        </span>
                    @endif
                    @if (!empty($filters['tingkat_kerusakan']))
                        <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] text-xs font-mono uppercase">
                            Kerusakan: {{ $filters['tingkat_kerusakan'] }}
                        </span>
                    @endif
                    @if (!empty($filters['status']))
                        <span class="px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14] text-xs font-mono uppercase">
                            Status: {{ $filters['status'] }}
                        </span>
                    @endif
                    <a href="{{ route('koleksi.index') }}" class="text-xs font-mono text-[#9e3820] font-bold hover:underline ml-2">
                        Reset Semua Filter ✕
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Koleksi Cards Grid (Cassette Deck Motif) -->
    @if ($koleksiList->isEmpty())
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 border-2 border-[#241a14] bg-[#e7d8c0] flex items-center justify-center font-mono text-2xl font-bold text-[#54392b]">
                ∅
            </div>
            <h3 class="text-lg font-bold text-[#241a14]">Tidak Ada Koleksi Pita Ditemukan</h3>
            <p class="text-xs font-mono text-[#54392b] max-w-md mx-auto mt-1 mb-5">
                Tidak ada data pita yang sesuai dengan kriteria pencarian atau filter yang Anda pilih.
            </p>
            <div class="flex items-center justify-center gap-3">
                <x-button href="{{ route('koleksi.index') }}" variant="cream" size="sm">
                    Reset Filter
                </x-button>
                <x-button href="{{ route('koleksi.create') }}" variant="primary" size="sm">
                    Registrasi Pita Baru
                </x-button>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($koleksiList as $koleksi)
                <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro hover:shadow-retro-lg transition-all flex flex-col justify-between group relative overflow-hidden">
                    <!-- Cassette Top Header Strip -->
                    <div class="px-4 py-2.5 bg-[#e7d8c0] border-b-2 border-[#241a14] flex items-center justify-between">
                        <span class="font-mono text-xs font-bold px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] border border-[#241a14]">
                            {{ $koleksi->kode_koleksi }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <span class="font-mono text-xs text-[#54392b] font-bold">YEAR:</span>
                            <span class="font-mono text-xs font-bold text-[#241a14] bg-[#f9f5ed] px-1.5 py-0.2 border border-[#241a14]">
                                {{ $koleksi->tahun }}
                            </span>
                        </div>
                    </div>

                    <!-- Cassette Window Graphic -->
                    <div class="mx-4 mt-3 p-2 bg-[#241a14] border border-[#241a14] shadow-retro-sm">
                        <div class="h-12 bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-between px-3 relative">
                            <!-- Left Spool -->
                            <div class="w-8 h-8 rounded-full border-2 border-[#f4ebd9] bg-[#170f0b] flex items-center justify-center reel-spin">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#f4ebd9]"></div>
                            </div>
                            <!-- Tape Center Window -->
                            <div class="flex-1 mx-2 text-center">
                                <span class="font-mono text-[9px] text-[#d2c0a5] tracking-widest uppercase block">
                                    {{ Str::limit($koleksi->kategori->nama_format ?? 'ANALOG TAPE', 24) }}
                                </span>
                                <div class="h-1.5 w-3/4 mx-auto bg-[#170f0b] border border-[#d2c0a5]/30 mt-1 relative overflow-hidden">
                                    <div class="w-2/3 h-full bg-[#c96b1b]"></div>
                                </div>
                            </div>
                            <!-- Right Spool -->
                            <div class="w-8 h-8 rounded-full border-2 border-[#f4ebd9] bg-[#170f0b] flex items-center justify-center reel-spin">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#f4ebd9]"></div>
                            </div>
                        </div>
                        <!-- Vintage Tricolor Tape Stripe -->
                        <div class="h-1 w-full tape-label-bands mt-1"></div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-[#241a14] text-base leading-snug group-hover:text-[#c96b1b] transition-colors mb-2">
                                <a href="{{ route('koleksi.show', $koleksi) }}">
                                    {{ $koleksi->nama_koleksi }}
                                </a>
                            </h3>

                            @if ($koleksi->deskripsi)
                                <p class="text-xs text-[#54392b] line-clamp-2 mb-3 leading-relaxed">
                                    {{ $koleksi->deskripsi }}
                                </p>
                            @endif

                            <!-- Condition Diagnostic Box -->
                            <div class="p-2.5 bg-[#f9f5ed] border border-[#241a14] mb-3">
                                <div class="flex items-center justify-between text-[11px] font-mono mb-1">
                                    <span class="text-[#54392b] font-bold">KONDISI FISIK:</span>
                                    @php
                                        $tk = $koleksi->detailKondisi->tingkat_kerusakan ?? 'sedang';
                                        $tkBadge = match($tk) {
                                            'ringan' => 'bg-[#4f5d2f] text-white',
                                            'berat' => 'bg-[#9e3820] text-white',
                                            default => 'bg-[#c96b1b] text-white',
                                        };
                                    @endphp
                                    <span class="px-1.5 py-0.2 text-[10px] font-bold uppercase {{ $tkBadge }} border border-[#241a14]">
                                        {{ $tk }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-[#241a14] line-clamp-2 italic">
                                    "{{ $koleksi->detailKondisi->kondisi_awal ?? 'Belum ada catatan kondisi' }}"
                                </p>
                            </div>

                            <!-- Attached Restorations Summary -->
                            <div class="flex items-center justify-between text-xs font-mono text-[#54392b]">
                                <span>Tindakan Restorasi:</span>
                                <span class="font-bold text-[#241a14] bg-[#e7d8c0] px-2 py-0.5 border border-[#241a14]">
                                    {{ $koleksi->tindakanRestorasis->count() }} Tindakan
                                </span>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="mt-4 pt-3 border-t-2 border-[#241a14] flex items-center justify-between gap-2">
                            <a
                                href="{{ route('koleksi.show', $koleksi) }}"
                                class="flex-1 text-center px-2.5 py-1.5 bg-[#241a14] hover:bg-[#3a251b] text-[#f9f5ed] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm"
                            >
                                Periksa
                            </a>
                            <a
                                href="{{ route('koleksi.edit', $koleksi) }}"
                                class="px-2.5 py-1.5 bg-[#e7d8c0] hover:bg-[#c96b1b] hover:text-white text-[#241a14] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm transition-colors"
                            >
                                Edit
                            </a>
                            <form
                                action="{{ route('koleksi.destroy', $koleksi) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip koleksi [{{ $koleksi->kode_koleksi }}] {{ $koleksi->nama_koleksi }}? Data detail kondisi dan tindakan restorasi terkait akan ikut terhapus.')"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-2.5 py-1.5 bg-[#9e3820] hover:bg-[#b9452a] text-white border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm cursor-pointer"
                                    title="Hapus Koleksi"
                                >
                                    ✕
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Custom Pagination -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-4 flex items-center justify-between">
            <div class="text-xs font-mono text-[#54392b]">
                Menampilkan <span class="font-bold text-[#241a14]">{{ $koleksiList->firstItem() ?? 0 }}</span> -
                <span class="font-bold text-[#241a14]">{{ $koleksiList->lastItem() ?? 0 }}</span> dari
                <span class="font-bold text-[#241a14]">{{ $koleksiList->total() }}</span> pita koleksi
            </div>
            <div>
                {{ $koleksiList->links() }}
            </div>
        </div>
    @endif
@endsection
