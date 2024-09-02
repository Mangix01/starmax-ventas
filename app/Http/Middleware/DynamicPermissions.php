<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DynamicPermissions
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario tiene el rol de "Admin"
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            // Si es un admin, permitir acceso completo
            return $next($request);
        }

        // Obtener el nombre de la ruta actual
        $routeName = Route::currentRouteName();
        
        // Asumimos que el nombre de la ruta sigue la convención "resource.action"
        if ($routeName) {
            // Separar el recurso y la acción de la ruta
            [$resource, $action] = explode('.', $routeName);

            // Definir las acciones especiales
            $specialActions = [
                'create' => ['create', 'store'],
                'edit' => ['edit', 'update']
            ];
            
            // Verificar si la acción es especial para "create"
            if (in_array($action, $specialActions['create'])) {
                // Si la acción actual es una acción especial para "create",
                // verificar si el usuario tiene permiso para la acción especial
                $permission = 'create ' . $resource;
                if (Auth::user()->hasPermissionTo($permission)) {
                    return $next($request);
                }
            } elseif (in_array($action, $specialActions['edit'])) {
                // Verificar si la acción es especial para "edit"
                // Si la acción actual es una acción especial para "edit",
                // verificar si el usuario tiene permiso para la acción especial
                $permission = 'edit ' . $resource;
                if (Auth::user()->hasPermissionTo($permission)) {
                    return $next($request);
                }
            } else {
                // Si la acción actual no es una acción especial,
                // verificar si el usuario tiene permiso normalmente
                $permission = $action . ' ' . $resource;
                if (Auth::user()->hasPermissionTo($permission)) {
                    return $next($request);
                }
            }

            // Si el usuario no tiene permiso para la acción, abortar con un error 403
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        // Si no se puede determinar la ruta actual, continuar con la solicitud
        return $next($request);
    }
}
