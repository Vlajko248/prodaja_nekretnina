@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="m-0">Lista nekretnina</h1>

    <a href="{{ route('nekretnina.create') }}" class="btn btn-primary">
        Nova nekretnina
    </a>
</div>

<form method="GET" action="{{ route('nekretnina.index') }}" class="mb-3" style="max-width: 320px;">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Sve</option>
        <option value="slobodno" {{ ($status ?? '') === 'slobodno' ? 'selected' : '' }}>Slobodno</option>
        <option value="rezervisano" {{ ($status ?? '') === 'rezervisano' ? 'selected' : '' }}>Rezervisano</option>
        <option value="prodato" {{ ($status ?? '') === 'prodato' ? 'selected' : '' }}>Prodato</option>
    </select>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Oznaka</th>
                        <th>Površina (m²)</th>
                        <th>Cena</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 180px;">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($nekretnine as $n)
                    <tr>
                        <td>
                            <a href="{{ route('nekretnina.show', $n) }}" class="text-decoration-none">
                                {{ $n->oznaka }}
                            </a>
                        </td>
                        <td>{{ $n->povrsina_m2 }}</td>
                        <td>{{ number_format((float)$n->cena, 2, ',', '.') }} €</td>
                        <td>
                            @php
                                $badge = match($n->status) {
                                    'slobodno' => 'success',
                                    'rezervisano' => 'warning',
                                    'prodata' => 'secondary',
                                    default => 'light'
                                };
                            @endphp
                            <span class="badge text-bg-{{ $badge }}">
                                {{ ucfirst($n->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('nekretnina.edit', $n) }}">Izmeni</a>

                            <form action="{{ route('nekretnina.destroy', $n) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Obrisati nekretninu?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-muted">
                            Nema unetih nekretnina.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
