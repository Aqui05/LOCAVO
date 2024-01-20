@extends('layouts.app')

@section('title', $car->marque . ' m . $car->model)

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $car->matriculation }} {{ $car->model }}</h2>

            <!-- Afficher l'image de la voiture -->
            <img src="{{ asset($car->photo_path) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">

            <!-- Afficher tous les détails correspondant à la voiture -->
            <p class="card-text">Marque: {{ $car->brand }}</p>
            <p class="card-text">Prix: {{ $car->prix }} FCFA</p>
            <!-- Ajoutez d'autres détails selon vos besoins -->

            <!-- Afficher les commentaires des utilisateurs -->
            @if($car->comments->count() > 0)
                <h4>Commentaires des utilisateurs :</h4>
                <ul>
                    @foreach($car->comments as $comment)
                        <li>{{ $comment->comment }}</li>
                    @endforeach
                </ul>
            @else
                <p>Aucun commentaire disponible.</p>
            @endif

            <!-- Ajouter un champ pour noter la voiture sur 5 -->
            <h4>Noter la voiture sur 5 :</h4>
            <select name="rating" id="rating" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <!-- Ajouter un champ pour ajouter des commentaires -->
            <form action="{{ route('cars.comment', ['car' => $car->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="comment">Commentaire :</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter un commentaire</button>
            </form>

            <!-- Liens de navigation -->
            <a href="{{ route('cars.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
            <a href="{{ route('locations.create', ['car' => $car]) }}"
                    class="btn btn-success mt-3">Louer cette voiture</a>
        </div>
    </div>
@endsection
