<!-- resources/views/locations/history.blade.php -->

@extends('layouts.app')

@section('title', 'Historique de location')

@section('content')
    <h1>Historique de location</h1>

    @if ($locations->isEmpty())
        <p>Aucune location disponible dans l'historique.</p>
    @else
        <ul>
            @foreach ($locations as $location)
                <li>{{ $location->car->marque }}
                    {{ $location->car->model }} - {{ $location->start_date }} à {{ $location->end_date }}</li>
            @endforeach
        </ul>
    @endif
@endsection
