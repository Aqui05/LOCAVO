<!-- resources/views/confirmations/confirmation.blade.php -->

@extends('layouts.app')

@section('title', 'Confirmation de Location')

@section('content')
    <div class="container">
        <h2>Confirmation de Location</h2>
        <p>Merci pour votre location. Voici les détails :</p>

        <ul>
            <li>Date de début : {{ $location->start_date }}</li>
            <li>Date de fin : {{ $location->end_date }}</li>
            <li>Prix total : {{ $location->total_price }}</li>
            <!-- Ajoutez d'autres détails de la location selon vos besoins -->
        </ul>

        <a href="{{ route('cars.show', ['car' => $location->car_id]) }}" class="btn btn-primary">Retour à la voiture</a>
    </div>
@endsection
