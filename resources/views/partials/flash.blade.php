@if (session('success'))
    <div class="mb-6 p-4 bg-[#4f5d2f]/15 border-2 border-[#4f5d2f] shadow-retro text-[#241a14] flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="px-2 py-0.5 bg-[#4f5d2f] text-white font-mono text-xs font-bold uppercase tracking-wider border border-[#241a14]">
                BERHASIL
            </span>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-[#241a14] hover:text-[#9e3820] font-mono text-sm font-bold px-1 cursor-pointer">
            ✕
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 p-4 bg-[#9e3820]/15 border-2 border-[#9e3820] shadow-retro text-[#241a14] flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="px-2 py-0.5 bg-[#9e3820] text-white font-mono text-xs font-bold uppercase tracking-wider border border-[#241a14]">
                GAGAL
            </span>
            <p class="text-sm font-semibold">{{ session('error') }}</p>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-[#241a14] hover:text-[#9e3820] font-mono text-sm font-bold px-1 cursor-pointer">
            ✕
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 p-4 bg-[#9e3820]/15 border-2 border-[#9e3820] shadow-retro text-[#241a14]">
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2 py-0.5 bg-[#9e3820] text-white font-mono text-xs font-bold uppercase tracking-wider border border-[#241a14]">
                PERIKSA FORM
            </span>
            <p class="text-sm font-bold text-[#9e3820]">Terdapat beberapa kesalahan input yang perlu diperbaiki:</p>
        </div>
        <ul class="list-disc list-inside text-xs font-mono text-[#54392b] space-y-1 pl-2">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
