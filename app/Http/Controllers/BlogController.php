<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogController extends Controller
{
    // 1. Cargar la página de gestión con la tabla de artículos
   public function listarBlog()
    {
        if (!session()->has('medico')) { 
            return redirect('/login-medico')->with('error', 'Debe iniciar sesión.'); 
        }
        
        //  SOLUCIÓN: Especificamos la conexión de Mongo y usamos table()
        $articulos = DB::connection('mongodb')->table('blogs')->orderBy('created_at', 'desc')->get();
        
        return view('administracion.blog', compact('articulos'));
    }

    // 2. Guardar un nuevo artículo desde el administrador o páginas principales
    public function publicarBlog(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string',
            'contenido' => 'required|string'
        ]);

        $nombreImagen = null;
        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada');
            $nombreImagen = 'blog_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('img/blog'), $nombreImagen);
        }

        DB::connection('mongodb')->table('blogs')->insert([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'contenido' => $request->contenido,
            'imagen' => $nombreImagen,
            'autor' => session('medico.nombre', 'Especialista'),
            // Guardamos formato legible, pero puedes usar MongoDate si requieres ordenamiento estricto
            'created_at' => Carbon::now()->toISOString() 
        ]);

        return back()->with('success', '¡Artículo indexado con éxito!');
    }

    // 3. Eliminar una publicación de la base de datos
    public function eliminarBlog($id)
    {
        DB::connection('mongodb')->table('blogs')->where('_id', $id)->delete();
        return back()->with('success', 'Artículo removido correctamente.');
    }

    // 4. Actualizar un artículo existente
    // 4. Actualizar un artículo existente (Corregido para objetos stdClass)
    public function editarBlog(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string',
            'contenido' => 'required|string'
        ]);

        // Buscamos el artículo actual en MongoDB
        $articulo = DB::connection('mongodb')->table('blogs')->where('_id', $id)->first();
        
       
        $nombreImagen = $articulo->imagen ?? null;

        // Si el usuario subió una nueva portada, reemplazamos la anterior
        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada');
            $nombreImagen = 'blog_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('img/blog'), $nombreImagen);
        }

        // Actualizamos en MongoDB
        DB::connection('mongodb')->table('blogs')->where('_id', $id)->update([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'contenido' => $request->contenido,
            'imagen' => $nombreImagen,
            'updated_at' => \Carbon\Carbon::now()->format('d/m/Y H:i')
        ]);

        return back()->with('success', '¡Artículo actualizado con éxito!');
    }
    // Método para la página principal pública
   // Método para renderizar la Página Principal con los artículos de MongoDB
    public function mostrarPaginaPrincipal()
    {   
        $articulos = DB::connection('mongodb')->table('blogs')->orderBy('created_at', 'desc')->get();
        return view('pagina-principal', compact('articulos'));
    }

    // Método para renderizar la Página de Servicios con los artículos de MongoDB
    public function mostrarServicios()
    {
        $articulos = DB::connection('mongodb')->table('blogs')->orderBy('created_at', 'desc')->get();
        return view('servicios', compact('articulos'));
    }
}