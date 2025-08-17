<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Token inválido'
            ], 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Token expirado'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Token no proporcionado'
            ], 401);
        }
        return $next($request);
    }
}
