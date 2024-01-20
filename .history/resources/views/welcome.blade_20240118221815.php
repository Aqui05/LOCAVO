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
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i>Search</button>
            </div>
        </form>

        <!-- Formulaire de Filtre -->
<form action="{{ route('cars.filter') }}" method="GET" class="form-inline">
    <div class="input-group mr-2">
        <select class="form-control" name="criteria">
            <option value="marque">Marque</option>
            <option value="model">Modèle</option>
            <option value="category">Catégorie</option>
            <option value="max_price">Prix maximum</option>
            <option value="matriculation">Matriculation</option>
            <option value="average">Moyenne</option>
            <option value="recent">Ajouté récemment</option>
        </select>
        <input class="form-control" type="text" placeholder="Valeur" name="value">
        <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-funnel"></i> Filtrer
        </button>
    </div>
</form>
<br>
<!-- Liste des véhicules -->
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
                    @if($car->isAvailable())
                        <a href="{{ route('locations.create', ['car' => $car]) }}"
                class="btn btn-success w-100">Louer cette voiture</a>
                    @else
                        <button class="btn btn-secondary" disabled>Non disponible</button>
                    @endif
                </div>
                <br>
            </div>
        </div>
    @endforeach
</div>



        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
