<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; // <-- ¡OBLIGATORIO PARA ENVIAR EL CORREO!
use FPDF; // <-- ¡OBLIGATORIO PARA QUE ENCUENTRE LA CLASE PDF!

class CitaController extends Controller {
    
    public function guardarcita(Request $request) {
        // Validación estricta
        $request->validate([
            'nombre_paciente' => 'required',
            'cedula'          => 'required',
            'edad'            => 'required',
            'eps'             => 'required',
            'telefono'        => 'required',
            'direccion'       => 'required',
            'email'           => 'nullable|email',
            'especialidad'    => 'required|in:Medicina General,Pediatría,Odontología,Oftalmología',
            'motivo_especifico' => 'required'
        ]);

        // Buscamos médico aleatorio por especialidad
        $medicoasignado = Medico::where('especialidad', $request->especialidad)->get()->shuffle()->first();

        if (!$medicoasignado) {
            return back()->with('error', "No hay médicos para la especialidad: {$request->especialidad}");
        }

        // Lógica de fecha aleatoria (1 a 10 días adelante)
        $fechagenerada = Carbon::today()->addDays(rand(1, 10));
        
        // Turnos escalonados (miramos cuántos hay ese día para ese médico)
        $conteo = Cita::where('medico_id', $medicoasignado->_id)
                      ->where('fecha_asignada', $fechagenerada->format('d/m/Y'))
                      ->count();

        // Corregido: Usamos copy() para no alterar la fecha base accidentalmente
        $horabase = Carbon::instance($fechagenerada)->copy()->setHour(6)->setMinute(0);
        $horafinal = $horabase->addMinutes($conteo * 15);

        // Selección aleatoria con los nombres exactos de los hospitales en Quibdó
        $sedesDisponibles = [
            'Hospital Ismael Roldán Valencia',
            'Hospital San Francisco de Asís (ESE)'
        ];
        $sedeAleatoria = $sedesDisponibles[array_rand($sedesDisponibles)];

        $cita = new Cita();
        $cita->usuario_registrador = session('usuario.nombre') ?? 'tatiana serna';
        $cita->nombre_paciente     = $request->nombre_paciente;
        $cita->cedula              = $request->cedula;
        $cita->edad                = $request->edad;
        $cita->eps                 = $request->eps;
        $cita->telefono            = $request->telefono;
        $cita->direccion           = $request->direccion;
        $cita->especialidad        = $request->especialidad;
        $cita->motivo_especifico   = $request->motivo_especifico;
        $cita->descripcion         = $request->descripcion ?? 'sin descripción';
        $cita->email               = $request->email ?? '';
        $cita->medico_id           = $medicoasignado->_id;
        $cita->nombre_medico       = $medicoasignado->nombre;
        $cita->hora_cita           = $horafinal->format('h:i a');
        $cita->fecha_asignada      = $fechagenerada->format('d/m/Y');
        $cita->mes_asignado        = $fechagenerada->format('F');
        $cita->sede                = $sedeAleatoria;
        $cita->estado              = 'pendiente';

        if($cita->save()) {
            return back()->with('success', "Cita asignada con el médico {$medicoasignado->nombre} en la sede {$sedeAleatoria}");
        } else {
            return back()->with('error', "Error al guardar en la base de datos");
        }
    }
        
    public function index() {
        $citas = Cita::where('medico_id', session('medico.id'))->get();
        $usuarios = \App\Models\Usuarios::all(['nombre', 'email', 'cedula']);
        return view('administracion.gestion-citas', compact('citas', 'usuarios'));
    }

    public function actualizar(Request $request, $id) {
        $cita = Cita::findOrFail($id);
        $cita->nombre_paciente   = $request->nombre_paciente;
        $cita->cedula            = $request->cedula;
        $cita->email             = $request->email;
        $cita->edad              = $request->edad;
        $cita->eps               = $request->eps;
        $cita->telefono          = $request->telefono;
        $cita->direccion         = $request->direccion;
        $cita->especialidad      = $request->especialidad;
        $cita->motivo_especifico = $request->motivo_especifico;
        $cita->descripcion       = $request->descripcion ?? 'sin descripción';
        $cita->estado            = $request->estado;
        $cita->save();
        return back()->with('success', 'Cita actualizada correctamente');
    }

    public function eliminar($id) {
        Cita::findOrFail($id)->delete();
        return back()->with('success', 'Cita eliminada');
    }

}