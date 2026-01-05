<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Nekretnina;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NekretninaController
 */
final class NekretninaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $nekretninas = Nekretnina::factory()->count(3)->create();

        $response = $this->get(route('nekretninas.index'));

        $response->assertOk();
        $response->assertViewIs('nekretnina.index');
        $response->assertViewHas('nekretninas', $nekretninas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('nekretninas.create'));

        $response->assertOk();
        $response->assertViewIs('nekretnina.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NekretninaController::class,
            'store',
            \App\Http\Requests\NekretninaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $oznaka = fake()->word();
        $povrsina_m2 = fake()->randomFloat(/** decimal_attributes **/);
        $cena = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->word();

        $response = $this->post(route('nekretninas.store'), [
            'oznaka' => $oznaka,
            'povrsina_m2' => $povrsina_m2,
            'cena' => $cena,
            'status' => $status,
        ]);

        $nekretninas = Nekretnina::query()
            ->where('oznaka', $oznaka)
            ->where('povrsina_m2', $povrsina_m2)
            ->where('cena', $cena)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $nekretninas);
        $nekretnina = $nekretninas->first();

        $response->assertRedirect(route('nekretninas.index'));
        $response->assertSessionHas('nekretnina.id', $nekretnina->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $nekretnina = Nekretnina::factory()->create();

        $response = $this->get(route('nekretninas.show', $nekretnina));

        $response->assertOk();
        $response->assertViewIs('nekretnina.show');
        $response->assertViewHas('nekretnina', $nekretnina);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $nekretnina = Nekretnina::factory()->create();

        $response = $this->get(route('nekretninas.edit', $nekretnina));

        $response->assertOk();
        $response->assertViewIs('nekretnina.edit');
        $response->assertViewHas('nekretnina', $nekretnina);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NekretninaController::class,
            'update',
            \App\Http\Requests\NekretninaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $nekretnina = Nekretnina::factory()->create();
        $oznaka = fake()->word();
        $povrsina_m2 = fake()->randomFloat(/** decimal_attributes **/);
        $cena = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->word();

        $response = $this->put(route('nekretninas.update', $nekretnina), [
            'oznaka' => $oznaka,
            'povrsina_m2' => $povrsina_m2,
            'cena' => $cena,
            'status' => $status,
        ]);

        $nekretnina->refresh();

        $response->assertRedirect(route('nekretninas.index'));
        $response->assertSessionHas('nekretnina.id', $nekretnina->id);

        $this->assertEquals($oznaka, $nekretnina->oznaka);
        $this->assertEquals($povrsina_m2, $nekretnina->povrsina_m2);
        $this->assertEquals($cena, $nekretnina->cena);
        $this->assertEquals($status, $nekretnina->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $nekretnina = Nekretnina::factory()->create();

        $response = $this->delete(route('nekretninas.destroy', $nekretnina));

        $response->assertRedirect(route('nekretninas.index'));

        $this->assertModelMissing($nekretnina);
    }
}
