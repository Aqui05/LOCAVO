<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('title', 'Liste des Voitures')

@section('content')

<div class="text-center">
    <h2>Liste des Voitures</h2>
</div>

    <br><br>
    <br>

    <div class="text-center">
    <div class="card bg-info rounded p-3">
        <h4 class="text-white">Trier par marque :</h4>
        <ul class="list-inline">
            <!-- Liens statiques pour chaque marque avec des images -->
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Honda']) }}">
                    <img src="{{ asset('images/honda.png') }}"
                        alt="Honda Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Audi']) }}">
                    <img src="{{ asset('images/audi.png') }}"
                        alt="Audi Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Hundai']) }}">
                    <img src="{{ asset('images/hyundai.jpg') }}"
                        alt="Hundai Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Nissan']) }}">
                    <img src="{{ asset('images/nissan.png') }}"
                        alt="Nissan Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Mercedes']) }}">
                    <img src="{{ asset('images/mercedes.png') }}"
                        alt="Mercedes Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'BMW']) }}">
                    <img src="{{ asset('images/bmw.png') }}"
                        alt="BMW Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'VolksWagen']) }}">
                    <img src="{{ asset('images/volks.jpg') }}"
                        alt="VolksWagen Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Chevrolet']) }}">
                    <img src="{{ asset('images/chevrolet.webp') }}"
                        alt="Chevrolet Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Ford']) }}">
                    <img src="{{ asset('images/ford.png') }}"
                        alt="Ford Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Toyota']) }}">
                    <img src="{{ asset('images/toyota.webp') }}"
                        alt="Toyota Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Tesla']) }}">
                    <img src="{{ asset('images/tesla.jpg') }}"
                        alt="Tesla Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Lotus']) }}">
                    <img src="{{ asset('images/Lotus.webp') }}"
                        alt="Lotus Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Jaguar']) }}">
                    <img src="{{ asset('images/Jaguar.png') }}"
                        alt="Jaguar Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Bugatti']) }}">
                    <img src="{{ asset('images/bugatti.png') }}"
                        alt="Bugatti Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('cars.filter', ['criteria' => 'marque', 'value' => 'Ferrari']) }}">
                    <img src="{{ asset('images/ferrari.png') }}"
                        alt="Ferrari Logo" class="rounded-circle" width="50" height="50">
                </a>
            </li>
        </ul>
    </div>
    </div>
    <br>
    <br>

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
                <img src="{{ asset($car->photo_path) }}" class="card-img-top h-75 w-100" alt="{{ $car->marque }}">
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
