<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
{
    $user = $request->user();

    if ($user && $user->must_change_password) {
        $path = $request->path();

        // Allow only these endpoints until password is changed
        $allowed = [
            'api/auth/me',
            'api/auth/change-password',
            'api/auth/logout',
        ];

        if (!in_array($path, $allowed, true)) {
            return response()->json([
                'message' => 'Password change required',
                'must_change_password' => true,
            ], 403);
        }
    }

    return $next($request);
}

}
