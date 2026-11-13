@extends('layouts.app')

@section('title', 'Registrasi Pita Koleksi Baru')

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#241a14] text-[#f9f5ed] font-mono text-[10px] font-bold tracking-widest uppercase">
                FORM INPUT
            </span>
            <span class="text-xs font-mono text-[#54392b]">DATABASE PRESERVASI</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Registrasi Pita Analog Baru
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Daftarkan pita ke arsip lengkap dengan diagnostik kerusakan dan rencana tindakan restorasi laboratorium.
        </p>
    </div>
    <div class="flex items-center gap-2.5">
        <x-button href="{{ route('koleksi.index') }}" variant="cream" size="md">
            ← Kembali ke Katalog
        </x-button>
    </div>
@endsection

@section('content')
    <form action="{{ route('koleksi.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- SEKSI 1: IDENTITAS UTAMA PITA KOLEKSI -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6 relative">
            <div class="border-b-2 border-[#241a14] pb-3 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#c96b1b] text-white flex items-center justify-center font-mono font-bold text-xs border border-[#241a14]">
                        1
                    </span>
                    <div>
                        <h2 class="font-bold text-[#241a14] text-base uppercase tracking-wide">Identitas Utama Pita</h2>
                        <p class="text-xs font-mono text-[#54392b]">Informasi metadata fisik dan diskografi</p>
                    </div>
                </div>
                <span class="font-mono text-xs text-[#54392b] bg-[#e7d8c0] px-2 py-0.5 border border-[#241a14]">
                    ENTITAS UTAMA
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Kode Koleksi -->
                <div>
                    <x-input
                        name="kode_koleksi"
                        label="Kode Koleksi (Unik)"
                        placeholder="Contoh: TAPE-1980-JKT1"
                        :value="old('kode_koleksi')"
                        :mono="true"
                        :required="true"
                        help="Gunakan format unik pengarsipan. Huruf kapital disarankan."
                    />
                </div>

                <!-- Tahun -->
                <div>
                    <x-input
                        name="tahun"
                        type="number"
                        label="Tahun Rekaman / Produksi"
                        placeholder="Contoh: 1978"
                        :value="old('tahun', 1980)"
                        :mono="true"
                        :required="true"
                        help="Tahun rilis atau rekaman tape (1900 s/d sekarang)."
                    />
                </div>

                <!-- Nama Koleksi / Judul -->
                <div class="md:col-span-2">
                    <x-input
                        name="nama_koleksi"
                        label="Nama Koleksi / Judul Rekaman"
                        placeholder="Contoh: Koes Plus - Master Pita Vol. 4 Sesi Rekaman Studio Remata"
                        :value="old('nama_koleksi')"
                        :required="true"
                    />
                </div>

                <!-- Kategori Format -->
                <div class="md:col-span-2">
                    <x-select
                        name="kategori_format_id"
                        label="Kategori Format Pita"
                        :required="true"
                        help="Pilih format pita magnetik yang sesuai."
                    >
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_format_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_format }}
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Deskripsi / Keterangan Konten
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="3"
                        placeholder="Catatan mengenai materi rekaman, musisi, asal usul pita, atau label rekaman..."
                        class="w-full px-3.5 py-2.5 bg-[#f9f5ed] border-2 border-[#241a14] text-[#241a14] placeholder-[#54392b]/50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm text-sm font-sans"
                    >{{ old('deskripsi') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SEKSI 2: DIAGNOSTIK DETAIL KONDISI (ONE-TO-ONE) -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6 relative">
            <div class="border-b-2 border-[#241a14] pb-3 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#4f5d2f] text-white flex items-center justify-center font-mono font-bold text-xs border border-[#241a14]">
                        2
                    </span>
                    <div>
                        <h2 class="font-bold text-[#241a14] text-base uppercase tracking-wide">Detail Kondisi Awal</h2>
                        <p class="text-xs font-mono text-[#54392b]">Diagnostik fisik sebelum tindakan restorasi dijalankan (Relasi One-to-One)</p>
                    </div>
                </div>
                <span class="font-mono text-xs text-white bg-[#4f5d2f] px-2 py-0.5 border border-[#241a14] font-bold">
                    DETAIL FISIK
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Tingkat Kerusakan (Enum) -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-2">
                        Tingkat Kerusakan Pita <span class="text-[#9e3820]">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <!-- Ringan -->
                        <label class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] flex items-center gap-3 cursor-pointer hover:bg-[#e7d8c0] shadow-retro-sm">
                            <input
                                type="radio"
                                name="tingkat_kerusakan"
                                value="ringan"
                                {{ old('tingkat_kerusakan', 'sedang') === 'ringan' ? 'checked' : '' }}
                                class="text-[#4f5d2f] focus:ring-[#4f5d2f] h-4 w-4"
                            />
                            <div>
                                <span class="font-mono text-xs font-bold text-[#4f5d2f] uppercase block">Ringan</span>
                                <span class="text-[11px] text-[#54392b]">Debu, housing kusam, jamur halus tepi.</span>
                            </div>
                        </label>

                        <!-- Sedang -->
                        <label class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] flex items-center gap-3 cursor-pointer hover:bg-[#e7d8c0] shadow-retro-sm">
                            <input
                                type="radio"
                                name="tingkat_kerusakan"
                                value="sedang"
                                {{ old('tingkat_kerusakan', 'sedang') === 'sedang' ? 'checked' : '' }}
                                class="text-[#c96b1b] focus:ring-[#c96b1b] h-4 w-4"
                            />
                            <div>
                                <span class="font-mono text-xs font-bold text-[#c96b1b] uppercase block">Sedang</span>
                                <span class="text-[11px] text-[#54392b]">Pita kusut, busa rusak, desis tinggi.</span>
                            </div>
                        </label>

                        <!-- Berat -->
                        <label class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] flex items-center gap-3 cursor-pointer hover:bg-[#e7d8c0] shadow-retro-sm">
                            <input
                                type="radio"
                                name="tingkat_kerusakan"
                                value="berat"
                                {{ old('tingkat_kerusakan') === 'berat' ? 'checked' : '' }}
                                class="text-[#9e3820] focus:ring-[#9e3820] h-4 w-4"
                            />
                            <div>
                                <span class="font-mono text-xs font-bold text-[#9e3820] uppercase block">Berat</span>
                                <span class="text-[11px] text-[#54392b]">Putus, sticky-shed, spora tebal.</span>
                            </div>
                        </label>
                    </div>
                    @error('tingkat_kerusakan')
                        <p class="text-xs text-[#9e3820] font-mono font-bold mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kondisi Awal -->
                <div class="md:col-span-2">
                    <label for="kondisi_awal" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Deskripsi Kondisi Awal <span class="text-[#9e3820]">*</span>
                    </label>
                    <textarea
                        id="kondisi_awal"
                        name="kondisi_awal"
                        rows="3"
                        required
                        placeholder="Contoh: Pita berjamur pada sisi tepi, spons penekan terlepas dan meninggalkan sisa residu hitam..."
                        class="w-full px-3.5 py-2.5 bg-[#f9f5ed] border-2 border-[#241a14] text-[#241a14] placeholder-[#54392b]/50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm text-sm font-sans"
                    >{{ old('kondisi_awal') }}</textarea>
                    @error('kondisi_awal')
                        <p class="text-xs text-[#9e3820] font-mono font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan Kondisi Khusus -->
                <div class="md:col-span-2">
                    <label for="catatan_kondisi" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                        Catatan Penanganan Khusus Konservator
                    </label>
                    <textarea
                        id="catatan_kondisi"
                        name="catatan_kondisi"
                        rows="2"
                        placeholder="Contoh: Jangan coba diputar pada playback deck biasa sebelum perlakuan inkubasi oven dehidrasi..."
                        class="w-full px-3.5 py-2.5 bg-[#f9f5ed] border-2 border-[#241a14] text-[#241a14] placeholder-[#54392b]/50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm text-sm font-sans"
                    >{{ old('catatan_kondisi') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SEKSI 3: TINDAKAN RESTORASI & PIVOT (MANY-TO-MANY) -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6 relative">
            <div class="border-b-2 border-[#241a14] pb-3 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#9e3820] text-white flex items-center justify-center font-mono font-bold text-xs border border-[#241a14]">
                        3
                    </span>
                    <div>
                        <h2 class="font-bold text-[#241a14] text-base uppercase tracking-wide">Pilihan Tindakan Restorasi</h2>
                        <p class="text-xs font-mono text-[#54392b]">Hubungkan tindakan teknis dan parameter pivot (status, tanggal, catatan)</p>
                    </div>
                </div>
                <span class="font-mono text-xs text-white bg-[#9e3820] px-2 py-0.5 border border-[#241a14] font-bold">
                    PIVOT MANY-TO-MANY
                </span>
            </div>

            <p class="text-xs font-mono text-[#54392b] mb-4">
                Centang tindakan yang akan atau sedang diterapkan pada pita ini, lalu tentukan status pengerjaannya:
            </p>

            <div class="space-y-4">
                @foreach ($tindakanList as $index => $tindakan)
                    <div
                        class="p-4 bg-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm transition-all"
                        x-data="{ checked: {{ old("tindakan.{$tindakan->id}.tindakan_id") ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                id="tindakan_{{ $tindakan->id }}"
                                name="tindakan[{{ $tindakan->id }}][tindakan_id]"
                                value="{{ $tindakan->id }}"
                                {{ old("tindakan.{$tindakan->id}.tindakan_id") ? 'checked' : '' }}
                                class="mt-1 h-4 w-4 rounded border-[#241a14] text-[#c96b1b] focus:ring-[#c96b1b] cursor-pointer"
                                onchange="document.getElementById('pivot_fields_{{ $tindakan->id }}').classList.toggle('hidden', !this.checked)"
                            />
                            <div class="flex-1">
                                <label for="tindakan_{{ $tindakan->id }}" class="font-bold text-sm text-[#241a14] cursor-pointer hover:text-[#c96b1b]">
                                    {{ $tindakan->nama_tindakan }}
                                </label>
                                @if ($tindakan->deskripsi)
                                    <p class="text-xs text-[#54392b] mt-0.5">{{ $tindakan->deskripsi }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Pivot Fields Container -->
                        <div
                            id="pivot_fields_{{ $tindakan->id }}"
                            class="{{ old("tindakan.{$tindakan->id}.tindakan_id") ? '' : 'hidden' }} mt-4 pt-3 border-t-2 border-[#241a14] bg-[#e7d8c0]/50 p-3"
                        >
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#54392b] block mb-2">
                                PARAMETER PIVOT TINDAKAN:
                            </span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
                                <!-- Status Pivot -->
                                <div>
                                    <label class="block text-[11px] font-mono font-bold uppercase text-[#3a251b] mb-1">
                                        Status Tindakan
                                    </label>
                                    <select
                                        name="tindakan[{{ $tindakan->id }}][status]"
                                        class="w-full px-2.5 py-1.5 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-1 focus:ring-[#c96b1b]"
                                    >
                                        <option value="rencana" {{ old("tindakan.{$tindakan->id}.status") === 'rencana' ? 'selected' : '' }}>Rencana</option>
                                        <option value="proses" {{ old("tindakan.{$tindakan->id}.status") === 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ old("tindakan.{$tindakan->id}.status") === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                <!-- Tanggal Mulai -->
                                <div>
                                    <label class="block text-[11px] font-mono font-bold uppercase text-[#3a251b] mb-1">
                                        Tanggal Mulai
                                    </label>
                                    <input
                                        type="date"
                                        name="tindakan[{{ $tindakan->id }}][tanggal_mulai]"
                                        value="{{ old("tindakan.{$tindakan->id}.tanggal_mulai") }}"
                                        class="w-full px-2.5 py-1.5 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-1 focus:ring-[#c96b1b]"
                                    />
                                </div>

                                <!-- Tanggal Selesai -->
                                <div>
                                    <label class="block text-[11px] font-mono font-bold uppercase text-[#3a251b] mb-1">
                                        Tanggal Selesai
                                    </label>
                                    <input
                                        type="date"
                                        name="tindakan[{{ $tindakan->id }}][tanggal_selesai]"
                                        value="{{ old("tindakan.{$tindakan->id}.tanggal_selesai") }}"
                                        class="w-full px-2.5 py-1.5 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-1 focus:ring-[#c96b1b]"
                                    />
                                </div>
                            </div>

                            <!-- Catatan Pivot -->
                            <div>
                                <label class="block text-[11px] font-mono font-bold uppercase text-[#3a251b] mb-1">
                                    Catatan Khusus Tindakan Ini
                                </label>
                                <input
                                    type="text"
                                    name="tindakan[{{ $tindakan->id }}][catatan]"
                                    value="{{ old("tindakan.{$tindakan->id}.catatan") }}"
                                    placeholder="Contoh: Menggunakan splicing tape 1/4 inch standar BASF..."
                                    class="w-full px-3 py-1.5 bg-[#f9f5ed] border-2 border-[#241a14] text-xs font-mono text-[#241a14] focus:outline-none focus:ring-1 focus:ring-[#c96b1b]"
                                />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- FORM SUBMIT BAR -->
        <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs font-mono text-[#54392b]">
                <p class="font-bold text-[#241a14]">DB Transaction Enabled:</p>
                Koleksi, Detail Kondisi, dan Relasi Tindakan disimpan secara atomik.
            </div>
            <div class="flex items-center gap-3">
                <x-button href="{{ route('koleksi.index') }}" variant="cream" size="md">
                    Batal
                </x-button>
                <x-button type="submit" variant="primary" size="md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Seluruh Data
                </x-button>
            </div>
        </div>
    </form>
@endsection
