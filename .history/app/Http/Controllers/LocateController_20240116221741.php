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

    $location = new Location([
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'total_price' => $car->calculateTotalPrice($request->input('start_date'), $request->input('end_date')),
        'user_id' => auth()->user()->id,
    ]);

    // Associer la location à la voiture
    $car->locations()->save($location);

    // Rediriger avec un message de succès
    return redirect()->route('confirmation', ['location' => $location])->with('success', 'Location ajoutée avec succès.');
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










    //

public function LocateCarById(Request $request, $carId)
{
    $user = Auth::user();
    $car = Car::findOrFail($carId);

    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    // Vérifier si la voiture est déjà louée pour les dates spécifiées
    $existingLocation = Location::where('car_id', $car->id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
        })
        ->first();

    if ($existingLocation) {
        return response()->json(['message' => 'La voiture est déjà louée pour les dates spécifiées.'], 400);
    }

    // Créer une nouvelle location pour la voiture
    $location = new Location([
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'car_id' => $car->id,
        'user_id' => $user->id,
        ]);


    // Calculer le nombre de jours entre start_date et end_date
    $startDateTime = new \DateTime($location->start_date);
    $endDateTime = new \DateTime($location->end_date);
    $diffInDays = $startDateTime->diff($endDateTime)->days;

    // Calculer le prix en fonction du nombre de jours
    $price = $diffInDays * $car->daily_rate;

    // Enregistrer la location dans la base de données
    $location->save();


    $location->update([
        'prix' => $price,
        ]);

    return response()->json(['message' => 'Location ajoutée avec succès', 'price' => $price]);
}


public function History()
    {
        $user = Auth::user();
        $locations = Location::where('user_id', $user->id)->get();

        return response()->json(['locations' => $locations]);
    }





    public function getLocateById($id)
    {
        $user = Auth::user();
        // Récupérer la location par ID
        $location = Location::find($id);

        // Vérifier si la location existe
        if (!$location) {
            // Retourner une réponse appropriée si la location n'est pas trouvée (par exemple, une vue d'erreur)
            return view('error', ['message' => 'Location introuvable']);
        }
        return response()->json(['locations' => $location]);

        /*// Retourner la vue avec les détails de la location
        return view('locate', compact('location'));*/
    }




    public function cancelLocate(Request $request, $locateId)
{
    // Obtenir l'utilisateur authentifié (si nécessaire)
    $user = Auth::user();

    if($user){
    // Rechercher la location par son ID
    $location = Location::find($locateId);

    // Vérifier si la location existe
    if (is_null($location)) {
        return response()->json(['message' => 'Produit introuvable'], 404);
    }

    // Calculer la différence en heures entre maintenant et la date de début
    $diffInHours = now()->diffInHours($location->start_date);

    // Vérifier si la date de début est dans les 72 heures
    if ($diffInHours >= 72) {
        // Mettre à jour le statut uniquement si la date de début est à au moins 72 heures
        $location->update([
            'status' => 'annulé',
        ]);

        // Retourner la location mise à jour
        return response()->json($location, 200);
    }

    // Si la date de début est dans les 72 heures, renvoyer une réponse appropriée
    return response()->json(['message' => 'La location ne peut pas être annulée car la date de début est dans moins de 72 heures.'], 400);
}
else{
    return response()->json(['message' => 'Veillez vous connecter'],200);
}
}






public function updateLocation(Request $request, $locationId)
{
    $user = Auth::user();

    // Rechercher la location par son ID
    $location = Location::find($locationId);

    // Vérifier si la location existe
    if (is_null($location)) {
        return response()->json(['message' => 'Location introuvable'], 404);
    }

    // Vérifier si la date de début n'est pas encore arrivée
    $startDate = new \DateTime($location->start_date);
    if ($startDate <= now()) {
        return response()->json(['message' => 'Vous ne pouvez pas mettre à jour une location après le début.'], 400);
    }

    // Vérifier si l'utilisateur est le propriétaire de la location
    if ($user->id !== $location->user_id) {
        return response()->json(['message' => 'Vous n\'êtes pas autorisé à mettre à jour cette location'], 403);
    }

    // Valider les données de la requête
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    // Mettre à jour les champs de la location
    $location->start_date = $request->start_date;
    $location->end_date = $request->end_date;

    // Calculer le nouveau prix en fonction des dates mises à jour
    $startDateTime = new \DateTime($location->start_date);
    $endDateTime = new \DateTime($location->end_date);
    $diffInDays = $startDateTime->diff($endDateTime)->days;
    $newPrice = $diffInDays * $location->car->daily_rate;

    // Mettre à jour le prix et enregistrer les modifications
    $location->price = $newPrice;
    $location->save();

    return response()->json(['message' => 'Location mise à jour avec succès', 'new_price' => $newPrice]);
}

}
