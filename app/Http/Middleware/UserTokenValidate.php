<?php

namespace App\Http\Middleware;

use Closure;

class UserTokenValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->tokenCan('user')) {
            return response()->json([
                'message' => "Unauthenticated",
            ]);
        }
        
        return $next($request);
    }
}
