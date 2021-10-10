<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->is_admin != '1'){
            Auth::logout();
            Session::flush();
            Session::regenerate();
            return redirect()->route('login')->withErrors(['email' => 'These credientials does not matched.']);
        }
        return $next($request);
    }
}
