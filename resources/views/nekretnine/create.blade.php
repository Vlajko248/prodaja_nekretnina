@extends('layouts.app')

@section('content')
<h1 class="mb-4">Nova nekretnina</h1>

<div class="card border-0 shadow-sm" style="max-width: 820px;">
  <div class="card-body">
    <form method="POST" action="{{ route('nekretnina.store') }}">
        @include('nekretnine._form')
    </form>
  </div>
</div>
@endsection
