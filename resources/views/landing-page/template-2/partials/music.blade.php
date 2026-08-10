@php $musicUrl = $invitation?->music_url ? asset('storage/'.$invitation->music_url) : null; @endphp

@if ($musicUrl)
<div
    x-data="{
        playing: false,
        audio: null,
        init() { this.audio = this.$refs.audio; },
        toggle() {
            this.playing ? this.audio.pause() : this.audio.play().catch(() => {});
            this.playing = !this.playing;
        },
        autoPlay() { this.audio.play().then(() => this.playing = true).catch(() => {}); },
    }"
    x-on:cover-dismissed.window="autoPlay()"
    class="fixed bottom-6 right-6 z-50"
>
    <audio x-ref="audio" loop src="{{ $musicUrl }}"></audio>

    <button
        @click="toggle()"
        class="group flex h-11 w-11 items-center justify-center rounded-full border border-[#E8DFD1] bg-white shadow-lg transition-all duration-300 hover:border-[#C59B27]"
        :class="playing ? 'ring-2 ring-[#C59B27]/30' : 'opacity-80'"
    >
        <svg
            width="15" height="15" viewBox="0 0 24 24" fill="none"
            stroke="#C59B27" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
            :class="playing ? 'animate-[spin_6s_linear_infinite]' : ''"
        >
            <circle cx="12" cy="12" r="2"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
        </svg>
    </button>
</div>
@endif
