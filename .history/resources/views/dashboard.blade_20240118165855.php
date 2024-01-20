<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
    <h2>Tableau de Bord</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nombre total de voitures</h5>
                    <p class="card-text">{{ $totalCars }}</p>
                </div>
            </div>
        </div>
        <!-- Ajoutez d'autres statistiques si nécessaire -->
    </div>

    <h3>Dernières Voitures</h3>

    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="{{ asset($car->photo_path) }}" class="card-img-top h-75" alt="{{ $car->marque }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->model }}</h5>
                    <p class="card-text">Prix: {{ $car->prix }} FCFA</p>
                    <p class="card-text">Statut: {{ $car->isAvailable() ? 'Disponible' : 'Non disponible' }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Détails</a>

                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Mettre à jour</a>

                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
                <br>
                <br>
            </div>
            </div>
        @endforeach
    </div>
@endsection
