<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('title', 'Liste des Voitures')

@section('content')
    <h2>Liste des Voitures</h2>

    <div class="row">
        @if(isset($message))
        <p>{{ $message }}</p>
    @else
        <!-- Afficher les résultats de la recherche ou la liste complète de voitures -->
        @foreach($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->marque }} {{ $car->model }}</h5>
                        <!-- Ajoutez d'autres informations de la voiture ici -->
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">Voir les détails</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>

    <div class="d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
@endsection
