@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="m-0">Detalji nekretnine</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('nekretnina.edit', $nekretnina) }}" class="btn btn-outline-primary">Izmeni</a>
        <a href="{{ route('nekretnina.index') }}" class="btn btn-secondary">Nazad</a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width: 820px;">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">Oznaka</dt>
            <dd class="col-sm-8">{{ $nekretnina->oznaka }}</dd>

            <dt class="col-sm-4">Površina (m²)</dt>
            <dd class="col-sm-8">{{ $nekretnina->povrsina_m2 }}</dd>

            <dt class="col-sm-4">Cena</dt>
            <dd class="col-sm-8">{{ number_format((float)$nekretnina->cena, 2, ',', '.') }} €</dd>

            <dt class="col-sm-4">Status</dt>
            <dd class="col-sm-8">{{ ucfirst($nekretnina->status) }}</dd>
        </dl>
    </div>
</div>
@endsection
