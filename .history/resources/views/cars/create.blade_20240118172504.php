<!-- resources/views/cars/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter une Nouvelle Voiture')

@section('content')
    <h2>Ajouter une Nouvelle Voiture</h2>
    
        <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input id="marque" type="text" class="form-control" name="marque" value="{{ old('marque') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label for="model">Modèle:</label>
            <input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label for="matriculation">Immatriculation:</label>
            <input id="matriculation" type="text"
                class="form-control" name="matriculation" value="{{ old('matriculation') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" class="form-control"
                name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <br>

        <div class="form-group">
            <label for="prix">Prix de Location par Jour (FCFA):</label>
            <input id="prix" type="number" class="form-control"
                name="prix" value="{{ old('prix') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label for="category">Catégorie:</label>
            <input id="category" type="text" class="form-control"
                name="category" value="{{ old('category') }}" required>
        </div>

        <br>

        <div class="form-group">
            <label for="photo_path">Image de la Voiture:</label>
            <input id="photo_path" type="file" class="form-control-file" name="photo_path"
                value="{{ old('photo_path') }}" accept="image/*">
        </div>

        <br>


        <button type="submit" class="btn btn-primary">Ajouter la Voiture</button>
    </form>
@endsection
