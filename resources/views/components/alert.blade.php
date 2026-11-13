@props([
    'type' => 'info', // info, success, warning, danger
    'title' => null,
])

@php
    $typeClasses = match ($type) {
        'success' => 'bg-[#4f5d2f]/15 border-[#4f5d2f] text-[#384221]',
        'danger', 'error' => 'bg-[#9e3820]/15 border-[#9e3820] text-[#78230f]',
        'warning' => 'bg-[#c96b1b]/15 border-[#c96b1b] text-[#8c460d]',
        default => 'bg-[#e7d8c0] border-[#54392b] text-[#241a14]',
    };

    $badgeColor = match ($type) {
        'success' => 'bg-[#4f5d2f] text-white',
        'danger', 'error' => 'bg-[#9e3820] text-white',
        'warning' => 'bg-[#c96b1b] text-white',
        default => 'bg-[#54392b] text-white',
    };
@endphp

<div {{ $attributes->merge(['class' => "p-4 border-2 shadow-retro-sm relative {$typeClasses}"]) }}>
    <div class="flex items-start gap-3">
        <span class="inline-block px-1.5 py-0.5 text-[10px] font-mono font-bold uppercase tracking-wider {{ $badgeColor }} border border-[#241a14]">
            {{ $type }}
        </span>
        <div class="flex-1 text-sm">
            @if ($title)
                <p class="font-bold text-sm mb-1">{{ $title }}</p>
            @endif
            <div class="font-sans leading-relaxed">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
