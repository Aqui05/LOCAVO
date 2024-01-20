<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Events\LocationStatusUpdated;


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
        'start_date' => 'required|date|after_or_equal:now',
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

    event(new LocationStatusUpdated($location));

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

    event(new LocationStatusUpdated($location));

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
    if ($location->status === 'confirmé') {

        $location->status = 'annulé';
        $location->save();

        event(new LocationStatusUpdated($location));

        return redirect()->route('locations.index')->with('success', 'Location annulée avec succès');
    } else {
        return redirect()->route('locations.index')->with('error', 'La location ne peut pas être annulée.');
    }
}


public function update(Request $request, Location $location)
{
    // Validation des données du formulaire

    $request->validate([
        'start_date' => 'date|after_or_equal:now',
        'end_date' => 'date|after:start_date',
        // Ajoutez d'autres règles de validation selon vos besoins
    ]);

    // Vérification des conditions pour la mise à jour de la date de début
    if ($location->status == 'confirmé') {
        $location->start_date = $request->input('start_date');
        $location->end_date = $request->input('end_date');
    }

    // Vérification des conditions pour la mise à jour de la date de fin
    if ($location->status == 'en cours') {
        $location->end_date = $request->input('end_date');
    }

    // Recalcul du prix en conséquence
    $newStartDate = Carbon::parse($location->start_date);
    $newEndDate = Carbon::parse($location->end_date);

    // Calcul de la nouvelle durée en jours
    $newDurationInDays = $newEndDate->diffInDays($newStartDate);

    // Récupération du prix par jour depuis la voiture liée à la location
    $dailyRate = $location->car->prix;

    // Nouveau prix
    $newPrice = $newDurationInDays * $dailyRate;

    $location->prix = $newPrice;

    // Sauvegarde de la location mise à jour
    $location->save();

    event(new LocationStatusUpdated($location));

    // Redirection vers la page de détails de la location
    return redirect()->route('locations.show', $location->id)->with('success', 'Location mise à jour avec succès');
}



public function history()
{
    // Récupérez l'historique de location de l'utilisateur authentifié
    $user = auth()->user();
    $locations = $user->locations;

    // Récupérer les informations des voitures de chaque location
    $cars = Car::whereIn('id', $locations->pluck('car_id'))->get();

    return view('locations.history', compact('locations', 'cars'));
}





    public function confirmDelete($id)
{
    $car = Car::find($id);
    // Ajoutez ici des données nécessaires pour la confirmation de suppression
    return view('cars.confirm-delete', compact('car'));
}
}




