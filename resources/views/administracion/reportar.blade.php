<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="rounded-circle" rel="icon" href="{{ asset('img/logo-admin.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/administracion/p1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/administracion/pagina-reportar.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <title>Reportes de Citas</title>
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
        @if (session('success'))
            <div class="alert-custom alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert-custom alert-warning">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('warning') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-custom alert-error">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        
        <div class="page-header">
            <div>
                <h1>
                    <i class="fa-solid fa-file-medical me-2"></i>
                    Reportes de Citas
                </h1>
                <p>Registre el diagnóstico y envíe el reporte clínico al paciente por correo.</p>
            </div>
            <span class="badge-count">
                <i class="fa-solid fa-stethoscope me-1"></i>
                {{ $citas->count() }} {{ $citas->count() === 1 ? 'cita' : 'citas' }}
            </span>
        </div>

        
        @if ($citas->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-calendar-xmark"></i>
                <h3>Sin citas registradas</h3>
                <p>No hay citas asignadas a su usuario en este momento.</p>
            </div>
        @else
            <div class="citas-grid">
                @foreach ($citas as $cita)
                    <div class="cita-card">

                        
                        <div class="cita-card-header">
                            <div class="paciente-info">
                                <h3>
                                    <i class="fa-solid fa-user-injured me-1" style="font-size:.85rem;opacity:.8"></i>
                                    {{ $cita->nombre_paciente }}
                                </h3>
                                <span>Cédula: {{ $cita->cedula }} &nbsp;·&nbsp; {{ $cita->especialidad }}</span>
                            </div>
                            @php
                                $estadoClass = match($cita->estado) {
                                    'pendiente'  => 'estado-pendiente',
                                    'confirmada' => 'estado-confirmada',
                                    'finalizada' => 'estado-finalizada',
                                    'cancelada'  => 'estado-cancelada',
                                    default      => 'estado-pendiente',
                                };
                            @endphp
                            <span class="estado-badge {{ $estadoClass }}">{{ ucfirst($cita->estado) }}</span>
                        </div>

                        
                        <div class="cita-card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label><i class="fa-regular fa-calendar me-1"></i>Fecha</label>
                                    <span>{{ $cita->fecha_asignada }}</span>
                                </div>
                                <div class="info-item">
                                    <label><i class="fa-regular fa-clock me-1"></i>Hora</label>
                                    <span>{{ $cita->hora_cita }}</span>
                                </div>
                                <div class="info-item">
                                    <label><i class="fa-solid fa-building me-1"></i>Sede</label>
                                    <span>{{ $cita->sede }}</span>
                                </div>
                                <div class="info-item">
                                    <label><i class="fa-solid fa-shield-halved me-1"></i>EPS</label>
                                    <span>{{ $cita->eps }}</span>
                                </div>
                                <div class="info-item">
                                    <label><i class="fa-solid fa-phone me-1"></i>Teléfono</label>
                                    <span>{{ $cita->telefono ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <label><i class="fa-regular fa-envelope me-1"></i>Correo</label>
                                    <span>{{ $cita->email ?? '—' }}</span>
                                </div>
                                @if ($cita->motivo_especifico)
                                    <div class="info-item" style="grid-column: 1/-1;">
                                        <label><i class="fa-solid fa-notes-medical me-1"></i>Motivo</label>
                                        <span>{{ $cita->motivo_especifico }}</span>
                                    </div>
                                @endif
                            </div>

                            @if ($cita->estado === 'cancelada')
                                <span class="cancelada-note">
                                    <i class="fa-solid fa-ban"></i> Cita cancelada
                                </span>
                            @else
                                <button class="btn-toggle-form"
                                        onclick="toggleForm('form-{{ $cita->id }}', this)">
                                    <i class="fa-solid fa-file-pen"></i> Registrar diagnóstico
                                </button>

                                <div class="diagnostico-form" id="form-{{ $cita->id }}">
                                    <p class="form-section-title">
                                        <i class="fa-solid fa-stethoscope"></i> Diagnóstico y reporte clínico
                                    </p>

                                    <form action="{{ route('diagnostico.enviar', $cita->id) }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label class="form-label-custom" for="diagnostico_{{ $cita->id }}">
                                                Diagnóstico <span class="required">*</span>
                                            </label>
                                            <textarea class="form-control-custom"
                                                      id="diagnostico_{{ $cita->id }}"
                                                      name="diagnostico"
                                                      rows="3"
                                                      placeholder="Describa el diagnóstico del paciente..."
                                                      required>{{ old('diagnostico') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label-custom" for="tratamiento_{{ $cita->id }}">
                                                Tratamiento / Indicaciones <span class="required">*</span>
                                            </label>
                                            <textarea class="form-control-custom"
                                                      id="tratamiento_{{ $cita->id }}"
                                                      name="tratamiento"
                                                      rows="3"
                                                      placeholder="Indique el tratamiento o indicaciones médicas..."
                                                      required>{{ old('tratamiento') }}</textarea>
                                        </div>

                                        <div class="form-row">
                                            <div>
                                                <label class="form-label-custom" for="proxima_cita_{{ $cita->id }}">
                                                    Próxima cita
                                                </label>
                                                <input type="date"
                                                       class="form-control-custom"
                                                       id="proxima_cita_{{ $cita->id }}"
                                                       name="proxima_cita"
                                                       min="{{ date('Y-m-d') }}"
                                                       value="{{ old('proxima_cita') }}">
                                            </div>
                                            <div>
                                                <label class="form-label-custom" for="observaciones_{{ $cita->id }}">
                                                    Observaciones adicionales
                                                </label>
                                                <textarea class="form-control-custom"
                                                          id="observaciones_{{ $cita->id }}"
                                                          name="observaciones"
                                                          rows="2"
                                                          placeholder="Observaciones opcionales...">{{ old('observaciones') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <button type="submit" class="btn-enviar">
                                                <i class="fa-solid fa-paper-plane"></i>
                                                Generar PDF y enviar por correo
                                            </button>
                                            <button type="button"
                                                    class="btn-toggle-form"
                                                    style="background:transparent;border-color:#ccc;color:#666;"
                                                    onclick="toggleForm('form-{{ $cita->id }}', this, true)">
                                                <i class="fa-solid fa-xmark"></i> Cancelar
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

         <footer class="text-secondary text-center py-3 mt-4 border-top">
            &copy; {{ date('Y') }} SaludAdmin. Todos los derechos reservados.
        </footer>

    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleForm(id, btn, forceClose = false) {
            const form = document.getElementById(id);
            if (!form) return;

            const isOpen = form.classList.contains('open');

            if (forceClose || isOpen) {
                form.classList.remove('open');
                const mainBtn = form.closest('.cita-card-body').querySelector('.btn-toggle-form');
                if (mainBtn && mainBtn !== btn) {
                    mainBtn.innerHTML = '<i class="fa-solid fa-file-pen"></i> Registrar diagnóstico';
                }
            } else {
                form.classList.add('open');
                if (!forceClose) {
                    btn.innerHTML = '<i class="fa-solid fa-chevron-up"></i> Ocultar formulario';
                }
                form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        @if ($errors->any())
            document.querySelectorAll('.diagnostico-form').forEach(f => f.classList.add('open'));
        @endif
    </script>

</body>
</html>
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
                    <p class="mb-1"> <i class="fa-solid fa-clock me-1"></i> <strong>Horarios:</strong>
                        @foreach(session('medico.horarios') ?? [] as $horario)
                            {{ $horario['dia'] }} · {{ $horario['inicio'] }} - {{ $horario['fin'] }}
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>