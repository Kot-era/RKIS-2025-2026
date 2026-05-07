<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login')
                ->with('error', 'Для доступа к панели управления необходимо войти.');
        }
        return $next($request);
    }
}
