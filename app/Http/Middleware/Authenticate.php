<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request || $request->expectsJson()) {
            return null;
        }
    
        if ($request->is('area-admin/*')) {
            return route('login');
        }

        if ($request->is('sevend/*')) {
            return route('sevend.home');
        }
    
        // fallback padrão
        return route('login'); // ou qualquer rota genérica de login que você tenha
    }
}
