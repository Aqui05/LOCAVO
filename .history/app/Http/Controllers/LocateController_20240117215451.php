<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LocateController extends Controller
{

    public function confirmation(Location $location)
{
    if (auth()->user()->id !== $location->user_id) {
        abort(403, 'Unauthorized action.');
    }

    return view('confirmations.confirmation', compact('location'));
}



public function createLocation(Car $car)
{
    if (!$car->isAvailable()) {
        return redirect()->route('cars.show', ['car' => $car])
            ->with('error', 'La voiture n\'est pas disponible pour la location.');
    }

    return view('locations.create', compact('car'));
}

public function storeLocation(Request $request, Car $car)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        // Ajoutez d'autres règles de validation selon vos besoins
    ]);

    $startDate = Carbon::parse($request->input('start_date'));
    $endDate = Carbon::parse($request->input('end_date'));
    $pricePerDay = $car->prix;

    $totalPrice = $startDate->diffInDays($endDate) * $pricePerDay;


    $location = new Location([
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'car_id' => $car->id,
        'prix' => $totalPrice,
        'user_id' => auth()->user()->id,
    ]);

    // Associer la location à la voiture
    $car->locations()->save($location);

    return redirect()->route('confirmation', ['location' => $location])
        ->with('success', 'Location ajoutée avec succès.');
}



public function louerVoiture(Request $request, $carId)
{
    // Validation des données du formulaire
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    // Charger la voiture depuis la base de données
    $car = Car::findOrFail($carId);

    // Calculer le prix total en fonction des dates et du prix quotidien de la voiture
    $startDate = Carbon::parse($request->input('start_date'));
    $endDate = Carbon::parse($request->input('end_date'));
    $pricePerDay = $car->price_per_day;

    $totalPrice = $startDate->diffInDays($endDate) * $pricePerDay;

    // Créer une nouvelle location
    $location = new Location([
        'start_date' => $startDate,
        'end_date' => $endDate,
        'total_price' => $totalPrice,
    ]);

    // Associer la voiture et l'utilisateur à la location
    $location->car()->associate($car);
    $location->user()->associate(auth()->user());

    // Enregistrement en base de données
    $location->save();

    // Redirection vers une page de confirmation
    return redirect()->route('confirmation', ['location' => $location->id]);
}


public function show(Location $location)
{
    return view('locations.show', compact('location'));
}

public function edit(Location $location)
{
    return view('locations.edit', compact('location'));
}



public function destroy(Location $location)
{
    return view('locations.show', compact('location'));
}

public function update(Request $request, Location $location)
{
    // Validation des données du formulaire

    // Vérification des conditions pour la mise à jour de la date de début
    if ($location->status !== 'en cours') {
        $location->start_date = $request->input('start_date');
        $location->end_date = $request->input('end_date');
    }

    // Vérification des conditions pour la mise à jour de la date de fin
    if ($location->status !== 'confirmé') {
        $location->end_date = $request->input('end_date');
    }

    // Recalcul du prix en conséquence (ajouter votre logique de calcul ici)

    // Sauvegarde de la location mise à jour
    $location->save();

    // Redirection vers la page de détails de la location
    return redirect()->route('locations.show', $location->id)->with('success', 'Location mise à jour avec succès');
}



    public function history()
    {
        // Récupérez l'historique de location de l'utilisateur authentifié
        $user = auth()->user();
        $locations = $user->locations;

        return view('locations.history', compact('locations'));
    }
}





