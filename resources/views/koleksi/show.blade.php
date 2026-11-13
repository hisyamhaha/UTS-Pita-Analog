@extends('layouts.app')

@section('title', '[' . $koleksi->kode_koleksi . '] ' . $koleksi->nama_koleksi)

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] font-mono text-[10px] font-bold tracking-widest uppercase">
                DETAIL ARSIP
            </span>
            <span class="font-mono text-xs text-[#c96b1b] font-bold">{{ $koleksi->kode_koleksi }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            {{ $koleksi->nama_koleksi }}
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Format: {{ $koleksi->kategori->nama_format ?? 'Analog Tape' }} • Tahun Rekaman: {{ $koleksi->tahun }}
        </p>
    </div>
    <div class="flex flex-wrap items-center gap-2.5">
        <x-button href="{{ route('koleksi.index') }}" variant="cream" size="md">
            ← Katalog
        </x-button>
        <x-button href="{{ route('koleksi.edit', $koleksi) }}" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Data
        </x-button>
        <form
            action="{{ route('koleksi.destroy', $koleksi) }}"
            method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip koleksi [{{ $koleksi->kode_koleksi }}]? Semua data detail kondisi dan relasi tindakan akan ikut dihapus.')"
        >
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="px-4 py-2 bg-[#9e3820] hover:bg-[#b9452a] text-white border-2 border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro cursor-pointer active:translate-x-0.5 active:translate-y-0.5"
            >
                Hapus
            </button>
        </form>
    </div>
@endsection

@section('content')
    <!-- CASSETTE CASING VISUAL CARD -->
    <div class="bg-[#241a14] border-2 border-[#241a14] shadow-retro-xl p-6 sm:p-8 mb-8 text-[#f9f5ed] relative overflow-hidden group">
        <!-- Screw Rivets in 4 Corners -->
        <span class="absolute top-2.5 left-2.5 w-3 h-3 rounded-full bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-center text-[8px] text-[#d2c0a5] font-mono">+</span>
        <span class="absolute top-2.5 right-2.5 w-3 h-3 rounded-full bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-center text-[8px] text-[#d2c0a5] font-mono">+</span>
        <span class="absolute bottom-2.5 left-2.5 w-3 h-3 rounded-full bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-center text-[8px] text-[#d2c0a5] font-mono">+</span>
        <span class="absolute bottom-2.5 right-2.5 w-3 h-3 rounded-full bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-center text-[8px] text-[#d2c0a5] font-mono">+</span>

        <!-- Cassette Top Paper Label Inlay -->
        <div class="bg-[#f4ebd9] text-[#241a14] border-2 border-[#241a14] p-4 sm:p-5 mb-6 relative shadow-inner">
            <!-- Label Bands Top -->
            <div class="h-2 w-full tape-label-bands mb-3"></div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-3 border-b border-[#d2c0a5]">
                <div>
                    <span class="font-mono text-xs font-bold px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] border border-[#241a14]">
                        SERIAL: {{ $koleksi->kode_koleksi }}
                    </span>
                    <span class="font-mono text-xs text-[#54392b] ml-2 font-bold">SIDE A / STEREO</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-mono text-[#54392b]">REKORDING TAHUN:</span>
                    <span class="font-mono text-sm font-extrabold px-2 py-0.5 bg-[#e7d8c0] border border-[#241a14]">
                        {{ $koleksi->tahun }}
                    </span>
                </div>
            </div>

            <div class="pt-3">
                <h2 class="text-xl sm:text-2xl font-black text-[#241a14] tracking-tight">
                    {{ $koleksi->nama_koleksi }}
                </h2>
                <p class="text-xs font-mono text-[#54392b] mt-1">
                    {{ $koleksi->kategori->nama_format ?? 'Pita Magnetik' }}
                </p>
                @if ($koleksi->deskripsi)
                    <p class="text-xs sm:text-sm text-[#54392b] mt-2.5 leading-relaxed bg-[#f9f5ed] p-3 border border-[#d2c0a5]">
                        {{ $koleksi->deskripsi }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Center Large Reel Spool Window -->
        <div class="h-24 sm:h-28 bg-[#170f0b] border-2 border-[#3a251b] rounded flex items-center justify-around px-6 sm:px-16 relative">
            <!-- Left Spool -->
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-4 border-[#d2c0a5] bg-[#241a14] flex items-center justify-center reel-spin shadow-inner">
                <div class="w-6 h-6 rounded-full bg-[#d2c0a5] flex items-center justify-center">
                    <div class="w-3 h-3 rounded-full bg-[#170f0b]"></div>
                </div>
            </div>

            <!-- Tape Window Meter & Counter -->
            <div class="flex-1 mx-4 sm:mx-8 text-center max-w-sm">
                <div class="flex items-center justify-center gap-2 mb-1.5">
                    <span class="font-mono text-[10px] text-[#d2c0a5] tracking-widest">POSITION</span>
                    <div class="bg-black px-2 py-0.5 border border-[#54392b] text-[#c96b1b] font-mono text-xs font-bold tracking-widest">
                        <span>0</span><span>8</span><span>4</span>
                    </div>
                </div>
                <div class="h-4 bg-[#241a14] border border-[#54392b] rounded-sm relative overflow-hidden flex items-center px-1">
                    <div class="w-2/3 h-2 bg-[#54392b] rounded-sm"></div>
                </div>
                <span class="font-mono text-[9px] text-[#d2c0a5]/60 mt-1 block">
                    BIAS: NORMAL • DOLBY NR: ON • TAPE HEAD DE-MAGNETIZED
                </span>
            </div>

            <!-- Right Spool -->
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-4 border-[#d2c0a5] bg-[#241a14] flex items-center justify-center reel-spin shadow-inner">
                <div class="w-6 h-6 rounded-full bg-[#d2c0a5] flex items-center justify-center">
                    <div class="w-3 h-3 rounded-full bg-[#170f0b]"></div>
                </div>
            </div>
        </div>

        <!-- Magnetic Tape Bottom Strip -->
        <div class="h-3 w-full tape-magnetic-strip mt-6 border-t border-[#3a251b]"></div>
    </div>

    <!-- 2 COLUMN DETAILS: KONDISI FISIK (1-TO-1) & ACTIONS (MANY-TO-MANY) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- DETAIL KONDISI (ONE-TO-ONE) -->
        <div class="lg:col-span-1 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5 flex flex-col justify-between">
            <div>
                <div class="border-b-2 border-[#241a14] pb-3 mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-[#241a14] text-base">Detail Kondisi Fisik</h3>
                        <p class="text-xs font-mono text-[#54392b]">Relasi One-to-One (DetailKondisi)</p>
                    </div>
                    @php
                        $tk = $koleksi->detailKondisi->tingkat_kerusakan ?? 'sedang';
                        $tkBadge = match($tk) {
                            'ringan' => 'bg-[#4f5d2f] text-white',
                            'berat' => 'bg-[#9e3820] text-white',
                            default => 'bg-[#c96b1b] text-white',
                        };
                    @endphp
                    <span class="px-2 py-0.5 text-xs font-mono font-bold uppercase {{ $tkBadge }} border border-[#241a14]">
                        {{ $tk }}
                    </span>
                </div>

                <div class="space-y-4">
                    <!-- Kondisi Awal -->
                    <div>
                        <span class="text-xs font-mono font-bold uppercase text-[#54392b] block mb-1">
                            Diagnostik Kondisi Awal:
                        </span>
                        <div class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] text-sm text-[#241a14] leading-relaxed">
                            {{ $koleksi->detailKondisi->kondisi_awal ?? 'Belum ada data kondisi awal.' }}
                        </div>
                    </div>

                    <!-- Catatan Konservator -->
                    <div>
                        <span class="text-xs font-mono font-bold uppercase text-[#54392b] block mb-1">
                            Instruksi Khusus Konservator:
                        </span>
                        <div class="p-3 bg-[#e7d8c0] border border-[#241a14] text-xs font-mono text-[#3a251b] leading-relaxed italic">
                            {{ $koleksi->detailKondisi->catatan ?? 'Tidak ada catatan penanganan khusus.' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metadata Timestamps -->
            <div class="mt-6 pt-3 border-t border-[#d2c0a5] text-[10px] font-mono text-[#54392b] space-y-1">
                <div>Didaftarkan: {{ $koleksi->created_at ? $koleksi->created_at->format('d/m/Y H:i') : '-' }}</div>
                <div>Pembaruan Terakhir: {{ $koleksi->updated_at ? $koleksi->updated_at->format('d/m/Y H:i') : '-' }}</div>
            </div>
        </div>

        <!-- DAFTAR TINDAKAN RESTORASI & PIVOT (MANY-TO-MANY) -->
        <div class="lg:col-span-2 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5">
            <div class="border-b-2 border-[#241a14] pb-3 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div>
                    <h3 class="font-bold text-[#241a14] text-base">Alur Tindakan Restorasi</h3>
                    <p class="text-xs font-mono text-[#54392b]">Relasi Many-to-Many via pivot `koleksi_tindakan`</p>
                </div>
                <span class="font-mono text-xs px-2.5 py-0.5 bg-[#241a14] text-[#f9f5ed] border border-[#241a14]">
                    {{ $koleksi->tindakanRestorasis->count() }} TINDAKAN TERKAIT
                </span>
            </div>

            @if ($koleksi->tindakanRestorasis->isEmpty())
                <div class="p-8 text-center bg-[#f9f5ed] border-2 border-dashed border-[#d2c0a5]">
                    <p class="text-sm font-mono text-[#54392b] mb-2">Belum ada tindakan restorasi yang ditugaskan pada pita ini.</p>
                    <a
                        href="{{ route('koleksi.edit', $koleksi) }}"
                        class="inline-block px-3 py-1.5 bg-[#c96b1b] text-white border-2 border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm"
                    >
                        + Tambahkan Tindakan Restorasi
                    </a>
                </div>
            @else
                <div class="space-y-3.5">
                    @foreach ($koleksi->tindakanRestorasis as $tindakan)
                        @php
                            $status = $tindakan->pivot->status ?? 'rencana';
                            $statusBadge = match($status) {
                                'selesai' => 'bg-[#4f5d2f] text-white',
                                'proses' => 'bg-[#c96b1b] text-white',
                                default => 'bg-[#54392b] text-white',
                            };
                        @endphp
                        <div class="p-4 bg-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $status === 'proses' ? 'bg-[#c96b1b] animate-ping' : ($status === 'selesai' ? 'bg-[#4f5d2f]' : 'bg-[#54392b]') }}"></span>
                                    <h4 class="font-bold text-[#241a14] text-sm">
                                        {{ $tindakan->nama_tindakan }}
                                    </h4>
                                </div>
                                <span class="inline-block px-2 py-0.5 text-xs font-mono font-bold uppercase border border-[#241a14] {{ $statusBadge }}">
                                    {{ $status }}
                                </span>
                            </div>

                            @if ($tindakan->deskripsi)
                                <p class="text-xs text-[#54392b] mb-2.5 leading-relaxed">
                                    {{ $tindakan->deskripsi }}
                                </p>
                            @endif

                            <!-- Pivot Dates & Notes Bar -->
                            <div class="p-2.5 bg-[#e7d8c0]/60 border border-[#241a14] text-xs font-mono grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <div>
                                    <span class="text-[#54392b]">JADWAL PENGERJAAN:</span>
                                    <p class="font-bold text-[#241a14] mt-0.5">
                                        {{ $tindakan->pivot->tanggal_mulai ? date('d/m/Y', strtotime($tindakan->pivot->tanggal_mulai)) : 'Belum dimulai' }}
                                        →
                                        {{ $tindakan->pivot->tanggal_selesai ? date('d/m/Y', strtotime($tindakan->pivot->tanggal_selesai)) : ($status === 'selesai' ? 'Selesai' : 'Belum selesai') }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-[#54392b]">CATATAN TEKNIS PIVOT:</span>
                                    <p class="text-[#241a14] italic mt-0.5">
                                        {{ $tindakan->pivot->catatan ?: '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
