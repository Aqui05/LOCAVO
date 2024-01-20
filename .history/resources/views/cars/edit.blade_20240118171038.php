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
            <input id="model" type="text" class="form-control" name="model" value="{{ $car->model }}">
        </div>

        <br>

        <div class="form-group">
            <label for="model">Modèle:</label>
            <input id="model" type="text" class="form-control" name="model" value="{{ $car->model }}">
        </div>

        <br>
        
        <div class="form-group">
            <label for="matriculation">Immatriculation:</label>
            <input id="matriculation" type="text" class="form-control" name="matriculation" value="{{ $car->matriculation }}">
        </div>

        <br>
        <br>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
@endsection
