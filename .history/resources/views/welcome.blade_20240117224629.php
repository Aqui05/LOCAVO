<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('title', 'Bienvenue sur LOCAVO')

@section('content')
    <div class="container mt-4">
        <h2>Bienvenue sur LOCAVO</h2>
        <p>Découvrez notre sélection de véhicules et trouvez celui qui vous convient le mieux.</p>

        <!-- Filtrage -->
        <form action="{{ route('cars.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher une voiture..." name="search">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <!-- Liste des véhicules -->
        <div class="row row-cols-1 row-cols-md-3">
            @foreach($cars as $car)
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ $car->photo_path }}" class="card-img-top" alt="{{ $car->model }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->marque }} {{ $car->model }}</h5>
                            <p class="card-text">Prix: {{ $car->prix }} FCFA</p>
                            <p class="card-text">Statut: {{ $car->isAvailable() ? 'Disponible' : 'Non disponible' }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Détails</a>
                            @if($car->isAvailable())
                                <button class="btn btn-success">Louer</button>
                            @else
                                <button class="btn btn-secondary" disabled>Non disponible</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
