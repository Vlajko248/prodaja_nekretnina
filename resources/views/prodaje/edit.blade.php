@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Izmena prodaje</h1>
    <a href="{{ route('prodaja.show', $prodaja) }}" class="btn btn-secondary">Nazad</a>
</div>

<div class="card border-0" style="max-width: 820px;">
    <div class="card-body">
        <form method="POST" action="{{ route('prodaja.update', $prodaja) }}">
            @method('PUT')
            @include('prodaje._form', [
                'prodaja' => $prodaja,
                'kupci' => $kupci,
                'agenti' => $agenti,
                'nekretnine' => $nekretnine,
                'statusi' => $statusi,
            ])
        </form>
    </div>
</div>
@endsection
