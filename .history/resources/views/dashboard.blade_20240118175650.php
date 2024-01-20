<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
    <h2>Tableau de Bord</h2>

    <div class="row mb-4">
        <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Nombre de voitures</h5>
                    <p class="card-text">{{ $totalCars }}</p>
                </div>
                <a href="{{ route('cars.create') }}" class="btn btn-light mt-3">Ajouter une nouvelle voiture</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Nombre de locations</h5>
                    <p class="card-text">{{ $totalRentals }}</p>
                </div>
                <a href="{{ route('cars.create') }}" class="btn btn-light mt-3">Ajouter une nouvelle voiture</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-black text-white">
                <div class="card-body">
                    <h5 class="card-title">Nombre d'utilisateurs</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
                <a href="{{ route('cars.create') }}" class="btn btn-light mt-3">Ajouter une nouvelle voiture</a>
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

                    <a href="{{ route('cars.confirm-delete', $car->id) }}" class="btn btn-danger">Supprimer</a>


                </div>
                <br>
                <br>
            </div>
            </div>
        @endforeach
    </div>
@endsection
