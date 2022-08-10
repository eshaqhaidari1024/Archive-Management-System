<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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

        if(Auth::user()->user_level==\App\User::MANAGER || Auth::user()->user_level==\App\User::User || Auth::user()->user_level==\App\User::ADMIN)
            return $next($request);

        return redirect('error');
    }
}
