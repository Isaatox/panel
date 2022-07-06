<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticate
{

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::user() == null){
            return abort(404);
        
        }
        if(Auth::user() != null && Auth::user()->admin == true) {
            return $next($request);
        } else if (Auth::user() && Auth::user()->admin == false){
            return abort(404);
        }
        return parent::handle($request, $next, $guards);
    }
}
