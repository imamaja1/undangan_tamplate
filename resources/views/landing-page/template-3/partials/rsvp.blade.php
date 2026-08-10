<section class="flex flex-col items-center px-6 py-24 relative z-10">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
    </div>

    <div class="w-full max-w-sm">
        @livewire('landing-page.rsvp-form', ['invitation' => $invitation])
    </div>

</section>
