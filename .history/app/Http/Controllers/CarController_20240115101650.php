<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    
    public function create()
    {
        return view('cars.create');
    }


    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Vous n\'avez pas la permission d\'ajouter des voitures.'], 403);
        }

        $request->validate([
            'prix' => 'required|numeric',
            'photo_path' => 'image|mimes:jpeg,web,png,jpg,gif,svg|max:2048',
        ]);


        // Ajoutez le car associé à l'utilisateur actuel
        $car = new Car([
            'name' => $request->name,
            'marque' => $request->marque,
            'model' => $request->model,
            'matriculation' => $request->matriculation,
            'description' => $request->description,
            'prix' => $request->prix,
            'category'=> $request->category,
        ]);

        if ($request->hasFile('photo_path')) {
            $imagePath = $request->file('photo_path')->store('images', 'public');
            $car->photo_path = $imagePath;
        }


        $car->save();

        return redirect()->route('dashboard')->with('success', 'Voiture ajoutée avec succès.');
    }

        public function index()
    {
        $cars = Car::paginate(20);

        return view('cars.index', compact('cars'));
    }



    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }


        public function update(Request $request, $id)
    {
        $car = Car::findorFail($id);
        

        // Mettez à jour les données du $car
        $car->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Détails de la voiture mis à jour avec succès.');
    }


    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('dashboard')->with('success', 'Voiture supprimée avec succès.');
    }



    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $cars = Car::where('marque', 'like', "%$search%")
            ->orWhere('matriculation', 'like', "%$search%")
            ->orWhere('model', 'like', "%$search%")
            //->get()
            ->paginate(10);

            if ($cars->isEmpty()) {
                return view('cars.index', ['message' => 'Aucune voiture trouvée pour la recherche: ' . $search]);
            }


        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }
























    public function getAllCars()
    {
        return response()->json([Car::all(),200]);
    }



    public function getCarById($id)
    {
        $car = Car::find($id);
        if(is_null($car)){
            return response()->json(['message'=>'Car introuvable'],404);
        }
        return response()->json(Car::find($id),200);
    }

    public function deleteCar(Request $request,$id)
    {
        $car = Car::find($id);

        if(is_null($car)){
            return response()->json(['message'=>'Voiture introuvable'],404);
        }

        // Vérifiez si l'utilisateur actuel est le propriétaire du vehicle
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Vous n\'avez pas la permission d\'ajouter des voitures.'], 403);
        }

        $car->delete();
        return response()->json(['message' => 'voiture spprimé avec succès']);
    }


    public function searchCar(Request $request)
    {
        // Validez les données du formulaire si nécessaire
        $request->validate([
            'query' => 'required|string',
        ]);

        // Effectuez la recherche des cars
        $results = Car::where('name', 'like', '%' . $request->input('query') . '%')
            ->overWhere('matriculation', 'like', '%' . $request->input('query') . '%')
            ->get();

        return response()->json(['results' => $results]);
    }






    public function filter(Request $request)
    {
        $query = Car::query();

        $criteria = $request->input('criteria', 'recent');

        switch ($criteria) {
            case 'marque':
                $query->where('marque', 'like', "%{$request->input('value')}%");
                break;
            case 'model':
                $query->where('model', 'like', "%{$request->input('value')}%");
                break;
            case 'categorie':
                $query->where('category', 'like', "%{$request->input('value')}%");
                break;
            case 'max_price':
                $query->where('prix', '<=', $request->input('value'));
                break;
            case 'immatriculation':
                $query->where('matriculation', 'like', "%{$request->input('value')}%");
                break;
            case 'average':
                $query->orderBy(DB::raw('COALESCE(AVG(rating), 0)'), 'desc');
                break;
            case 'recent':
            default:
                $query->latest();
                break;
        }

        $cars = $query->get();

        if ($cars->isEmpty()) {
            return view('cars.index', ['message' => 'Aucune voiture trouvée avec les filtres spécifiés.']);
        }

        return view('cars.index', compact('cars'));
    }














    public function filterCars(Request $request)
    {
        $query = Car::query();

        // Filtrage par marque
        if ($request->has('marque')) {
            $query->where('marque', $request->input('marque'));
        }

        // Filtrage par category
        if ($request->has('categorie')) {
            $query->where('category', $request->input('categorie'));
        }

        // Filtrage par model
        if ($request->has('model')) {
            $query->where('model', $request->input('model'));
        }

        // Filtrage par prix minimum
        if ($request->has('min_price')) {
            $query->where('prix', '>=', $request->input('min_price'));
        }

        // Filtrage par prix maximum
        if ($request->has('max_price')) {
            $query->where('prix', '<=', $request->input('max_price'));
        }

        // Filtrage par date d'ajout (les voitures ajoutés après la date spécifiée)
        if ($request->has('added_after')) {
            $query->where('created_at', '>=', $request->input('added_after'));
        }

        // Filtrage par note
        if ($request->has('min_rating')) {
            $query->where('rating', '>=', $request->input('min_rating'));
        }

        // Ordre alphabétique des noms
        if ($request->has('alphabetical_order')) {
            $query->orderBy('name', $request->input('alphabetical_order'));
        }

        // Récupérer les résultats
        $cars = $query->get();

        return response()->json(['cars' => $cars]);
    }








        public function rateCar(Request $request, $carId)
{
    $user = auth()->user();

    $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

    // Vérifiez si l'utilisateur a déjà noté ce car
    $existingRating = $user->ratingForCar(Car::find($carId));

    if ($existingRating) {
        // Si l'utilisateur a déjà noté, mettez à jour la note existante
        $existingRating->update(['rating' => $request->input('rating')]);
    } else {
        // Sinon, créez une nouvelle note
        $user->ratings()->create([
            'car_id' => $carId,
            'rating' => $request->input('rating'),
        ]);
    }

    $car = Car::find($carId);

    $car->update(['rating' => $car->averageRating()]);

    return response()->json(['message' => 'Note enregistrée avec succès']);
}




















        public function dash()
    {
        $totalCars = Car::count();
        $cars = Car::latest()->take(5)->get(); // Modifier selon vos besoins

        return view('dashboard', compact('totalCars', 'cars'));
    }
}
