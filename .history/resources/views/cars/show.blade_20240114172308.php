<!-- resources/views/cars/show.blade.php -->

@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
    <h2>{{ $car->matriculation }} {{ $car->model }}</h2>
    <!-- Affichez d'autres détails de la voiture ici -->
    <a href="{{ route('cars.index') }}" class="btn btn-primary">Retour à la liste</a>
@endsection
