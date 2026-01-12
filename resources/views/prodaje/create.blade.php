@extends('layouts.app')

@section('content')
<h1 class="mb-4">Nova prodaja</h1>

<div class="card border-0" style="max-width: 820px;">
    <div class="card-body">
        <form method="POST" action="{{ route('prodaja.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kupac</label>
                <select name="kupac_id" class="form-select @error('kupac_id') is-invalid @enderror">
                    <option value="">Izaberi kupca</option>
                    @foreach($kupci as $k)
                        <option value="{{ $k->id }}" @selected(old('kupac_id') == $k->id)>
                            {{ $k->prezime }} {{ $k->ime }}
                        </option>
                    @endforeach
                </select>
                @error('kupac_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nekretnina</label>
                <select name="nekretnina_id" class="form-select @error('nekretnina_id') is-invalid @enderror">
                    <option value="">Izaberi nekretninu</option>
                    @foreach($nekretnine as $n)
                        <option value="{{ $n->id }}" @selected(old('nekretnina_id') == $n->id)>
                            {{ $n->oznaka }} ({{ $n->povrsina_m2 }} m², {{ $n->cena }} €)
                        </option>
                    @endforeach
                </select>
                @error('nekretnina_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Agent</label>
                <select name="agent_id" class="form-select @error('agent_id') is-invalid @enderror">
                    <option value="">Izaberi agenta</option>
                    @foreach($agenti as $a)
                        <option value="{{ $a->id }}" @selected(old('agent_id') == $a->id)>
                            {{ $a->prezime }} {{ $a->ime }}
                        </option>
                    @endforeach
                </select>
                @error('agent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Status prodaje</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    @foreach($statusi as $s)
                        <option value="{{ $s }}" @selected(old('status', 'nacrt') === $s)>{{ $s }}</option>
                    @endforeach
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Sačuvaj</button>
                <a class="btn btn-secondary" href="{{ route('prodaja.index') }}">Otkaži</a>
            </div>
        </form>
    </div>
</div>
@endsection
