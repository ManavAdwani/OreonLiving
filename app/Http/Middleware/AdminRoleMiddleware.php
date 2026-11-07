<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $section = null): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Please log in to access staff portals.');
        }

        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('admin.login')->with('error', 'Your staff account has been deactivated. Please contact Super Admin.');
        }

        if (!$user->isStaff()) {
            abort(403, 'Unauthorized. Access restricted to authorized Oréon Living staff.');
        }

        if ($section && !$user->canAccessSection($section)) {
            abort(403, "Access denied. Your role ({$user->role}) does not have permission to access the '{$section}' section.");
        }

        return $next($request);
    }
}
