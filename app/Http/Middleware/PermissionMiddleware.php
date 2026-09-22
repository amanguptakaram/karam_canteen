<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {

        $user = $request->user();

        if (!$user || !$user->hasPermission($permission)) {

            return redirect()
                ->back()
                ->with('permission_error', 'You are not eligible to access this section.');
        }

        return $next($request);
    }
}