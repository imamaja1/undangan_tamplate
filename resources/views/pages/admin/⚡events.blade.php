<?php

use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Acara')] class extends Component {
    public bool $showForm = false;

    public ?int $editingId = null;

    public string $type = 'akad';

    public string $title = '';

    public string $eventDate = '';

    public string $startTime = '';

    public string $endTime = '';

    public string $locationName = '';

    public string $locationAddress = '';

    public string $googleMapsUrl = '';

    public bool $isMainEvent = false;

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function events()
    {
        return $this->invitation?->events()->orderBy('event_date')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $event = $this->invitation?->events()->findOrFail($id);

        $this->editingId = $event->id;
        $this->type = $event->type;
        $this->title = $event->title;
        $this->eventDate = $event->event_date?->format('Y-m-d') ?? '';
        $this->startTime = $event->start_time ?? '';
        $this->endTime = $event->end_time ?? '';
        $this->locationName = $event->location_name;
        $this->locationAddress = $event->location_address;
        $this->googleMapsUrl = $event->google_maps_url ?? '';
        $this->isMainEvent = $event->is_main_event;
        $this->showForm = true;
    }

    public function cancel(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'type' => ['required', Rule::in(['akad', 'resepsi', 'other'])],
            'title' => ['required', 'string', 'max:255'],
            'eventDate' => ['required', 'date'],
            'startTime' => ['required', 'date_format:H:i'],
            'endTime' => ['nullable', 'date_format:H:i'],
            'locationName' => ['required', 'string', 'max:255'],
            'locationAddress' => ['required', 'string', 'max:5000'],
            'googleMapsUrl' => ['nullable', 'url', 'max:500'],
            'isMainEvent' => ['boolean'],
        ]);

        $data = [
            'type' => $validated['type'],
            'title' => $validated['title'],
            'event_date' => $validated['eventDate'],
            'start_time' => $validated['startTime'],
            'end_time' => $validated['endTime'] ?: null,
            'location_name' => $validated['locationName'],
            'location_address' => $validated['locationAddress'],
            'google_maps_url' => $validated['googleMapsUrl'] ?: null,
            'is_main_event' => $validated['isMainEvent'],
        ];

        if ($this->editingId) {
            $this->invitation?->events()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->events()->create($data);
        }

        $this->dispatch('toast', message: 'Acara tersimpan.', type: 'success');
        $this->cancel();
    }

    public function delete(int $id): void
    {
        $this->invitation?->events()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Acara dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->type = 'akad';
        $this->title = '';
        $this->eventDate = '';
        $this->startTime = '';
        $this->endTime = '';
        $this->locationName = '';
        $this->locationAddress = '';
        $this->googleMapsUrl = '';
        $this->isMainEvent = false;
        $this->resetValidation();
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    @if (! $this->invitation)
        <x-ui.card class="p-6">
            <p class="text-sm text-muted-foreground">
                Kamu belum membuat undangan. Silakan <a href="{{ route('admin.invitation') }}" wire:navigate class="font-medium text-primary underline underline-offset-4">atur undangan</a> terlebih dahulu.
            </p>
        </x-ui.card>
    @else
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Acara</h1>
                <p class="text-sm text-muted-foreground">Jadwal dan lokasi acara pernikahan.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Acara
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Acara' : 'Tambah Acara' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Jadwal dan lokasi acara pernikahan.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="type">Jenis Acara</x-ui.label>
                            <x-ui.select wire:model="type" id="type">
                                <option value="akad">Akad</option>
                                <option value="resepsi">Resepsi</option>
                                <option value="other">Lainnya</option>
                            </x-ui.select>
                            @error('type')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="title">Judul</x-ui.label>
                            <x-ui.input wire:model="title" id="title" type="text" required placeholder="Akad Nikah" />
                            @error('title')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="grid gap-2">
                            <x-ui.label for="eventDate">Tanggal</x-ui.label>
                            <x-ui.input wire:model="eventDate" id="eventDate" type="date" required />
                            @error('eventDate')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="startTime">Mulai</x-ui.label>
                            <x-ui.input wire:model="startTime" id="startTime" type="time" required />
                            @error('startTime')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="endTime">Selesai</x-ui.label>
                            <x-ui.input wire:model="endTime" id="endTime" type="time" />
                            @error('endTime')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="locationName">Nama Lokasi</x-ui.label>
                        <x-ui.input wire:model="locationName" id="locationName" type="text" required placeholder="Hotel Grand Ballroom" />
                        @error('locationName')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="locationAddress">Alamat</x-ui.label>
                        <x-ui.textarea wire:model="locationAddress" id="locationAddress" rows="3" required />
                        @error('locationAddress')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="googleMapsUrl">URL Google Maps</x-ui.label>
                        <x-ui.input wire:model="googleMapsUrl" id="googleMapsUrl" type="url" placeholder="https://maps.google.com/..." />
                        @error('googleMapsUrl')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <x-ui.switch wire:model="isMainEvent" id="isMainEvent" />
                        <x-ui.label for="isMainEvent">Acara Utama</x-ui.label>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-ui.button type="submit">Simpan</x-ui.button>
                        <x-ui.button type="button" variant="ghost" x-on:click="__dialogOpen = false">Batal</x-ui.button>
                    </div>
                </form>
            </x-ui.dialog.content>
        </x-ui.dialog>

        <x-ui.card class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left text-xs uppercase tracking-wider text-muted-foreground">
                            <th class="px-4 py-3">Jenis</th>
                            <th class="px-4 py-3">Acara</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->events as $event)
                            <tr wire:key="ev-{{ $event->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3">
                                    <x-ui.badge variant="{{ $event->is_main_event ? 'default' : 'secondary' }}">
                                        {{ strtoupper($event->type) }}
                                    </x-ui.badge>
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $event->title }}</td>
                                <td class="px-4 py-3">{{ $event->event_date?->format('d M Y') }} {{ $event->start_time }}{{ $event->end_time ? ' - '.$event->end_time : ' - Selesai' }}</td>
                                <td class="px-4 py-3 text-muted-foreground">{{ $event->location_name }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $event->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus acara ini?')"
                                            x-on:click="__confirm('delete', {{ $event->id }})"
                                            title="Hapus"
                                            aria-label="Hapus"
                                        >
                                            <x-lucide-trash-2 class="size-4 text-destructive" />
                                        </x-ui.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-muted-foreground">Belum ada acara.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
