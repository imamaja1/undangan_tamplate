<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=EB+Garamond:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<style>
    .font-arabic { font-family: 'Amiri', serif; }
    .font-headline-md { font-family: 'EB Garamond', serif; }
    .font-display-lg-mobile { font-family: 'EB Garamond', serif; }
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    
    .bg-surface { background-color: #fef9f0; }
    .text-primary { color: #6f5d30; }
    .bg-tertiary-container { background-color: #3c3d35; }
    .text-tertiary-container { color: #3c3d35; }
    .bg-surface-container-low { background-color: #f8f3eb; }
    .border-primary { border-color: #6f5d30; }
</style>

<section class="flex flex-col items-center bg-surface relative overflow-hidden py-12 px-6 text-[#1e1b16] font-['EB_Garamond']">
    <div class="absolute top-0 left-0 opacity-10 pointer-events-none z-0 transform -translate-x-1/4 -translate-y-1/4">
        <span class="material-symbols-outlined text-[200px] text-tertiary-container">eco</span>
    </div>
    
    <div
        x-data="{ v: false }"
        x-intersect.half="v = true"
        class="w-full max-w-2xl relative z-10 flex flex-col items-center opacity-0 translate-y-8 transition-all duration-1000"
        :class="v ? '!opacity-100 !translate-y-0' : ''"
    >
        <!-- Section 1: Islamic Greeting -->
        <div class="flex flex-col items-center space-y-4 mb-10">
            <div class="w-24 h-[1px] bg-tertiary-container mb-2"></div>
            <h2 class="font-arabic text-3xl md:text-4xl leading-loose text-primary font-headline-md" dir="rtl">
                السلام عليكم ورحمة الله وبركاته
            </h2>
            <p class="font-display-lg-mobile text-lg md:text-xl text-center text-primary font-headline-md max-w-[80%] mx-auto">
                Assalamu'alaikum Warahmatullahi Wabarakatuh
            </p>
            <div class="w-24 h-[1px] bg-tertiary-container mt-2"></div>
        </div>

        <!-- Section 2: Quote (Ar-Rum 21) -->
        <div class="flex flex-col items-center space-y-6 max-w-[90%] mx-auto pb-10 text-center">
            <p class="text-[18px] md:text-[20px] text-primary/80 leading-relaxed font-headline-md italic">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berpikir."
            </p>
            <p class="font-label-caps text-[12px] tracking-widest text-primary font-semibold uppercase">
                Ar-Rum: 21
            </p>
            
            <div class="flex items-center justify-center space-x-2 mt-4">
                <div class="w-12 h-[1px] bg-tertiary-container"></div>
                <div class="w-2 h-2 rounded-full bg-tertiary-container transform rotate-45"></div>
                <div class="w-12 h-[1px] bg-tertiary-container"></div>
            </div>
        </div>

        <!-- Section 3: Invitation Text -->
        <div class="w-full max-w-[90%] mx-auto p-8 rounded-xl bg-surface-container-low/80 backdrop-blur-sm border border-primary/20 shadow-sm">
            <p class="text-center text-primary text-[20px] md:text-[24px] leading-relaxed font-headline-md">
                {!! nl2br(e($invitation?->opening_message ?? 'Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan putra-putri kami.')) !!}
            </p>
        </div>
        
    </div>
    
    <div class="absolute bottom-0 right-0 opacity-10 pointer-events-none z-0 transform translate-x-1/4 translate-y-1/4">
        <span class="material-symbols-outlined text-[200px] text-tertiary-container">eco</span>
    </div>
</section>
