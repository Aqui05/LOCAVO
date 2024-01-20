<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    
</body>
</html>



<div class="navbar-nav ms-auto mb-2 mb-lg-0">
    @auth
        {{ Auth::user()->name }}
    @endauth
    @guest
        <a href="{{ route('auth.login') }}">Se connecter</a>
        <a href="{{ route('auth.register') }}">S'inscrire</a>
    @endguest
</div>