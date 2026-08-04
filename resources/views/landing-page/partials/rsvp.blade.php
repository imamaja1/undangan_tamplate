<section
    id="rsvp"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex min-h-dvh flex-col items-center justify-center gap-10 overflow-hidden px-6 py-24"
    style="background: linear-gradient(175deg, #0a1128 0%, #0d1b2e 50%, #0a1128 100%);"
>
    {{-- Ambient glows --}}
    <div class="pointer-events-none absolute top-0 left-0 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(201,176,55,0.18) 0%, transparent 70%);"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-96 w-96 translate-x-1/3 translate-y-1/3 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(183,110,121,0.12) 0%, transparent 70%);"></div>


    {{-- The Form Component --}}
    <div class="reveal relative z-10 w-full max-w-sm">
        <livewire:landing-page.rsvp-form :invitation="$invitation" />
    </div>

</section>
