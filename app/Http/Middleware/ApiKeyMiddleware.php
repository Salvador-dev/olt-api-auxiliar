<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $idTenant = $request->header('X-Tenant');

        // if (!$idTenant) {
        //     $tenant = Tenant::find($idTenant);

        //     tenancy()->initialize($tenant);

        //     $apiKey = $request->header('AK');

        //     if (!$apiKey || $apiKey !== config('app.api_key')) {
        //         return response()->json(['error' => 'Unauthorized'], 401);
        //     }
        // }

        $apiKey = $request->header('AK');

        $ip = $request->ip();

        $allowedIpList = ['127.0.0.1'];

        if (!$apiKey || $apiKey !== config('app.api_key') || !in_array($request->ip(), $allowedIpList)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
