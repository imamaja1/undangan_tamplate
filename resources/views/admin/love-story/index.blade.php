<x-layouts::app :title="__('Cerita Cinta')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-6 bg-card rounded-xl border">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Timeline Kisah Cinta</h2>
                <x-ui.button>Tambah Cerita</x-ui.button>
            </div>
            <p class="text-muted-foreground">Daftar momen-momen penting perjalanan cinta akan ditampilkan di sini.</p>
        </div>
    </div>
</x-layouts::app>
