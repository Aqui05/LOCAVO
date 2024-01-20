<!-- resources/views/cars/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Édition de la Voiture')

@section('content')
    <h2>Édition de la Voiture</h2>

    <form method="POST" action="{{ route('cars.update', $car) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input id="marque" type="text" class="form-control" name="marque" value="{{ $car->marque }}">
        </div>

        <br>

        <div class="form-group">
            <label for="model">Modèle:</label>
            <input id="model" type="text" class="form-control" name="model" value="{{ $car->model }}" required>
        </div>

        <div class="form-group">
            <label for="matriculation">Immatriculation:</label>
            <input id="matriculation" type="text"
                class="form-control" name="matriculation" value="{{ $car->matriculation }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" class="form-control"
                name="description" rows="4">{{ $car->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="prix">Prix de Location par Jour (FCFA):</label>
            <input id="prix" type="number" class="form-control"
                name="prix" value="{{ $car->prix }}" required>
        </div>

        <div class="form-group">
            <label for="category">Catégorie:</label>
            <input id="category" type="text" class="form-control"
                name="category" value="{{ $car->category }}" required>
        </div>

        <div class="form-group">
            <label for="photo_path">Image de la Voiture:</label>
            <input id="photo_path" type="file" class="form-control-file" name="photo_path"
                value="{{ $car->photo_path }}" accept="image/*">
        </div>

        <br>
        <br>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
@endsection
