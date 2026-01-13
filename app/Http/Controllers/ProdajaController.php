<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdajaStoreRequest;
use App\Http\Requests\ProdajaUpdateRequest;
use App\Models\Agent;
use App\Models\Kupac;
use App\Models\Nekretnina;
use App\Models\Prodaja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

/**
 * ProdajaController
 *
 * Manages sales (prodaje) lifecycle: create, edit, update, delete.
 * Implements status workflow: 'nacrt' → 'rezervisana' → 'završena' (or 'otkazana').
 * Views: prodaje.index, prodaje.create, prodaje.show, prodaje.edit
 * Routes (resource): prodaja.index, prodaja.create, prodaja.store, prodaja.show, prodaja.edit, prodaja.update, prodaja.destroy
 */
class ProdajaController extends Controller
{
    private array $statusi = ['nacrt', 'rezervisana', 'završena', 'otkazana'];

    /**
     * Display a listing of sales with related models eager loaded.
     * Route: prodaja.index
     */
    public function index(Request $request): View
    {
        $prodaje = Prodaja::with(['kupac', 'agent', 'nekretnina'])
            ->orderByDesc('id')
            ->get();

        return view('prodaje.index', [
            'prodaje' => $prodaje,
        ]);
    }

    /**
     * Show the form for creating a new sale.
     * Provides lists of kupci, agenti, nekretnine and allowed statusi.
     * Route: prodaja.create
     */
    public function create(Request $request): View
    {
        return view('prodaje.create', [
            'kupci' => Kupac::orderBy('prezime')->orderBy('ime')->get(),
            'agenti' => Agent::orderBy('prezime')->orderBy('ime')->get(),
            'nekretnine' => Nekretnina::where('status', 'slobodno')->orderBy('oznaka')->get(),
            'statusi' => $this->statusi,
        ]);
    }

    /**
     * Store a newly created sale.
     * Applies defaults and enforces allowed statuses.
     * When creating a sale, if status is 'rezervisana', sets nekretnina status to 'rezervisano'.
     * Route: prodaja.store
     *
     * @param  ProdajaStoreRequest  $request  Validated data (kupac_id, agent_id, nekretnina_id, datum_kreiranja, status)
     * @return RedirectResponse Redirect to prodaja.index with success message
     */
    public function store(ProdajaStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // defaulti
        $data['status'] = $data['status'] ?? 'nacrt';
        $data['datum_kreiranja'] = $data['datum_kreiranja'] ?? Carbon::today()->toDateString();

        // ako želiš da forsiraš statuse na dozvoljene:
        if (! in_array($data['status'], $this->statusi, true)) {
            $data['status'] = 'nacrt';
        }

        // Ako je prodaja 'rezervisana', ažuriramo status nekretnine na 'rezervisano'
        if ($data['status'] === 'rezervisana') {
            Nekretnina::findOrFail($data['nekretnina_id'])->update([
                'status' => 'rezervisano',
            ]);
        }

        Prodaja::create($data);

        return redirect()->route('prodaja.index')->with('success', 'Prodaja je uspešno kreirana.');
    }

    /**
     * Display the specified sale with relations.
     * Route: prodaja.show
     */
    public function show(Request $request, Prodaja $prodaja): View
    {
        $prodaja->load(['kupac', 'agent', 'nekretnina']);

        return view('prodaje.show', [
            'prodaja' => $prodaja,
        ]);
    }

    /**
     * Show the form for editing the specified sale.
     * Ensures currently selected nekretnina is included even if not 'slobodno'.
     * Route: prodaja.edit
     */
    public function edit(Request $request, Prodaja $prodaja): View
    {
        // Nekretnine: nudimo slobodne + trenutno izabranu (da edit ne pukne)
        $nekretnine = Nekretnina::where('status', 'slobodno')
            ->orWhere('id', $prodaja->nekretnina_id)
            ->orderBy('oznaka')
            ->get();

        return view('prodaje.edit', [
            'prodaja' => $prodaja,
            'kupci' => Kupac::orderBy('prezime')->orderBy('ime')->get(),
            'agenti' => Agent::orderBy('prezime')->orderBy('ime')->get(),
            'nekretnine' => $nekretnine,
            'statusi' => $this->statusi,
        ]);
    }

    /**
     * Update the specified sale.
     * When sale status changes, automatically updates property (nekretnina) status:
     * - 'nacrt' → nekretnina 'slobodno'
     * - 'rezervisana' → nekretnina 'rezervisano' + cancels all other draft sales
     * - 'završena' → nekretnina 'prodato'
     * - 'otkazana' → nekretnina 'slobodno'
     * Route: prodaja.update
     *
     * @param  ProdajaUpdateRequest  $request  Validated data
     * @return RedirectResponse Redirect to prodaja.index with success message
     */
    public function update(ProdajaUpdateRequest $request, Prodaja $prodaja): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['status']) && ! in_array($data['status'], $this->statusi, true)) {
            unset($data['status']);
        }

        // Ako se status prodaje promenio, ažuriramo status nekretnine
        if (isset($data['status']) && $data['status'] !== $prodaja->status) {
            $statusMap = [
                'nacrt' => 'slobodno',
                'rezervisana' => 'rezervisano',
                'završena' => 'prodato',
                'otkazana' => 'slobodno',
            ];

            $prodaja->nekretnina->update([
                'status' => $statusMap[$data['status']] ?? 'slobodno',
            ]);

            // Ako se prodaja prebaca na 'rezervisana', otkazujemo sve druge 'nacrt' prodaje
            if ($data['status'] === 'rezervisana') {
                Prodaja::where('nekretnina_id', $prodaja->nekretnina_id)
                    ->where('id', '!=', $prodaja->id)
                    ->where('status', 'nacrt')
                    ->update(['status' => 'otkazana']);
            }
        }

        $prodaja->update($data);

        return redirect()->route('prodaja.index')->with('success', 'Prodaja je uspešno izmenjena.');
    }

    /**
     * Remove the specified sale from storage.
     * Route: prodaja.destroy
     *
     * @return RedirectResponse Redirect to prodaja.index with success message
     */
    public function destroy(Request $request, Prodaja $prodaja): RedirectResponse
    {
        $prodaja->delete();

        return redirect()->route('prodaja.index')->with('success', 'Prodaja je obrisana.');
    }
}
