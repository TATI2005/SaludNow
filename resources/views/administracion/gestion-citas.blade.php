<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="rounded-circle" rel="icon" href="{{asset('img/logo-admin.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/administracion/p1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/administracion/pagina-gestion-citas.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Gestión de Citas - SaludAdmin</title>
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

    <main class="main-content">
        <div class="container-fluid p-0">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>Control de Citas Médicas</h2>
                    <p class="text-muted small m-0">Administra, edita y realiza el seguimiento de las citas asignadas.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-stat text-white p-3 shadow-sm" style="background-color: var(--confirmada);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-white-50 small text-uppercase fw-bold">Confirmadas</span>
                                <h3 class="fw-bold m-0 mt-1">{{ $citas->where('estado', 'Confirmada')->count() ?? 0 }}</h3>
                            </div>
                            <div class="icon-shape">
                                <i class="fa-solid fa-calendar-check fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-stat text-white p-3 shadow-sm" style="background-color: var(--pendiente);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-white-50 small text-uppercase fw-bold">Pendientes</span>
                                <h3 class="fw-bold m-0 mt-1">{{ $citas->where('estado', 'Pendiente')->count() ?? 0 }}</h3>
                            </div>
                            <div class="icon-shape">
                                <i class="fa-solid fa-clock fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-stat text-white p-3 shadow-sm" style="background-color: var(--no-asistida);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-white-50 small text-uppercase fw-bold">No Asistidas</span>
                                <h3 class="fw-bold m-0 mt-1">{{ $citas->where('estado', 'No Asistida')->count() ?? 0 }}</h3>
                            </div>
                            <div class="icon-shape">
                                <i class="fa-solid fa-user-xmark fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card table-container p-4 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead>
                            <tr class="border-bottom text-muted">
                                <th>Paciente / Cédula</th>
                                <th>Médico Asignado</th>
                                <th>Contacto / EPS</th>
                                <th>Motivo / Descripción</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($citas as $cita)
                            <tr class="border-bottom">
                                <td>
                                    <div class="fw-bold">{{ $cita->nombre_paciente }}</div>
                                    <div class="text-muted small"><i class="fa-solid fa-id-card me-1"></i>{{ $cita->cedula }} ({{ $cita->edad }} años)</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><i class="fa-solid fa-user-doctor me-1 text-muted"></i>{{ $cita->nombre_medico ?? 'Dra. Asignada' }}</div>
                                    <div class="text-muted small">
                                        {{ $cita->especialidad ?? ($cita->nombre_medico == 'Marcela Sanchez Gamboa' ? 'Medicina General' : 'General') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="small"><i class="fa-solid fa-phone me-1 text-muted"></i>{{ $cita->telefono }}</div>
                                    <div class="text-muted small fw-semibold">{{ $cita->eps }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate small" style="max-width: 180px;">{{ $cita->motivo_especifico }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 200px;">{{ $cita->descripcion }}</div>
                                </td>
                                <td>
                                    @if(strtolower($cita->estado) == 'confirmada')
                                        <span class="badge-status bg-confirmada-light">Confirmada</span>
                                    @elseif(strtolower($cita->estado) == 'pendiente')
                                        <span class="badge-status bg-pendiente-light">Pendiente</span>
                                    @else
                                        <span class="badge-status bg-no-asistida-light">No Asistida</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary btn-editar-cita" 
                                                data-id="{{ $cita->id }}"
                                                data-nombre="{{ $cita->nombre_paciente }}"
                                                data-cedula="{{ $cita->cedula }}"
                                                data-edad="{{ $cita->edad }}"
                                                data-direccion="{{ $cita->direccion }}"
                                                data-telefono="{{ $cita->telefono }}"
                                                data-eps="{{ $cita->eps }}"
                                                data-medico="{{ $cita->nombre_medico }}"
                                                data-fecha="{{ $cita->fecha_asignada }}"
                                                data-email="{{ $cita->email }}"
                                                data-hora="{{ $cita->hora_cita }}"
                                                data-motivo="{{ $cita->motivo_especifico }}"
                                                data-descripcion="{{ $cita->descripcion }}"
                                                data-estado="{{ $cita->estado ?? 'Pendiente' }}"
                                                title="Editar Cita">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        
                                        <form action="{{ url('/citas/'.$cita->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar Cita">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-calendar-xmark fs-2 mb-2 d-block text-black-50"></i>
                                    No hay citas registradas en el sistema.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <div class="modal fade" id="modalEditarCita" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-user-gear me-2"></i> Modificar Cita Médica
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                <form id="formEditarCita" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Nombre y apellidos completos</label>
                                <input type="text" name="nombre_paciente" id="edit_nombre" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Cédula / Documento</label>
                                <input type="text" name="cedula" id="edit_cedula" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Edad</label>
                                <input type="number" name="edad" id="edit_edad" class="form-control" min="0" max="120" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Dirección</label>
                                <input type="text" name="direccion" id="edit_direccion" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Teléfono móvil</label>
                                <input type="tel" name="telefono" id="edit_telefono" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Correo electrónico</label>
                                <input type="email" name="email" id="edit_email" class="form-control" placeholder="correo@ejemplo.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Entidad de Salud (EPS)</label>
                                <input type="text" name="eps" id="edit_eps" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-secondary">Doctora Asignada</label>
                                <input type="text" id="edit_medico" class="form-control bg-light text-muted fw-bold" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-primary">Fecha de la Cita</label>
                                <input type="text" name="fecha_asignada" id="edit_fecha" class="form-control border-primary" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-primary">Hora de la Cita</label>
                                <input type="text" name="hora_cita" id="edit_hora" class="form-control border-primary" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-primary">Estado de la Cita</label>
                                <select name="estado" id="edit_estado" class="form-select border-primary" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Confirmada">Confirmada</option>
                                    <option value="No Asistida">No Asistida</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Motivo específico</label>
                                <select name="motivo_especifico" id="edit_motivo" class="form-select" required>
                                    <option value="">Selecciona el motivo...</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Descripción de síntomas / Notas médicas</label>
                                <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>

         <footer class="text-secondary text-center py-3 mt-4 border-top">
            &copy; {{ date('Y') }} SaludAdmin. Todos los derechos reservados.
        </footer>

    </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalEditarElement = document.getElementById('modalEditarCita');
            const modalEditar = new bootstrap.Modal(modalEditarElement);
            const formEditar = document.getElementById('formEditarCita');
            const selectMotivo = document.getElementById('edit_motivo');

            // Listas extraídas fielmente de tus imágenes de especialidades
            const motivosPorEspecialidad = {
                'Medicina General': ['Control médico', 'Fiebre y malestar', 'Gripa o tos', 'Dolor de cabeza', 'Chequeo general'],
                'Pediatría': ['Control de crecimiento', 'Vacunación', 'Fiebre en niños', 'Revisión pediátrica'],
                'Odontología': ['Limpieza dental', 'Dolor de muela', 'Extracción', 'Revisión bucal'],
                'Oftalmología': ['Examen de la vista', 'Prescripción de lentes', 'Irritación ocular', 'Control oftalmológico']
            };

            document.querySelectorAll('.btn-editar-cita').forEach(boton => {
                boton.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    formEditar.action = '/citas/' + id;

                    const nombreMedico = this.getAttribute('data-medico') ? this.getAttribute('data-medico').trim() : '';
                    const motivoActual = this.getAttribute('data-motivo') ? this.getAttribute('data-motivo').trim() : '';

                    // Deducimos de forma automática la rama basándonos en la doctora asignada
                    let especialidadCalculada = 'Medicina General';
                    
                    if (nombreMedico === 'Marcela Sanchez Gamboa') {
                        especialidadCalculada = 'Medicina General';
                    }
                    // Cuando añadas doctores de otras especialidades, puedes expandirlo aquí:
                    // else if (nombreMedico === 'Dr. Juan Pediatra') { especialidadCalculada = 'Pediatría'; }

                    // 1. Limpieza y carga del select de motivos correspondientes
                    selectMotivo.innerHTML = '<option value="">Selecciona el motivo...</option>';
                    if (motivosPorEspecialidad[especialidadCalculada]) {
                        motivosPorEspecialidad[especialidadCalculada].forEach(motivo => {
                            const option = document.createElement('option');
                            option.value = motivo;
                            option.textContent = motivo;
                            if (motivo === motivoActual) option.selected = true;
                            selectMotivo.appendChild(option);
                        });
                    } else if (motivoActual) {
                        const option = document.createElement('option');
                        option.value = motivoActual;
                        option.textContent = motivoActual;
                        option.selected = true;
                        selectMotivo.appendChild(option);
                    }

                    // 2. Rellenar la información personal del paciente
                    document.getElementById('edit_nombre').value = this.getAttribute('data-nombre');
                    document.getElementById('edit_cedula').value = this.getAttribute('data-cedula');
                    document.getElementById('edit_edad').value = this.getAttribute('data-edad');
                    document.getElementById('edit_direccion').value = this.getAttribute('data-direccion');
                    document.getElementById('edit_telefono').value = this.getAttribute('data-telefono');
                    document.getElementById('edit_eps').value = this.getAttribute('data-eps');
                    document.getElementById('edit_descripcion').value = this.getAttribute('data-descripcion');
                    
                    // 3. Pintar de forma fija los valores de MongoDB (Doctora, Fecha y Hora)
                    document.getElementById('edit_medico').value = nombreMedico;
                    document.getElementById('edit_fecha').value = this.getAttribute('data-fecha');
                    document.getElementById('edit_hora').value = this.getAttribute('data-hora');
                    document.getElementById('edit_email').value = this.getAttribute('data-email') ?? '';

                    // 4. Procesar el estado de la cita quitando espacios extras
                    let estadoCita = this.getAttribute('data-estado') ? this.getAttribute('data-estado').trim() : 'Pendiente';
                    estadoCita = estadoCita.charAt(0).toUpperCase() + estadoCita.slice(1).toLowerCase();
                    
                    const selectEstado = document.getElementById('edit_estado');
                    selectEstado.value = estadoCita;
                    if (selectEstado.selectedIndex === -1) selectEstado.value = 'Pendiente';

                    // 5. Desplegar el modal limpio
                    modalEditar.show();
                });
            });
        });
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