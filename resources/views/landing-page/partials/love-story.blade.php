<section
    id="love-story"
    class="relative flex min-h-dvh flex-col items-center gap-12 overflow-hidden bg-navy px-8 py-24"
>
    {{-- Decorative Glow --}}
    <div class="pointer-events-none absolute top-0 left-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-champagne/10 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-[500px] w-[500px] translate-x-1/2 translate-y-1/2 rounded-full bg-champagne/10 blur-3xl"></div>

    <div class="z-10 flex flex-col items-center gap-4 text-center">
        <p class="text-[10px] font-semibold uppercase tracking-[0.4em] text-champagne/70">Our Journey</p>
        <h2 class="font-display text-4xl leading-tight text-softwhite">Love Story</h2>
        <div class="mt-4 h-12 w-px bg-gradient-to-b from-champagne/50 to-transparent"></div>
    </div>

    <div class="z-10 w-full relative mt-4">
        {{-- Vertical Timeline Line --}}
        <div class="absolute left-[11px] top-2 bottom-0 w-px bg-champagne/20"></div>
        
        <div class="flex flex-col gap-14">
            @foreach ($loveStories as $story)
                <div class="relative flex flex-col pl-10 text-left">
                    
                    {{-- Timeline Dot & Glow --}}
                    <div class="absolute left-[8px] top-1.5 w-1.5 h-1.5 rounded-full bg-champagne ring-4 ring-navy z-10"></div>
                    <div class="absolute left-[-2px] top-[2px] w-6 h-6 rounded-full bg-champagne/20 blur-sm z-0"></div>
                    
                    <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-champagne mb-2">
                        {{ \Carbon\Carbon::parse($story->date)->translatedFormat('F Y') }}
                    </p>
                    <h3 class="font-display text-3xl text-softwhite mb-4">{{ $story->title }}</h3>
                    
                    @if ($story->photo_path)
                        <div class="relative w-full rounded-tl-3xl rounded-br-3xl overflow-hidden mb-5 p-1 border border-champagne/30 bg-white/5">
                            <img src="{{ asset('storage/'.$story->photo_path) }}" alt="{{ $story->title }}" class="w-full aspect-[4/3] object-cover rounded-tl-2xl rounded-br-2xl filter grayscale contrast-110">
                        </div>
                    @endif
                    
                    <p class="text-[13px] font-light leading-relaxed text-softwhite/80 tracking-wide">{{ $story->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
