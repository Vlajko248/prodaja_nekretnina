<?php

use App\Models\Agent;
use App\Models\Kupac;
use App\Models\Nekretnina;
use App\Models\Prodaja;
use App\Models\User;
use Illuminate\Support\Carbon;

it('can create a new prodaja (sale)', function () {
    // Create required relationships
    $nekretnina = Nekretnina::factory()->create(['status' => 'slobodno']);
    $kupac = Kupac::factory()->create();
    $agent = Agent::factory()->create();
    $user = User::factory()->create();

    // Simulate authenticated request
    $this->actingAs($user);

    // Create prodaja
    $response = $this->post(route('prodaja.store'), [
        'nekretnina_id' => $nekretnina->id,
        'kupac_id' => $kupac->id,
        'agent_id' => $agent->id,
        'status' => 'nacrt',
        'datum_kreiranja' => Carbon::today()->toDateString(),
    ]);

    // Assert that prodaja was created
    $this->assertDatabaseHas('prodajas', [
        'nekretnina_id' => $nekretnina->id,
        'kupac_id' => $kupac->id,
        'agent_id' => $agent->id,
        'status' => 'nacrt',
    ]);

    // Assert redirect to index
    $response->assertRedirectToRoute('prodaja.index');
});

it('can update prodaja status from draft to reserved', function () {
    // Create a prodaja with draft status
    $prodaja = Prodaja::factory()->create(['status' => 'nacrt']);
    $user = User::factory()->create();

    // Simulate authenticated request
    $this->actingAs($user);

    // Update prodaja status to reserved
    $response = $this->patch(route('prodaja.update', $prodaja), [
        'nekretnina_id' => $prodaja->nekretnina_id,
        'kupac_id' => $prodaja->kupac_id,
        'agent_id' => $prodaja->agent_id,
        'status' => 'rezervisana',
        'datum_kreiranja' => $prodaja->datum_kreiranja,
    ]);

    // Assert that status was updated
    $this->assertDatabaseHas('prodajas', [
        'id' => $prodaja->id,
        'status' => 'rezervisana',
    ]);

    // Assert redirect to index
    $response->assertRedirectToRoute('prodaja.index');
});

it('can view all prodajas', function () {
    $user = User::factory()->create();
    Prodaja::factory(5)->create();

    $this->actingAs($user);

    $response = $this->get(route('prodaja.index'));

    $response->assertStatus(200);
    $response->assertViewHas('prodaje');
    $this->assertCount(5, Prodaja::all());
});

it('can delete a prodaja', function () {
    $prodaja = Prodaja::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->delete(route('prodaja.destroy', $prodaja));

    $this->assertDatabaseMissing('prodajas', [
        'id' => $prodaja->id,
    ]);

    $response->assertRedirectToRoute('prodaja.index');
});
