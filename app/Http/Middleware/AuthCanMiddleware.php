<?php

namespace App\Http\Middleware;

use App\Helpers\RouteName;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthCanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @param $role
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next, $role): JsonResponse
    {
        $request->merge([
            "auth_can" => RouteName::makeActionName($role)
        ]);


        return $next($request);
    }
}
