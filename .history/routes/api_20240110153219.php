<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('me', 'AuthController@me')->name('profile');
    Route::get('register', [AuthController::class,'register'])->name('register');

});



//Operation sur les car

Route::get('/car/{id}',[CarController::class,'getCarById']);
Route::get('/car_all',[CarController::class,'getAllCars']);
Route::post('/addCar',[CarController::class,'addCar']);
Route::post('/updateCar/{id}',[CarController::class,'updateCar']);
Route::delete('/deleteCar/{id}',[CarController::class,'deleteCar']);
Route::get('/searchCars',[CarController::class,'searchCar']);


//LOCATION

Route::get('/CarLocate/{id}',[LocateController::class,'LocateCarById']);
Route::get('/History_Location',[LocateController::class,'History']);
Route::get('/Locate/{id}',[CarController::class,'getLocateById']);
Route::post('/CancelLocation/{id}',[LocateController::class,'cancelLocate']);
Route::post('/updateLocation/{id}',[LocateController::class,'updateLocation']);


//filter de Car:

Route::get('/cars/filter', [CarController::class, 'filterCars']);


Route::post('/rate_car/{carId}',[CarController::class, 'rateCar']);
