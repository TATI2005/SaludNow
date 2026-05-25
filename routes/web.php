<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\BlogController; 
use App\Http\Controllers\ReportarController;


Route::get('/bienvenido', function () {
    return view('bienvenido');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/pagina-principal', function () {
    return view('pagina-principal');
});

Route::get('/pagina-principal-ejemplo', function () {
    return view('pagina-principal-ejemplo');
});

Route::post('/registro', [UsuarioController::class, 'registrar']);
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);



Route::post('/comentarios', [ComentarioController::class, 'guardar']); 
Route::get('/comentarios/eliminar/{id}', [ComentarioController::class, 'eliminar']);
Route::post('/comentarios/editar/{id}', [ComentarioController::class, 'editar']);




Route::post('/enviar-contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');



Route::get('/pagina-admin', [MedicoController::class, 'paginaAdmin']);


Route::post('/medico/registrar', [MedicoController::class, 'registrar']);
Route::post('/medico/login', [MedicoController::class, 'login']);
Route::get('/medico/logout', [MedicoController::class, 'logoutMedico']);



Route::get('/registro-medico', function () { 
    return view('administracion.registro-medico'); 
});

Route::get('', function () { 
    return view('administracion.login-medico'); 
});


Route::post('/medico/save', [MedicoController::class, 'registrar'])->name('medico.save');
Route::post('/medico/auth', [MedicoController::class, 'login'])->name('medico.auth');
Route::get('/medico/logout', [MedicoController::class, 'logoutMedico']);



Route::post('/agendar-cita', [CitaController::class, 'guardarCita'])->name('guardar.cita');


Route::get('/blog',              [BlogController::class, 'listarBlog']);
Route::post('/blog/publicar',    [BlogController::class, 'publicarBlog']);
Route::delete('/blog/eliminar/{id}', [BlogController::class, 'eliminarBlog']);
Route::put('/blog/editar/{id}',  [BlogController::class, 'editarBlog']);


Route::get('/pagina-principal', [BlogController::class, 'mostrarPaginaPrincipal']);

Route::get('/servicios',[BlogController::class, 'mostrarServicios']);

// ANTES:
Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/pagina-principal', function () {
    return view('pagina-principal');
});

Route::get('/login', function () {
    return view('login');
});

// DESPUÉS:
Route::get('/servicios', [BlogController::class, 'mostrarServicios']);
Route::get('/pagina-principal', [BlogController::class, 'mostrarPaginaPrincipal']);

Route::get('/login', function () {
    return view('login');
});


Route::get('/gestion-citas', [CitaController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitaController::class, 'guardarcita'])->name('citas.store');
Route::put('/citas/{id}', [CitaController::class, 'actualizar']);
Route::delete('/citas/{id}',[CitaController::class, 'eliminar']);




Route::get('/reportar', [ReportarController::class, 'reportarIndex'])->name('reportar.index');
Route::post('/enviar-diagnostico/{id}', [ReportarController::class, 'enviarDiagnosticoReporte'])->name('diagnostico.enviar');