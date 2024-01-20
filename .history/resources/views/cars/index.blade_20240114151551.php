<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Voitures</h2>

        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                            <!-- Ajoutez d'autres informations de la voiture ici -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
