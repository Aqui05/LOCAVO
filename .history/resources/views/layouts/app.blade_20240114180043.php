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
                <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="nav-link">Se déconnecter</button>
                </form>
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
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Ajoutez ici le pied de page ou d'autres éléments communs à toutes les pages -->

</body>
</html>
