@csrf

<div class="mb-3">
    <label class="form-label">Kupac</label>
    <select name="kupac_id" class="form-select @error('kupac_id') is-invalid @enderror">
        <option value="">Izaberi kupca</option>
        @foreach($kupci as $k)
            <option value="{{ $k->id }}"
                @selected(old('kupac_id', $prodaja->kupac_id ?? null) == $k->id)>
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
            <option value="{{ $n->id }}"
                @selected(old('nekretnina_id', $prodaja->nekretnina_id ?? null) == $n->id)>
                {{ $n->oznaka }} ({{ $n->povrsina_m2 }} m², {{ number_format($n->cena, 2, ',', '.') }} €)
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
            <option value="{{ $a->id }}"
                @selected(old('agent_id', $prodaja->agent_id ?? null) == $a->id)>
                {{ $a->prezime }} {{ $a->ime }}
            </option>
        @endforeach
    </select>
    @error('agent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Datum kreiranja</label>
    <input type="date" name="datum_kreiranja" class="form-control @error('datum_kreiranja') is-invalid @enderror" 
           value="{{ old('datum_kreiranja', isset($prodaja) ? $prodaja->datum_kreiranja : now()->toDateString()) }}">
    @error('datum_kreiranja') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label">Status prodaje</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach($statusi as $s)
            <option value="{{ $s }}" @selected(old('status', $prodaja->status ?? 'nacrt') === $s)>
                {{ $s }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-primary">Sačuvaj</button>
    <a class="btn btn-secondary" href="{{ route('prodaja.index') }}">Otkaži</a>
</div>
