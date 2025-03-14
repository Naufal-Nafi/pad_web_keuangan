<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
// fungsi untuk memproses dan memastikan hanya user dengan role 'owner' yang dapat mengakses
    public function handle($request, Closure $next): Response
    {   
        if (Auth::check() && Auth::user()->role != 'owner') {
            return redirect()->back(); 
        }
        return $next($request); 
    }
}