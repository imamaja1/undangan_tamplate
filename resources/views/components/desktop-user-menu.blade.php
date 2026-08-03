<x-ui.dropdown-menu>
    <x-ui.dropdown-menu.trigger 
        variant="ghost" 
        data-test="sidebar-menu-button"
        class="flex items-center justify-start gap-2 h-auto px-2 py-2 hover:bg-accent hover:text-accent-foreground w-full transition-colors"
    >
        <x-ui.avatar class="size-8">
            <x-ui.avatar.fallback>{{ auth()->user()->initials() }}</x-ui.avatar.fallback>
        </x-ui.avatar>
        <div class="grid flex-1 text-sm leading-tight text-left">
            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
            <span class="truncate text-xs text-muted-foreground">{{ auth()->user()->email }}</span>
        </div>
        <x-lucide-chevrons-up-down class="size-4 text-muted-foreground ml-auto" />
    </x-ui.dropdown-menu.trigger>

    <x-ui.dropdown-menu.content align="end" side="top" class="w-56 mb-2">
        <div class="flex items-center gap-2 px-2 py-1.5 text-sm">
            <x-ui.avatar class="size-8">
                <x-ui.avatar.fallback>{{ auth()->user()->initials() }}</x-ui.avatar.fallback>
            </x-ui.avatar>
            <div class="grid flex-1 leading-tight">
                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                <span class="truncate text-xs text-muted-foreground">{{ auth()->user()->email }}</span>
            </div>
        </div>
        <x-ui.dropdown-menu.separator />
        <x-ui.dropdown-menu.item href="{{ route('profile.edit') }}" wire:navigate class="cursor-pointer">
            <x-lucide-settings class="mr-2 size-4" />
            {{ __('Settings') }}
        </x-ui.dropdown-menu.item>
        <x-ui.dropdown-menu.separator />
        <x-ui.dropdown-menu.item 
            as="button" 
            type="button" 
            x-data 
            @click="localStorage.theme = document.documentElement.classList.contains('dark') ? 'light' : 'dark'; document.documentElement.classList.toggle('dark');" 
            class="w-full cursor-pointer"
        >
            <x-lucide-sun class="mr-2 size-4 hidden dark:block" />
            <x-lucide-moon class="mr-2 size-4 block dark:hidden" />
            <span class="hidden dark:inline">{{ __('Light Mode') }}</span>
            <span class="inline dark:hidden">{{ __('Dark Mode') }}</span>
        </x-ui.dropdown-menu.item>
        <x-ui.dropdown-menu.separator />
        <form method="POST" action="{{ route('logout') }}" class="w-full m-0 p-0">
            @csrf
            <x-ui.dropdown-menu.item as="button" type="submit" class="w-full cursor-pointer" data-test="logout-button">
                <x-lucide-log-out class="mr-2 size-4" />
                {{ __('Log out') }}
            </x-ui.dropdown-menu.item>
        </form>
    </x-ui.dropdown-menu.content>
</x-ui.dropdown-menu>
