<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet"/>

<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg, .font-display-lg-mobile, .font-headline-md, .font-body-lg { font-family: 'EB Garamond', serif; }

    .timeline-line {
        width: 1px;
        background: linear-gradient(to bottom, transparent, #755b1f, transparent);
    }
    
    .bg-surface { background-color: #fef9f0; }
    .bg-surface-container-low { background-color: #f8f3eb; }
    .text-primary { color: #755b1f; }
    .text-on-surface-variant { color: #4b4639; }
    .border-outline-variant { border-color: #cec6b4; }
    .text-outline { color: #7c7667; }
    .bg-primary { background-color: #755b1f; }
    .text-on-primary { color: #ffffff; }

    @keyframes pulse-heart {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }
    .animate-pulse-heart { animation: pulse-heart 2s infinite ease-in-out; }
</style>

<section class="bg-surface text-[#1d1b16] antialiased py-12 px-6 md:px-16 overflow-hidden">
    <div class="max-w-md mx-auto relative z-10">
        <!-- Header Section -->
        <div 
            x-data="{ v: false }" x-intersect.half="v = true"
            class="text-center flex flex-col items-center mb-12 opacity-0 translate-y-8 transition-all duration-1000"
            :class="v ? '!opacity-100 !translate-y-0' : ''"
        >
            <div class="mb-6 flex justify-center items-center gap-4 w-full max-w-[200px] opacity-70">
                <div class="h-px bg-gradient-to-r from-transparent to-[#7c7667] w-full"></div>
                <span class="material-symbols-outlined text-outline text-sm" style="font-variation-settings: 'FILL' 1;">favorite</span>
                <div class="h-px bg-gradient-to-l from-transparent to-[#7c7667] w-full"></div>
            </div>
            <h2 class="font-display-lg-mobile text-[40px] font-semibold text-primary mb-4 leading-tight">Kisah Kasih</h2>
            <p class="font-body-lg text-[16px] text-on-surface-variant max-w-sm mx-auto italic px-4">
                "Dari pertemuan pertama hingga komitmen seumur hidup, ikuti perjalanan momen yang menyatukan kami."
            </p>
        </div>

        <!-- Timeline Section -->
        @if(count($loveStories) > 0)
        <div class="relative w-full pb-10">
            <!-- Left Line (Mobile Style for all) -->
            <div class="absolute left-6 top-0 bottom-0 timeline-line z-0"></div>

            <div class="flex flex-col gap-10 relative z-10">
                @foreach ($loveStories as $index => $story)
                <div 
                    x-data="{ v: false }" x-intersect.half="v = true"
                    class="relative flex flex-col group opacity-0 translate-y-8 transition-all duration-1000"
                    :class="v ? '!opacity-100 !translate-y-0' : ''"
                >
                    <!-- Icon/Node -->
                    <div class="absolute left-6 -translate-x-1/2 w-12 h-12 bg-surface border border-outline-variant rounded-full flex items-center justify-center z-20 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center {{ $loop->last ? 'animate-pulse-heart' : '' }}">
                            @if($loop->last)
                                <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
                            @else
                                <div class="w-3 h-3 rounded-full bg-[#fef9f0]"></div>
                            @endif
                        </div>
                    </div>

                    <!-- Content & Image -->
                    <div class="w-full pl-16 pr-2">
                        <div class="p-6 border border-outline-variant/50 hover:border-[#cec6b4] transition-colors duration-500 rounded-lg relative overflow-hidden bg-surface-container-low shadow-sm">
                            <h3 class="font-headline-md text-[20px] font-medium text-primary mb-2">{{ $story->title }}</h3>
                            <p class="font-label-caps text-[12px] font-semibold tracking-widest uppercase text-on-surface-variant mb-4">{{ \Carbon\Carbon::parse($story->date)->translatedFormat('F Y') }}</p>
                            <p class="font-body-lg text-[15px] text-on-surface-variant leading-relaxed">
                                {{ $story->description }}
                            </p>

                            @if ($story->photo_path)
                            <div class="mt-4 w-full aspect-[4/3] rounded-sm overflow-hidden border border-outline-variant/30 p-2 bg-surface-container-low/50">
                                <img alt="{{ $story->title }}" class="w-full h-full object-cover rounded-sm filter brightness-95 sepia-[0.1]" src="{{ asset('storage/'.$story->photo_path) }}"/>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
