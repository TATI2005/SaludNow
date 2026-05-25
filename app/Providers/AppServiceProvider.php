<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Comentario;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $comentarios = Comentario::latest()->get();
            $view->with('comentarios', $comentarios);
        });

        Carbon::setLocale('es');
        \View::composer('Administracion.modal-mostrar-post', function ($view) {
            $articulos = \DB::connection('mongodb')->table('blogs')->orderBy('created_at', 'desc')->get();
            $view->with('articulos', $articulos);
        });

         if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

    }
}
