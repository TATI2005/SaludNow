<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
   
    <link rel="icon" href="{{ asset('img/logo2.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Pagina-principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Servicios.css') }}">
  
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
</head>
<body>

    
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif


    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img class="logo" src="img/logo1.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item">
                        <a href="/pagina-principal" class="nav-link">
                            <i class="fa-solid fa-house"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalQuienesSomos">
                            <i class="fa-solid fa-users"></i> Quienes Somos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/servicios" class="nav-link">
                            <i class="fa-solid fa-briefcase-medical"></i> Servicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalContacto">
                            <i class="fa-solid fa-phone"></i> Contáctanos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#perfilModal">
                              <img src="https://ui-avatars.com/api/?name={{ session('usuario.nombre') }}&background=0D8ABC&color=fff" alt="" width="32" height="32" class="rounded-circle"> Perfil
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-0">
        <div class="banner">
            <img src="img/Utiles.jpg" alt="SaludNow Banner" class="banner-img">
            <div class="banner-overlay">
                <div class="text-center">
                    <h1 class="anim-titulo">Servicios SaludNow</h1>
                    <p class="anim-subtitulo">Te atenderemos lo más pronto posible.</p>
                </div>
            </div>
        </div>
    </div>

 
    <div class="container contenedor1 mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="titulo1">Servicio</h1>
                <h2>Nuestros Servicios en SaludNow</h2>
                <p class="mt-3">
                    En SaludNow, nos dedicamos a facilitar el acceso a la salud para la comunidad de Quibdó, eliminando las barreras de tiempo y distancia.
                    Ofrecemos una plataforma intuitiva donde los usuarios pueden programar sus citas médicas de forma rápida y sencilla, sin necesidad de filas o esperas telefónicas.<br><br>
                    Cada usuario cuenta con un espacio personal (Perfil) donde puede visualizar sus datos y mantener el control de sus interacciones con la plataforma.<br><br>
                    Fomentamos la transparencia y la mejora continua permitiendo que los usuarios registrados dejen comentarios y testimonios sobre su experiencia en la plataforma.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <div class="contenedor-img">
                    <img src="img/Hospital.jpg" class="img-fluid rounded-4" id="imagen1" alt="Hospital">
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 parte1 mt-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold color-titulo1">Nuestros Servicios</h2>
                <p class="text-muted small">Selecciona una especialidad para agendar tu cita en Quibdó</p>
            </div>

            <div class="row align-items-center">
                <!-- Tarjetas de especialidades -->
                <div class="col-lg-6">
                    <div class="row row-cols-2 g-3 justify-content-center mx-auto" style="max-width: 650px;">
                        <!-- Medicina General -->
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0 text-center p-3">
                                <div class="mb-2" style="color: #0ea5e9;">
                                    <i class="fa-solid fa-user-doctor fs-3"></i>
                                </div>
                                <div style="font-size: 16px; color: #334155;" class="fw-bold mb-2">Medicina General</div>
                                <button class="agendar-boton w-75" onclick="abrirModalCita('Medicina General')">Agendar</button>
                            </div>
                        </div>
                        <!-- Pediatría -->
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0 text-center p-3">
                                <div class="mb-2" style="color: #ec4899;">
                                    <i class="fa-solid fa-baby fs-3"></i>
                                </div>
                                <div style="font-size: 16px; color: #334155;" class="fw-bold mb-2">Pediatra</div>
                                <button class="agendar-boton w-75" onclick="abrirModalCita('Pediatria')">Agendar</button>
                            </div>
                        </div>
                        <!-- Odontología -->
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0 text-center p-3">
                                <div class="mb-2" style="color: #10b981;">
                                    <i class="fa-solid fa-tooth fs-3"></i>
                                </div>
                                <div style="font-size: 14px; color: #334155;" class="fw-bold mb-2">Odontología</div>
                                <button class="agendar-boton w-75" onclick="abrirModalCita('Odontologia')">Agendar</button>
                            </div>
                        </div>
                        <!-- Oftalmología -->
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0 text-center p-3">
                                <div class="mb-2" style="color: #f59e0b;">
                                    <i class="fa-solid fa-eye fs-3"></i>
                                </div>
                                <div style="font-size: 14px; color: #334155;" class="fw-bold mb-2">Oftalmología</div>
                                <button class="agendar-boton w-75" onclick="abrirModalCita('Oftamologia')">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descripciones detalladas -->
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="row px-lg-5">
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold color-titulo1">Medicina General</h5>
                            <p class="text-muted small">Consulta primaria para diagnóstico, tratamiento y prevención de enfermedades comunes.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold color-titulo1">Pediatría</h5>
                            <p class="text-muted small">Cuidado especializado enfocado en la salud y el desarrollo integral de los niños.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold color-titulo1">Odontología</h5>
                            <p class="text-muted small">Servicios de salud bucal, prevención, limpiezas y tratamientos dentales.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold color-titulo1">Oftalmología</h5>
                            <p class="text-muted small">Exámenes oculares, prescripción de lentes y cuidado especializado de la vista.</p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="container contenedor1 mt-5">
        <div class="row d-flex align-items-stretch">
            <!-- Formulario para comentar -->
            <div class="col-md-6">
                <form action="/comentarios" method="POST" class="d-flex flex-column h-100">
                    @csrf
                    <textarea class="form-control flex-grow-1" rows="5" name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea>
                    <button class="rounded-2 boton1 mt-3" type="submit">Comentar</button>
                </form>
            </div>

            <!-- Carrusel de comentarios -->
            <div class="col-md-6">
                <div id="carruselComentarios" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        @forelse($comentarios as $key => $c)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
                                <div class="card p-4 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold">{{ $c->nombre }}</h5>
                                        <small class="text-muted">{{ $c->created_at->diffForHumans() }}</small>
                                    </div>
                                    <hr>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">{{ $c->comentario }}</p>
                                    </div>
                                    
                                    <!-- Botones de Acción (Editar/Eliminar) y Navegación del Carrusel -->
                                    <div class="d-flex justify-content-between align-items-center mt-3" style="min-height: 40px;">
                                        <div class="d-flex gap-2">
                                            @if(session('usuario.nombre') == $c->nombre)
                                                <a class="boton btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editar{{ $c->_id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </a>
                                                <a class="boton btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#eliminar{{ $c->_id }}">
                                                    <i class="fa-solid fa-trash"></i> Eliminar
                                                </a>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-3">
                                            <a role="button" data-bs-target="#carruselComentarios" data-bs-slide="prev" class="text-decoration-none">
                                                <i class="fa-solid fa-left-long color"></i>
                                            </a>
                                            <a role="button" data-bs-target="#carruselComentarios" data-bs-slide="next" class="text-decoration-none">
                                                <i class="fa-solid fa-right-long color"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="carousel-item active h-100">
                                <div class="card h-100 p-5 text-center d-flex align-items-center justify-content-center">
                                    <p class="text-muted">No hay comentarios aún.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg bg-light mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-6 mb-4 mt-0">
                    <img src="img/logo3.png" id="img-footer" class="img-fluid" alt="SaludNow Footer Logo"><br>
                    <p class="mt-2">
                        Plataforma para agendar citas médicas de forma<br> rápida y sencilla en Quibdó.
                    </p>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalBlogPublico">
                                Blog
                            </a>
                        </li>
                        
                        <li>
                            <a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#modalPrivacidad">Política privacidad</a>
                        </li>
                        
                        <li>
                            <a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#modalMapa">Sedes y Mapa</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Contacto</h5>
                    <p>
                        Email: www.SaludNow.com<br>
                        Tel: +300 000 0000
                    </p>
                </div>
            </div>
        </div>

        <div class="p-4 footer-abajo"> 
            <div class="container d-flex justify-content-between align-items-center">
                <span><strong>© 2026 SaludNow.</strong> Todos los derechos reservados.</span>
                <div class="d-flex gap-3">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a> 
                </div>
            </div> 
        </div>
    </footer>


    <!-- Modal: Agendar Cita -->
