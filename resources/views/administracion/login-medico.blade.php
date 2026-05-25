<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/logo-admin.png')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/administracion/loginyregistro-m.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="card-medico">
        <form action="{{ route('medico.auth') }}" method="POST">
            @csrf
            <h2 class="text-center">Portal Médico</h2>
            <p class="text-center text-muted">Gestión de citas SaludNow</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="wrapper-input mb-3">
                <input type="email" name="email" class="form-control" placeholder="Escribe tu correo Electronico" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="password" name="password" class="form-control" placeholder="Escribe tu contraseña" required>
                <i class="fa-solid fa-eye toggle-password"></i>
            </div>

                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn-custom boton">Iniciar sesión</button>
                    <a href="/registro-medico" class="link-custom enlace">Registrarse</a>
                </div>
        </form>
    </div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/administracion/ojito-admin.js"></script>
</body>
</html>