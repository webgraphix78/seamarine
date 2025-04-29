<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MobileRequestAuthenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		// this means that this is a valid request
		$source = $request->header('User-Agent');
        if ($source !== 'MobileApp') {
            // Not a mobile app request, bypass the check
            return $next($request);
        }
		else{
			
			$authHeader = $request->header('Authorization');
			if (!$authHeader || !str_starts_with($authHeader, 'Bearer '))
				return response()->json(['status' => -100], 401);
	
			$encodedToken = substr($authHeader, 7); // remove 'Bearer '
			$decodedToken = base64_decode($encodedToken);
	
			if ($decodedToken !== 'seamarine@123') {
				return response()->json(['status' => -100], 401);
			}
			
			// Skip if the requests are for authentication or token validation
			$excludedPaths = ['api/authenticate-user', 'api/authenticate-token'];
			$path = $request->path();
	
			if (in_array($path, $excludedPaths)) {
				return $next($request); // Skip auth check
			}

			// If it is, check the user_token
			if (!$request->has('user_token') || $request->input('user_token') == '') {
				return response()->json([
					'status' => -1,
					'message' => 'User Token is mandatory and cannot be empty.',
				]);
			}
			return $next($request);
		}

    }

}
