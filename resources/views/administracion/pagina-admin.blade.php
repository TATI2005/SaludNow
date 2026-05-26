<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="rounded-circle" rel="icon" href="{{asset('img/logo-admin.png')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/administracion/pagina.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>
<script>
    setTimeout(function() {
        alert('Tu sesión expirará en 2 minutos.');
    }, 118 * 60 * 1000);

    setTimeout(function() {
        alert('Sesión expirada. Vuelve a iniciar sesión.');
        window.location.href = '/login-medico';
    }, 120 * 60 * 1000);
</script>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-sidebar navbar-mobile shadow-sm w-100 p-3">
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
                    <li><a href="/blog" class="nav-link active"><i class="fa-solid fa-globe me-2"></i> Blog</a></li>
                </ul>
                 <hr class="text-white-50">
                <div class="dropdown pb-2">
                    <a href="#" class="gap-2 d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="mobUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ session('medico.nombre') }}&background=89cbca&color=1f5945" alt="" width="32" height="32" class="rounded-circle">  
                        <strong>{{ session('medico.nombre') }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="mobUser">
                        <li><a class="dropdown-item" href="{{ url('/medico/logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar-desktop bg-sidebar p-3 text-white shadow-sm">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="fa-solid fa-heart-pulse me-2 fs-4"></i>
            <span class="fs-4 fw-bold">SaludAdmin</span>
        </a>
        <hr class="my-2">
        <ul class="nav nav-pills flex-column mb-auto gap-1">
            <li><a href="/pagina-admin" class="nav-link active"><i class="fa-solid fa-chart-area me-2"></i> Dashboard</a></li>
            <li><a href="/gestion-citas" class="nav-link"><i class="fa-solid fa-calendar-check me-2"></i> Gestión de Citas</a></li>
            <li><a href="/reportar" class="nav-link"><i class="fa-solid fa-file-invoice me-2"></i> Reportes de Citas</a></li>
            <li><a href="/blog" class="nav-link active"><i class="fa-solid fa-globe me-2"></i> Blog</a></li>
        </ul>
        <hr class="my-2">
        <div class="dropdown">
            <a href="#" class="gap-2 d-flex align-items-center text-white text-decoration-none dropdown-toggle py-1" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ session('medico.nombre') }}&background=89cbca&color=1f5945" alt="" width="32" height="32" class="rounded-circle">  
                <strong>{{ session('medico.nombre') }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{ url('/medico/logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-12 col-sm-6">
                <h2 class="fw-bold mb-0 fs-3 text-dark">Panel de Control</h2>
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

        <div class="row g-3">
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
                        </div>
                        <div class="text-warning fs-3 bg-warning bg-opacity-10 p-3 rounded-3 ms-2">
                            <i class="fa-solid fa-hospital"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
       <div class="row g-3 mb-4">
            <div class="col-12 col-lg-7">
                <div class="bg-white p-4 shadow-sm rounded-4 border-0" style="min-height: 380px;">
                    <h5 class="fw-bold text-dark mb-4 fs-5">
                        <i class="fa-solid fa-users-viewfinder me-2 text-success"></i> Monitoreo Global de Usuarios Activos
                    </h5>
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="graficaUsuariosActivos"></canvas>
                    </div>
                </div>
            </div>

    </div> 
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="js/administracion/dashboard.js"></script>
    
    <script>
        // Variables compartidas Globales extraídas de Laravel
        const diasData = @json($diasSemana);
        const baseUsuarios = {{ $usuariosActivos ?? 0 }};
        const totalCitasBase = {{ $totalCitas ?? 0 }};
        const paletaVerdes = ['#1f5945', '#327d63', '#52a289', '#89cbca', '#b3e0df', '#e2f3f3', '#ced4da'];

        // --- 1. CONFIGURACIÓN GRÁFICA DE LÍNEA ---
        const ctxL = document.getElementById('graficaUsuariosActivos').getContext('2d');
        const degradado = ctxL.createLinearGradient(0, 0, 0, 260);
        degradado.addColorStop(0, 'rgba(31, 89, 69, 0.45)');
        degradado.addColorStop(0.5, 'rgba(137, 203, 202, 0.15)');
        degradado.addColorStop(1, 'rgba(255, 255, 255, 0)');

        const datosDinamicos = diasData.map((_, index) => {
            if (baseUsuarios === 0) return 0;
            return Math.max(0, baseUsuarios + ([0, -1, 1, 0, -1, 1, 0][index % 7]));
        });

        new Chart(ctxL, {
            type: 'line',
            data: {
                labels: diasData, 
                datasets: [{
                    label: 'Usuarios Conectados',
                    data: datosDinamicos,
                    borderColor: '#1f5945', 
                    borderWidth: 3.5,
                    fill: true,
                    backgroundColor: degradado, 
                    tension: 0.38, 
                    pointRadius: 5, 
                    pointBackgroundColor: '#ffffff', 
                    pointBorderColor: '#1f5945',     
                    pointBorderWidth: 3,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true,
                        suggestedMax: baseUsuarios + 2, 
                        ticks: { color: '#8a92a6', font: { size: 11 }, stepSize: baseUsuarios > 10 ? undefined : 1 },
                        grid: { color: '#f1f4f9', drawBorder: false }
                    },
                    x: { 
                        ticks: { color: '#8a92a6', font: { size: 12, weight: '500' } },
                        grid: { display: false }
                    }
                }
            }
        });

    </script>
</body>
</html>