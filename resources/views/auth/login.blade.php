@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="vh-100" style="background-color: #9a9dad;">
    <div class="container py-3">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-8">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('images/LOCAVO.png') }}" alt="Logo" class="img-fluid" style="border-radius: 1rem 0 0 1rem; max-width: 100%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-3 p-lg-4 text-black">
                                <form action="{{ route('auth.login') }}" method="POST" class="vstack gap-3">
                                    @csrf
                                    <div class="d-flex align-items-center mb-2 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">LOCAVO</span>
                                    </div>
                                    <h5 class="fw-normal mb-2 pb-2" style="letter-spacing: 1px; font-size: 1.2rem;">
                                        Connexion à votre compte
                                    </h5>
                                    <div class="form-outline mb-3">
                                        <input type="email" id="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" />
                                        <label class="form-label" for="email">Addresse email</label>
                                        @error("email")
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" />
                                        <label class="form-label" for="password">Mot de passe</label>
                                        @error("password")
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pt-1 mb-3">
                                        <button class="btn btn-dark btn-block" type="submit">Se connecter</button>
                                        @if(session('error'))
                                            <div class="alert alert-danger mt-2">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    </div>
                                    <a class="small text-muted" href="#!">Mt de passe oublié ?</a>
                                    <p class="mb-2 pb-lg-1" style="color: #393f81;">Vous n'aviez pas de compte ?
                                        <a href="{{ route('auth.register') }}" style="color: #393f81;">Créer un nouveau compte</a>
                                    </p>
                                    <a href="#!" class="small text-muted">Termes d'utilisation.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
