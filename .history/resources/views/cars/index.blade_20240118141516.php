<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('title', 'Liste des Voitures')

@section('content')
    <h2>Liste des Voitures</h2>

    <br><br>

    <div class="row">
        
        @if(isset($error))
            <p class="text-danger">{{ $error }}</p>
        @elseif(isset($message))
            <p>{{ $message }}</p>
        @else
    <div class="row row-cols-1 row-cols-md-3">
    @foreach($cars as $car)
        <div class="col mb-4">
            <div class="card h-100">
                <img src="{{ asset($car->photo_path) }}" class="card-img-top h-75" alt="{{ $car->marque }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->model }}</h5>
                    <p class="card-text">Prix: {{ $car->prix }} FCFA</p>
                    <p class="card-text">Statut: {{ $car->isAvailable() ? 'Disponible' : 'Non disponible' }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Détails</a>
                    <!-- <button class="btn btn-danger" onclick="addToFavorites({{ $car->id }})">
                        <i class="bi bi-heart"></i> Ajouter aux favoris
                    </button> -->
                    @if($car->isAvailable())
                        <button class="btn btn-success">Louer</button>
                    @else
                        <button class="btn btn-secondary" disabled>Non disponible</button>
                    @endif
                </div>
                <br>
            </div>
        </div>
    @endforeach
</div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
    @endif
@endsection
