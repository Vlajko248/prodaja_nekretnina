@extends('layouts.app')

@section('content')
<h1 class="mb-4">Izmena nekretnine</h1>

<div class="card border-0 shadow-sm" style="max-width: 820px;">
  <div class="card-body">
    <form method="POST" action="{{ route('nekretnina.update', $nekretnina) }}">
        @csrf
        @method('PUT')
        @include('nekretnine._form', ['nekretnina' => $nekretnina])
    </form>
  </div>
</div>
@endsection
