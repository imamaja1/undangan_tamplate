<x-layouts::app :title="__('Galeri Foto & Video')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-6 bg-card rounded-xl border">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Koleksi Momen</h2>
                <x-ui.button>Upload Media</x-ui.button>
            </div>
            <p class="text-muted-foreground">Grid galeri foto prewedding dan video cinematic akan ditampilkan di sini.</p>
        </div>
    </div>
</x-layouts::app>
