@props([
    'variant' => 'outline',
])

<x-ui.button
    :$variant
    x-on:click="__dialogOpen = false"
>
    @if ($slot->isEmpty())
        {{ __('Close') }}
    @else
        {{ $slot }}
    @endif
</x-ui.button>

