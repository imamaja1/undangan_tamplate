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
    class="fixed bottom-8 right-8 z-50"
>
    <audio x-ref="audio" loop src="{{ $musicUrl }}"></audio>

    <button
        @click="toggle()"
        class="glass-panel group flex h-12 w-12 items-center justify-center rounded-2xl shadow-2xl transition-all duration-300 hover:border-[#D8C4A6]"
        :class="playing ? 'ring-2 ring-[#D8C4A6]/50 opacity-100' : 'opacity-80'"
    >
        <svg
            width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="#D8C4A6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
            :class="playing ? 'animate-[spin_6s_linear_infinite]' : ''"
        >
            <circle cx="12" cy="12" r="2"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
        </svg>
    </button>
</div>
@endif
