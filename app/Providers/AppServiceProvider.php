<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\Comentario;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            $comentarios = Comentario::latest()->get();
            $view->with('comentarios', $comentarios);
        });

        Carbon::setLocale('es');

        \View::composer('Administracion.modal-mostrar-post', function ($view) {
            $articulos = \DB::connection('mongodb')->table('blogs')->orderBy('created_at', 'desc')->get();
            $view->with('articulos', $articulos);
        });
    }
}