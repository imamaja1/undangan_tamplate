<section
    id="wishes"
    class="relative flex min-h-dvh flex-col items-center gap-10 overflow-hidden px-6 py-24"
    style="background: linear-gradient(175deg, #0a1128 0%, #0d1b2e 50%, #0a1128 100%);"
>
    {{-- Parchment texture --}}
    <div class="parchment pointer-events-none absolute inset-0 opacity-40"></div>

    {{-- Ambient glows --}}
    <div class="pointer-events-none absolute top-0 left-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(201,176,55,0.18) 0%, transparent 70%);"></div>

    {{-- Heading --}}
    <div class="reveal relative z-10 flex flex-col items-center gap-3 text-center">
        <div class="flex items-center gap-4">
            <div class="h-px w-8 bg-gradient-to-r from-transparent to-[#d4af37]/60"></div>
            <h2 class="text-champagne" style="font-family:'Playfair Display',serif; font-size:2.2rem; font-style:italic;">Tamu &amp; Harapan</h2>
            <div class="h-px w-8 bg-gradient-to-l from-transparent to-[#d4af37]/60"></div>
        </div>
    </div>

    {{-- The List Component --}}
    <div class="relative z-10 w-full max-w-sm">
        <livewire:landing-page.wishes-list :invitation="$invitation" />
    </div>
</section>
