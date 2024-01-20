<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $cars = Car::paginate(12);

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
            ->paginate(12);

            if ($cars->isEmpty()) {
                return view('cars.index', ['message' => 'Aucune voiture trouvée pour la recherche: ' . $search]);
            }


        return view('cars.index', compact('cars'));
    }



public function show(Car $car)
{
    $favoritedUsers = $car->favoritedByUsers;
    $comments = $car->comments;

    return view('cars.show', compact('car', 'favoritedUsers', 'comments'));
}


public function ViewComment(Car $car)
{
    $comments = $car->comments;

    return view('cars.commentView', compact('comments', 'car'));
}





































    public function filter(Request $request)
    {
        try {

        $query = Car::query();

        $criteria = $request->input('criteria', 'recent');

        switch ($criteria) {
            case 'marque':
                $query->where('marque', 'like', "%{$request->input('value')}%");
                break;
            case 'model':
                $query->where('model', 'like', "%{$request->input('value')}%");
                break;
            case 'category':
                $query->where('category', 'like', "%{$request->input('value')}%");
                break;
            case 'max_price':
                $query->where('prix', '<=', $request->input('value'));
                break;
            case 'matriculation':
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

            $cars = $query->paginate(12);
            

            if ($cars->isEmpty()) {
                return view('cars.index', ['message' => 'Aucune voiture trouvée avec les filtres spécifiés.']);
            }

            return view('cars.index', compact('cars'));
        } catch (\Exception $e) {
            return view('cars.index', ['error' => 'Une erreur s\'est produite. Veuillez réessayer.']);
        }
    }










public function rateCar(Request $request, Car $car)
{
    $request->validate([
        'rating' => 'required|integer|between:1,5',
    ]);

    $userRating = $car->ratings()->where('user_id', auth()->id())->first();

    if ($userRating) {
        // L'utilisateur a déjà noté cette voiture, mettez simplement à jour sa notation existante
        $userRating->update(['rating' => $request->input('rating')]);
    } else {
        // L'utilisateur n'a pas encore noté cette voiture, créez une nouvelle notation
        $rating = new Rating([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'rating' => $request->input('rating'),
        ]);
        $rating->save();
    }

    // Mettez à jour la notation moyenne de la voiture
    $car->update(['rating' => $car->averageRating()]);

    return redirect()->back()->with('success', 'Voiture notée avec succès.');
}









public function favoriteCar(Request $request, Car $car)
{
    // Assurez-vous que l'utilisateur est authentifié
    if (!auth()->check()) {
        return redirect()->route('auth.login')->with('error', 'Vous devez être connecté pour ajouter une voiture aux favoris.');
    }

    // Assurez-vous que la voiture existe
    if (!$car) {
        return redirect()->back()->with('error', 'Voiture non trouvée.');
    }

    // Vérifiez si la voiture est déjà marquée comme favori par l'utilisateur
    if (auth()->user()->favorites()->where('car_id', $car->id)->exists()) {
        return redirect()->back()->with('error', 'Cette voiture est déjà dans vos favoris.');
    }

    // Ajoutez la voiture aux favoris de l'utilisateur
    auth()->user()->favorites()->attach($car);

    return redirect()->back()->with('success', 'Voiture ajoutée aux favoris avec succès.');
}




public function comment(Request $request, Car $car)
{
    $request->validate([
        'comment' => 'required|string',
    ]);

    // Assurez-vous que la voiture existe
    if (!$car) {
        return redirect()->back()->with('error', 'Voiture non trouvée.');
    }

    // Créez le commentaire associé à la voiture
    $comment = new Comment([
        'user_id' => auth()->id(),
        'car_id' => $car->id,
        'comment' => $request->input('comment'),
    ]);
    $comment->save();

    return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
}






































        public function dash()
    {
        $totalCars = Car::count();
        $cars = Car::latest()->take(5)->get(); // Modifier selon vos besoins

        return view('dashboard', compact('totalCars', 'cars'));
    }
}
