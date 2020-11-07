<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CheckPermissionsMiddleWare
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
        if( !check_users_permissions( $request )){
            abort(403, "Access Forbidden !");
        }
        return $next($request);
    }
}
