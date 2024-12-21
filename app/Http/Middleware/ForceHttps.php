<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class ForceHttps
{
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        return $next($request);
    }
} 