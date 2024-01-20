<!-- resources/views/cars/show.blade.php -->

@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
    <h2>{{ $car->matriculation }} {{ $car->model }}</h2>
    <!-- Affichez d'autres détails de la voiture ici -->
    <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
    <a href="{{ route('locations.create', ['car' => $car]) }}" class="btn btn-success">Louer cette voiture</a>


    <!-- Dans votre vue -->
<form action="{{ route('cars.comment', ['car' => $car->id]) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="comment">Commentaire :</label>
        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter un commentaire</button>
</form>


@endsection
