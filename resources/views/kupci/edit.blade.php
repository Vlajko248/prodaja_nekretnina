@extends('layouts.app')

@section('title', 'Izmena kupca')

@section('content')
<h1 class="mb-4">Izmena kupca</h1>

<div class="card border-0" style="max-width: 820px;">
    <div class="card-body">
        <form method="POST" action="{{ route('kupac.update', $kupac) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Ime (obavezno)</label>
                <input type="text" name="ime"
                       class="form-control @error('ime') is-invalid @enderror"
                       value="{{ old('ime', $kupac->ime) }}">
                @error('ime') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Prezime (obavezno)</label>
                <input type="text" name="prezime"
                       class="form-control @error('prezime') is-invalid @enderror"
                       value="{{ old('prezime', $kupac->prezime) }}">
                @error('prezime') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Telefon (obavezno)</label>
                <input type="text" name="telefon"
                       class="form-control @error('telefon') is-invalid @enderror"
                       value="{{ old('telefon', $kupac->telefon) }}">
                @error('telefon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Email (opciono)</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $kupac->email) }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Sačuvaj izmene</button>
                <a href="{{ route('kupac.index') }}" class="btn btn-secondary">Otkaži</a>
            </div>
        </form>
    </div>
</div>
@endsection
