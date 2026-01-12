@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Lista prodaja</h1>
    <a href="{{ route('prodaja.create') }}" class="btn btn-primary">Nova prodaja</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kupac</th>
                        <th>Nekretnina</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Datum prodaje</th>
                        <th class="text-end">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($prodaje as $p)
                    <tr>
                        <td>{{ $p->kupac?->ime }} {{ $p->kupac?->prezime }}</td>
                        <td>{{ $p->nekretnina?->oznaka }}</td>
                        <td>{{ $p->agent?->ime }} {{ $p->agent?->prezime }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->datum_kreiranja }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('prodaja.show', $p) }}">Prikaži</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('prodaja.edit', $p) }}">Izmeni</a>
                            <form class="d-inline" method="POST" action="{{ route('prodaja.destroy', $p) }}"
                                  onsubmit="return confirm('Obrisati prodaju?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4">Nema prodaja.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
