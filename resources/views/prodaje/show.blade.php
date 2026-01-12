@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="mb-1">Detalji prodaje</h1>
        <div class="text-muted">ID: {{ $prodaja->id }}</div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('prodaja.edit', $prodaja) }}" class="btn btn-outline-primary">Izmeni</a>
        <a href="{{ route('prodaja.index') }}" class="btn btn-secondary">Nazad</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0" style="max-width: 900px;">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="text-muted small">Kupac</div>
                    <div class="fw-semibold">
                        {{ $prodaja->kupac?->ime }} {{ $prodaja->kupac?->prezime }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Agent</div>
                    <div class="fw-semibold">
                        {{ $prodaja->agent?->ime }} {{ $prodaja->agent?->prezime }}
                    </div>
                </div>

                <div class="mb-0">
                    <div class="text-muted small">Datum prodaje</div>
                    <div class="fw-semibold">{{ $prodaja->datum_kreiranja }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <div class="text-muted small">Nekretnina</div>
                    <div class="fw-semibold">{{ $prodaja->nekretnina?->oznaka }}</div>
                    @if($prodaja->nekretnina)
                        <div class="text-muted small">
                            {{ $prodaja->nekretnina->povrsina_m2 }} m² • {{ number_format($prodaja->nekretnina->cena, 2, ',', '.') }} €
                        </div>
                    @endif
                </div>

                <div class="mb-0">
                    <div class="text-muted small">Status</div>
                    <span class="badge text-bg-light border">{{ $prodaja->status }}</span>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex gap-2">
            <a href="{{ route('prodaja.edit', $prodaja) }}" class="btn btn-primary">Izmeni</a>

            <form method="POST" action="{{ route('prodaja.destroy', $prodaja) }}"
                  onsubmit="return confirm('Obrisati ovu prodaju?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Obriši</button>
            </form>
        </div>
    </div>
</div>
@endsection
