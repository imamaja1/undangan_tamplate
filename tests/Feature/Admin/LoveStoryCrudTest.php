<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\LoveStory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoveStoryCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_a_love_story(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.love-story')
            ->set('title', 'Pertama Bertemu')
            ->set('date', '2023-01-15')
            ->set('description', 'Kami bertemu di sebuah acara.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('love_stories', [
            'invitation_id' => $invitation->id,
            'title' => 'Pertama Bertemu',
        ]);

        $story = LoveStory::where('invitation_id', $invitation->id)->firstOrFail();
        $this->assertSame('2023-01-15', $story->date->format('Y-m-d'));
    }

    public function test_user_can_update_a_love_story(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $story = LoveStory::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.love-story')
            ->call('edit', $story->id)
            ->set('title', 'Lamaran')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('love_stories', [
            'id' => $story->id,
            'title' => 'Lamaran',
        ]);
    }

    public function test_user_can_delete_a_love_story(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $story = LoveStory::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.love-story')
            ->call('delete', $story->id);

        $this->assertDatabaseMissing('love_stories', ['id' => $story->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.love-story')
            ->set('title', '')
            ->set('date', '')
            ->set('description', '')
            ->call('save')
            ->assertHasErrors(['title', 'date', 'description']);
    }
}
