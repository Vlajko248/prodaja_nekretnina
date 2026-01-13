@extends('layouts.app')

@section('content')
<h1 class="mb-4">Nova prodaja</h1>

<div class="card border-0" style="max-width: 820px;">
    <div class="card-body">
        <form method="POST" action="{{ route('prodaja.store') }}">
            @include('prodaje._form', [
                'prodaja' => null,
                'kupci' => $kupci,
                'agenti' => $agenti,
                'nekretnine' => $nekretnine,
                'statusi' => $statusi,
            ])
        </form>
    </div>
</div>
@endsection
