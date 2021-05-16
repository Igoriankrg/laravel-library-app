<?php


namespace App\Http\Middleware;


use Closure;

class ResponseApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);

        $response->header('Content-Type', 'application/json');

        return $response;
    }
}