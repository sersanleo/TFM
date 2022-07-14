<div>
    <!-- An unexamined life is not worth living. - Socrates -->
</div><nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container-md">
        <div class="navbar-brand font-Lobster user-select-none">
            PetClinic
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav gap-lg-2 me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-home"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-paw"></i> Mascotas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-calendar-day"></i> Citas
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav gap-lg-2 mb-2 mb-lg-0">
                @auth
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mi cuenta
                        </button>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item d-flex gap-1 align-items-center" href="/admin">
                                <i class="fas fa-fw fa-cog" aria-hidden="true"></i>
                                <span class="flex-grow-1">Administrar</span>
                            </a>
                            <hr class="dropdown-divider" role="separator">
                            <a class="dropdown-item text-danger d-flex gap-1 align-items-center" href="{{ route('logout') }}">
                                <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i>
                                <span class="flex-grow-1">Cerrar sesión</span>
                            </a>
                        </div>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link{{ (request()->is('login')) ? ' active' : '' }}" href="{{ route('login') }}">
                        Iniciar sesión
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ (request()->is('register')) ? ' active' : '' }}" href="{{ route('register') }}">
                        Registrarme
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
