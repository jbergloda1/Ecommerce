<?php

namespace App\Http\Middleware;

use Closure;
use Facades\App\Libraries\Session;
use App\Exceptions\UserUnauthorizedException;

class Auth
{
    public function handle($request, Closure $next)
    {
        if (Session::verify($request->bearerToken(), $request->email)) {
            return $next($request);
        }
        throw new UserUnauthorizedException;
    }
}
