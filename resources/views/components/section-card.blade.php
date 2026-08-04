@props(['noAccentBar' => false, 'class' => ''])

<div {{ $attributes->merge(['class' => 'glass-card relative overflow-hidden rounded-2xl p-6 transition-all duration-300 ' . $class]) }}>
    {{-- Top gold accent bar --}}
    @unless ($noAccentBar)
        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-champagne/50 to-transparent"></div>
    @endunless

    {{-- Corner filigree dots (subtle, pointer-events-none) --}}
    <span class="pointer-events-none absolute left-2 top-2 text-[8px] text-champagne/15">✦</span>
    <span class="pointer-events-none absolute right-2 top-2 text-[8px] text-champagne/15">✦</span>
    <span class="pointer-events-none absolute bottom-2 left-2 text-[8px] text-champagne/15">✦</span>
    <span class="pointer-events-none absolute bottom-2 right-2 text-[8px] text-champagne/15">✦</span>

    {{-- Content --}}
    <div class="relative z-10">
        {{ $slot }}
    </div>
</div>
