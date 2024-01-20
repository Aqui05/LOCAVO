@extends('layouts.app')

@section('title', 'Historique des Locations')

@section('content')
    <div class="container mt-5">
        <h2>Historique des Locations</h2>

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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->car->brand }} {{ $location->car->model }}</td>
                            <td>{{ $location->start_date }}</td>
                            <td>{{ $location->end_date }}</td>
                            <td>{{ $location->prix }} FCFA</td>
                            <td>{{ $location->status }}</td>
                            <td>
                                <a href="{{ route('locations.show', $location->id) }}"
                                    class="btn btn-info btn-sm">Détails</a>
                                <a href="{{ route('locations.edit', $location->id) }}"
                                    class="btn btn-success btn-sm">Mettre à jour</a>
                                <a href="{{ route('locations.confirm-delete', $location->id) }}"
                                    class="btn btn-danger btn-sm">Annuler</a>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
