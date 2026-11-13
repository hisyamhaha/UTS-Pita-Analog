@props([
    'label' => null,
    'name',
    'required' => false,
    'help' => null,
    'placeholder' => '-- Pilih Opsi --',
])

<div class="space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs font-mono font-bold uppercase tracking-wider text-[#3a251b]">
            {{ $label }}
            @if ($required)
                <span class="text-[#9e3820]">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full px-3.5 py-2.5 bg-[#f9f5ed] border-2 border-[#241a14] text-[#241a14] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#c96b1b] focus:border-[#241a14] shadow-retro-sm text-sm appearance-none pr-10 cursor-pointer font-sans transition-all' . ($errors->has($name) ? ' border-[#9e3820] bg-red-50' : '')
            ]) }}
        >
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            {{ $slot }}
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#241a14]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    @if ($help && !$errors->has($name))
        <p class="text-xs text-[#54392b]/80 font-mono">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-xs text-[#9e3820] font-mono font-bold flex items-center gap-1 mt-1">
            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>
