<form action="{{ route('locations.update', $location->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Fields for editing -->



    <!-- Autres champs à mettre à jour -->

    <!-- Bouton de soumission -->
    <button type="submit"></button>
</form>


<!-- Form for editing location -->

@extends('layouts.app')

@section('title', 'Mettre à jour une Location')

@section('content')
    <div class="container">
        <br>

        <h2>Mettre à jour une location</h2>
        <br>

        <form action="{{ route('locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <!-- Date de début -->
                <label for="start_date">Date de début:</label>
                <input type="date" name="start_date" value="{{ $location->start_date }}"
                @if ($location->status == 'en cours') disabled @endif>
            </div>

            <br>

            <div class="form-group">
                <!-- Date de fin -->
                <label for="end_date">Date de fin:</label>
                <input type="date" name="end_date" value="{{ $location->end_date }}"
                @if ($location->status == 'terminé' || $location->status == 'annulé' ) disabled @endif>

            </div>

            <br>

            <button type="submit" class="btn btn-info">Mettre à jour</button>
        </form>
    </div>
@endsection
