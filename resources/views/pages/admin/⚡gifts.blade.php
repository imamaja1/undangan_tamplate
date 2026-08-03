<?php

use App\Models\Gift;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Hadiah')] class extends Component {
    use WithFileUploads;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $providerName = '';

    public string $accountNumber = '';

    public string $accountName = '';

    public $qrCode;

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function gifts()
    {
        return $this->invitation?->gifts()->orderBy('id')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $gift = $this->invitation?->gifts()->findOrFail($id);

        $this->editingId = $gift->id;
        $this->providerName = $gift->provider_name;
        $this->accountNumber = $gift->account_number;
        $this->accountName = $gift->account_name;
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
            'providerName' => ['required', 'string', 'max:255'],
            'accountNumber' => ['required', 'string', 'max:255'],
            'accountName' => ['required', 'string', 'max:255'],
            'qrCode' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'provider_name' => $validated['providerName'],
            'account_number' => $validated['accountNumber'],
            'account_name' => $validated['accountName'],
        ];

        if ($this->qrCode) {
            $data['qr_code_path'] = $this->qrCode->store('gifts', 'public');
        }

        if ($this->editingId) {
            $this->invitation?->gifts()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->gifts()->create($data);
        }

        $this->dispatch('toast', message: 'Hadiah tersimpan.', type: 'success');
        $this->cancel();
    }

    public function delete(int $id): void
    {
        $this->invitation?->gifts()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Hadiah dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->providerName = '';
        $this->accountNumber = '';
        $this->accountName = '';
        $this->qrCode = null;
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
                <h1 class="text-2xl font-semibold tracking-tight">Hadiah</h1>
                <p class="text-sm text-muted-foreground">Rekening dan QR code untuk amplop digital.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Hadiah
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Hadiah' : 'Tambah Hadiah' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Rekening dan QR code untuk amplop digital.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="providerName">Penyedia / Bank</x-ui.label>
                            <x-ui.input wire:model="providerName" id="providerName" type="text" required placeholder="BCA, OVO, DANA..." />
                            @error('providerName')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="accountName">Atas Nama</x-ui.label>
                            <x-ui.input wire:model="accountName" id="accountName" type="text" required />
                            @error('accountName')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="accountNumber">Nomor Rekening</x-ui.label>
                        <x-ui.input wire:model="accountNumber" id="accountNumber" type="text" required />
                        @error('accountNumber')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="qrCode">Gambar QR Code</x-ui.label>
                        @if ($this->qrCode)
                            <img src="{{ $this->qrCode->temporaryUrl() }}" alt="Pratinjau QR" class="h-32 w-32 rounded-md border object-cover" />
                        @endif
                        <x-ui.input wire:model="qrCode" id="qrCode" type="file" accept="image/*" />
                        @error('qrCode')
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
                            <th class="px-4 py-3">Penyedia</th>
                            <th class="px-4 py-3">Atas Nama</th>
                            <th class="px-4 py-3">Nomor</th>
                            <th class="px-4 py-3">QR</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->gifts as $gift)
                            <tr wire:key="gf-{{ $gift->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3 font-medium">{{ $gift->provider_name }}</td>
                                <td class="px-4 py-3">{{ $gift->account_name }}</td>
                                <td class="px-4 py-3 text-muted-foreground">{{ $gift->account_number }}</td>
                                <td class="px-4 py-3">
                                    @if ($gift->qr_code_path)
                                        <img src="{{ asset('storage/'.$gift->qr_code_path) }}" alt="QR" class="h-10 w-10 rounded border object-cover" />
                                    @else
                                        <span class="text-muted-foreground">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $gift->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus hadiah ini?')"
                                            x-on:click="__confirm('delete', {{ $gift->id }})"
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
                                <td colspan="5" class="px-4 py-10 text-center text-muted-foreground">Belum ada data hadiah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
