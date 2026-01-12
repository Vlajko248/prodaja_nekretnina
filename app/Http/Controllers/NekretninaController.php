<?php

namespace App\Http\Controllers;

use App\Http\Requests\NekretninaStoreRequest;
use App\Http\Requests\NekretninaUpdateRequest;
use App\Models\Nekretnina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * NekretninaController
 *
 * Manages CRUD for properties (nekretnine) with optional status filtering.
 * Views: nekretnine.index, nekretnine.create, nekretnine.show, nekretnine.edit
 * Routes (resource): nekretnina.index, nekretnina.create, nekretnina.store, nekretnina.show, nekretnina.edit, nekretnina.update, nekretnina.destroy
 */
class NekretninaController extends Controller
{
    /**
     * Display a listing of properties.
     * Supports filtering by `status` query param (slobodno|rezervisano|prodato).
     * Route: nekretnina.index
     */
    public function index(Request $request): View
    {
        $status = $request->query('status'); // slobodna|rezervisano|prodata|null

        $query = Nekretnina::query();

        if (! empty($status)) {
            $query->where('status', $status);
        }

        $nekretnine = $query->orderBy('id', 'desc')->get();

        return view('nekretnine.index', [
            'nekretnine' => $nekretnine,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new property.
     * Route: nekretnina.create
     */
    public function create(Request $request): View
    {
        return view('nekretnine.create');
    }

    /**
     * Store a newly created property.
     * Route: nekretnina.store
     *
     * @param  NekretninaStoreRequest  $request  Validated data (oznaka, povrsina_m2, cena, status)
     * @return RedirectResponse Redirect to nekretnina.index with success message
     */
    public function store(NekretninaStoreRequest $request): RedirectResponse
    {
        $nekretnina = Nekretnina::create($request->validated());
        $request->session()->flash('nekretnina.id', $nekretnina->id);

        return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno dodata.');
    }

    /**
     * Display the specified property.
     * Route: nekretnina.show
     */
    public function show(Request $request, Nekretnina $nekretnina): View
    {
        return view('nekretnine.show', compact('nekretnina'));
    }

    /**
     * Show the form for editing the specified property.
     * Route: nekretnina.edit
     */
    public function edit(Request $request, Nekretnina $nekretnina): View
    {
        return view('nekretnine.edit', compact('nekretnina'));
    }

    /**
     * Update the specified property.
     * Route: nekretnina.update
     *
     * @param  NekretninaUpdateRequest  $request  Validated data
     * @return RedirectResponse Redirect to nekretnina.index with success message
     */
    public function update(NekretninaUpdateRequest $request, Nekretnina $nekretnina): RedirectResponse
    {
        $nekretnina->update($request->validated());
        $request->session()->flash('nekretnina.id', $nekretnina->id);

        return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno izmenjena.');
    }

    /**
     * Remove the specified property from storage.
     * Route: nekretnina.destroy
     *
     * @return RedirectResponse Redirect to nekretnina.index with success message
     */
    public function destroy(Request $request, Nekretnina $nekretnina): RedirectResponse
    {
        $nekretnina->delete();

        return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno obrisana.');
    }
}
