<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo2.png">
    <link rel="stylesheet" href="{{ asset('css/estilo1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <title>Registrarse</title>
</head>

<script>
    setTimeout(function() {
        alert('Sesión expirada. Vuelve a iniciar sesión.');
        window.location.href = '/login';
    }, 14 * 60 * 1000);
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
        <div class="card-custom col-12 col-md-11 col-lg-9">
            <div class="row align-items-center">
                <!-- Formulario -->
                <div class="col-md-6 pe-md-4">
                    <img src="img/logo1.png" width="150" class="mb-3" alt="Logo">
                    <form method="POST" action="/registro">
                        @csrf
                        <div class="wrapper-input mb-3">
                            <input type="text" name="nombre" class="form-control-custom w-100" placeholder="Nombre completo" required>
                            <i class="fa-solid fa-user icono"></i>
                        </div>
                        <div class="wrapper-input mb-3">
                            <input type="email" name="email" class="form-control-custom w-100" placeholder="Correo electrónico" required>
                            <i class="fa-solid fa-envelope icono"></i>
                        </div>
                        <div class="wrapper-input mb-3">
                            <input type="password" name="password" id="password" class="form-control-custom w-100" placeholder="Contraseña" required>
                            <i class="fa-solid fa-eye icono" onclick="togglePassword('password', this)"></i>
                        </div>
                        <div class="wrapper-input mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control-custom w-100" placeholder="Confirmar contraseña" required>
                            <i class="fa-solid fa-eye icono" onclick="togglePassword('password_confirmation', this)"></i>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <button type="submit" class="btn-custom">Registrarse</button>
                            <a href="/login" class="link-custom">Iniciar sesion</a>
                        </div>
                    </form>
                </div>

                <!-- Divisor -->
                <div class="col-md-1 d-none d-md-block">
                    <div class="linea-divisora"></div>
                </div>

                <!-- Texto e Imagen -->
                <div class="col-md-5 text-center ps-md-4">
                    <h1 class="titulo-verde h3">¡Hola, nuevo usuario!</h1>
                    <p class="desc-verde">Regístrese para comenzar.</p>
                    <img src="img/enfermera-07.gif" class="img-fluid" style="max-height: 220px;">
                </div>
            </div>
        </div>
    </div>

    @csrf
   
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/ojito.js"></script>
    
</body>
</html>