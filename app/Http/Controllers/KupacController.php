<?php

namespace App\Http\Controllers;

use App\Http\Requests\KupacStoreRequest;
use App\Http\Requests\KupacUpdateRequest;
use App\Models\Kupac;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KupacController extends Controller
{
    public function index(Request $request): View
    {
        $kupacs = Kupac::all();

        return view('kupci.index', [
            'kupacs' => $kupacs,
        ]);
    }

    public function create(Request $request): View
    {
        return view('kupci.create');
    }

    public function store(KupacStoreRequest $request): RedirectResponse
    {
        $kupac = Kupac::create($request->validated());

        $request->session()->flash('kupac.id', $kupac->id);

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno dodat.');
    }

    public function show(Request $request, Kupac $kupac): View
    {
        return view('kupci.show', [
            'kupac' => $kupac,
        ]);
    }

    public function edit(Request $request, Kupac $kupac): View
    {
        return view('kupci.edit', [
            'kupac' => $kupac,
        ]);
    }

    public function update(KupacUpdateRequest $request, Kupac $kupac): RedirectResponse
    {
        $kupac->update($request->validated());

        $request->session()->flash('kupac.id', $kupac->id);

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno izmenjen.');
    }

    public function destroy(Request $request, Kupac $kupac): RedirectResponse
    {
        $kupac->delete();

        return redirect()->route('kupac.index')->with('success', 'Kupac je uspešno obrisan');
    }
}
