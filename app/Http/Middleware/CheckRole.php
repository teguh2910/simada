<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check based on role parameter
        switch ($role) {
            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Access denied. Admin privileges required.');
                }
                break;

            case 'sptt':
                if (!Gate::allows('access-sptt')) {
                    abort(403, 'Access denied. SPTT access required.');
                }
                break;

            case 'pcr-apr':
                if (!Gate::allows('access-pcr-apr')) {
                    abort(403, 'Access denied. PCR/APR access required.');
                }
                break;

            case 'dashboard':
                if (!Gate::allows('access-dashboard')) {
                    abort(403, 'Access denied. Dashboard access required.');
                }
                break;

            default:
                // Check for specific department
                if (!$user->hasDepartment($role)) {
                    abort(403, 'Access denied. Department access required.');
                }
                break;
        }

        return $next($request);
    }
}
