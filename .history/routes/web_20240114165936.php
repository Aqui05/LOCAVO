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

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php

Route::get('/register', [AuthController::class,'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registration'])->name('register.form');



Route::get('/login', [AuthController::class,'login'])->name('auth.login');
Route::post('/login', [AuthController::class,'DoLogin']);


Route::delete('/logout', [AuthController::class,'logout'])->name('auth.logout');




//Operation sur les car

Route::middleware(['auth', 'admin'])->group(function () {
    // Middleware 'admin' can être créé pour vérifier si l'utilisateur est un administrateur
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// routes/web.php



Route::post('/add/cars', [CarController::class, 'store'])->name('cars.store');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');




Route::get('/car/{id}',[CarController::class,'getCarById'])->name('car');
Route::get('/car_all',[CarController::class,'getAllCars'])->name('cars');
Route::post('/addCar',[CarController::class,'addCar'])->name('addCar');
Route::post('/updateCar/{id}',[CarController::class,'updateCar'])->name('updateCar');
Route::delete('/deleteCar/{id}',[CarController::class,'deleteCar'])->name('deleteCar');
Route::get('/searchCars',[CarController::class,'searchCar'])->name('search');


//LOCATION

Route::get('/CarLocate/{id}',[LocateController::class,'LocateCarById'])->name('locate')->middleware('auth');
Route::get('/History_Location',[LocateController::class,'History'])->
    name('history')->name('locate')->middleware('auth');
Route::get('/Locate/{id}',[CarController::class,'getLocateById'])->
    name('detailLocate')->name('locate')->middleware('auth');
Route::post('/CancelLocation/{id}',[LocateController::class,'cancelLocate'])->
    name('cancelLocate')->name('locate')->middleware('auth');
Route::post('/updateLocation/{id}',[LocateController::class,'updateLocation'])->
    name('updateLocate')->name('locate')->middleware('auth');


//filter de Car:

Route::get('/cars/filter', [CarController::class, 'filterCars'])->name('filter');


Route::post('/rate_car/{carId}',[CarController::class, 'rateCar'])->name('rate')->name('locate')->middleware('auth');



