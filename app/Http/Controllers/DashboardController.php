<?php

namespace App\Http\Controllers;

use App\Models\Kupac;
use App\Models\Nekretnina;
use App\Models\Prodaja;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $kupciUkupno = Kupac::count();

        $nekretnineUkupno = Nekretnina::count();
        $nekretnineSlobodno = Nekretnina::where('status', 'slobodno')->count();
        $nekretnineRezervisano = Nekretnina::where('status', 'rezervisano')->count();
        $nekretnineProdato = Nekretnina::where('status', 'prodato')->count();

        $prodajeUkupno = Prodaja::count();
        $prodajeNacrt = Prodaja::where('status', 'nacrt')->count();
        $prodajeRezervisano = Prodaja::where('status', 'rezervisana')->count();
        $prodajeZavrseno = Prodaja::where('status', 'završena')->count();
        $prodajeOtkazana = Prodaja::where('status', 'otkazana')->count();

        // Prihod = suma cena nekretnina za prodaje koje su završene
        $prihodUkupno = Prodaja::query()
            ->where('prodajas.status', 'završena')
            ->join('nekretninas', 'prodajas.nekretnina_id', '=', 'nekretninas.id')
            ->sum('nekretninas.cena');

        // poslednjih 5 prodaja za prikaz na dashboardu (ako imas relacije u modelima)
        $poslednjeProdaje = Prodaja::with(['kupac', 'agent', 'nekretnina'])
            ->orderByDesc('id')
            ->take(5)
            ->get();

        // Sales funnel - vrijednosti prodaja po statusima
        $funnelNacrt = Prodaja::where('prodajas.status', 'nacrt')
            ->join('nekretninas', 'prodajas.nekretnina_id', '=', 'nekretninas.id')
            ->sum('nekretninas.cena');
        
        $funnelRezervisana = Prodaja::where('prodajas.status', 'rezervisana')
            ->join('nekretninas', 'prodajas.nekretnina_id', '=', 'nekretninas.id')
            ->sum('nekretninas.cena');
        
        $funnelZavrsena = Prodaja::where('prodajas.status', 'završena')
            ->join('nekretninas', 'prodajas.nekretnina_id', '=', 'nekretninas.id')
            ->sum('nekretninas.cena');
        
        $funnelOtkazana = Prodaja::where('prodajas.status', 'otkazana')
            ->join('nekretninas', 'prodajas.nekretnina_id', '=', 'nekretninas.id')
            ->sum('nekretninas.cena');

        return view('dashboard', compact(
            'kupciUkupno',
            'nekretnineUkupno', 'nekretnineSlobodno', 'nekretnineRezervisano', 'nekretnineProdato',
            'prodajeUkupno', 'prodajeNacrt', 'prodajeRezervisano', 'prodajeZavrseno', 'prodajeOtkazana',
            'prihodUkupno',
            'poslednjeProdaje',
            'funnelNacrt', 'funnelRezervisana', 'funnelZavrsena', 'funnelOtkazana'
        ));
    }
}
