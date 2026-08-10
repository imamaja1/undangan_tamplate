<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>

<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg-mobile, .font-body-lg, .font-body-md { font-family: 'EB Garamond', serif; }
</style>

<footer class="bg-[#fef9f0] text-[#1d1b16] relative overflow-hidden flex flex-col items-center justify-center px-6 py-12 text-center pb-24">
    <!-- Background Texture -->
    <div class="absolute inset-0 bg-cover bg-center opacity-10 z-0 pointer-events-none mix-blend-overlay" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBk0D5YxXx-0mZuLXTbcyq3VCpSB3tnVGTXV4nfR4OpaWvwgXFhMemvpooHlBPtlZHUp-iu2ZYSucvSmmY9eRd-0TQdeX6uCNBorsmxpceEmbrIimGdBeiBxOezUb4d4nhsBu547K7jYI1KD4213E2ISrOndE3BBITqWdIUVwc8hiYQ-7zquhlGgCfLvXVrBkVjhVShSLOz7blAj_21r3-pb3ii943NStZIjjQ5myk-7YOwAhxZl2_0"); filter: invert(1) hue-rotate(180deg);'></div>
    
    <div class="w-full max-w-md mx-auto relative z-10 flex flex-col items-center"
        x-data="{ v: false }" x-intersect.half="v = true"
        class="opacity-0 translate-y-8 transition-all duration-1000"
        :class="v ? '!opacity-100 !translate-y-0' : ''">
        
        <!-- Elegant Top Divider -->
        <div class="flex items-center justify-center w-full max-w-[200px] mb-8 gap-4 opacity-80">
            <div class="h-[1px] w-full bg-gradient-to-r from-transparent to-[#d0c6b5]"></div>
            <span class="material-symbols-outlined text-[#d0c6b5]" style="font-variation-settings: 'FILL' 1;">spa</span>
            <div class="h-[1px] w-full bg-gradient-to-l from-transparent to-[#d0c6b5]"></div>
        </div>

        <p class="font-body-lg text-[18px] text-[#4d4638] max-w-sm mx-auto mb-6 leading-relaxed">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu kepada kami.
        </p>

        <p class="font-body-md text-[16px] text-[#1d1b16] max-w-sm mx-auto mb-12 tracking-wide uppercase">
            Terima kasih atas segala perhatian dan doa restu Anda.
        </p>

        <h1 class="font-display-lg-mobile text-[40px] font-semibold text-[#765a0b] italic mb-4 tracking-tight leading-tight">
            {{ $bride?->nickname ?? 'Bride' }} &amp; {{ $groom?->nickname ?? 'Groom' }}
        </h1>

        <p class="font-label-caps text-[12px] font-semibold text-[#4d4638] tracking-[0.15em] mt-4 uppercase">
            &copy; {{ date('Y') }} &nbsp;{{ $bride?->nickname ?? 'Bride' }} &amp; {{ $groom?->nickname ?? 'Groom' }}
        </p>

        <!-- Elegant Bottom Divider -->
        <div class="flex items-center justify-center w-full max-w-[150px] mt-12 gap-4 opacity-80">
            <div class="h-[1px] w-full bg-gradient-to-r from-transparent to-[#d0c6b5]"></div>
            <div class="w-1.5 h-1.5 rotate-45 bg-[#d0c6b5]"></div>
            <div class="h-[1px] w-full bg-gradient-to-l from-transparent to-[#d0c6b5]"></div>
        </div>
    </div>
</footer>
