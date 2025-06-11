<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!$request->user()) {
            Log::error('CheckRole: No authenticated user found');
            return redirect()->route('login');
        }

        Log::info('CheckRole: Checking role', [
            'user_id' => $request->user()->id,
            'user_role' => $request->user()->role,
            'required_role' => $role
        ]);

        if ($role === 'admin') {
            if (!$request->user()->isAdmin()) {
                Log::warning('CheckRole: User is not admin', [
                    'user_id' => $request->user()->id,
                    'user_role' => $request->user()->role
                ]);
                abort(403, 'Unauthorized action.');
            }
        }

        if ($role === 'client') {
            if (!$request->user()->isClient()) {
                Log::warning('CheckRole: User is not client', [
                    'user_id' => $request->user()->id,
                    'user_role' => $request->user()->role
                ]);
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
} 