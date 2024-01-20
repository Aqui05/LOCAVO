<!-- resources/views/cars/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Édition de la Voiture')

@section('content')
    <h2>Édition de la Voiture</h2>

    <form method="POST" action="{{ route('cars.update', $car) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="model">Modèle:</label>
            <input id="model" type="text" class="form-control" name="model" value="{{ $car->model }}" required>
        </div>

        <br>
        <div class="form-group">
            <label for="brand">Marque:</label>
            <input id="brand" type="text" class="form-control" name="brand" value="{{ $car->brand }}" required>
        </div>

        <!-- Ajoutez d'autres champs selon vos besoins -->

        <br>
        <br>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
@endsection
