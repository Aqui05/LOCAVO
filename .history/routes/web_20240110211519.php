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



//Operation sur les car

Route::get('/car/{id}',[CarController::class,'getCarById'])->name('car');
Route::get('/car_all',[CarController::class,'getAllCars'])->name('cars');
Route::post('/addCar',[CarController::class,'addCar'])->name('addCar');
Route::post('/updateCar/{id}',[CarController::class,'updateCar'])->name('updateCar');
Route::delete('/deleteCar/{id}',[CarController::class,'deleteCar'])->name('deleteCar');
Route::get('/searchCars',[CarController::class,'searchCar'])->name('search');


//LOCATION

Route::get('/CarLocate/{id}',[LocateController::class,'LocateCarById'])->name('locate');
Route::get('/History_Location',[LocateController::class,'History'])->name('history');
Route::get('/Locate/{id}',[CarController::class,'getLocateById'])->name('detailLocate');
Route::post('/CancelLocation/{id}',[LocateController::class,'cancelLocate'])->name('cancelLocate');
Route::post('/updateLocation/{id}',[LocateController::class,'updateLocation'])->name('updateLocate');


//filter de Car:

Route::get('/cars/filter', [CarController::class, 'filterCars'])->name('filter');


Route::post('/rate_car/{carId}',[CarController::class, 'rateCar'])->name('rate');



// routes/web.php

Route::post('/registration', [AuthController::class,'showRegisterForm'])->name('register.form');

Route::get('/connect', [AuthController::class,'showLoginForm'])->name('login.form');
