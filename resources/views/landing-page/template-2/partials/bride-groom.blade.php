<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=EB+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg-mobile, .font-headline-md, .font-body-md { font-family: 'EB Garamond', serif; }
    
    .gold-gradient-text {
        background: linear-gradient(45deg, #d8bf8a, #a68d59);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .gold-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #d8bf8a, transparent);
    }
    
    .bg-surface-container { background-color: #f3ede4; }
    .text-primary { color: #705d2e; }
    .text-on-surface { color: #1d1b16; }
    .text-on-surface-variant { color: #4b4639; }
</style>

<section class="flex flex-col items-center px-6 py-12 relative bg-[#fef9f0] text-[#1d1b16] font-['EB_Garamond'] overflow-hidden">
    <div class="w-full max-w-md mx-auto relative z-10 flex flex-col items-center">
        <!-- Section Header -->
        <div
            x-data="{ v: false }" x-intersect.half="v = true"
            class="text-center mb-12 opacity-0 translate-y-8 transition-all duration-1000"
            :class="v ? '!opacity-100 !translate-y-0' : ''"
        >
            <h2 class="font-display-lg-mobile text-[40px] gold-gradient-text mb-4 italic whitespace-nowrap">Pasangan Berbahagia</h2>
            <div class="gold-divider w-32 mx-auto"></div>
        </div>

        <!-- Profiles Container -->
        <div class="w-full">
            <!-- Bride Card -->
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="w-full bg-surface-container rounded-[1rem] p-6 mb-8 relative overflow-hidden flex flex-col items-center text-center opacity-0 translate-y-8 transition-all duration-700"
                style="box-shadow: rgba(0, 0, 0, 0.05) 0px 4px 20px;"
                :class="v ? '!opacity-100 !translate-y-0' : ''"
            >
                <span class="font-label-caps text-[12px] text-primary mb-4 tracking-widest uppercase font-semibold">Mempelai Wanita</span>
                
                <div class="w-48 h-48 mb-6 rounded-full overflow-hidden transition-transform duration-500 hover:scale-105">
                    @if ($bride?->photo_path)
                        <img alt="{{ $bride->full_name }}" class="w-full h-full object-cover rounded-full" src="{{ asset('storage/'.$bride->photo_path) }}">
                    @else
                        <div class="w-full h-full rounded-full bg-[#cdc6b4]"></div>
                    @endif
                </div>
                
                <h3 class="font-headline-md text-[32px] text-on-surface mb-2 font-medium">
                    {{ $bride?->full_name ?? 'Nama Mempelai Wanita' }}
                </h3>
                <p class="font-body-md text-[16px] text-on-surface-variant italic">
                    Putri tercinta dari Bapak {{ $bride?->father_name }} <br>&amp; Ibu {{ $bride?->mother_name }}
                </p>
                
                @if ($bride?->description || $bride?->instagram_url)
                <a class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-transparent text-primary font-label-caps text-[12px] font-semibold hover:opacity-70 transition-all duration-300 uppercase tracking-widest" href="{{ $bride?->instagram_url && $bride->instagram_url !== '#' ? $bride->instagram_url : 'https://instagram.com/' . ltrim($bride?->description ?? '', '@') }}" target="_blank">
                    <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                    {{ $bride?->description ? '@' . ltrim($bride->description, '@') : 'Instagram' }}
                </a>
                @endif
            </div>

            <!-- Ampersand -->
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="flex items-center justify-center mb-8 opacity-0 transition-opacity duration-1000"
                :class="v ? '!opacity-100' : ''"
            >
                <div class="gold-divider w-12"></div>
                <span class="font-display-lg-mobile text-[40px] gold-gradient-text px-4 italic">&amp;</span>
                <div class="gold-divider w-12"></div>
            </div>

            <!-- Groom Card -->
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="w-full bg-surface-container rounded-[1rem] p-6 relative overflow-hidden flex flex-col items-center text-center opacity-0 translate-y-8 transition-all duration-700"
                style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);"
                :class="v ? '!opacity-100 !translate-y-0' : ''"
            >
                <span class="font-label-caps text-[12px] text-primary mb-4 tracking-widest uppercase font-semibold">Mempelai Pria</span>
                
                <div class="w-48 h-48 mb-6 rounded-full overflow-hidden transition-transform duration-500 hover:scale-105">
                    @if ($groom?->photo_path)
                        <img alt="{{ $groom->full_name }}" class="w-full h-full object-cover rounded-full" src="{{ asset('storage/'.$groom->photo_path) }}">
                    @else
                        <div class="w-full h-full rounded-full bg-[#cdc6b4]"></div>
                    @endif
                </div>
                
                <h3 class="font-headline-md text-[32px] text-on-surface mb-2 font-medium">
                    {{ $groom?->full_name ?? 'Nama Mempelai Pria' }}
                </h3>
                <p class="font-body-md text-[16px] text-on-surface-variant italic">
                    Putra tercinta dari Bapak {{ $groom?->father_name }} <br>&amp; Ibu {{ $groom?->mother_name }}
                </p>

                @if ($groom?->description || $groom?->instagram_url)
                <a class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-transparent text-primary font-label-caps text-[12px] font-semibold hover:opacity-70 transition-all duration-300 uppercase tracking-widest" href="{{ $groom?->instagram_url && $groom->instagram_url !== '#' ? $groom->instagram_url : 'https://instagram.com/' . ltrim($groom?->description ?? '', '@') }}" target="_blank">
                    <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                    {{ $groom?->description ? '@' . ltrim($groom->description, '@') : 'Instagram' }}
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
