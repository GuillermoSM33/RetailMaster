<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define la ruta predeterminada según el rol del usuario.
     * 
     * Esta constante ahora utiliza un método dinámico para determinar la ruta de redirección.
     */
    public const HOME = '/';

    /**
     * Define tus vinculaciones de modelo, filtros de patrones y otra configuración de rutas.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura los limitadores de velocidad para la aplicación.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Determina dinámicamente la ruta "home" según el rol del usuario.
     *
     * @return string
     */
    public static function redirectBasedOnRole()
    {
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            return route('usuarios.index'); // Redirige a la página de gestión de usuarios
        }

        if ($user->hasRole('Cajero')) {
            return route('ventas'); // Redirige a la vista de ventas
        }

        return self::HOME; // Redirige al dashboard por defecto
    }
}
