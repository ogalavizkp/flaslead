<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class AllowIframeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Permitir carga en iframes de cualquier origen
        $response->headers->set('X-Frame-Options', 'ALLOWALL');

        // Asegurar que la cookie de sesión funcione en iframe (SameSite=None y Secure)
        if ($request->hasSession()) {
            $sessionName = config('session.cookie');
            $sessionId = $request->cookie($sessionName);

            if ($sessionId) {
                cookie()->queue(
                    cookie(
                        $sessionName,
                        $sessionId,
                        config('session.lifetime'),
                        config('session.path'),
                        config('session.domain'),
                        true, // Secure
                        true, // HttpOnly
                        false,
                        'None' // SameSite
                    )
                );
            }
        }

        return $response;
    }
}
