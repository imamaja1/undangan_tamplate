<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use App\Models\WaConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WaConfigTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_wa_config(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test('pages::admin.wa-configs')
            ->set('provider', 'fonnte')
            ->set('apiKey', 'secret-key')
            ->set('messageTemplate', 'Halo {name}, silakan klik {link}')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('wa_configs', [
            'invitation_id' => $invitation->id,
            'provider' => 'fonnte',
            'api_key' => 'secret-key',
            'message_template' => 'Halo {name}, silakan klik {link}',
        ]);
    }

    public function test_user_can_update_an_existing_wa_config(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        $config = WaConfig::factory()->create(['invitation_id' => $invitation->id]);

        $this->actingAs($user);

        Livewire::test('pages::admin.wa-configs')
            ->set('apiKey', 'new-secret')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('wa_configs', [
            'id' => $config->id,
            'api_key' => 'new-secret',
        ]);
    }

    public function test_provider_must_be_valid(): void
    {
        $user = User::factory()->create();
        Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test('pages::admin.wa-configs')
            ->set('provider', 'invalid-provider')
            ->call('save')
            ->assertHasErrors(['provider']);
    }
}
