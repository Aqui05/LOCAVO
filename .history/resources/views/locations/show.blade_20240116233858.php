{{-- locations/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Détails de la Location')

@section('content')
    <div class="container">
        <h2>Détails de la Location</h2>
        <p>Date de début: {{ $location->start_date }}</p>
        <p>Date de fin: {{ $location->end_date }}</p>
        <p>Prix de la location: {{ $location->prix }}</p>
        <!-- Autres détails de la location -->
    </div>
@endsection
