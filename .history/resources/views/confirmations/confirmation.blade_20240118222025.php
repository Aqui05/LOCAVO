<!-- resources/views/confirmations/confirmation.blade.php -->

@extends('layouts.app')

@section('title', 'Confirmation de Location')

@section('content')
    <div class="container">
        <br>
        <h2>Confirmation de Location</h2>
        <br>
        <p>Merci pour votre location. Voici les détails :</p>

        <ul>
            <li>Date de début :<strong> {{ $location->start_date }}</strong></li><br>
            <li>Date de fin : <strong>{{ $location->end_date }}</strong></li><br>
            <li>Prix total : <strong>{{ $location->prix }}</strong></li><br>
            <!-- Ajoutez d'autres détails de la location selon vos besoins -->
        </ul>

        <a href="{{ route('cars.show', ['car' => $location->car_id]) }}" class="btn btn-info">Retour à la voiture</a>
    </div>
@endsection
