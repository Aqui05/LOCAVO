<!-- resources/views/locations/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter une Location')

@section('content')
    <div class="container">
        <h2>Ajouter une Location</h2>

        <form action="{{ route('locations.store', ['car' => $car]) }}" method="post">
            @csrf

            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <!-- Ajoutez d'autres champs de formulaire selon vos besoins -->

            <br>
            
            <button type="submit" class="btn btn-primary">Louer</button>
        </form>
    </div>
@endsection
