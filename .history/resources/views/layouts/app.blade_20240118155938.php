<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <title>@yield('title', 'Ma Voiture App')</title>
    <!-- Ajoutez ici d'autres balises meta, liens CSS, scripts, etc., selon vos besoins -->
</head>

<body style="background-color: #f8f9fa;">

    <!-- Header -->
    <header>
        <div class="card fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-secondary p-3">
                <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('welcome') }}"">
                        <img src="{{ asset('images/LOCAVO.png') }}" alt="Logo"
                            width="30" height="24" class="d-inline-block align-text-top">
                            <a class="navbar-brand text-white text-uppercase" href="{{ route('welcome') }}">LOCAVO</a>
                            </a>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white text-uppercase"
                                    href="{{ route('welcome') }}">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white text-uppercase"
                                    href="{{ route('cars.index') }}">Liste des véhicules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white text-uppercase" href="#">Mes Locations</a>
                            </li>
                        </ul>
                    </div>

                            <!-- Formulaire de Recherche  -->

    <form action="{{ route('cars.search') }}" method="GET" class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
    </form>


                    <div class="ml-auto">
                        <ul class="navbar-nav">
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <li class="nav-item">
                                        <a class="nav-link text-white text-uppercase"
                                            href="{{ route('dashboard') }}">Tableau de Bord</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link text-white text-uppercase"
                                            href="{{ route('profile') }}">Profil</a>
                                    </li>
                                @endif
                                <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button class="nav-link text-white text-uppercase">Se déconnecter</button>
                                </form>
                            @endauth
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-white text-uppercase"
                                        href="{{ route('auth.login') }}">Connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white text-uppercase"
                                        href="{{ route('auth.register') }}">Inscription</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>






        <div class="card mt-5">
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </header>

    <!-- Footer -- fixed-bottom -->
    <footer class="bg-light text-center py-3 ">
        <p>&copy; 2024 <strong>Ma Voiture App</strong></p>
    </footer>

</body>

</html>








