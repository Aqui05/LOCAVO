<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocateController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class,'welcome'])->name('welcome');

// routes/web.php

Route::get('/register', [AuthController::class,'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registration'])->name('register.form');



Route::get('/login', [AuthController::class,'login'])->name('auth.login');
Route::post('/login', [AuthController::class,'DoLogin']);


Route::delete('/logout', [AuthController::class,'logout'])->name('auth.logout');


Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

//Operation sur les car

Route::middleware(['auth', 'admin'])->group(function () {
    // Middleware 'admin' create pour vérifier si l'utilisateur est un administrateur

    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/add/cars', [CarController::class, 'store'])->name('cars.store');

    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');

    Route::put('/update/cars/{car}', [CarController::class, 'update'])->name('cars.update');

    Route::delete('/cars/destroy/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('/dashboard', [CarController::class, 'dash'])->name('dashboard');

    Route::get('/cars/{id}/confirm-delete', [CarController::class, 'confirmDelete'])->name('cars.confirm-delete');

});


Route::get('/cars/filter', [CarController::class, 'filter'])->name('cars.filter');

Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');


Route::get('/car/{car}', [CarController::class, 'show'])->name('cars.show');


Route::get('/cars', [CarController::class, 'index'])->name('cars.index');



//Operation sur les locations

Route::middleware(['auth'])->group(function () {
    Route::get('/locations/create/{car}', [LocateController::class,'createLocation'])->name('locations.create');
    Route::post('/locations/store/{car}', [LocateController::class,'storeLocation'])->name('locations.store');
    Route::get('/location/show/{location}', [LocateController::class,'show'])->name('locations.show');


    Route::get('/locations/{location}/edit', [LocateController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/update/{location}', [LocateController::class, 'update'])->name('locations.update');


    Route::delete('/locations/destroy/{location}', [LocateController::class,'destroy'])->name('locations.destroy');

    Route::get('/confirmation/{location}', [LocateController::class,'confirmation'])->name('confirmation');

    Route::get('/cars/{id}/confirm-delete', [LocateController::class, 'confirmDeleteLocation'])->
        name('locations.confirm-delete');

});











Route::post('/rate/{car}', [CarController::class,'rateCar'])->name('cars.rate')->middleware('auth');

Route::post('/favorite/{car}', [CarController::class,'favoriteCar'])->name('cars.favorite')->middleware('auth');

Route::post('/comment/{car}', [CarController::class,'comment'])->name('cars.comment')->middleware('auth');

Route::get('/view/comments/{car}', [CarController::class,'ViewComment'])->name('cars.commentView');




Route::get('/locations/history', [LocateController::class,'history'])->name('locations.history')->middleware('auth');




