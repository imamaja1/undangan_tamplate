<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>

<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg-mobile, .font-headline-md, .font-body-md { font-family: 'EB Garamond', serif; }
    
    .bg-surface { background-color: #fef9f0; }
    .bg-surface-container { background-color: #f2ede5; }
    .text-primary { color: #755b23; }
    .text-secondary { color: #606044; }
    .text-on-primary { color: #ffffff; }
    .text-on-surface-variant { color: #4d4638; }
    .border-primary { border-color: #755b23; }
    .border-outline-variant { border-color: #d0c5b3; }
</style>

<section class="bg-surface text-[#1e1b16] antialiased py-12 px-4 overflow-hidden flex flex-col justify-center">
    <div class="w-full max-w-md mx-auto relative z-10 flex flex-col items-center text-center">
        <!-- Header Section -->
        <div 
            x-data="{ v: false }" x-intersect.half="v = true"
            class="mb-8 opacity-0 translate-y-8 transition-all duration-1000"
            :class="v ? '!opacity-100 !translate-y-0' : ''"
        >
            <span class="material-symbols-outlined text-[40px] text-primary mb-2">volunteer_activism</span>
            <h2 class="font-headline-md text-[32px] font-medium text-primary mb-4 leading-tight">Wedding Gift</h2>
            <p class="font-body-md text-[16px] text-on-surface-variant max-w-lg mx-auto px-4">
                Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun, jika Anda ingin memberikan tanda kasih, Anda dapat memberikannya melalui:
            </p>
        </div>

        {{-- Gift Cards Section --}}
        @if(count($gifts) > 0)
        <div class="w-full flex flex-col gap-4 mb-10">
            @foreach ($gifts as $index => $gift)
                <div
                    x-data="{ v: false, copied: false }" x-intersect.half="v = true"
                    class="w-full p-8 rounded-xl border border-outline-variant bg-surface-container relative overflow-hidden group shadow-sm opacity-0 translate-y-8 transition-all duration-700 hover:shadow-md"
                    style="transition-delay: {{ $index * 150 }}ms"
                    :class="v ? '!opacity-100 !translate-y-0' : ''"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-[#755b23]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <h3 class="font-label-caps text-[12px] font-semibold text-secondary mb-2 tracking-widest uppercase">{{ $gift->provider_name }}</h3>
                        
                        @if ($gift->qr_code_path)
                            <div class="bg-white p-2 rounded-lg mb-4 shadow-sm border border-outline-variant">
                                <img
                                    src="{{ asset('storage/'.$gift->qr_code_path) }}"
                                    alt="QR Code"
                                    class="h-32 w-32 object-contain block mx-auto"
                                >
                            </div>
                        @endif

                        <p class="font-display-lg-mobile text-[36px] font-semibold mb-1 tracking-wider text-primary">{{ $gift->account_number }}</p>
                        <p class="font-body-md text-[16px] text-on-surface-variant mb-6 uppercase tracking-wider">a/n {{ $gift->account_name }}</p>
                        
                        <button
                            @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied = true; setTimeout(() => copied = false, 3000)"
                            class="px-6 py-3 rounded-full border border-primary text-primary hover:bg-[#755b23] hover:text-white transition-all duration-300 font-label-caps text-[12px] font-semibold uppercase flex items-center gap-2 group/btn"
                        >
                            <span class="material-symbols-outlined text-[16px] group-hover/btn:scale-110 group-hover/btn:text-white transition-transform" x-show="!copied">content_copy</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/btn:text-white" x-show="copied" style="display: none;">check</span>
                            <span class="group-hover/btn:text-white" x-show="!copied">Salin No. Rekening</span>
                            <span class="group-hover/btn:text-white" x-show="copied" style="display: none;">Tersalin!</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        
      
        @endif
    </div>
</section>
