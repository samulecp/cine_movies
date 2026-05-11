<header class="site-header reveal">
    <div class="logo">
        <img src="/img/logofinal.jpeg" alt="Cine XYZ Logo">
    </div>

    <nav class="navbar" id="menu-principal">
        <button class="menu-toggle">☰</button>
        <ul class="nav-links">
            <li><a href="/">Inicio</a></li>
            <li><a href="#cartelera">Cartelera</a></li>
            <li><a href="#horarios">Horarios</a></li>
            <li>
                <div class="dropdown">
                    <select id="cityDropdown" class="city-selector">
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="La Paz">La Paz</option>
                        <option value="Cochabamba">Cochabamba</option>
                    </select>
                </div>
            </li>
        </ul>
    </nav>

    <div class="auth-buttons">
        @guest
            <a id="login" href="{{ route('login') }}" class="auth-button auth-button-primary">Iniciar sesion</a>
            <a id="register" href="{{ route('register') }}" class="auth-button auth-button-secondary">Registrarse</a>
        @endguest

        @auth
            <div class="profile-dropdown">
                <button type="button" class="profile-trigger" aria-label="Menu de perfil">
                    <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </button>
                <div class="profile-menu">
                    <div class="profile-menu-header">
                        <strong>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                    <a href="#" role="button" aria-disabled="true" onclick="return false;">Mi perfil</a>
                    <a href="{{ route('password.edit') }}">Cambiar contrasena</a>
                    <a href="#" role="button" aria-disabled="true" onclick="return false;">Mi cuenta cliente virtual</a>
                    <a href="#" role="button" aria-disabled="true" onclick="return false;">Mis compras</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="profile-logout-btn">Cerrar sesion</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</header>
