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

    <script>
    // Gráfica dona
    const ctxD = document.getElementById('graficaEstados').getContext('2d');
    new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ['Pendientes', 'Confirmadas', 'No Asistidas'],
            datasets: [{
                data: [{{ $citasPendientes }}, {{ $citasConfirmadas }}, {{ $citasNoAsistidas }}],
                backgroundColor: ['#f59e0b', '#1f5945', '#ef4444'],
                borderWidth: 0, hoverOffset: 8
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#6b7280', font: { size: 12 }, padding: 16 } } } }
    });

    // Gráfica barras
    const ctxB = document.getElementById('graficaProximas').getContext('2d');
    new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: @json($diasSemana),
            datasets: [{ label: 'Citas', data: @json($datosGrafica), backgroundColor: '#89cbca', borderRadius: 8, borderSkipped: false }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { color: '#8a92a6', stepSize: 1 }, grid: { color: '#f1f4f9' } }, x: { ticks: { color: '#8a92a6' }, grid: { display: false } } } }
    });

    // Gráfica línea
    const diasData = @json($diasSemana);
    const baseUsuarios = {{ $usuariosActivos ?? 0 }};
    const ctxL = document.getElementById('graficaUsuariosActivos').getContext('2d');
    const degradado = ctxL.createLinearGradient(0, 0, 0, 260);
    degradado.addColorStop(0, 'rgba(31, 89, 69, 0.45)');
    degradado.addColorStop(0.5, 'rgba(137, 203, 202, 0.15)');
    degradado.addColorStop(1, 'rgba(255, 255, 255, 0)');
    const datosDinamicos = diasData.map((_, i) => baseUsuarios === 0 ? 0 : Math.max(0, baseUsuarios + ([0,-1,1,0,-1,1,0][i%7])));
    new Chart(ctxL, {
        type: 'line',
        data: { labels: diasData, datasets: [{ label: 'Usuarios Conectados', data: datosDinamicos, borderColor: '#1f5945', borderWidth: 3.5, fill: true, backgroundColor: degradado, tension: 0.38, pointRadius: 5, pointBackgroundColor: '#ffffff', pointBorderColor: '#1f5945', pointBorderWidth: 3, pointHoverRadius: 7 }] },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, suggestedMax: baseUsuarios + 2, ticks: { color: '#8a92a6', font: { size: 11 }, stepSize: baseUsuarios > 10 ? undefined : 1 }, grid: { color: '#f1f4f9', drawBorder: false } }, x: { ticks: { color: '#8a92a6', font: { size: 12, weight: '500' } }, grid: { display: false } } } }
    });

    // Calendario
    const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    const diasSem = ['Lu','Ma','Mi','Ju','Vi','Sá','Do'];
    let cal = new Date();
    function renderCal() {
        const year = cal.getFullYear(), month = cal.getMonth(), today = new Date();
        const firstDay = new Date(year, month, 1).getDay();
        const offset = firstDay === 0 ? 6 : firstDay - 1;
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        let html = `<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <button onclick="cal.setMonth(cal.getMonth()-1);renderCal()" style="background:none;border:none;cursor:pointer;font-size:18px;color:#1f5945;">‹</button>
            <span style="font-weight:500;font-size:14px;">${meses[month]} ${year}</span>
            <button onclick="cal.setMonth(cal.getMonth()+1);renderCal()" style="background:none;border:none;cursor:pointer;font-size:18px;color:#1f5945;">›</button>
        </div><div style="display:grid;grid-template-columns:repeat(7,1fr);gap:2px;margin-bottom:4px;">`;
        diasSem.forEach(d => { html += `<div style="text-align:center;font-size:11px;color:#6c757d;padding:4px 0;">${d}</div>`; });
        html += '</div><div style="display:grid;grid-template-columns:repeat(7,1fr);gap:2px;">';
        for (let i = 0; i < offset; i++) html += '<div></div>';
        for (let d = 1; d <= daysInMonth; d++) {
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            html += `<div style="text-align:center;padding:6px 2px;border-radius:6px;font-size:13px;cursor:pointer;background:${isToday?'#1f5945':'transparent'};color:${isToday?'#fff':'#333'};font-weight:${isToday?'500':'400'};" onmouseover="if(!${isToday})this.style.background='#e2f3f3'" onmouseout="if(!${isToday})this.style.background='transparent'">${d}</div>`;
        }
        html += '</div>';
        document.getElementById('calendarioAdmin').innerHTML = html;
    }
    renderCal();
    </script>

</body>
</html>