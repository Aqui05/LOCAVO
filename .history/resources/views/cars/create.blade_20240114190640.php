<!-- resources/views/cars/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter une Nouvelle Voiture')

@section('content')
    <h2>Ajouter une Nouvelle Voiture</h2>

    <form method="POST" action="{{ route('cars.store') }}">
        @csrf

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input id="marque" type="text" class="form-control" name="marque" value="{{ old('marque') }}" required>
        </div>

        <div class="form-group">
            <label for="model">Modèle:</label>
            <input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}" required>
        </div>

        <div class="form-group">
            <label for="matriculation">Immatriculation:</label>
            <input id="matriculation" type="text"
                class="form-control" name="matriculation" value="{{ old('registration_number') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" class="form-control"
                name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="prix">Prix de Location par Jour (FCFA):</label>
            <input id="prix" type="number" class="form-control"
                name="prix" value="{{ old('prix') }}" required>
        </div>

        <div class="form-group">
            <label for="category">Catégorie:</label>
            <input id="category" type="text" class="form-control"
                name="category" value="{{ old('category') }}" required>
        </div>

        <div class="form-group">
            <label for="category">Catégorie:</label>
            <input id="category" type="text" class="form-control"
                name="category" value="{{ old('category') }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Ajouter la Voiture</button>
    </form>
@endsection
