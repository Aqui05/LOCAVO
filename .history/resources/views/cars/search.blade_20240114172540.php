<!-- resources/views/cars/search.blade.php -->

@extends('layouts.app')

@section('title', 'Recherche de Voitures')

@section('content')
    <h2>Recherche de Voitures</h2>

    <form method="GET" action="{{ route('cars.search') }}">
        <div class="form-group">
            <label for="search">Recherche</label>
            <input id="search" type="text" class="form-control" name="search" value="{{ request('search') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <!-- Affichez ici les résultats de la recherche -->
@endsection
