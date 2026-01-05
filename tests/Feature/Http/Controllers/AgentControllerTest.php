<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AgentController
 */
final class AgentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $agents = Agent::factory()->count(3)->create();

        $response = $this->get(route('agents.index'));

        $response->assertOk();
        $response->assertViewIs('agent.index');
        $response->assertViewHas('agents', $agents);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('agents.create'));

        $response->assertOk();
        $response->assertViewIs('agent.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AgentController::class,
            'store',
            \App\Http\Requests\AgentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $ime = fake()->word();
        $prezime = fake()->word();
        $email = fake()->safeEmail();

        $response = $this->post(route('agents.store'), [
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
        ]);

        $agents = Agent::query()
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('email', $email)
            ->get();
        $this->assertCount(1, $agents);
        $agent = $agents->first();

        $response->assertRedirect(route('agents.index'));
        $response->assertSessionHas('agent.id', $agent->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->get(route('agents.show', $agent));

        $response->assertOk();
        $response->assertViewIs('agent.show');
        $response->assertViewHas('agent', $agent);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->get(route('agents.edit', $agent));

        $response->assertOk();
        $response->assertViewIs('agent.edit');
        $response->assertViewHas('agent', $agent);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AgentController::class,
            'update',
            \App\Http\Requests\AgentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $agent = Agent::factory()->create();
        $ime = fake()->word();
        $prezime = fake()->word();
        $email = fake()->safeEmail();

        $response = $this->put(route('agents.update', $agent), [
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
        ]);

        $agent->refresh();

        $response->assertRedirect(route('agents.index'));
        $response->assertSessionHas('agent.id', $agent->id);

        $this->assertEquals($ime, $agent->ime);
        $this->assertEquals($prezime, $agent->prezime);
        $this->assertEquals($email, $agent->email);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->delete(route('agents.destroy', $agent));

        $response->assertRedirect(route('agents.index'));

        $this->assertModelMissing($agent);
    }
}
