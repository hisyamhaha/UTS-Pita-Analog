<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-40 w-72 bg-[#f4ebd9] border-r-2 border-[#241a14] transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col justify-between"
>
    <!-- Top Branding & Navigation -->
    <div class="flex-1 overflow-y-auto">
        <!-- Logo / Cassette Deck Branding -->
        <div class="p-5 border-b-2 border-[#241a14] bg-[#e7d8c0]">
            <a href="{{ route('dashboard') }}" class="group block">
                <!-- Cassette Mini Tape Graphic -->
                <div class="p-3 bg-[#241a14] border-2 border-[#241a14] shadow-retro-sm mb-3 relative overflow-hidden group-hover:border-[#c96b1b] transition-colors">
                    <!-- Cassette Window -->
                    <div class="h-10 bg-[#3a251b] border border-[#d2c0a5]/40 flex items-center justify-around px-4 relative">
                        <!-- Left Reel Spool -->
                        <div class="w-6 h-6 rounded-full border-2 border-[#f4ebd9] bg-[#170f0b] flex items-center justify-center reel-spin">
                            <div class="w-2 h-2 rounded-full bg-[#f4ebd9]"></div>
                        </div>
                        <!-- Magnetic Tape Window Center Lines -->
                        <div class="flex-1 mx-3 h-3 bg-[#170f0b] border border-[#d2c0a5]/30 relative overflow-hidden">
                            <div class="w-1/2 h-full bg-[#54392b]"></div>
                        </div>
                        <!-- Right Reel Spool -->
                        <div class="w-6 h-6 rounded-full border-2 border-[#f4ebd9] bg-[#170f0b] flex items-center justify-center reel-spin">
                            <div class="w-2 h-2 rounded-full bg-[#f4ebd9]"></div>
                        </div>
                    </div>
                    <!-- Vintage Label Stripe -->
                    <div class="h-1.5 w-full tape-label-bands mt-1.5"></div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="font-mono text-[11px] font-bold tracking-widest text-[#c96b1b] uppercase">STUDIO SK04</span>
                    <span class="font-mono text-[10px] text-[#54392b] bg-[#d2c0a5] px-1.5 py-0.5 border border-[#241a14]">v1.0-UTS</span>
                </div>
                <h1 class="font-extrabold text-[#241a14] text-lg leading-tight tracking-tight mt-0.5 group-hover:text-[#c96b1b] transition-colors">
                    RESTORASI PITA ANALOG
                </h1>
                <p class="text-xs text-[#54392b] font-mono mt-0.5">Sistem Preservasi & Audio Archive</p>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-1.5">
            <p class="px-3 pt-2 pb-1 text-[11px] font-mono font-bold uppercase tracking-widest text-[#54392b]">
                MAIN CONSOLE
            </p>

            <!-- Dashboard -->
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 border-2 font-mono text-xs font-bold uppercase tracking-wider transition-all {{ request()->routeIs('dashboard') ? 'bg-[#c96b1b] text-white border-[#241a14] shadow-retro-sm' : 'border-transparent text-[#241a14] hover:bg-[#e7d8c0] hover:border-[#241a14]' }}"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Koleksi Pita -->
            <a
                href="{{ route('koleksi.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 border-2 font-mono text-xs font-bold uppercase tracking-wider transition-all {{ request()->routeIs('koleksi.*') ? 'bg-[#c96b1b] text-white border-[#241a14] shadow-retro-sm' : 'border-transparent text-[#241a14] hover:bg-[#e7d8c0] hover:border-[#241a14]' }}"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Koleksi Pita</span>
            </a>

            <p class="px-3 pt-5 pb-1 text-[11px] font-mono font-bold uppercase tracking-widest text-[#54392b]">
                MASTER DATA
            </p>

            <!-- Kategori Format -->
            <a
                href="{{ route('kategori.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 border-2 font-mono text-xs font-bold uppercase tracking-wider transition-all {{ request()->routeIs('kategori.*') ? 'bg-[#4f5d2f] text-white border-[#241a14] shadow-retro-sm' : 'border-transparent text-[#241a14] hover:bg-[#e7d8c0] hover:border-[#241a14]' }}"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>Kategori Format</span>
            </a>

            <!-- Tindakan Restorasi -->
            <a
                href="{{ route('tindakan.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 border-2 font-mono text-xs font-bold uppercase tracking-wider transition-all {{ request()->routeIs('tindakan.*') ? 'bg-[#4f5d2f] text-white border-[#241a14] shadow-retro-sm' : 'border-transparent text-[#241a14] hover:bg-[#e7d8c0] hover:border-[#241a14]' }}"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Tindakan Restorasi</span>
            </a>
        </nav>
    </div>

    <!-- Bottom Operator / Mahasiswa Badge -->
    <div class="p-4 border-t-2 border-[#241a14] bg-[#e7d8c0]">
        <div class="p-3 bg-[#f9f5ed] border-2 border-[#241a14] shadow-retro-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#4f5d2f]">OPERATOR / ARCHIVIST</span>
                <span class="w-2 h-2 rounded-full bg-[#4f5d2f]"></span>
            </div>
            <p class="font-bold text-xs text-[#241a14] truncate">Hisyam K.</p>
            <p class="font-mono text-[11px] text-[#54392b]">NIM: 422410033</p>
            <div class="mt-2 pt-2 border-t border-[#d2c0a5] flex items-center justify-between text-[10px] font-mono text-[#54392b]">
                <span>UTS FRAMEWORK</span>
                <span class="font-bold text-[#c96b1b]">LARAVEL 12</span>
            </div>
        </div>
    </div>
</aside>

<!-- Backdrop for mobile drawer -->
<div
    id="sidebarBackdrop"
    class="fixed inset-0 bg-[#241a14]/60 z-30 hidden lg:hidden"
></div>