<div class="modal fade" id="modalAgendarCita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
 
            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa-solid fa-calendar-plus"></i>
                    Agendar cita &nbsp;
                    <span class="badge-especialidad" id="displayEspecialidad"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
 
            <form action="{{ route('guardar.cita') }}" method="POST">
                @csrf
                <input type="hidden" name="especialidad" id="fieldEspecialidad">
 
                <div class="modal-body">
                    <div class="row g-3">
 
                        {{-- ── Sección 1: Paciente ── --}}
                        <div class="col-12">
                            <p class="seccion-label">
                                <i class="fa-solid fa-user-injured"></i> Información del paciente
                            </p>
                            <hr class="seccion-divider">
                        </div>
 
                        <div class="col-md-8">
                            <label class="form-label">Nombre y apellidos completos</label>
                            <input type="text" name="nombre_paciente" class="form-control"
                                   placeholder="ej. Tatiana Serna" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cédula / Documento</label>
                            <input type="text" name="cedula" class="form-control"
                                   placeholder="Número de identificación" required>
                        </div>
 
                        <div class="col-md-3">
                            <label class="form-label">Edad</label>
                            <input type="number" name="edad" class="form-control"
                                   placeholder="00" min="0" max="120" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Dirección de residencia</label>
                            <input type="text" name="direccion" class="form-control"
                                   placeholder="ej. Barrio El Jardín" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono móvil</label>
                            <input type="tel" name="telefono" class="form-control"
                                   placeholder="300 000 0000" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label w-50">Correo electrónico</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="correo@ejemplo.com"
                                   value="{{ session('usuario.email') }}">
                            @if(session('usuario.email'))
                                <div style="font-size:11.5px;color:#10b981;margin-top:4px;">
                                    <i class="fa-solid fa-circle-check" style="margin-right:3px;"></i>
                                    Correo de tu cuenta detectado automáticamente
                                </div>
                            @else
                                <div style="font-size:11.5px;color:#9ca3af;margin-top:4px;">
                                    Opcional — si lo ingresas recibirás el reporte en tu correo
                                </div>
                            @endif
                        </div>
 
                        <div class="col-12">
                            <label class="form-label">Entidad de salud (EPS)</label>
                            <input type="text" name="eps" class="form-control"
                                   placeholder="ej. Nueva EPS, Coosalud, Sura..." required>
                        </div>
 
                        {{-- ── Sección 2: Consulta ── --}}
                        <div class="col-12 mt-2">
                            <p class="seccion-label">
                                <i class="fa-solid fa-stethoscope"></i> Detalles de la consulta
                            </p>
                            <hr class="seccion-divider">
                        </div>
 
                        <div class="col-12">
                            <label class="form-label">Motivo específico de consulta</label>
                            <select name="motivo_especifico" id="motivoSelect" class="form-select" required>
                                <option value="" disabled selected>Selecciona el motivo...</option>
                            </select>
                        </div>
 
                        <div class="col-12">
                            <label class="form-label">Descripción de síntomas o comentarios</label>
                            <textarea name="descripcion" class="form-control" rows="3"
                                      placeholder="Cuéntenos brevemente el motivo de su visita..." required></textarea>
                        </div>
 
                    </div>
                </div>
 
                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn-cancelar-cita" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn-confirmar-cita">
                        <i class="fa-solid fa-calendar-check me-2"></i> Confirmar y agendar
                    </button>
                </div>
            </form>
 
        </div>
    </div>
