@extends('layouts.app')

@section('title', $car->marque . ' ' . $car->model)

@section('content')
    <div class="card">
            <br>
            <h2 class="card-title">{{ $car->matriculation }} {{ $car->model }}</h2>

            <br>
            <br>

            <!-- Afficher l'image de la voiture -->
            <img src="{{ asset($car->photo_path) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
<br>
<br>

            <!-- Afficher tous les détails correspondant à la voiture -->
            <p class="card-text"><strong>Marque: </strong>{{ $car->marque }}</p>
            <p class="card-text"><strong>Modèle: </strong>{{ $car->Modèle }}</p>
            <p class="card-text"><strong>description: </strong>{{ $car->description }}</p>
            <p class="card-text"><strong>Prix: </strong>{{ $car->prix }} FCFA</p>
            <p class="card-text"><strong>category: </strong>{{ $car->category }}</p>
            <p class="card-text"><strong>rating: </strong>{{ $car->rating }}</p>
            <!-- Ajoutez d'autres détails selon vos besoins -->
<br>
<br>
<br>
            <!-- Afficher les commentaires des utilisateurs -->
<div class="row mb-6">
        <div class="row mb-6">
            <div class="col-md-6">
            <div class="card bg-white text-black p-6">
                <div class="card-body">
                    <h5 class="card-title">Commentaires des utilisateurs</h5>
                    @if($car->comments->count() > 0)
                    <ul>
                        @foreach($car->comments as $comment)
                            <li>
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                            </li>
                        @endforeach
                    </ul>
                    @else
                        <p><strong>Aucun commentaire disponible.</strong></p>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-6">
        <div class="card bg-white text-black">
                <div class="card-body">
                    <h5 class="card-title">Ecrire un commentaire</h5>
                    <form action="{{ route('cars.comment', ['car' => $car->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="comment">Commentaire :</label>
                    <br>
                    <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-info">Ajouter un commentaire</button>
            </form>

                </div>
            </div>
        </div>
        </div>
        <br>
<br>
<br>
</div>

<br>
<br>
<br>


    <div class="row mb-12">
        <div class="row mb-12">
        <div class="col-md-12">
            <div class="card bg-white text-black">
                <div class="card-body">
                    <h5 class="card-title">Noter la voiture sur 5 :</h5>
                    <form action="{{ route('cars.rate', ['car' => $car->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="rating">Votre notation :</label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-info">Noter la voiture</button>
            </form>
                </div>
            </div>
        </div>
        </div>
    </div>
            

            <!-- Liens de navigation -->
            <a href="{{ route('cars.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
            <a href="{{ route('locations.create', ['car' => $car]) }}"
                class="btn btn-success mt-3">Louer cette voiture</a>
        </div>
@endsection
