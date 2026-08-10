<?php

namespace App\Livewire\LandingPage;

use App\Models\Invitation;
use App\Models\Rsvp;
use Livewire\Component;

class RsvpForm extends Component
{
    public Invitation $invitation;

    public string $name = '';
    public string $status = 'attending';
    public int $pax = 1;
    public string $message = '';
    public string $theme = 'template-1';
    
    public bool $isSubmitted = false;

    public function mount(Invitation $invitation): void
    {
        $this->invitation = $invitation;
        
        $to = request()->query('to');
        if ($to) {
            $this->name = $to;
        }
    }

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:attending,declined'],
            'pax' => ['required', 'integer', 'min:1', 'max:10'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $this->invitation->rsvps()->create($validated);

        $this->isSubmitted = true;
        
        $this->dispatch('toast', message: 'Terima kasih atas konfirmasi Anda!', type: 'success');
        $this->dispatch('rsvp-submitted');
    }

    public function render()
    {
        return view('livewire.landing-page.rsvp-form');
    }
}
