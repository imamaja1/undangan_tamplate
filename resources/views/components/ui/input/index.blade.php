@props([
    'type' => 'text',
])

<input
    type="{{ $type }}"
    {{ $attributes->twMerge('flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors'.(in_array($type, ['date', 'time', 'datetime-local', 'month', 'week']) ? ' pr-10' : '').' file:mr-4 file:h-7 file:cursor-pointer file:rounded-md file:border-0 file:bg-muted file:px-3 file:py-1 file:text-sm file:font-medium file:shadow-sm hover:file:bg-accent placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 [&::-webkit-calendar-picker-indicator]:cursor-pointer') }}
/>

