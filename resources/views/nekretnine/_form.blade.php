@csrf

<div class="mb-3">
    <label class="form-label">Oznaka (obavezno)</label>
    <input type="text" name="oznaka"
           class="form-control @error('oznaka') is-invalid @enderror"
           value="{{ old('oznaka', $nekretnina->oznaka ?? '') }}">
    @error('oznaka') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Površina (m²)</label>
    <input type="number" step="0.01" name="povrsina_m2"
           class="form-control @error('povrsina_m2') is-invalid @enderror"
           value="{{ old('povrsina_m2', $nekretnina->povrsina_m2 ?? '') }}">
    @error('povrsina_m2') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Cena</label>
    <input type="number" step="0.01" name="cena"
           class="form-control @error('cena') is-invalid @enderror"
           value="{{ old('cena', $nekretnina->cena ?? '') }}">
    @error('cena') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @php $s = old('status', $nekretnina->status ?? 'slobodno'); @endphp
        <option value="slobodno" {{ $s === 'slobodno' ? 'selected' : '' }}>Slobodno</option>
        <option value="rezervisano" {{ $s === 'rezervisano' ? 'selected' : '' }}>Rezervisano</option>
        <option value="prodata" {{ $s === 'prodata' ? 'selected' : '' }}>Prodato</option>
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-primary">Sačuvaj</button>
    <a href="{{ route('nekretnina.index') }}" class="btn btn-secondary">Otkaži</a>
</div>
