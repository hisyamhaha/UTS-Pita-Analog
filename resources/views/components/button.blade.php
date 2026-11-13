@props([
    'type' => 'button',
    'variant' => 'primary', // primary (amber), olive, rust, cream, dark
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-mono font-bold uppercase tracking-wider transition-all duration-150 border-2 border-[#241a14] select-none active:translate-x-0.5 active:translate-y-0.5 active:shadow-none cursor-pointer';

    $sizeClasses = match ($size) {
        'sm' => 'px-3 py-1 text-xs gap-1.5 shadow-retro-sm',
        'lg' => 'px-6 py-3 text-base gap-3 shadow-retro',
        default => 'px-4 py-2 text-sm gap-2 shadow-retro',
    };

    $variantClasses = match ($variant) {
        'primary' => 'bg-[#c96b1b] hover:bg-[#e0832d] text-white',
        'olive' => 'bg-[#4f5d2f] hover:bg-[#6b7e3e] text-white',
        'rust' => 'bg-[#9e3820] hover:bg-[#b9452a] text-white',
        'cream' => 'bg-[#e7d8c0] hover:bg-[#f4ebd9] text-[#241a14]',
        'dark' => 'bg-[#241a14] hover:bg-[#3a251b] text-[#f9f5ed]',
        'outline' => 'bg-transparent hover:bg-[#e7d8c0]/50 text-[#241a14]',
        default => 'bg-[#c96b1b] hover:bg-[#e0832d] text-white',
    };

    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
