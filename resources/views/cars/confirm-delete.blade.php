@extends('layouts.app')

@section('title', 'Confirmer la suppression')

@section('content')
    <h2>Confirmer la suppression</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $car->model }}</h5>
            <p class="card-text">Marque: {{ $car->marque }}</p>
            <p class="card-text">Prix: {{ $car->prix }} FCFA</p>
            <!-- Ajoutez d'autres détails du véhicule si nécessaire -->

            <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
            </form>
        </div>
    </div>
@endsection
