<?php

namespace Tests\Feature\Admin;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_an_event(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.events')
            ->set('type', 'resepsi')
            ->set('title', 'Resepsi')
            ->set('eventDate', '2026-12-25')
            ->set('startTime', '10:00')
            ->set('locationName', 'Hotel Grand')
            ->set('locationAddress', 'Jl. Merdeka No. 1')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('events', [
            'invitation_id' => $invitation->id,
            'type' => 'resepsi',
            'title' => 'Resepsi',
            'start_time' => '10:00',
        ]);

        $event = Event::where('invitation_id', $invitation->id)->firstOrFail();
        $this->assertSame('2026-12-25', $event->event_date->format('Y-m-d'));
    }

    public function test_user_can_update_an_event(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $event = Event::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.events')
            ->call('edit', $event->id)
            ->set('locationName', 'Hotel Baru')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'location_name' => 'Hotel Baru',
        ]);
    }

    public function test_user_can_delete_an_event(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $event = Event::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.events')
            ->call('delete', $event->id);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.events')
            ->set('type', 'invalid')
            ->call('save')
            ->assertHasErrors(['type', 'title', 'eventDate', 'startTime', 'locationName', 'locationAddress']);
    }
}
