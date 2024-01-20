<!-- resources/views/welcolme.blade.php -->

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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->matriculation }} {{ $car->model }}</h5>
                        <!-- Ajoutez d'autres informations de la voiture ici -->
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">Voir les détails</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection



<h1>ACCEUIL</h1>
