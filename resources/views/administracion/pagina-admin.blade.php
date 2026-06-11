<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="rounded-circle" rel="icon" href="{{asset('img/logo-admin.png')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/administracion/p1.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>
<script>
    setTimeout(function() {
        alert('Sesión expirada. Vuelve a iniciar sesión.');
        window.location.href = '/login-medico';
    }, 14 * 60 * 1000);
</script>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-sidebar d-md-none  navbar-mobile shadow-sm w-100 p-3">
        <div class="container-fluid p-0">
            <a class="navbar-brand fw-bold d-flex align-items-center text-white text-decoration-none" href="/">
                <i class="fa-solid fa-heart-pulse me-2"></i> SaludAdmin
            </a>
            <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMobileMenu" aria-controls="navMobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse mt-3" id="navMobileMenu">
                <ul class="nav nav-pills flex-column gap-1 mb-3">
                    <li><a href="/pagina-admin" class="nav-link active"><i class="fa-solid fa-chart-area me-2"></i> Dashboard</a></li>
                    <li><a href="/gestion-citas" class="nav-link"><i class="fa-solid fa-calendar-check me-2"></i> Gestión de Citas</a></li>
                    <li><a href="/reportar" class="nav-link"><i class="fa-solid fa-file-invoice me-2"></i> Reportes de Citas</a></li>
                    <li><a href="/blog" class="nav-link"><i class="fa-solid fa-globe me-2"></i> Blog</a></li>
                </ul>
                <hr class="text-white-50">
                <div class="dropdown pb-2">
                    <a href="#" class="gap-2 d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="mobUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ session('medico.nombre') }}&background=89cbca&color=1f5945" alt="" width="32" height="32" class="rounded-circle">
                        <strong>{{ session('medico.nombre') }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="mobUser">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalPerfil"><i class="fa-solid fa-user me-2"></i> Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/medico/logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar-desktop bg-sidebar p-3 d-none d-md-flex flex-column  text-white shadow-sm">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="fa-solid fa-heart-pulse me-2 fs-4"></i>
            <span class="fs-4 fw-bold">SaludAdmin</span>
        </a>
        <hr class="my-2">
        <ul class="nav nav-pills flex-column mb-auto gap-1">
            <li><a href="/pagina-admin" class="nav-link active"><i class="fa-solid fa-chart-area me-2"></i> Dashboard</a></li>
            <li><a href="/gestion-citas" class="nav-link"><i class="fa-solid fa-calendar-check me-2"></i> Gestión de Citas</a></li>
            <li><a href="/reportar" class="nav-link"><i class="fa-solid fa-file-invoice me-2"></i> Reportes de Citas</a></li>
            <li><a href="/blog" class="nav-link"><i class="fa-solid fa-globe me-2"></i> Blog</a></li>
        </ul>
        <hr class="my-2">
        <div class="dropdown  dropup">
            <a href="#" class="gap-2 d-flex align-items-center text-white text-decoration-none dropdown-toggle py-1" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ session('medico.nombre') }}&background=89cbca&color=1f5945" alt="" width="32" height="32" class="rounded-circle">
                <strong>{{ session('medico.nombre') }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" data-bs-popper="static">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalPerfil"><i class="fa-solid fa-user me-2"></i> Mi Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ url('/medico/logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">

        <div class="row g-3 mb-4 align-items-center">
            <div class="col-12 col-sm-6">
                <h2>Panel de Control</h2>
                <small class="text-muted">Bienvenido, Dr(a). {{ session('medico.nombre') }}</small>
            </div>
            <div class="col-12 col-sm-6 text-sm-end">
                <div class="live-datetime bg-white px-3 py-2 rounded-3 shadow-sm border d-inline-block text-start">
                    <span id="fechaActual"></span>
                    <span class="mx-2 text-muted">|</span>
                    <i class="fa-regular fa-clock me-1 text-secondary"></i> <span id="horaActual" class="fw-bold text-dark"></span>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 border-start border-primary border-5 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold">Usuarios Activos</h6>
                            <h2 class="fw-bold mb-0 text-dark mt-1">{{ $usuariosActivos ?? 0 }}</h2>
                        </div>
                        <div class="text-primary fs-3 bg-primary bg-opacity-10 p-3 rounded-3">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 border-start border-success border-5 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold">Total Citas</h6>
                            <h2 class="fw-bold mb-0 text-dark mt-1">{{ $totalCitas ?? 0 }}</h2>
                        </div>
                        <div class="text-success fs-3 bg-success bg-opacity-10 p-3 rounded-3">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 bg-white shadow-sm rounded-4 border-start border-warning border-5 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold">Sede Asignada</h6>
                            <h5 class="fw-bold mb-0 text-dark mt-2" style="font-size: 1.05rem;">{{ session('medico.sede') }}</h5>
                            @foreach(session('medico.horarios') ?? [] as $horario)
                            
                                <h6 class="mb-1 ms-4 small">
                                    {{ $horario['dia'] }} · {{ $horario['inicio'] }} - {{ $horario['fin'] }}
                                </h6>
                            @endforeach
                        </div>
                        <div class="text-warning fs-3 bg-warning bg-opacity-10 p-3 rounded-3 ms-2">
                            <i class="fa-solid fa-hospital"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-7">
                <div class="bg-white p-4 shadow-sm rounded-4 border-0" style="min-height: 380px;">
                    <h5>
                        <i class="fa-solid fa-users-viewfinder me-2 text-success"></i> Monitoreo Global de Usuarios Activos
                    </h5>
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="graficaUsuariosActivos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="bg-white p-4 shadow-sm rounded-4 border-0" style="min-height: 380px;">
                    <h5 class="fw-bold text-dark mb-3 fs-5">
                        <i class="fa-solid fa-calendar me-2 text-success"></i> Calendario
                    </h5>
                    <div id="calendarioAdmin"></div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-5">
                <div class="bg-white p-4 shadow-sm rounded-4 border-0">
                    <h5 class="fw-bold text-dark mb-4 fs-5">
                        <i class="fa-solid fa-chart-pie me-2 text-success"></i> Citas por Estado
                    </h5>
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="graficaEstados"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="bg-white p-4 shadow-sm rounded-4 border-0">
                    <h5 class="fw-bold text-dark mb-4 fs-5">
                        <i class="fa-solid fa-calendar-days me-2 text-success"></i> Próximas Citas por Día
                    </h5>
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="graficaProximas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-secondary text-center py-3 mt-4 border-top">
            &copy; {{ date('Y') }} SaludAdmin. Todos los derechos reservados.
        </footer>

    </div>

    <!-- Modal Perfil -->
    <div class="modal fade" id="modalPerfil" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background-color: #1f5945; color: white;">
                    <h5 class="modal-title"><i class="fa-solid fa-user me-2"></i> Mi Perfil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <img src="https://ui-avatars.com/api/?name={{ session('medico.nombre') }}&background=89cbca&color=1f5945&size=80"
                         class="rounded-circle mb-3" width="80" height="80">
                    <h5 class="fw-bold text-dark">{{ session('medico.nombre') }}</h5>
                    <hr>
                    <div class="text-start">
                        <p><i class="fa-solid fa-envelope me-2 text-success"></i> <strong>Correo:</strong> {{ session('medico.email') }}</p>
                        <p><i class="fa-solid fa-hospital me-2 text-success"></i> <strong>Sede:</strong> {{ session('medico.sede') }}</p>
                        <p><i class="fa-solid fa-stethoscope me-2 text-success"></i> <strong>Especialidad:</strong> {{ session('medico.especialidad') }}</p>
                        <p class="mb-1"> <i class="fa-solid fa-clock me-2 text-success"></i> <strong>Horarios:</strong>
                        @foreach(session('medico.horarios') ?? [] as $horario)
                                {{ $horario['dia'] }} · {{ $horario['inicio'] }} - {{ $horario['fin'] }}
                            
                        @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/administracion/dashboard.js') }}"></script>

</body>
</html>