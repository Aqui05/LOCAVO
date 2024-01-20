<!-- resources/views/auth/profile.blade.php -->

@extends('layouts.app')

@section('title', 'Profil de l\'Utilisateur')

@section('content')
    <h2>Profil de l'Utilisateur</h2>

    <div>
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <!-- Ajoutez d'autres informations du profil ici -->
    </div>
@endsection
