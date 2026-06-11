<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Usuarios;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $medicoId = session('medico.id');

        // Todas las citas del médico logueado
        $citas = Cita::where('medico_id', $medicoId)->get();

        // ── Contadores para la gráfica dona ──────────────────────────
        $citasPendientes   = $citas->where('estado', 'pendiente')->count();
        $citasConfirmadas  = $citas->where('estado', 'confirmada')->count();
        $citasNoAsistidas  = $citas->where('estado', 'no asistida')->count();

        // ── Totales para las tarjetas ─────────────────────────────────
        $totalCitas      = $citas->count();
        $usuariosActivos = Usuarios::count(); // ajusta según tu modelo

        // ── Gráfica de barras: próximas citas por día (7 días) ────────
        $diasSemana   = [];
        $datosGrafica = [];

        for ($i = 0; $i < 7; $i++) {
            $fecha = Carbon::today()->addDays($i);
            $diasSemana[]   = $fecha->translatedFormat('D d/m'); // Ej: "Lun 11/06"
            $datosGrafica[] = $citas
                ->where('fecha_asignada', $fecha->format('d/m/Y'))
                ->count();
        }

        return view('administracion.pagina-admin', compact(
            'citasPendientes',
            'citasConfirmadas',
            'citasNoAsistidas',
            'totalCitas',
            'usuariosActivos',
            'diasSemana',
            'datosGrafica'
        ));
    }
}