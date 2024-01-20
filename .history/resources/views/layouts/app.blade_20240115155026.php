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

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Bootstrap
    </a>
  </div>
</nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Ajoutez ici le pied de page ou d'autres éléments communs à toutes les pages -->
</body>
</html>
