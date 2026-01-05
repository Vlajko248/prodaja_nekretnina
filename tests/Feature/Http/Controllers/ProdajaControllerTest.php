<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Agent;
use App\Models\Kupac;
use App\Models\Nekretnina;
use App\Models\Prodaja;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProdajaController
 */
final class ProdajaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $prodajas = Prodaja::factory()->count(3)->create();

        $response = $this->get(route('prodajas.index'));

        $response->assertOk();
        $response->assertViewIs('prodaja.index');
        $response->assertViewHas('prodajas', $prodajas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('prodajas.create'));

        $response->assertOk();
        $response->assertViewIs('prodaja.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProdajaController::class,
            'store',
            \App\Http\Requests\ProdajaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $kupac = Kupac::factory()->create();
        $agent = Agent::factory()->create();
        $nekretnina = Nekretnina::factory()->create();
        $datum_kreiranja = Carbon::parse(fake()->date());
        $status = fake()->word();

        $response = $this->post(route('prodajas.store'), [
            'kupac_id' => $kupac->id,
            'agent_id' => $agent->id,
            'nekretnina_id' => $nekretnina->id,
            'datum_kreiranja' => $datum_kreiranja->toDateString(),
            'status' => $status,
        ]);

        $prodajas = Prodaja::query()
            ->where('kupac_id', $kupac->id)
            ->where('agent_id', $agent->id)
            ->where('nekretnina_id', $nekretnina->id)
            ->where('datum_kreiranja', $datum_kreiranja)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $prodajas);
        $prodaja = $prodajas->first();

        $response->assertRedirect(route('prodajas.index'));
        $response->assertSessionHas('prodaja.id', $prodaja->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $prodaja = Prodaja::factory()->create();

        $response = $this->get(route('prodajas.show', $prodaja));

        $response->assertOk();
        $response->assertViewIs('prodaja.show');
        $response->assertViewHas('prodaja', $prodaja);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $prodaja = Prodaja::factory()->create();

        $response = $this->get(route('prodajas.edit', $prodaja));

        $response->assertOk();
        $response->assertViewIs('prodaja.edit');
        $response->assertViewHas('prodaja', $prodaja);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProdajaController::class,
            'update',
            \App\Http\Requests\ProdajaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $prodaja = Prodaja::factory()->create();
        $kupac = Kupac::factory()->create();
        $agent = Agent::factory()->create();
        $nekretnina = Nekretnina::factory()->create();
        $datum_kreiranja = Carbon::parse(fake()->date());
        $status = fake()->word();

        $response = $this->put(route('prodajas.update', $prodaja), [
            'kupac_id' => $kupac->id,
            'agent_id' => $agent->id,
            'nekretnina_id' => $nekretnina->id,
            'datum_kreiranja' => $datum_kreiranja->toDateString(),
            'status' => $status,
        ]);

        $prodaja->refresh();

        $response->assertRedirect(route('prodajas.index'));
        $response->assertSessionHas('prodaja.id', $prodaja->id);

        $this->assertEquals($kupac->id, $prodaja->kupac_id);
        $this->assertEquals($agent->id, $prodaja->agent_id);
        $this->assertEquals($nekretnina->id, $prodaja->nekretnina_id);
        $this->assertEquals($datum_kreiranja, $prodaja->datum_kreiranja);
        $this->assertEquals($status, $prodaja->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $prodaja = Prodaja::factory()->create();

        $response = $this->delete(route('prodajas.destroy', $prodaja));

        $response->assertRedirect(route('prodajas.index'));

        $this->assertModelMissing($prodaja);
    }
}
