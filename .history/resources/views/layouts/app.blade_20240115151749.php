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
                <!-- Le contenu du menu sera généré dynamiquement par JavaScript -->
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
        @yield('content') <!-- Cette section sera remplacée par le contenu de chaque page -->
    </div>

    <!-- Ajoutez ici le pied de page ou d'autres éléments communs à toutes les pages -->

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
            integrity="sha384-EzFzQxqZlP5nG5h5zNM6tqUv56V9szsv2qdjau9aL5r5eZNefbjvFB1WQ1yOK6hj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-b5C3aTEFXYJAbjMYb9mPSAC77U9yvhT/t+0pBEZlPA2Dp4eJq4JwrBXQthYqOyot"
            crossorigin="anonymous"></script>

    <script>
        // Insérez le code JavaScript ici
        const userType = "utilisateur"; // "visiteur", "utilisateur", "administrateur"
        document.addEventListener("DOMContentLoaded", function () {
            const menu = document.querySelector("nav ul");
            menu.innerHTML = "";
            switch (userType) {
                case "visiteur":
                    createVisitorMenu();
                    break;
                case "utilisateur":
                    createUserMenu();
                    break;
                case "administrateur":
                    createAdminMenu();
                    break;
                default:
                    console.error("Type d'utilisateur non reconnu");
            }
        });

        function createVisitorMenu() {
            menu.innerHTML = `
                <li><a href="index.html">Accueil</a></li>
                <li><a href="cars.html">Liste des véhicules</a></li>
                <li><a href="about.html">À propos</a></li>
                <li><a href="register.html">Inscription</a></li>
                <li><a href="login.html">Connexion</a></li>
            `;
        }

        function createUserMenu() {
            menu.innerHTML = `
                <li><a href="index.html">Accueil</a></li>
                <li><a href="cars.html">Liste des véhicules</a></li>
                <li><a href="rental-history.html">Mes Locations</a></li>
                <li><a href="profile.html">Mon Compte</a></li>
                <li><a href="#" onclick="logout()">Déconnexion</a></li>
            `;
        }

        function createAdminMenu() {
            menu.innerHTML = `
                <li><a href="index.html">Accueil</a></li>
                <li><a href="cars.html">Liste des véhicules</a></li>
                <li><a href="users.html">Utilisateurs</a></li>
                <li><a href="rentals.html">Locations</a></li>
                <li><a href="profile.html">Mon Compte</a></li>
                <li><a href="#" onclick="logout()">Déconnexion</a></li>
            `;
        }

        function logout() {
            // Ajoutez le code de déconnexion ici
        }

        function louer() {
            switch (userType) {
                case "visiteur":
                    window.location.href = "login.html";
                    break;
                case "utilisateur":
                case "administrateur":
                    window.location.href = "car-details.html";
                    break;
                default:
                    console.error("Type d'utilisateur non reconnu");
            }
        }
    </script>

</body>
</html>
