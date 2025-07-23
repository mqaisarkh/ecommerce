<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->is_admin == 1) {
            return $next($request); // allow access to dashboard
        }

        return redirect()->route('home'); // redirect non-admins
    }
}