</div>

    <!-- Modal: Mi Perfil -->
    @if(session('usuario'))
        <div class="modal fade" id="perfilModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mi Perfil</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre:</strong> {{ session('usuario.nombre') }}</p>
                        <p><strong>Correo Electrónico:</strong> {{ session('usuario.email') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/logout" class="btn btn-secondary">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modales de Comentarios (Eliminar y Editar) -->
    @foreach($comentarios as $c)
        @if(session('usuario.nombre') == $c->nombre)
            <!-- Modal: Eliminar Comentario -->
            <div class="modal fade" id="eliminar{{ $c->_id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Eliminar comentario</h5>
                            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres eliminar este comentario?
                        </div>
                        <div class="modal-footer">
                            <a href="/comentarios/eliminar/{{ $c->_id }}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal: Editar Comentario -->
            <div class="modal fade" id="editar{{ $c->_id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Editar comentario</h5>
                            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="/comentarios/editar/{{ $c->_id }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="text" name="comentario" value="{{ $c->comentario }}" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Modal: Contacto -->
    <div class="modal fade" id="modalContacto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title">Enviar descripción a SaludNow</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p><strong>Remitente:</strong> {{ session('usuario.nombre') }}</p>
                        <p><strong>Tu correo:</strong> <span class="text-primary">{{ session('usuario.email') }}</span></p>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">¿En qué podemos ayudarte?</label>
                            <textarea class="form-control" name="mensaje" rows="4" required placeholder="Escribe aquí tu duda..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Quienes Somos -->
    <div class="modal fade" id="modalQuienesSomos" tabindex="-1" aria-labelledby="modalQuienesSomosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalQuienesSomosLabel">
                        <i class="bi bi-hospital me-2"></i> Sobre SaludNow
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center mb-3 mb-md-0">
                            <img src="img/logo2.png" alt="SaludNow Logo" class="img-fluid" style="max-height: 150px;">
                        </div>
                        <div class="col-md-7">
                            <h4 class="titulo3">Nuestra Misión</h4>
                            <p class="text-muted">
                                En <strong>SaludNow</strong>, nos dedicamos a conectar pacientes con servicios de salud de alta calidad de manera ágil y humana. Nuestra plataforma facilita el acceso a la atención médica que necesitas, cuando más la necesitas.
                            </p>
                        </div>
                    </div>
                    <hr class="my-4 text-secondary opacity-25">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="p-3">
                                <h5 class="mt-2 titulo3"><i class="fa-solid fa-face-smile-beam"></i> Confianza</h5>
                                <p class="small text-muted">Seguridad total en tus datos médicos.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3">
                                <h5 class="mt-2 titulo3"><i class="fa-solid fa-bolt"></i> Agilidad</h5>
                                <p class="small text-muted">Atención sin esperas innecesarias.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3">
                                <h5 class="mt-2 titulo3"><i class="fa-solid fa-heart"></i> Empatía</h5>
                                <p class="small text-muted">Cuidamos de ti con calidez humana.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal privacidad-->
<div class="modal fade" id="modalPrivacidad" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 py-3">
                <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i>Política de tratamiento de datos personales</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body px-4 pb-4" style="font-size: 0.9rem; color: #444; max-height: 450px; overflow-y: auto; line-height: 1.6;">

                <p class="fw-bold text-dark">Tratamiento de datos sensibles</p>
                <p>al ser una plataforma de salud, recolectamos datos sobre su estado físico o diagnóstico (motivo de consulta). estos datos son considerados <strong>sensibles</strong>. su tratamiento se realiza bajo estrictas medidas de seguridad para garantizar que solo el personal médico asignado tenga acceso a ellos.</p>

                <p class="fw-bold text-dark">Finalidades específicas</p>
                <ul>
                    <li>gestionar la agenda médica en el hospital ismael roldán y el hospital san francisco de asís.</li>
                    <li>cumplir con los requerimientos de las eps y el sistema general de seguridad social en salud.</li>
                    <li>contactarlo vía telefónica o whatsapp para confirmar, cancelar o reprogramar sus turnos.</li>
                </ul>

                <p class="fw-bold text-dark">derechos del usuario (habeas data)</p>
                <p>usted como titular tiene derecho a:</p>
                <ul>
                    <li>conocer, actualizar y rectificar sus datos en cualquier momento.</li>
                    <li>revocar la autorización cuando no se respeten los principios legales.</li>
                    <li>ser informado sobre el uso que se le ha dado a sus datos personales.</li>
                </ul>
                
                <div class="p-3 bg-light rounded-3 border-start border-4 border-success">
                    <small><strong>nota:</strong> para ejercer sus derechos, puede dirigirse a las oficinas de atención al usuario (siau) de cualquiera de nuestras dos sedes físicas en quibdó.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal sedes-->
<div class="modal fade" id="modalMapa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header  border-0 py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Nuestras sedes hospitalarias</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-4 p-4 bg-white shadow-sm" style="z-index: 1;">
                        <div class="card border-0 bg-light mb-3" style="border-radius: 12px;">
                            <div class="card-body">
                                <h6 class="fw-bold titulo-1 mb-1">hospital ismael roldán valencia</h6>
                                <p class="small text-muted mb-0"><i class="bi bi-map me-1"></i>cl. 21 #20-126, barrio el jardín</p>
                                <span class="badge bg-success mt-2">urgencias 24h</span>
                            </div>
                        </div>
                        <div class="card border-0 bg-light mb-3" style="border-radius: 12px;">
                            <div class="card-body">
                                <h6 class="fw-bold titulo-1 mb-1">h. san francisco de asís (nueva ese)</h6>
                                <p class="small text-muted mb-0"><i class="bi bi-map me-1"></i>cra. 1 #31-25, zona norte (frente al malecón)</p>
                                <span class="badge bg-success mt-2">atención integral</span>
                            </div>
                        </div>
                        <div class="alert alert-primary small border-0 d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                            <div>sus citas serán asignadas aleatoriamente a cualquiera de estas sedes según disponibilidad.</div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ratio ratio-16x9 h-100" style="min-height: 450px;">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d15877.0!2d-76.65!3d5.69!3m2!1i1024!2i768!4f13.1!2m1!1shospital%20ismael%20roldan%20y%20san%20francisco%20de%20asis%20quibdo!5e0!3m2!1ses!2sco!4v1716000000000!5m2!1ses!2sco" 
                                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalNuevoArticulo" tabindex="-1" aria-labelledby="modalBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header modal-header-corporate py-3" style="background-color: #1f5945; color: white; border-bottom: 4px solid #89cbca;">
                <h5 class="modal-title fw-bold" id="modalBlogLabel">
                    <i class="fa-solid fa-cloud-arrow-up me-2"></i> Publicar en Blog del Sitio Web Principal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/blog/publicar" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-success py-2 small mb-4 border-0 rounded-2" style="background-color: rgba(137, 203, 202, 0.2); color: #1f5945;">
                        <i class="fa-solid fa-circle-info me-1"></i> <strong>Nota de Administración:</strong> Las entradas validadas aquí aparecerán listadas inmediatamente en el feed de noticias de la página de inicio para los pacientes.
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8 col-12">
                            <label class="form-label fw-bold text-secondary small">Título del Artículo:</label>
                            <input type="text" name="titulo" class="form-control form-control-sm rounded-2 border-secondary-subtle" placeholder="Ej: Pasos clave para prevenir la hipertensión en casa" required>
                        </div>

                        <div class="col-md-4 col-12">
                            <label class="form-label fw-bold text-secondary small">Categoría Destacada:</label>
                            <select name="categoria" class="form-select form-select-sm rounded-2 border-secondary-subtle" required>
                                <option value="Prevención Médica">Prevención Médica</option>
                                <option value="Salud y Nutrición">Salud y Nutrición</option>
                                <option value="Pediatría General">Pediatría General</option>
                                <option value="Actualidad Científica">Actualidad Científica</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small">Imagen de Portada (Formatos recomendados: JPG, PNG):</label>
                            <input type="file" name="imagen_destacada" class="form-control form-control-sm rounded-2 border-secondary-subtle" accept="image/*">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small">Cuerpo y Redacción del Artículo:</label>
                            <textarea name="contenido" class="form-control rounded-2 border-secondary-subtle" rows="7" placeholder="Escriba los consejos y criterios de salud en un lenguaje comprensible y cercano para la comunidad de pacientes..." required></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm px-4 rounded-2 text-white fw-bold" style="background-color: #1f5945;">
                        <i class="fa-solid fa-rocket me-1"></i> Lanzar a la Web Principal
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@include('Administracion.modal-mostrar-post')

    <script>
        function leerArticulo(titulo, categoria, contenido, autor, fecha, imagen) {
            // Ocultar listado y mostrar pantalla de lectura
            document.getElementById('vista-lista-blog').classList.add('d-none');
            document.getElementById('vista-lectura-blog').classList.remove('d-none');
            document.getElementById('btnRegresarLista').classList.remove('d-none');
            
            // Inyectar la data del post seleccionado
            document.getElementById('ver-titulo').innerText = titulo;
            document.getElementById('ver-categoria').innerText = categoria;
            document.getElementById('ver-contenido').innerText = contenido;
            document.getElementById('ver-autor').innerText = autor;
            document.getElementById('ver-fecha').innerText = 'Publicado: ' + fecha;
            document.getElementById('ver-avatar').innerText = autor.substring(0, 1);
            
            // Evaluar si renderizar la imagen o no
            const contenedorImg = document.getElementById('ver-contenedor-img');
            if(imagen) {
                document.getElementById('ver-imagen').src = imagen;
                contenedorImg.style.display = 'block';
            } else {
                contenedorImg.style.display = 'none';
            }
        }

        function mostrarListaBlog() {
            // Regresar el flujo visual al catálogo original
            document.getElementById('vista-lectura-blog').classList.add('d-none');
            document.getElementById('btnRegresarLista').classList.add('d-none');
            document.getElementById('vista-lista-blog').classList.remove('d-none');
        }

        // Si cierran el modal leyendo un artículo, lo reseteamos para la próxima apertura
        const modalBlog = document.getElementById('modalBlogPublico');
        if(modalBlog){
            modalBlog.addEventListener('hidden.bs.modal', function () {
                mostrarListaBlog();
            });
        }
    </script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/servicio.js"></script>
       
</body>
</html>