<x-layouts::app :title="__('Jadwal Acara')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-6 bg-card rounded-xl border">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Daftar Acara</h2>
                <x-ui.button>Tambah Acara</x-ui.button>
            </div>
            <p class="text-muted-foreground">Informasi Akad, Resepsi, waktu dan lokasi (Maps) akan diatur di sini.</p>
        </div>
    </div>
</x-layouts::app>
