<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ma Voiture App')</title>
    <!-- Ajoutez ici d'autres balises meta, liens CSS, scripts, etc., selon vos besoins -->
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ma Voiture App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars.index') }}">Voitures</a>
                </li>
                <!-- Ajoutez d'autres liens de navigation selon vos besoins -->
                @auth
                    {{ Auth::user()->name }}
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Tableau de Bord</a>
                        </li>
                        <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                            @method("delete")
                            @csrf
                            <button class="nav-link">Se déconnecter</button>
                        </form>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                        </li>
                        <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                            @method("delete")
                            @csrf
                            <button class="nav-link">Se déconnecter</button>
                        </form>
                    @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.register') }}">Inscription</a>
                    </li>
                @endguest
            </ul>
        </div>

        <!-- Formulaire de Recherche -->
    <form action="{{ route('cars.search') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher une voiture..." name="search">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </div>
    </form>

    <form action="{{ route('cars.filter') }}" method="GET" class="form-inline my-2 my-lg-0 ml-auto">
        <select class="form-control mr-sm-2" name="criteria">
            <option value="marque">Marque</option>
            <option value="model">Modèle</option>
            <option value="category">Catégorie</option>
            <option value="max_price">Prix maximum</option>
            <option value="matriculation">Matriculation</option>
            <option value="average">Moyenne</option>
            <option value="recent">Ajouté récemment</option>
        </select>
        <input class="form-control mr-sm-2" type="text" placeholder="Valeur" name="value">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Filtrer</button>
    </form>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Ajoutez ici le pied de page ou d'autres éléments communs à toutes les pages -->

</body>
</html>
