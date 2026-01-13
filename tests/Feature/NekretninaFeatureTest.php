<?php

use App\Models\Nekretnina;
use App\Models\Prodaja;
use App\Models\User;

it('can create a new nekretnina (property)', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post(route('nekretnina.store'), [
        'oznaka' => 'NEK-001',
        'povrsina_m2' => 120.5,
        'cena' => 250000.00,
        'status' => 'slobodno',
    ]);

    $this->assertDatabaseHas('nekretninas', [
        'oznaka' => 'NEK-001',
        'povrsina_m2' => 120.5,
        'cena' => 250000.00,
        'status' => 'slobodno',
    ]);

    $response->assertRedirectToRoute('nekretnina.index');
});

it('can update nekretnina status from available to reserved', function () {
    $nekretnina = Nekretnina::factory()->create(['status' => 'slobodno']);
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->patch(route('nekretnina.update', $nekretnina), [
        'oznaka' => $nekretnina->oznaka,
        'povrsina_m2' => $nekretnina->povrsina_m2,
        'cena' => $nekretnina->cena,
        'status' => 'rezervisano',
    ]);

    $this->assertDatabaseHas('nekretninas', [
        'id' => $nekretnina->id,
        'status' => 'rezervisano',
    ]);

    $response->assertRedirectToRoute('nekretnina.index');
});

it('cancels all draft prodajas when nekretnina is reserved', function () {
    // Create a nekretnina and multiple draft sales
    $nekretnina = Nekretnina::factory()->create(['status' => 'slobodno']);
    $prodaja1 = Prodaja::factory()->create(['nekretnina_id' => $nekretnina->id, 'status' => 'nacrt']);
    $prodaja2 = Prodaja::factory()->create(['nekretnina_id' => $nekretnina->id, 'status' => 'nacrt']);
    $prodaja3 = Prodaja::factory()->create(['nekretnina_id' => $nekretnina->id, 'status' => 'rezervisana']); // not draft
    
    $user = User::factory()->create();
    $this->actingAs($user);

    // Update nekretnina to reserved
    $this->patch(route('nekretnina.update', $nekretnina), [
        'oznaka' => $nekretnina->oznaka,
        'povrsina_m2' => $nekretnina->povrsina_m2,
        'cena' => $nekretnina->cena,
        'status' => 'rezervisano',
    ]);

    // Assert draft prodajas are now canceled
    $this->assertDatabaseHas('prodajas', [
        'id' => $prodaja1->id,
        'status' => 'otkazana',
    ]);
    $this->assertDatabaseHas('prodajas', [
        'id' => $prodaja2->id,
        'status' => 'otkazana',
    ]);
    // Assert reserved prodaja stays unchanged
    $this->assertDatabaseHas('prodajas', [
        'id' => $prodaja3->id,
        'status' => 'rezervisana',
    ]);
});

it('can list all properties grouped by status', function () {
    $user = User::factory()->create();
    Nekretnina::factory(3)->create(['status' => 'slobodno']);
    Nekretnina::factory(2)->create(['status' => 'rezervisano']);
    Nekretnina::factory(1)->create(['status' => 'prodato']);

    $this->actingAs($user);

    $response = $this->get(route('nekretnina.index'));

    $response->assertStatus(200);
    $response->assertViewHas('nekretnine');
    $this->assertCount(6, Nekretnina::all());
});

it('can delete a nekretnina', function () {
    $nekretnina = Nekretnina::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->delete(route('nekretnina.destroy', $nekretnina));

    $this->assertDatabaseMissing('nekretninas', [
        'id' => $nekretnina->id,
    ]);

    $response->assertRedirectToRoute('nekretnina.index');
});
