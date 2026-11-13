@extends('layouts.app')

@section('title', 'Master Tindakan Restorasi')

@section('header')
    <div>
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-[10px] font-bold tracking-widest uppercase">
                MASTER TINDAKAN
            </span>
            <span class="text-xs font-mono text-[#54392b]">LABORATORIUM KONSERVASI</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#241a14] tracking-tight">
            Master Tindakan Restorasi
        </h1>
        <p class="text-xs sm:text-sm text-[#54392b] font-mono mt-1">
            Standar operasional prosedur (SOP) perlakuan teknis perbaikan fisik dan pelestarian pita analog.
        </p>
    </div>
    <div>
        <x-button href="{{ route('tindakan.create') }}" variant="olive" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Tindakan Baru
        </x-button>
    </div>
@endsection

@section('content')
    <div class="bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro">
        <div class="px-5 py-3.5 bg-[#e7d8c0] border-b-2 border-[#241a14] flex items-center justify-between">
            <h2 class="font-bold text-[#241a14] text-base">Tabel Prosedur Restorasi Laboratorium</h2>
            <span class="font-mono text-xs px-2 py-0.5 bg-[#f9f5ed] border border-[#241a14]">
                TOTAL: {{ $tindakanList->total() }} PROSEDUR
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-[#e7d8c0]/70 border-b-2 border-[#241a14] font-mono text-[11px] uppercase tracking-wider text-[#3a251b]">
                        <th class="px-4 py-3 w-16">No</th>
                        <th class="px-4 py-3">Nama Tindakan Restorasi</th>
                        <th class="px-4 py-3">Deskripsi Prosedur Teknis</th>
                        <th class="px-4 py-3 text-center">Pita Terkait</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-[#241a14]">
                    @forelse ($tindakanList as $index => $act)
                        <tr class="hover:bg-[#f9f5ed] transition-colors">
                            <td class="px-4 py-3.5 font-mono text-xs text-[#54392b]">
                                {{ $tindakanList->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3.5 font-bold text-[#241a14]">
                                <a href="{{ route('tindakan.show', $act) }}" class="hover:text-[#c96b1b] transition-colors">
                                    {{ $act->nama_tindakan }}
                                </a>
                            </td>
                            <td class="px-4 py-3.5 text-xs text-[#54392b] leading-relaxed max-w-md">
                                {{ $act->deskripsi ?: 'Tidak ada deskripsi prosedur' }}
                            </td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                <span class="px-2.5 py-1 bg-[#e7d8c0] border border-[#241a14] font-mono text-xs font-bold text-[#241a14]">
                                    {{ $act->koleksi_pitas_count }} Pita
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a
                                        href="{{ route('tindakan.show', $act) }}"
                                        class="px-2 py-1 bg-[#f9f5ed] hover:bg-[#e7d8c0] text-[#241a14] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm"
                                    >
                                        Lihat
                                    </a>
                                    <a
                                        href="{{ route('tindakan.edit', $act) }}"
                                        class="px-2 py-1 bg-[#e7d8c0] hover:bg-[#c96b1b] hover:text-white text-[#241a14] border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm transition-colors"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('tindakan.destroy', $act) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tindakan restorasi {{ $act->nama_tindakan }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="px-2 py-1 bg-[#9e3820] hover:bg-[#b9452a] text-white border border-[#241a14] font-mono text-xs font-bold uppercase shadow-retro-sm cursor-pointer"
                                            title="Hapus Tindakan"
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
                                Belum ada master tindakan restorasi yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t-2 border-[#241a14] bg-[#e7d8c0]/50">
            {{ $tindakanList->links() }}
        </div>
    </div>
@endsection
