<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Usuarios; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
   public function paginaAdmin()
    {
        $medicoLogueado = session('medico');
        $medicoId = is_array($medicoLogueado) ? ($medicoLogueado['_id'] ?? $medicoLogueado['id'] ?? null) : ($medicoLogueado->_id ?? $medicoLogueado->id ?? null);
        $usuariosActivos = Usuarios::count(); 
        $totalCitas = Cita::count();
        $datosGrafica = []; $diasSemana = [];
        for ($i = 6; $i >= 0; $i--) {
            $fecha = Carbon::today()->subDays($i);
            $diasSemana[] = $fecha->isoFormat('ddv'); 
            $datosGrafica[] = Cita::where('medico_id', $medicoId)->where('fecha_asignada', $fecha->format('d/m/Y'))->count();
        }

        // Datos por estado
        $citasPendientes = Cita::where('medico_id', $medicoId)->where('estado', 'pendiente')->count();
        $citasConfirmadas = Cita::where('medico_id', $medicoId)->where('estado', 'Confirmada')->count();
        $citasNoAsistidas = Cita::where('medico_id', $medicoId)->where('estado', 'No Asistida')->count();

        return view('administracion.pagina-admin', compact('usuariosActivos', 'totalCitas', 'diasSemana', 'datosGrafica', 'citasPendientes', 'citasConfirmadas', 'citasNoAsistidas'));
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 'documento_identidad' => 'required|unique:medicos', 'email' => 'required|email|unique:medicos',
            'password' => 'required|min:6', 'telefono' => 'required', 'edad' => 'required|numeric', 'dias' => 'required|array', 
            'hora_inicio' => 'required', 'hora_fin' => 'required', 'sede' => 'required' 
        ]);
        foreach ($request->dias as $dia) {
            $choque = Medico::where('sede', $request->sede)->where('horarios.dia', $dia)->where(function($query) use ($request) {
                $query->whereBetween('horarios.inicio', [$request->hora_inicio, $request->hora_fin])->orWhereBetween('horarios.fin', [$request->hora_inicio, $request->hora_fin]);
            })->first();
            if ($choque) { return back()->with('error', "El día $dia en ese horario ya está ocupado."); }
        }
        $horarios = [];
        foreach ($request->dias as $dia) { $horarios[] = ['dia' => $dia, 'inicio' => $request->hora_inicio, 'fin' => $request->hora_fin]; }
        Medico::create([
            'nombre' => $request->nombre, 'documento_identidad' => $request->documento_identidad, 'email' => $request->email,
            'password' => Hash::make($request->password), 'telefono' => $request->telefono, 'edad' => $request->edad,
            'sede' => $request->sede, 'especialidad' => $request->especialidad, 'horarios' => $horarios
        ]);
        return redirect('/login-medico')->with('success', 'Registro médico exitoso');
    }

    public function login(Request $request)
    {
        $medico = Medico::where('email', $request->email)->first();
        if (!$medico || !Hash::check($request->password, $medico->password)) { return back()->with('error', 'Credenciales incorrectas'); }
        session([
            'medico' => ['id' => (string)$medico->_id,
            '_id' => (string)$medico->_id,
            'nombre' => $medico->nombre,
            'especialidad' => $medico->especialidad,
            'sede' => $medico->sede,
            'email' => $medico->email,
            'telefono' => $medico->telefono,
            'edad' => $medico->edad,
            'horarios' => $medico->horarios]]);
        return redirect('/pagina-admin');
    }

    public function logoutMedico() { session()->forget('medico'); return redirect('/login-medico'); }
}