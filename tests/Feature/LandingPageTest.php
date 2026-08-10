<?php

namespace Tests\Feature;

use App\Models\BrideGroom;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_without_invitation(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('You Are Invited');
        $response->assertSee('Open Invitation');
    }

    public function test_landing_page_shows_bride_and_groom_names(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Sarah Amelia');
        $response->assertSee('James Pratama');
    }

    public function test_landing_page_shows_countdown_for_main_event(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        Event::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'akad',
            'event_date' => now()->addDays(45)->format('Y-m-d'),
            'start_time' => '09:00',
            'is_main_event' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Days');
        $response->assertSee('Hours');
        $response->assertSee('Mins');
        $response->assertSee('countdown(');
    }

    public function test_landing_page_shows_opening_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Assalamu');
        $response->assertSee('Dengan memohon rahmat');
        $response->assertSee('Kepada Yth.');
        $response->assertSee('Mohon maaf apabila ada kesalahan penulisan nama/gelar');
    }

    public function test_landing_page_uses_guest_name_from_query(): void
    {
        $response = $this->get('/?to=Bapak Ahmad');

        $response->assertOk();
        $response->assertSee('Bapak Ahmad');
    }

    public function test_landing_page_shows_monogram_from_names(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('S & J');
    }

    public function test_landing_page_shows_bride_groom_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="bride-groom"', false);
        $response->assertSee('Putra dari');
        $response->assertSee('Putri dari');
    }

    public function test_landing_page_shows_bride_groom_names_and_parents(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
            'nickname' => 'Sarah',
            'father_name' => 'H. Ahmad',
            'mother_name' => 'Hj. Siti',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
            'nickname' => 'Muhammad',
            'father_name' => 'Yusuf',
            'mother_name' => 'Aminah',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Muhammad');
        $response->assertSee('Sarah');
        $response->assertSee('Bapak Yusuf & Ibu Aminah');
        $response->assertSee('Bapak H. Ahmad & Ibu Hj. Siti');
    }

    public function test_landing_page_shows_couple_portraits_in_bride_groom_section(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
            'photo_path' => 'bride-grooms/sarah.jpg',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
            'photo_path' => 'bride-grooms/james.jpg',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('bride-grooms/sarah.jpg');
        $response->assertSee('bride-grooms/james.jpg');
        $response->assertSee('Foto mempelai wanita');
        $response->assertSee('Foto mempelai pria');
    }

    public function test_template_2_loads_livewire_script_without_script_config(): void
    {
        $user = User::factory()->create();
        Invitation::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/?template=template-2');

        $response->assertOk();
        $response->assertSee('livewire.js', false);
        $response->assertSee('wire:snapshot', false);
        $response->assertDontSee('livewireScriptConfig');
        $response->assertDontSee('javascript:void');
    }

    public function test_rsvp_form_submits_via_livewire(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        Livewire::test('landing-page.rsvp-form', ['invitation' => $invitation, 'theme' => 'template-2'])
            ->set('name', 'Bapak Ahmad')
            ->set('status', 'attending')
            ->set('pax', 2)
            ->set('message', 'Selamat menempuh hidup baru!')
            ->call('submit')
            ->assertSet('isSubmitted', true)
            ->assertDispatched('rsvp-submitted');

        $this->assertDatabaseHas('rsvps', [
            'invitation_id' => $invitation->id,
            'name' => 'Bapak Ahmad',
            'status' => 'attending',
            'pax' => 2,
            'message' => 'Selamat menempuh hidup baru!',
        ]);
    }

    public function test_wishes_list_refreshes_on_rsvp_submitted_event(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $component = Livewire::test('landing-page.wishes-list', ['invitation' => $invitation, 'theme' => 'template-2'])
            ->assertSee('Belum ada ucapan');

        $invitation->rsvps()->create([
            'name' => 'Ibu Siti',
            'status' => 'attending',
            'pax' => 1,
            'message' => 'Barakallahu lakuma!',
        ]);

        $component->dispatch('rsvp-submitted')
            ->assertSee('Ibu Siti')
            ->assertSee('Barakallahu lakuma!');
    }

    public function test_template_2_gallery_opens_lightbox(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        Gallery::factory()->create([
            'invitation_id' => $invitation->id,
            'file_path' => 'galleries/images/foto-1.jpg',
        ]);
        Gallery::factory()->create([
            'invitation_id' => $invitation->id,
            'file_path' => 'galleries/images/foto-2.jpg',
        ]);

        $response = $this->get('/?template=template-2');

        $response->assertOk();
        $response->assertSee('Galeri Prewedding');
        $response->assertSee('lightboxIndex: null', false);
        $response->assertSee("photos: ['", false);
        $response->assertSee('max-w-md mx-auto relative w-full', false);
        $response->assertSee('@click="open(0)"', false);
        $response->assertSee('@click="open(1)"', false);
        $response->assertSee('galleries/images/foto-1.jpg', false);
        $response->assertSee('galleries/images/foto-2.jpg', false);
        $response->assertSee('@keydown.escape.window="close()"', false);
        $response->assertSee('@keydown.left.window="prev()"', false);
        $response->assertSee('@keydown.right.window="next()"', false);
        $response->assertSee('@touchstart.passive="touchStart($event)"', false);
        $response->assertSee('@touchend.passive="touchEnd($event)"', false);
        $response->assertDontSee('x-teleport="body"', false);
        $response->assertSee('x-show="lightboxIndex !== null"', false);
        $response->assertSee(':src="photos[lightboxIndex] ?? \'\'"', false);
        $response->assertSee('aria-label="Foto sebelumnya"', false);
        $response->assertSee('aria-label="Foto berikutnya"', false);
        $response->assertSee('x-text="(lightboxIndex ?? 0) + 1"', false);
    }
}
