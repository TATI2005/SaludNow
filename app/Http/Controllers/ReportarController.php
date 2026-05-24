<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; 
use FPDF; 

class ReportarController extends Controller {
    
    public function reportarIndex() {
        $citas = \App\Models\Cita::where('medico_id', session('medico.id'))->get();
        return view('Administracion.reportar', compact('citas'));
    }
 
    // ── Generar PDF membretado y enviar por correo ────────────
    public function enviarDiagnosticoReporte(Request $request, $id) {
        $request->validate([
            'diagnostico'   => 'required|string',
            'tratamiento'   => 'required|string',
            'proxima_cita'  => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);
 
        $cita = \App\Models\Cita::findOrFail($id);
 
        // Guardar diagnóstico en descripción (sin cambiar estado)
        $cita->descripcion = implode("\n", [
            'DIAGNÓSTICO: '   . $request->diagnostico,
            'TRATAMIENTO: '   . $request->tratamiento,
            'PRÓXIMA CITA: '  . ($request->proxima_cita ?? 'No requerida'),
            'OBSERVACIONES: ' . ($request->observaciones ?? 'Ninguna'),
        ]);
        $cita->save();
 
        // Destino del correo: campo email de la cita, luego sesión, luego fallback
    
        $correoDestino = (!empty($cita->email) && filter_var($cita->email, FILTER_VALIDATE_EMAIL))
            ? $cita->email
            : null;

        if (!$correoDestino) {
            return back()->with('warning', 'El paciente no tiene un correo válido');
        }

        // Generar PDF con membrete
        if (ob_get_length()) ob_end_clean();
 
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetMargins(22, 15, 22);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->AddPage();
 
        $membretada = public_path('img/Documento-Membretada.jpg');
        if (file_exists($membretada)) {
            $pdf->Image($membretada, 0, 0, 210, 297);
        }
 
        $pdf->SetY(40);
 
        // Título 
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->SetTextColor(31, 89, 69);
        $pdf->Cell(0, 8, utf8_decode('EVOLUCIÓN Y FORMULACIÓN CLÍNICA'), 0, 1, 'C');
 
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(120, 120, 120);
        $pdf->Cell(0, 5, utf8_decode('Quibdó, Chocó  ·  SaludNow  ·  Fecha de emisión: ' . now()->format('d/m/Y')), 0, 1, 'C');
        $pdf->Ln(3);
 
        // Línea separadora verde
        $pdf->SetDrawColor(31, 89, 69);
        $pdf->SetLineWidth(0.5);
        $pdf->Line(22, $pdf->GetY(), 188, $pdf->GetY());
        $pdf->Ln(4);
 
        // ── Helpers en bloques del PDF ────────────────────────
        $seccion = function(string $titulo) use ($pdf) {
            $pdf->SetFillColor(137, 203, 202);
            $pdf->SetTextColor(31, 89, 69);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 7, '  ' . utf8_decode(strtoupper($titulo)), 0, 1, 'L', true);
            $pdf->SetTextColor(34, 34, 34);
            $pdf->Ln(2);
        };
 
        $fila = function(string $label, ?string $valor) use ($pdf) {
            $valor = $valor ?? '—';
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(50, 6, utf8_decode($label . ':'), 0, 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(34, 34, 34);
            $pdf->MultiCell(0, 6, utf8_decode($valor), 0, 'L');
        };
 
        $bloque = function(string $label, string $texto) use ($pdf) {
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(31, 89, 69);
            $pdf->Cell(0, 5, utf8_decode($label), 0, 1);
            $pdf->SetFillColor(240, 250, 246);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(34, 34, 34);
            $pdf->MultiCell(0, 6, utf8_decode($texto), 0, 'L', true);
            $pdf->Ln(2);
        };
 
        // 1. DATOS DEL PACIENTE
        $seccion('1. Datos del paciente');
        $fila('Nombre completo',   $cita->nombre_paciente);
        $fila('Documento / Cédula', $cita->cedula);
        $fila('Edad',              ($cita->edad ?? '—') . ' años');
        $fila('EPS',               $cita->eps);
        $fila('Teléfono',          $cita->telefono ?? '—');
        $fila('Dirección',         $cita->direccion ?? '—');
        $fila('Correo registrado', $correoDestino);
        $pdf->Ln(3);
 
        // 2. DATOS DE LA CITA
        $seccion('2. Datos de la cita');
        $fila('Especialidad',    $cita->especialidad);
        $fila('Médico tratante', $cita->nombre_medico);
        $fila('Fecha',           $cita->fecha_asignada);
        $fila('Hora',            $cita->hora_cita);
        $fila('Sede',            $cita->sede);
        $fila('Motivo',          $cita->motivo_especifico ?? '—');
        $pdf->Ln(3);
 
        $pdf->SetDrawColor(31, 89, 69);
        $pdf->Line(22, $pdf->GetY(), 188, $pdf->GetY());
        $pdf->Ln(4);
 
        // 3. DIAGNÓSTICO Y TRATAMIENTO
        $seccion('3. Diagnóstico y tratamiento médico');
        $bloque('Diagnóstico del médico:',      $request->diagnostico);
        $bloque('Tratamiento / Indicaciones:',  $request->tratamiento);
        $bloque('Próxima cita:',
            $request->proxima_cita
                ? Carbon::parse($request->proxima_cita)->format('d/m/Y')
                : 'No requerida'
        );
 
        if ($request->filled('observaciones')) {
            $bloque('Observaciones adicionales:', $request->observaciones);
        }
 
        // Firma
        $pdf->Ln(6);
        $pdf->SetX(120);
        $pdf->SetDrawColor(31, 89, 69);
        $pdf->Line(120, $pdf->GetY(), 188, $pdf->GetY());
        $pdf->Ln(3);
        $pdf->SetX(120);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetTextColor(31, 89, 69);
        $pdf->Cell(68, 5, utf8_decode($cita->nombre_medico ?? '—'), 0, 1, 'C');
        $pdf->SetX(120);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(68, 5, utf8_decode('Médico ' . ($cita->especialidad ?? '') . ' — SaludNow'), 0, 1, 'C');
 
        $pdfStream = $pdf->Output('S');
 
        // ── Enviar correo vía SMTP ──────────────────────────
        try {
            Mail::send([], [], function ($message) use ($correoDestino, $cita, $pdfStream) {
                $message
                    ->from(config('mail.from.address'), config('mail.from.name')) 
                    ->to($correoDestino)
                    ->subject('SaludNow - Reporte Clinico de ' . $cita->nombre_paciente)
                    ->html(
                        '<div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;">
                            <h2 style="color:#1f5945;">SaludNow – Reporte de Evolución Médica</h2>
                            <p>Estimado/a <strong>' . e($cita->nombre_paciente) . '</strong>,</p>
                            <p>Adjunto encontrará el documento clínico correspondiente a su cita del día
                               <strong>' . e($cita->fecha_asignada) . '</strong> con el especialista
                               <strong>' . e($cita->nombre_medico) . '</strong>.</p>
                            <p>Si tiene alguna duda comuníquese con nosotros.</p>
                            <p style="color:#1f5945;font-weight:bold;margin-top:24px;">— Equipo SaludNow<br>
                               <small style="color:#888;">Quibdó, Chocó · 300 000 0000 · SaludNow.gmail.com</small></p>
                         </div>'
                    )
                    ->attachData($pdfStream, 'Reporte_Clinico_' . $cita->cedula . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            });

            return back()->with('success', 'Diagnóstico enviado con éxito al correo: ' . $correoDestino);

        } catch (\Exception $e) {
            return back()->with('warning', 'Diagnóstico guardado, pero el correo no se pudo enviar: ' . $e->getMessage());
        }
    }
}