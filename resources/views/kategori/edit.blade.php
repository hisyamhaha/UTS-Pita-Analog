@extends('layouts.app')

@section('title', 'Edit Kategori ' . $kategori->nama_format)

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-[10px] font-bold tracking-widest uppercase">
                MASTER FORMAT
            </span>
            <span class="text-xs font-mono text-[#54392b]">EDIT FORMAT</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Edit Kategori Format
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Modifikasi nama atau spesifikasi teknis kategori format pita.
        </p>
    </div>
    <div>
        <x-button href="{{ route('kategori.index') }}" variant="cream" size="md">
            ← Kembali ke Daftar Format
        </x-button>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <form action="{{ route('kategori.update', $kategori) }}" method="POST" class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b-2 border-[#241a14] pb-3 mb-4">
                <h2 class="font-bold text-[#241a14] text-base">Perbarui Spesifikasi Media</h2>
                <p class="text-xs font-mono text-[#54392b]">ID Format: #{{ $kategori->id }}</p>
            </div>

            <div>
                <x-input
                    name="nama_format"
                    label="Nama Format Pita"
                    placeholder="Contoh: Cassette Tape Type IV (Metal Audio Tape)"
                    :value="old('nama_format', $kategori->nama_format)"
                    :required="true"
                />
            </div>

            <div>
                <label for="deskripsi" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b] mb-1">
                    Deskripsi & Karakteristik Teknis
                </label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    class="w-full px-3.5 py-2.5 bg-[#f9f5ed] border-2 border-[#241a14] text-[#241a14] placeholder-[#54392b]/50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#c96b1b] shadow-retro-sm text-sm font-sans"
                >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-[#9e3820] font-mono font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t-2 border-[#241a14] flex items-center justify-end gap-3">
                <x-button href="{{ route('kategori.index') }}" variant="cream" size="md">
                    Batal
                </x-button>
                <x-button type="submit" variant="olive" size="md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </x-button>
            </div>
        </form>
    </div>
@endsection
