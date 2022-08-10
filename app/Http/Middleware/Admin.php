<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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

        if(Auth::user()->user_level == User::MANAGER ||
            Auth::user()->user_level== User::ADMIN ||
            Auth::user()->user_level== User::USER)

            return $next($request);

        return redirect('error');

        }


}
