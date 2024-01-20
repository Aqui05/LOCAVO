<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('title', 'Bienvenue sur LOCAVO')

@section('content')
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Bienvenue sur LOCAVO</h4>
        <p>Découvrez notre sélection de véhicules et trouvez celui qui vous convient le mieux.</p>
    </div>

    <!-- Formulaire de Recherche -->
    <form action="{{ route('cars.search') }}" method="GET" class="form-inline mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Rechercher une voiture..." name="search">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    <!-- Affichage des voitures avec pagination -->
    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $car->image_url }}" class="card-img-top" alt="{{ $car->model }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->model }}</h5>
                        <p class="card-text">{{ $car->description }}</p>
                        <a href="{{ route('cars.show', ['car' => $car->id]) }}" class="btn btn-primary">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cars->links() }}
    </div>
@endsection
