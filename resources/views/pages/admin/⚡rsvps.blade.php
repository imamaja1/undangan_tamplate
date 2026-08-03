<?php

use App\Models\Invitation;
use App\Models\Rsvp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('RSVP & Ucapan')] class extends Component {
    public bool $showForm = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $status = 'attending';

    public int $pax = 1;

    public string $message = '';

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function rsvps()
    {
        return $this->invitation?->rsvps()->orderByDesc('created_at')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $rsvp = $this->invitation?->rsvps()->findOrFail($id);

        $this->editingId = $rsvp->id;
        $this->name = $rsvp->name;
        $this->status = $rsvp->status;
        $this->pax = $rsvp->pax;
        $this->message = $rsvp->message ?? '';
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
            'status' => ['required', Rule::in(['attending', 'declined'])],
            'pax' => ['required', 'integer', 'min:1', 'max:20'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'pax' => $validated['pax'],
            'message' => $validated['message'] ?: null,
        ];

        if ($this->editingId) {
            $this->invitation?->rsvps()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->rsvps()->create($data);
        }

        $this->dispatch('toast', message: 'RSVP tersimpan.', type: 'success');
        $this->cancel();
    }

    public function delete(int $id): void
    {
        $this->invitation?->rsvps()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'RSVP dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->status = 'attending';
        $this->pax = 1;
        $this->message = '';
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
                <h1 class="text-2xl font-semibold tracking-tight">RSVP & Ucapan</h1>
                <p class="text-sm text-muted-foreground">Konfirmasi kehadiran dan ucapan dari tamu.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah RSVP
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit RSVP' : 'Tambah RSVP' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Konfirmasi kehadiran tamu undangan.</x-ui.dialog.description>
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
                            <x-ui.label for="status">Status</x-ui.label>
                            <x-ui.select wire:model="status" id="status">
                                <option value="attending">Hadir</option>
                                <option value="declined">Tidak Hadir</option>
                            </x-ui.select>
                            @error('status')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="pax">Jumlah Orang</x-ui.label>
                        <x-ui.input wire:model="pax" id="pax" type="number" min="1" max="20" required />
                        @error('pax')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="message">Ucapan</x-ui.label>
                        <x-ui.textarea wire:model="message" id="message" rows="3" />
                        @error('message')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
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
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Ucapan</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rsvps as $rsvp)
                            <tr wire:key="rs-{{ $rsvp->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3 font-medium">{{ $rsvp->name }}</td>
                                <td class="px-4 py-3">
                                    <x-ui.badge variant="{{ $rsvp->status === 'attending' ? 'default' : 'destructive' }}">
                                        {{ $rsvp->status === 'attending' ? 'Hadir' : 'Tidak Hadir' }}
                                    </x-ui.badge>
                                </td>
                                <td class="px-4 py-3">{{ $rsvp->pax }} orang</td>
                                <td class="max-w-xs truncate px-4 py-3 text-muted-foreground">{{ $rsvp->message ?? '—' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $rsvp->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus RSVP ini?')"
                                            x-on:click="__confirm('delete', {{ $rsvp->id }})"
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
                                <td colspan="5" class="px-4 py-10 text-center text-muted-foreground">Belum ada RSVP.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
