<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo2.png">
    <link rel="stylesheet" href="{{ asset('css/estilo1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <title>Inicio Sesion</title>
</head>

<script>
    setTimeout(function() {
        alert('Tu sesión expirará en 2 minutos.');
    }, 118 * 60 * 1000);

    setTimeout(function() {
        alert('Sesión expirada. Vuelve a iniciar sesión.');
        window.location.href = '/login';
    }, 120 * 60 * 1000);
</script>

<body>

        @if(session('error'))

        <script>

            alert("{{ session('error') }}");

        </script>

        @endif

        @if(session('success'))

            <script>

                alert("{{ session('success') }}");

            </script>

        @endif
    
   <div class="container d-flex justify-content-center">
        <div class="card-custom col-12 col-md-10 col-lg-8">
            <div class="row align-items: center;">
                <!-- Lado Izquierdo: Formulario -->
                <div class="col-md-6 pe-md-4">
                    <img src="img/logo1.png" width="160" class="mb-4" alt="Logo">
                    
                    <form method="POST" action="/login">
                        @csrf
                        <div class="wrapper-input mb-3">
                            <input type="email" name="email" class="form-control-custom w-100" placeholder="Ingrese su correo electrónico" required>
                            <i class="fa-solid fa-user icono"></i>
                        </div>

                        <div class="wrapper-input mb-4">
                            <input type="password" name="password" id="password" class="form-control-custom w-100" placeholder="Ingrese su contraseña" required>
                            <i class="fa-solid fa-eye icono" onclick="togglePassword('password', this)"></i>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <button type="submit" class="btn-custom">Iniciar sesión</button>
                            <a href="/registro" class="link-custom">Registrarse</a>
                        </div>
                    </form>
                </div>

                <!-- Línea Divisora (Solo visible en PC) -->
                <div class="col-md-1 d-none d-md-block">
                    <div class="linea-divisora"></div>
                </div>

                <!-- Lado Derecho: Imagen/GIF -->
                <div class="col-md-5 ps-md-4 mt-4 mt-md-0">
                    <h2 class="titulo-verde text-center h3">Iniciar Sesion</h2>
                    <img src="img/SaludNow-Video.gif" class="img-fluid mt-3" style="max-height: 150px; width: 380px;">
                </div>
            </div>
        </div>
    </div>
        @csrf

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/ojito.js"></script>
</body>
</html>