{{-- locations/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Détails de la Location')
<br>

@section('content')
    <div class="container">
        <h2><strong>Détails de la Location</strong></h2>
        <br>
        <p><strong>Date de début: </strong>{{ $location->start_date }}</p>
        <p><strong>Date de fin: </strong>{{ $location->end_date }}</p>
        <p><strong>Prix de la location: </strong>{{ $location->prix }}</p>
        <p><strong>Statut de la location: </strong>{{ $location->status }}</p>
    </div>
@endsection
