@extends('layouts.app')

@section('title', 'Liste des Locations')

@section('content')
    <div class="container mt-5">
        <h2>Liste des Locations</h2>

        @if($locations->isEmpty())
            <p>Aucune location à afficher.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Véhicule Loué</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Prix de la location</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->car->marque }} {{ $location->car->model }}</td>
                            <td>{{ $location->start_date }}</td>
                            <td>{{ $location->end_date }}</td>
                            <td>{{ $location->prix }} FCFA</td>
                            <td>{{ $location->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>
@endsection
