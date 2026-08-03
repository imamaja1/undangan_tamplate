@props([
    'type' => 'text',
    'label' => 'Label',
    'descriptionTrailing' => '',
])

<x-ui.form.item>
    <x-ui.form.label>
        {{ $label }}
    </x-ui.form.label>

    <x-ui.input
        type="{{ $type }}"
        x-form:control
        {{ $attributes }}
    />

    @if ($descriptionTrailing)
        <x-ui.form.description>
            {{ $descriptionTrailing }}
        </x-ui.form.description>
    @endif

    <x-ui.form.message
        name="{{ $attributes->has('wire:model') ? $attributes->get('wire:model') : $attributes->get('name') }}"
    />
</x-ui.form.item>

