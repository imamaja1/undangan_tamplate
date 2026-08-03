<?php

namespace App\Livewire\LandingPage;

use App\Models\Invitation;
use Livewire\Component;
use Livewire\Attributes\On;

class WishesList extends Component
{
    public Invitation $invitation;
    public int $limit = 5;

    public function loadMore(): void
    {
        $this->limit += 10;
    }

    #[On('rsvp-submitted')]
    public function refreshList(): void
    {
        // Calling this empty method triggers a re-render to fetch new data
    }

    public function render()
    {
        $wishes = $this->invitation->rsvps()
            ->whereNotNull('message')
            ->where('message', '!=', '')
            ->orderByDesc('created_at')
            ->limit($this->limit)
            ->get();
            
        $totalWishes = $this->invitation->rsvps()
            ->whereNotNull('message')
            ->where('message', '!=', '')
            ->count();

        return view('livewire.landing-page.wishes-list', [
            'wishes' => $wishes,
            'totalWishes' => $totalWishes,
        ]);
    }
}
