<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use JWTAuth;
use App\User;

class AccessAdmin
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
       

        try {
            
            $jwt = JWTAuth::parseToken()->authenticate();

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $jwt = false;
        }
        if (User::find($jwt->id)->hasAnyRole('admin')) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
