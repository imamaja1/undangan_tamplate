<?php

use App\Models\GuestList;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Daftar Tamu')] class extends Component {
    public bool $showForm = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $phoneNumber = '';

    public bool $isSent = false;

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function guestLists()
    {
        return $this->invitation?->guestLists()->orderByDesc('created_at')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $guest = $this->invitation?->guestLists()->findOrFail($id);

        $this->editingId = $guest->id;
        $this->name = $guest->name;
        $this->phoneNumber = $guest->phone_number;
        $this->isSent = $guest->is_sent;
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
            'name' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'isSent' => ['boolean'],
        ]);

        $data = [
            'name' => $validated['name'],
            'phone_number' => $validated['phoneNumber'],
            'is_sent' => $validated['isSent'],
        ];

        if ($this->editingId) {
            $this->invitation?->guestLists()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->guestLists()->create($data);
        }

        $this->dispatch('toast', message: 'Tamu tersimpan.', type: 'success');
        $this->cancel();
    }

    public function toggleSent(int $id): void
    {
        $guest = $this->invitation?->guestLists()->findOrFail($id);

        $guest->update(['is_sent' => ! $guest->is_sent]);

        $this->dispatch('toast', message: $guest->is_sent ? 'Status kirim diperbarui: Terkirim.' : 'Status kirim diperbarui: Belum.', type: 'success');
    }

    public function delete(int $id): void
    {
        $this->invitation?->guestLists()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Tamu dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->phoneNumber = '';
        $this->isSent = false;
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
                <h1 class="text-2xl font-semibold tracking-tight">Daftar Tamu</h1>
                <p class="text-sm text-muted-foreground">Nama dan nomor WhatsApp tamu penerima undangan.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Tamu
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Tamu' : 'Tambah Tamu' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Nama dan nomor WhatsApp tamu penerima undangan.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="name">Nama Tamu</x-ui.label>
                            <x-ui.input wire:model="name" id="name" type="text" required />
                            @error('name')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="phoneNumber">Nomor WhatsApp</x-ui.label>
                            <x-ui.input wire:model="phoneNumber" id="phoneNumber" type="text" required placeholder="6281234567890" />
                            @error('phoneNumber')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-ui.switch wire:model="isSent" id="isSent" />
                        <x-ui.label for="isSent">Undangan sudah dikirim</x-ui.label>
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
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Nomor WhatsApp</th>
                            <th class="px-4 py-3">Status Kirim</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->guestLists as $guest)
                            <tr wire:key="gl-{{ $guest->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3 font-medium">{{ $guest->name }}</td>
                                <td class="px-4 py-3 text-muted-foreground">{{ $guest->phone_number }}</td>
                                <td class="px-4 py-3">
                                    <button type="button" wire:click="toggleSent({{ $guest->id }})" wire:key="toggle-{{ $guest->id }}" class="cursor-pointer">
                                        <x-ui.badge variant="{{ $guest->is_sent ? 'default' : 'secondary' }}">
                                            {{ $guest->is_sent ? 'Terkirim' : 'Belum' }}
                                        </x-ui.badge>
                                    </button>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $guest->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus tamu ini?')"
                                            x-on:click="__confirm('delete', {{ $guest->id }})"
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
                                <td colspan="4" class="px-4 py-10 text-center text-muted-foreground">Belum ada tamu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
