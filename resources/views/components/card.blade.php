@props([
    'title' => null,
    'subtitle' => null,
    'badge' => null,
    'cassetteDecor' => false,
])

<div {{ $attributes->merge(['class' => 'bg-[#f4ebd9] border-2 border-[#241a14] shadow-retro relative']) }}>
    <!-- Decorative Corner Rivets / Screws -->
    <span class="absolute top-1.5 left-1.5 w-1.5 h-1.5 rounded-full bg-[#3a251b]/40 border border-[#241a14]/30 pointer-events-none"></span>
    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-[#3a251b]/40 border border-[#241a14]/30 pointer-events-none"></span>
    <span class="absolute bottom-1.5 left-1.5 w-1.5 h-1.5 rounded-full bg-[#3a251b]/40 border border-[#241a14]/30 pointer-events-none"></span>
    <span class="absolute bottom-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-[#3a251b]/40 border border-[#241a14]/30 pointer-events-none"></span>

    @if ($title || $header ?? false)
        <div class="px-5 py-3 border-b-2 border-[#241a14] bg-[#e7d8c0] flex items-center justify-between gap-3">
            @if ($header ?? false)
                {{ $header }}
            @else
                <div class="flex items-center gap-2">
                    @if ($cassetteDecor)
                        <div class="w-3 h-3 rounded-full border-2 border-[#241a14] bg-[#c96b1b]"></div>
                    @endif
                    <div>
                        <h3 class="font-bold text-[#241a14] text-base tracking-wide">{{ $title }}</h3>
                        @if ($subtitle)
                            <p class="text-xs font-mono text-[#54392b]">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>
                @if ($badge)
                    <div>{{ $badge }}</div>
                @endif
            @endif
        </div>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

    @if ($footer ?? false)
        <div class="px-5 py-3 border-t-2 border-[#241a14] bg-[#e7d8c0]/70 flex items-center justify-between">
            {{ $footer }}
        </div>
    @endif
</div>
