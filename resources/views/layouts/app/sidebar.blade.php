<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background font-sans text-foreground antialiased flex flex-col md:flex-row">
        
        <!-- Sidebar Desktop -->
        <aside class="hidden w-64 flex-col border-r bg-muted/40 md:flex min-h-screen sticky top-0">
            <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-semibold" />
            </div>
            
            <div class="flex-1 overflow-auto py-4">
                <nav class="grid items-start px-2 text-sm font-medium lg:px-4 gap-1">
                    <div class="px-2 py-2 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('Platform') }}
                    </div>
                    <a
                        href="{{ route('dashboard') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-primary transition-all hover:text-primary {{ request()->routeIs('dashboard') ? 'bg-muted' : 'text-muted-foreground hover:bg-muted/50' }}"
                    >
                        <x-lucide-layout-dashboard class="size-4" />
                        {{ __('Dashboard') }}
                    </a>
                </nav>
            </div>
            
            <div class="mt-auto p-4">
                <nav class="grid items-start text-sm font-medium gap-1">
                   
                </nav>
            </div>
            
            <div class="border-t p-4">
                <x-desktop-user-menu />
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex w-full flex-1 flex-col">
            <header class="sticky top-0 z-30 flex h-14 items-center justify-between border-b bg-background px-4 md:hidden">
                <!-- Mobile Menu (Sheet) -->
                <x-ui.sheet>
                    <x-ui.sheet.trigger asChild>
                        <x-ui.button variant="outline" size="icon" class="md:hidden">
                            <x-lucide-menu class="size-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </x-ui.button>
                    </x-ui.sheet.trigger>
                    <x-ui.sheet.content side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-semibold mb-4" />
                            <a
                                href="{{ route('dashboard') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-foreground hover:text-foreground {{ request()->routeIs('dashboard') ? 'bg-muted' : 'text-muted-foreground' }}"
                            >
                                <x-lucide-layout-dashboard class="size-5" />
                                {{ __('Dashboard') }}
                            </a>
                        </nav>
                    </x-ui.sheet.content>
                </x-ui.sheet>
                
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="md:hidden" />
                
                <div class="w-10">
                    <x-desktop-user-menu />
                </div>
            </header>
            
            <main class="flex-1 p-4 md:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
