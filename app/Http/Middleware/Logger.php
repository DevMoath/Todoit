<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Log::info('app.requests', [
            'request'  => $request->url(),
            'data'     => $request->except(['_token', 'password', 'password-confirm']),
            'response' => $response->getStatusCode()
        ]);
    }
}
