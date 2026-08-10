<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Undangan Pernikahan')</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#060a18] antialiased" x-data="{ loaded: false }" x-init="window.addEventListener('load', () => setTimeout(() => loaded = true, 500))">
        {{-- Preloader --}}
        <div 
            x-show="!loaded"
            x-transition:leave="transition ease-in-out duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] mx-auto flex max-w-md flex-col items-center justify-center bg-[#060a18]"
        >
            <div class="relative flex items-center justify-center">
                <div class="absolute h-20 w-20 animate-[spin_3s_linear_infinite] rounded-full border-t-2 border-b-2 border-[#c9b037]/60"></div>
                <div class="absolute h-14 w-14 animate-[spin_2s_linear_infinite_reverse] rounded-full border-r-2 border-l-2 border-[#c9b037]/40"></div>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c9b037" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse">
                    <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1.1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.9 7.9 7.9-7.9 1-1a5.5 5.5 0 000-7.8z"/>
                </svg>
            </div>
            <p class="mt-6 text-[9px] font-semibold uppercase tracking-[0.4em] text-[#c9b037]/60 animate-pulse">Memuat Undangan</p>
        </div>

        <main class="mx-auto flex min-h-dvh w-full max-w-md flex-col bg-[#0a1128] shadow-2xl relative">
            {{-- Background Animation Layer --}}
            <div class="fixed inset-0 z-0 mx-auto max-w-md pointer-events-none overflow-hidden">
                <div class="starfield absolute inset-0">
                    <span class="star-dot" style="top:5%;left:8%;animation-delay:0s"></span>
                    <span class="star-dot" style="top:12%;left:78%;animation-delay:0.6s"></span>
                    <span class="star-dot" style="top:22%;left:35%;animation-delay:1.2s"></span>
                    <span class="star-dot" style="top:35%;left:88%;animation-delay:0.3s"></span>
                    <span class="star-dot" style="top:48%;left:15%;animation-delay:1.8s"></span>
                    <span class="star-dot" style="top:55%;left:92%;animation-delay:0.9s"></span>
                    <span class="star-dot" style="top:68%;left:22%;animation-delay:2.1s"></span>
                    <span class="star-dot" style="top:75%;left:80%;animation-delay:1.5s"></span>
                    <span class="star-dot" style="top:88%;left:40%;animation-delay:0.4s"></span>
                    <span class="star-dot" style="top:95%;left:65%;animation-delay:2.5s"></span>
                    <span class="gold-dust-bg" style="top:8%;left:25%;animation-delay:0s"></span>
                    <span class="gold-dust-bg" style="top:18%;left:70%;animation-delay:2s"></span>
                    <span class="gold-dust-bg" style="top:30%;left:50%;animation-delay:4s"></span>
                    <span class="gold-dust-bg" style="top:42%;left:12%;animation-delay:1s"></span>
                    <span class="gold-dust-bg" style="top:55%;left:85%;animation-delay:3s"></span>
                    <span class="gold-dust-bg" style="top:65%;left:30%;animation-delay:5s"></span>
                    <span class="gold-dust-bg" style="top:78%;left:55%;animation-delay:2.5s"></span>
                    <span class="gold-dust-bg" style="top:90%;left:18%;animation-delay:4.5s"></span>
                </div>
            </div>
            <div class="relative z-10">
                @yield('content')
            </div>
        </main>
    </body>
</html>
