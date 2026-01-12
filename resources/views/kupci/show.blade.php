@extends('layouts.app')

@section('title', 'Detalji kupca')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1 class="mb-0">Detalji kupca</h1>
        <div class="text-muted">Pregled podataka o kupcu</div>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('kupac.index') }}" class="btn btn-outline-secondary">
            Nazad na listu
        </a>

        <a href="{{ route('kupac.edit', $kupac) }}" class="btn btn-outline-primary">
            Izmeni
        </a>

        <form method="POST" action="{{ route('kupac.destroy', $kupac) }}"
              onsubmit="return confirm('Da li ste sigurni da želite da obrišete kupca?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger">
                Obriši
            </button>
        </form>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0" style="max-width: 820px;">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3 text-muted">Ime</dt>
            <dd class="col-sm-9">{{ $kupac->ime }}</dd>

            <dt class="col-sm-3 text-muted">Prezime</dt>
            <dd class="col-sm-9">{{ $kupac->prezime }}</dd>

            <dt class="col-sm-3 text-muted">Telefon</dt>
            <dd class="col-sm-9">{{ $kupac->telefon }}</dd>

            <dt class="col-sm-3 text-muted">Email</dt>
            <dd class="col-sm-9">{{ $kupac->email ?? '-' }}</dd>

            <dt class="col-sm-3 text-muted">Kreiran</dt>
            <dd class="col-sm-9">{{ optional($kupac->created_at)->format('d.m.Y H:i') ?? '-' }}</dd>

            <dt class="col-sm-3 text-muted">Ažuriran</dt>
            <dd class="col-sm-9">{{ optional($kupac->updated_at)->format('d.m.Y H:i') ?? '-' }}</dd>
        </dl>
    </div>
</div>
@endsection
