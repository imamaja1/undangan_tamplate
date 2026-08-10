@php
    $musicUrl = $invitation?->music_url ? asset('storage/'.$invitation->music_url) : null;
@endphp

@if ($musicUrl)
    <div
        x-data="{
            playing: false,
            audio: null,
            init() {
                this.audio = this.$refs.audio;

                this.audio.play().then(() => {
                    this.playing = true;
                }).catch(() => {
                    // Autoplay blocked by browser — waiting for cover dismissal
                });
            },
            toggle() {
                if (this.playing) {
                    this.audio.pause();
                    this.playing = false;
                } else {
                    this.audio.play().then(() => {
                        this.playing = true;
                    }).catch(() => {});
                }
            },
            play() {
                this.audio.play().then(() => {
                    this.playing = true;
                }).catch(() => {});
            },
        }"
        x-on:cover-dismissed.window="play()"
        class="fixed bottom-6 right-6 z-40"
    >
        <audio x-ref="audio" loop>
            <source src="{{ $musicUrl }}" type="audio/mpeg">
        </audio>

        <button
            @click="toggle()"
            class="flex h-11 w-11 items-center justify-center rounded-full bg-navy/85 shadow-[0_4px_16px_rgba(29,39,77,0.35)] ring-1 ring-champagne/40 backdrop-blur-sm transition-all hover:scale-105 active:scale-95"
            :class="playing ? '' : 'opacity-80'"
            aria-label="Toggle Music"
        >
            <x-lucide-music class="size-4 text-champagne" x-show="!playing" />
            <x-lucide-music class="size-4 text-champagne animate-[spin_4s_linear_infinite]" x-show="playing" style="display: none;" />
        </button>
    </div>
@endif
