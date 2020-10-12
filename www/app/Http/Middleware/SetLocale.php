<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $locale)
    {
        App::setlocale($locale);

             
        return $next($request);
    }
}
