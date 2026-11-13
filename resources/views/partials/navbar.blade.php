<header class="bg-[#e7d8c0] border-b-2 border-[#241a14] sticky top-0 z-30 shadow-retro-sm">
    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Left: Mobile Menu Toggle & Brand Tag -->
        <div class="flex items-center gap-3">
            <button
                type="button"
                id="sidebarToggle"
                class="lg:hidden p-2 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro-sm text-[#241a14] hover:bg-[#c96b1b] hover:text-white cursor-pointer"
                title="Buka Menu"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Vintage Tape Head Indicator -->
            <div class="hidden sm:flex items-center gap-2 px-3 py-1 bg-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-[#9e3820] animate-pulse"></span>
                <span class="font-mono text-xs font-bold uppercase tracking-wider text-[#241a14]">
                    REC MODE • ARCHIVE DECK
                </span>
            </div>
        </div>

        <!-- Center: Tape Counter & VU Meter Simulation -->
        <div class="hidden md:flex items-center gap-6">
            <!-- Digital/Mechanical Tape Counter -->
            <div class="flex items-center gap-1.5 px-3 py-1 bg-[#241a14] text-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm">
                <span class="text-[10px] font-mono text-[#d2c0a5] tracking-widest">COUNTER</span>
                <div class="flex gap-1 font-mono text-sm font-bold tracking-widest text-[#c96b1b] bg-[#170f0b] px-1.5 py-0.5 border border-[#54392b]">
                    <span>0</span>
                    <span>4</span>
                    <span>2</span>
                </div>
            </div>

            <!-- Stylized VU Meter -->
            <div class="flex items-center gap-2 px-3 py-1 bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro-sm">
                <span class="text-[10px] font-mono font-bold text-[#54392b]">VU L/R</span>
                <div class="flex items-end gap-0.5 h-4">
                    <span class="vu-bar h-2"></span>
                    <span class="vu-bar h-3"></span>
                    <span class="vu-bar h-4"></span>
                    <span class="vu-bar h-3"></span>
                    <span class="vu-bar amber h-3.5"></span>
                    <span class="vu-bar red h-2"></span>
                </div>
                <div class="flex items-end gap-0.5 h-4">
                    <span class="vu-bar h-3"></span>
                    <span class="vu-bar h-2"></span>
                    <span class="vu-bar h-4"></span>
                    <span class="vu-bar h-3.5"></span>
                    <span class="vu-bar amber h-2.5"></span>
                    <span class="vu-bar red h-1"></span>
                </div>
            </div>
        </div>

        <!-- Right: Action / Fast Links -->
        <div class="flex items-center gap-3">
            <a
                href="{{ route('koleksi.create') }}"
                class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#c96b1b] hover:bg-[#e0832d] text-white border-2 border-[#241a14] font-mono text-xs font-bold uppercase tracking-wider shadow-retro-sm active:translate-x-0.5 active:translate-y-0.5"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden sm:inline">Pita Baru</span>
            </a>
            
            <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 bg-[#d2c0a5] border-2 border-[#241a14] text-xs font-mono font-bold text-[#241a14]">
                <span>SK04</span>
            </div>
        </div>
    </div>
</header>
