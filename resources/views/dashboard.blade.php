@extends('layouts.app')

@section('title', 'Kontrolna tabla')

@section('content')
<h1 class="mb-4">Kontrolna tabla</h1>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="border rounded p-3 text-center">
            <div class="text-muted">Aktivne prodaje:</div>
            <div class="fs-3 fw-semibold">{{ $aktivneProdaje ?? 0 }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="border rounded p-3 text-center">
            <div class="text-muted">Aktivne nekretnine:</div>
            <div class="fs-3 fw-semibold">{{ $aktivneNekretnine ?? 0 }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="border rounded p-3 text-center">
            <div class="text-muted">Prihod:</div>
            <div class="fs-3 fw-semibold">{{ $prihod ?? '0,00 €' }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="border rounded p-3 text-center">
            <div class="text-muted">Aktivni kupci:</div>
            <div class="fs-3 fw-semibold">{{ $aktivniKupci ?? 0 }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-xl-7">
        <div class="border rounded p-3" style="min-height: 320px;">
            <div class="fw-semibold mb-2">Pregled prodaje</div>
            <div class="text-muted">Grafikon (placeholder)</div>
            <div class="mt-3 bg-light rounded" style="height: 230px;"></div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="border rounded p-3" style="min-height: 320px;">
            <div class="fw-semibold mb-2">Status nekretnina</div>
            <div class="text-muted">Grafikon (placeholder)</div>
            <div class="mt-3 bg-light rounded" style="height: 230px;"></div>
        </div>
    </div>
</div>
@endsection
