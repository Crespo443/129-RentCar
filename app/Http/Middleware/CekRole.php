<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        
        if (!session('user_login')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu');
        }
        $userRole = session('user_role');

        if ($role === 'admin') {
            if ($userRole !== 'admin') {
                return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman admin');
            }
        } elseif ($role === 'user') {
            if ($userRole === 'admin') {
                return redirect('/admin/dashboard')->with('error', 'Admin tidak bisa akses halaman user');
            }
        }

        return $next($request);
    }
}
