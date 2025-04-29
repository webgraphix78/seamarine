<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WebTokenAuthenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If already authenticated, skip
        if (Auth::check()) {
            return $next($request);
        }

        // Check for token in query string or header
        $token = $request->query('current_token') ?? $request->header('Authorization');

        if ($token && str_starts_with($token, 'Bearer ')) {
            $token = substr($token, 7); // Remove Bearer prefix
        }

        if ($token) {
            $user = User::where('current_token', $token)->first();

            if ($user) {
                Auth::login($user);
            }
			else{
				// Token is invalid, return unauthorized response
				return response()->json([
					'status' => 0,
					'message' => 'Unauthorized',
				], 401);
			}
		} else {
			// No token provided, return unauthorized response
			if ($request->is('api/*')) {
				return response()->json([
					'status' => 0,
					'message' => 'Unauthorized',
				], 401);
			}
        }

        return $next($request);
    }
}
