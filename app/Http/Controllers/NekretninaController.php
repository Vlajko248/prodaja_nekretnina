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
    public function index(Request $request): View
    {
        $status = $request->query('status'); // slobodna|rezervisano|prodata|null

        $query = Nekretnina::query();

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $nekretnine = $query->orderBy('id', 'desc')->get();

        return view('nekretnine.index', [
            'nekretnine' => $nekretnine,
            'status' => $status,
        ]);
    }
    

    public function create(Request $request): View
    {
        return view('nekretnine.create');
    }

public function store(NekretninaStoreRequest $request): RedirectResponse
{
    $nekretnina = Nekretnina::create($request->validated());
    $request->session()->flash('nekretnina.id', $nekretnina->id);

        return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno dodata.');
}

public function show(Request $request, Nekretnina $nekretnina): View
{
    return view('nekretnine.show', compact('nekretnina'));
}

public function edit(Request $request, Nekretnina $nekretnina): View
{
    return view('nekretnine.edit', compact('nekretnina'));
}

public function update(NekretninaUpdateRequest $request, Nekretnina $nekretnina): RedirectResponse
{
    $nekretnina->update($request->validated());
    $request->session()->flash('nekretnina.id', $nekretnina->id);

    return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno izmenjena.');
}

public function destroy(Request $request, Nekretnina $nekretnina): RedirectResponse
{
    $nekretnina->delete();
    return redirect()->route('nekretnina.index')->with('success', 'Nekretnina je uspešno obrisana.');
}

}
