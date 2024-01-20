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
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
                <div class="container">
                    <a class="navbar-brand text-white text-uppercase" href="#">Ma Voiture App</a>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('cars.index') }}">Liste des véhicules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Mes Locations</a>
                            </li>
                        </ul>
                    </div>

                    <div class="ml-auto">
                        <ul class="navbar-nav">
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <li class="nav-item">
                                        <a class="nav-link text-white"
                                            href="{{ route('dashboard') }}">Tableau de Bord</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('profile') }}">Profil</a>
                                    </li>
                                @endif
                                <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button class="nav-link text-white">Se déconnecter</button>
                                </form>
                            @endauth
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('auth.login') }}">Connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('auth.register') }}">Inscription</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Formulaire de Recherche  
<form action="{{ route('cars.search') }}" method="GET" class="form-inline mb-2">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Rechercher une voiture..." name="search">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>-->

<!-- Formulaire de Filtre 
<form action="{{ route('cars.filter') }}" method="GET" class="form-inline">
    <div class="input-group mr-2">
        <select class="form-control" name="criteria">
            <option value="marque">Marque</option>
            <option value="model">Modèle</option>
            <option value="category">Catégorie</option>
            <option value="max_price">Prix maximum</option>
            <option value="matriculation">Matriculation</option>
            <option value="average">Moyenne</option>
            <option value="recent">Ajouté récemment</option>
        </select>
        <input class="form-control" type="text" placeholder="Valeur" name="value">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-funnel"></i> Filtrer
        </button>
    </div>
</form>
-->

        <!-- Formulaire de Recherche et Filtre  -->
        <div class="card mt-5">
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 fixed-bottom">
        <p>&copy; 2024 <strong>Ma Voiture App</strong></p>
    </footer>

</body>

</html>











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
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Ma Voiture App</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cars.index') }}">Listes des véhicules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Mes Locations</a>
                    </li>
                </ul>


                    <ul class="navbar-nav ml-auto">
    @auth
        @if(Auth::user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('dashboard') }}">Tableau de Bord</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('profile') }}">Profil</a>
            </li>
        @endif
        <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
            @method("delete")
            @csrf
            <button class="nav-link text-white">Se déconnecter</button>
        </form>
    @endauth
    @guest
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('auth.login') }}">Connexion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('auth.register') }}">Inscription</a>
        </li>
    @endguest
</ul>

                
            </div>
            
            <!-- Formulaire de Recherche et Filtre  -->
<!-- Formulaire de Recherche  -->
<form action="{{ route('cars.search') }}" method="GET" class="form-inline mb-2">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Rechercher une voiture..." name="search">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

<!-- Formulaire de Filtre 
<form action="{{ route('cars.filter') }}" method="GET" class="form-inline">
    <div class="input-group mr-2">
        <select class="form-control" name="criteria">
            <option value="marque">Marque</option>
            <option value="model">Modèle</option>
            <option value="category">Catégorie</option>
            <option value="max_price">Prix maximum</option>
            <option value="matriculation">Matriculation</option>
            <option value="average">Moyenne</option>
            <option value="recent">Ajouté récemment</option>
        </select>
        <input class="form-control" type="text" placeholder="Valeur" name="value">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-funnel"></i> Filtrer
        </button>
    </div>
</form>
-->

            
        </div>
    </nav>

    </header>


    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 <strong>Ma Voiture App</strong></p>
    </footer>

</body>
</html>
