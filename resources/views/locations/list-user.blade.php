@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')
    <div class="container mt-5">
        <h2>Liste des Utilisateurs</h2>

        @if($users->isEmpty())
            <p>Aucun utilisateur à afficher.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nom & Prénoms</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>
@endsection
