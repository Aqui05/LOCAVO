<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('title', 'Bienvenue sur LOCAVO')

@section('content')
    <div class="container mt-4">
        <div class="text-center">
    <br>
            <h2>Bienvenue sur LOCAVO</h2>
            <br>
        <p>Découvrez notre sélection de véhicules et trouvez celui qui vous convient le mieux.</p>

</div>

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
                <div class="favorite-icon">
                    <form action="{{ route('cars.favorite', $car->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            @if(auth()->user() && auth()->user()->favorites->contains($car))
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                </div>
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
                class="btn btn-success">Louer</a>
                    @else
                        <button class="btn btn-secondary" disabled>Non disponible</button>
                    @endif
                </div>
                <br>
                <br>
        <br>
            </div>
        </div>

    @endforeach
</div>



        <!-- Pagination -->
        <div class="d-flex justify-content-center">
        {{ $cars->links('vendor.custom') }}
    </div>
    </div>
@endsection
