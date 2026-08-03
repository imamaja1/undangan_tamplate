@props([
    'variant' => 'outline',
])

<x-ui.button
    :$variant
    x-on:click="__dialogOpen = true"
>
    {{ $slot }}
</x-ui.button>

