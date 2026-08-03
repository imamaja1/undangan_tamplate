<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background font-sans text-foreground antialiased flex flex-col">
        <header class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b bg-background px-4 lg:px-6 w-full">
            <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-semibold" />

            <nav class="hidden max-lg:hidden lg:flex items-center gap-4 text-sm lg:gap-6 ml-6">
                <a
                    href="{{ route('dashboard') }}"
                    wire:navigate
                    class="transition-colors hover:text-foreground/80 {{ request()->routeIs('dashboard') ? 'text-foreground' : 'text-foreground/60' }}"
                >
                    {{ __('Dashboard') }}
                </a>
            </nav>

            <div class="flex-1"></div>

            <nav class="flex items-center gap-2">
                <a
                    href="https://github.com/laravel/livewire-starter-kit"
                    target="_blank"
                    class="hidden lg:flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-hidden focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 w-9"
                    title="{{ __('Repository') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
                </a>
                <a
                    href="https://laravel.com/docs/starter-kits#livewire"
                    target="_blank"
                    class="hidden lg:flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-hidden focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 w-9"
                    title="{{ __('Documentation') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                </a>
                <x-desktop-user-menu />
            </nav>
        </header>

        <main class="flex-1 w-full flex flex-col p-4 sm:p-6">
            {{ $slot }}
        </main>

    </body>
</html>
