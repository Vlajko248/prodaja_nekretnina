@extends('layouts.app')

@section('title', 'Lista kupaca')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="mb-0">Lista kupaca</h1>

    <a href="{{ route('kupac.create') }}" class="btn btn-primary">
        Novi kupac
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th style="width: 220px;">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kupacs as $kupac)
                        <tr>
                            <td>{{ $kupac->ime }}</td>
                            <td>{{ $kupac->prezime }}</td>
                            <td>{{ $kupac->telefon }}</td>
                            <td>{{ $kupac->email ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('kupac.show', $kupac) }}" class="btn btn-sm btn-outline-secondary">
                                        Prikaži
                                    </a>

                                    <a href="{{ route('kupac.edit', $kupac) }}" class="btn btn-sm btn-outline-primary">
                                        Izmeni
                                    </a>

                                    <form method="POST" action="{{ route('kupac.destroy', $kupac) }}"
                                          onsubmit="return confirm('Da li ste sigurni da želite da obrišete kupca?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            Obriši
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nema kupaca u bazi. Klikni na <b>Novi kupac</b> da dodaš prvog.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
