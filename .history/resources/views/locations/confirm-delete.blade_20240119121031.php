@extends('layouts.app')

@section('title', 'Confirmer la suppression')

@section('content')
    <h2>Confirmer la suppression</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $location->start_date }}</h5>
            <p class="card-text">Marque: {{ $location->end_date }}</p>
            <p class="card-text">Prix: {{ $location->prix }} FCFA</p>
            <!-- Ajoutez d'autres détails du véhicule si nécessaire -->

            <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
            </form>
        </div>
    </div>
@endsection
