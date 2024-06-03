<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RenderRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!cache()->has('web-routes') || true) {
            $allRoutes = Route::getRoutes();
            $routes = [];
            foreach ($allRoutes as $route) {
                $name = $route->getName();
                $url = url($route->uri());
                $url = str_replace("{", ":", $url);
                $url = str_replace("}", "", $url);

                if (!empty($name) && !str_contains($name, 'ignition'))
                    $routes[$name] = $url;
            }
            cache()->remember('web-routes', 60 * 60, function() use($routes) {
                return json_encode($routes);
            });
        }

        return $next($request);
    }
}
