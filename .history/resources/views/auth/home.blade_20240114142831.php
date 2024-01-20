<div class="navbar-nav ms-auto mb-2 mb-lg-0">
    @auth
        {{ Auth::user()->name }}
    @endauth
    @guest
        <a href="{{ route('auth.login') }}">Se connecter</a>
    @endguest
</div>