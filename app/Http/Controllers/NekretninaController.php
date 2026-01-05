<?php

namespace App\Http\Controllers;

use App\Http\Requests\NekretninaStoreRequest;
use App\Http\Requests\NekretninaUpdateRequest;
use App\Models\Nekretnina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NekretninaController extends Controller
{
    public function index(Request $request): Response
    {
        $nekretninas = Nekretnina::all();

        return view('nekretnina.index', [
            'nekretninas' => $nekretninas,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('nekretnina.create');
    }

    public function store(NekretninaStoreRequest $request): Response
    {
        $nekretnina = Nekretnina::create($request->validated());

        $request->session()->flash('nekretnina.id', $nekretnina->id);

        return redirect()->route('nekretninas.index');
    }

    public function show(Request $request, Nekretnina $nekretnina): Response
    {
        return view('nekretnina.show', [
            'nekretnina' => $nekretnina,
        ]);
    }

    public function edit(Request $request, Nekretnina $nekretnina): Response
    {
        return view('nekretnina.edit', [
            'nekretnina' => $nekretnina,
        ]);
    }

    public function update(NekretninaUpdateRequest $request, Nekretnina $nekretnina): Response
    {
        $nekretnina->update($request->validated());

        $request->session()->flash('nekretnina.id', $nekretnina->id);

        return redirect()->route('nekretninas.index');
    }

    public function destroy(Request $request, Nekretnina $nekretnina): Response
    {
        $nekretnina->delete();

        return redirect()->route('nekretninas.index');
    }
}
