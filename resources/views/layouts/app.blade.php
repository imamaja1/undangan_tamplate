<x-layouts::app.sidebar :title="$title ?? null">
    <div class="w-full">
        {{ $slot }}
    </div>
</x-layouts::app.sidebar>
