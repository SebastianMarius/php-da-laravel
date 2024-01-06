<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if ($request->user() && $request->user()->isAdmin()) {
        //     Log::info('da drac');
        //     return $next($request);
        // } else {
        //     Log::info('da draccc');
        //     Log::info($request->user());
        //     // $request->user()->isAdmin();
        //     abort(403, 'Unauthorized actiosn.');
        //     // return $next($request);
        // }

      
    }
}
