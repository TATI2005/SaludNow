<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('img/logo-admin.png')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Administracion/loginyregistro-m.css') }}">
    <script src="https://kit.fontawesome.com/8f3b179c60.js" crossorigin="anonymous"></script>
    <title>Registro Profesional - Quibdó</title>
</head>
<body>
   <div class="card-medico">
    <h2>Registro Profesional</h2>
    
    <!-- Mostrar errores de validación o choques de horario -->
    @if(session('error'))
        <div class="alert alert-danger" style="font-size: 0.8rem;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('medico.save') }}" method="POST">
        @csrf
        
        <div class="grid-inputs">

            <div class="wrapper-input mb-3">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" value="{{ old('nombre') }}" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="text" class="form-control" name="documento_identidad" placeholder="Cédula" value="{{ old('documento_identidad') }}" required>
                <i class="fa-solid fa-address-card"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="text" class="form-control" name="direccion" placeholder="Dirección de residencia" value="{{ old('direccion') }}" required>
                <i class="fa-solid fa-location-dot"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="email" class="form-control" name="email" placeholder="Correo" value="{{ old('email') }}" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="text" class="form-control"  name="edad" placeholder="Edad" value="{{ old('edad') }}" required>
                <i class="fa-solid fa-hashtag"></i>
            </div> 

            <div class="wrapper-input mb-3">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                <i class="fa-solid fa-eye toggle-password"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
                <i class="fa-solid fa-eye toggle-password"></i>
            </div>

            <div class="wrapper-input mb-3">
                <input type="text" class="form-control" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required>
                <i class="fa-solid fa-phone"></i>
            </div>

            <!-- SELECCIÓN DE SEDE (NUEVO) -->
            <div class="wrapper-input mb-3">
                <select class="form-control" name="sede" required>
                    <option value="" disabled selected hidden>Elegir Sede de Atención</option>
                    <option value="Hospital Ismael Roldán Valencia">Hospital Ismael Roldán Valencia</option>
                    <option value="Hospital San Francisco de Asís (ESE)">Hospital San Francisco de Asís (ESE)</option>
                </select>
                <i class="fa-solid fa-hospital"></i>
            </div>

            <div class="wrapper-input mb-3">
                <select class="form-control" name="especialidad" required>
                    <option value="" disabled selected hidden>Elegir su especialidad</option>
                    <option value="Medicina General">Medicina General</option>
                    <option value="Odontologia">Odontología</option>
                    <option value="Pediatria">Pediatría</option>
                    <option value="Oftamologia">Oftalmología</option>
                </select>
                <i class="fa-solid fa-stethoscope"></i>
            </div>
        </div>

        <label class="dias-titulo">Días de atención (Quibdó):</label>
        <div class="dias-container">
            <label><input type="checkbox" name="dias[]" value="Lunes"> Lun</label>
            <label><input type="checkbox" name="dias[]" value="Martes"> Mar</label>
            <label><input type="checkbox" name="dias[]" value="Miércoles"> Mié</label>
            <label><input type="checkbox" name="dias[]" value="Jueves"> Jue</label>
            <label><input type="checkbox" name="dias[]" value="Viernes"> Vie</label>
            <label><input type="checkbox" name="dias[]" value="Sábado"> Sáb</label>
        </div>

        <div class="horas-row">
            <div class="w-100 me-1">
                <small>Inicio:</small>
                <input class="form-control" type="time" name="hora_inicio" required>
            </div>
            <div class="w-100 ms-1">
                <small>Fin:</small>
                <input class="form-control" type="time" name="hora_fin" required>
            </div>
        </div><br>

       <div class="d-flex align-items-center justify-content-between">
            <button type="submit" class="btn-custom boton">Registrarse</button>
            <a href="/login-medico" class="link-custom enlace">Iniciar sesión</a>
        </div>
    </form>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/Administracion/ojito-admin.js"></script>
</body>
</html>