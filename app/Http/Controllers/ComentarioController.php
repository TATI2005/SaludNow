<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function guardar(Request $request)
    {
        Comentario::create([
            'nombre' => session('usuario.nombre') ?? 'Invitado',
            'email' => session('usuario.email'),
            'comentario' => $request->comentario
        ]);

        return back();
    }

    // Eliminar
    public function eliminar($id)
    {
        $comentario = Comentario::find($id);

        if ($comentario && $comentario->nombre == session('usuario.nombre')) {
            $comentario->delete();
        }

        return back();
    }

    // Editar
    public function editar(Request $request, $id)
    {
        $comentario = Comentario::find($id);

        if ($comentario && $comentario->nombre == session('usuario.nombre')) {
            $comentario->comentario = $request->comentario;
            $comentario->save();
        }

        return back();
    }

}