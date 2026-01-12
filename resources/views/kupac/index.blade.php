@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Kupci</h1>

        <a href="{{ route('kupac.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Novi kupac
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Ime</th>
                    <th class="px-4 py-3 text-left">Prezime</th>
                    <th class="px-4 py-3 text-left">Telefon</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-right">Akcije</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($kupacs as $kupac)
                    <tr>
                        <td class="px-4 py-3">{{ $kupac->ime }}</td>
                        <td class="px-4 py-3">{{ $kupac->prezime }}</td>
                        <td class="px-4 py-3">{{ $kupac->telefon }}</td>
                        <td class="px-4 py-3">{{ $kupac->email ?? '-' }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('kupac.edit', $kupac) }}"
                               class="text-blue-600 hover:underline">
                                Izmeni
                            </a>

                            <form action="{{ route('kupac.destroy', $kupac) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Obrisati kupca?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Obriši
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Nema unetih kupaca.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
