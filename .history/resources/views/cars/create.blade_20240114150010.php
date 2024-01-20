<!-- resources/views/cars/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter une voiture</h2>
        <form action="{{ route('cars.store') }}" method="post">
            @csrf
            <label for="model">Modèle:</label>
            <input type="text" name="model" id="model" required>
            <br>
            <label for="brand">Marque:</label>
            <input type="text" name="brand" id="brand" required>
            <br>
            <!-- Ajoutez d'autres champs selon vos besoins -->
            <br>
            <button type="submit">Ajouter la voiture</button>
        </form>
    </div>
@endsection
