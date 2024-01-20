<!-- resources/views/cars/commentView.blade.php -->

@extends('layouts.app')

@section('title', 'Commentaires pour ' . $car->marque . ' ' . $car->model)

@section('content')
    <h1>Commentaires pour {{ $car->marque }} {{ $car->model }}</h1>

    @if ($comments->isEmpty())
        <p>Aucun commentaire disponible pour cette voiture.</p>
    @else
        <ul>
            @foreach ($comments as $comment)
                <li>{{ $comment->user->name }} : {{ $comment->comment }}</li>
            @endforeach
        </ul>
    @endif
@endsection
