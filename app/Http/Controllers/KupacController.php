<?php

namespace App\Http\Controllers;

use App\Http\Requests\KupacStoreRequest;
use App\Http\Requests\KupacUpdateRequest;
use App\Models\Kupac;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * KupacController
 *
 * Handles CRUD operations for buyers (kupci).
 * Views: kupci.index, kupci.create, kupci.show, kupci.edit
 * Routes (resource): kupac.index, kupac.create, kupac.store, kupac.show, kupac.edit, kupac.update, kupac.destroy
 */
class KupacController extends Controller
{
    /**
     * Display a listing of buyers.
     * Route: kupac.index
     */
    public function index(Request $request): View
    {
        $kupacs = Kupac::all();

        return view('kupci.index', [
            'kupacs' => $kupacs,
        ]);
    }

    /**
     * Show the form for creating a new buyer.
     * Route: kupac.create
     */
    public function create(Request $request): View
    {
        return view('kupci.create');
    }

    /**
     * Store a newly created buyer in storage.
     * Route: kupac.store
     *
     * @param  KupacStoreRequest  $request  Validated buyer data
     * @return RedirectResponse Redirect to kupac.index with success message
     */
    public function store(KupacStoreRequest $request): RedirectResponse
    {
        $kupac = Kupac::create($request->validated());

        $request->session()->flash('kupac.id', $kupac->id);

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno dodat.');
    }

    /**
     * Display the specified buyer.
     * Route: kupac.show
     */
    public function show(Request $request, Kupac $kupac): View
    {
        return view('kupci.show', [
            'kupac' => $kupac,
        ]);
    }

    /**
     * Show the form for editing the specified buyer.
     * Route: kupac.edit
     */
    public function edit(Request $request, Kupac $kupac): View
    {
        return view('kupci.edit', [
            'kupac' => $kupac,
        ]);
    }

    /**
     * Update the specified buyer in storage.
     * Route: kupac.update
     *
     * @param  KupacUpdateRequest  $request  Validated buyer data
     * @return RedirectResponse Redirect to kupac.index with success message
     */
    public function update(KupacUpdateRequest $request, Kupac $kupac): RedirectResponse
    {
        $kupac->update($request->validated());

        $request->session()->flash('kupac.id', $kupac->id);

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno izmenjen.');
    }

    /**
     * Remove the specified buyer from storage.
     * Route: kupac.destroy
     *
     * @return RedirectResponse Redirect to kupac.index with success message
     */
    public function destroy(Request $request, Kupac $kupac): RedirectResponse
    {
        $kupac->delete();

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno obrisan');
    }
}
