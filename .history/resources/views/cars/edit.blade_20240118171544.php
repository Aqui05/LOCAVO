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

        <br>
        <br>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
@endsection
