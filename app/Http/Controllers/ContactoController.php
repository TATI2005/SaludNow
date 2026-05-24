<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // 1. Validar mensaje
        $request->validate([
            'mensaje' => 'required|min:5',
        ]);

        $usuarioSesion = session('usuario');

        if (!$usuarioSesion) {
            return redirect()->back()->with('error', 'Debes iniciar sesión.');
        }

        $emailUsuario = $usuarioSesion['email'];
        $nombreUsuario = $usuarioSesion['nombre'];
        $empresaEmail = 'tatilia2005@gmail.com'; // Correo de la empresa

        // 2. Guardar en MongoDB
        Contacto::create([
            'nombre' => $nombreUsuario,
            'email' => $emailUsuario,
            'mensaje' => $request->mensaje,
            'leido' => false
        ]);

        // 3. ENVIAR A LA EMPRESA (Avisar que hay un nuevo mensaje)
        Mail::send([], [], function ($message) use ($nombreUsuario, $emailUsuario, $request, $empresaEmail) {
            $message->to($empresaEmail)
                ->subject('Nuevo mensaje de contacto de: ' . $nombreUsuario)
                ->html("
                    <h2>Nuevo mensaje recibido</h2>
                    <p><strong>De:</strong> {$nombreUsuario} ({$emailUsuario})</p>
                    <p><strong>Mensaje:</strong></p>
                    <p>{$request->mensaje}</p>
                ");
        });

        // 4. ENVIAR AL USUARIO (Confirmación de "Gracias")
        Mail::send([], [], function ($message) use ($emailUsuario, $nombreUsuario) {
            $message->to($emailUsuario)
                ->subject('Gracias por contactarnos - SaludNow')
                ->html("
                    <h1>¡Hola {$nombreUsuario}!</h1>
                    <p>Hemos recibido tu mensaje correctamente.</p>
                    <p><strong>Te responderemos lo más pronto posible.</strong></p>
                    <br>
                    <p>Atentamente,<br>El equipo de SaludNow</p>
                ");
        });

        return redirect()->back()->with('success', '¡Mensaje enviado! Hemos enviado una confirmación a tu correo.');
    }
}