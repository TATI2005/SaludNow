<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // REGISTRO
    public function registrar(Request $request)
    {
        // Validación con confirmación de contraseña
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ], 
        
        [
            'nombre.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);

        Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }

    // Login simple
    public function login(Request $request)
    {
        $usuario = Usuarios::where('email', $request->email)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $usuario->password)) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }
        
        session(['usuario' => [
            'id' => $usuario->_id,
            'nombre' => $usuario->nombre,
            'email' => $usuario->email
        ]]);

        // Login correcto
        return redirect('/pagina-principal')->with('success', 'Inicio de sesion exitoso');
    }

    public function logout()
    {
        session()->forget('usuario');
        return redirect('/login');
    }

}