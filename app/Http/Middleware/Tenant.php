<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::user()->user_type == 'staff'){ 
            return redirect()->route('home');
        }elseif(Auth::user()->user_type == 'client'){
            return $next($request);
        }else{ 
            auth()->logout();
            abort(401);
        }
    }
}
