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
    <title>Blog</title>
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

    <!-- Contenido Principal -->
    <div class="main-content container-fluid px-4 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Consola de Control del Blog Pública</h3>
                <small class="text-muted">Revise los artículos activos o redacte nuevas alertas de salud.</small>
            </div>
            <button class="btn btn-saludnow btn-sm px-3 rounded-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNuevoPost">
                <i class="fa-solid fa-plus me-1"></i> Crear Artículo
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm border-start border-4 border-success small" role="alert">
                <i class="fa-solid fa-circle-check me-2 text-success"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 table-corporate">
                        <thead class="table-success text-white">
                            <tr>
                                <th class="ps-3">Portada</th>
                                <th>Título de la Entrada</th>
                                <th>Categoría</th>
                                <th>Publicado Por</th>
                                <th class="text-center pe-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articulos as $art)
                            <tr>
                                <td class="ps-3">
                                    @if(!empty($art->imagen))
                                        <img src="{{ asset('img/blog/' . $art->imagen) }}" width="55" height="38" class="rounded border object-fit-cover">
                                    @else
                                        <span class="badge bg-light text-muted border small">No Img</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">{{ $art->titulo }}</td>
                                <td><span class="badge bg-light text-success border border-success-subtle">{{ $art->categoria }}</span></td>
                                <td class="small text-muted">{{ $art->autor ?? 'Especialista' }}<br>{{ $art->created_at }}</td>
                                <td class="text-nowrap text-center pe-3">
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-primary border-0 me-1"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditarPost"
                                            data-id="{{ $art->id }}"
                                            data-titulo="{{ $art->titulo }}"
                                            data-categoria="{{ $art->categoria }}"
                                            data-contenido="{{ $art->contenido }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </button>

                                    <form action="/blog/eliminar/{{ $art->id }}" method="POST" class="d-inline" onsubmit="return confirm('¿Remover post de la web pública?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="fa-solid fa-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted small">No hay noticias indexadas en la base de datos pública.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <footer class="text-secondary text-center py-3 mt-4 border-top">
            &copy; {{ date('Y') }} SaludAdmin. Todos los derechos reservados.
        </footer>
    </div>


    <!-- Inclusión del modal reutilizable -->
    @include('administracion.modal-nuevo-post')
    @include('administracion.modal-editar-post') 
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
       const modalEditar = document.getElementById('modalEditarPost');
        if (modalEditar) {
            modalEditar.addEventListener('show.bs.modal', function (event) {
                const boton = event.relatedTarget;

                const id        = boton.getAttribute('data-id');
                const titulo    = boton.getAttribute('data-titulo');
                const categoria = boton.getAttribute('data-categoria');
                const contenido = boton.getAttribute('data-contenido');

                modalEditar.querySelector('#edit-titulo').value    = titulo;
                modalEditar.querySelector('#edit-contenido').value = contenido;

                // Seleccionar correctamente el option de categoría
                const selectCategoria = modalEditar.querySelector('#edit-categoria');
                for (let opt of selectCategoria.options) {
                    opt.selected = (opt.value === categoria);
                }

                // Apuntar el action al ID correcto
                modalEditar.querySelector('#formEditarBlog').action = `/blog/editar/${id}`;
            });
        }
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