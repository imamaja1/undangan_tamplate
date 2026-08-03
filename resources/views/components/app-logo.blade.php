@props([
    'sidebar' => false,
])

<a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold text-lg" {{ $attributes }} wire:navigate>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
        <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
    </div>
    <span class="sr-only sm:not-sr-only sm:inline-block">
        {{ config('app.name', 'Laravel') }}
    </span>
</a>
