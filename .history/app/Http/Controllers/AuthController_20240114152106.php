<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


/*    public function register2(Request $request)
    {
        $validator =Validator::make(
            $request->all(),[
                'name'=>'required',
                'email'=>'required|string|email|unique:users',
                'password'=>'required|string|confirmed|min:6',
            ]
            );
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
            $user = User::create(array_merge(
                $validator->validated(),
                ['password'=>bcrypt($request->password),
                'role' => 'user',
                ]
            ));
            return response()->json([
                'message'=>'user successfully registered',
                'user'=>$user
            ],201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    public function logout2()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }



















public function callback()
    {
        try{
            $user = Socialite::driver('google')->user();

            $is_user = User::where('google_id',$user->getId())->first();

            if(!$is_user){
                $saveUser = User::create(
                    [
                        'google_id' => $user->getId(),
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => Hash::make($user->getName().'@'.$user->getId()),
                    ]
                    );

                    Auth::login($saveUser);

            return redirect()->intended('dashboard');
            }
            else{
                Auth::login($is_user);

            return redirect()->intended('dashboard');
            }

        }
        catch(\Throwable $th)
        {
            dd('something went wrong! '. $th->getMessage());
        }
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }





*/












    public function registration()
{
    return view('auth.register');
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
            return redirect()->intended(route('home'));
        }
    }
    return redirect()->route('auth.login')->with('error', 'Les informations de connexion sont incorrectes.');
}

public function logout()
    {
        Auth::logout();

        return to_route('home');
    }


}
