<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function registration(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors()->toJson(), 400);
    }

    // Créer l'utilisateur
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'role' => 'user',
    ]);

    Auth::login($user);

    return redirect()->intended(route('welcome'))->with('success', 'Inscription réussie et connexion automatique.');
}




    public function register()
{
    return view('auth.register');
}


    public function login()
{
    return view('auth.login');
}

public function DoLogin(LoginRequest $request)
{
    $credentials = $request->validated();
    
    if(Auth::attempt($credentials))
    {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->intended(route('welcome'));
        }
    }
    return redirect()->route('auth.login')->with('error', 'Les informations de connexion sont incorrectes.');
}

public function logout()
    {
        Auth::logout();

        return view('welcome');
    }







    public function profile()
    {
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }









public function welcome()
{
    $cars = Car::paginate(12); // Vous pouvez ajuster la pagination selon vos besoins
    return view('welcome', compact('cars'));
}


}
