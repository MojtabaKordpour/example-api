<?php

namespace App\Http\Middleware;

use Closure;

class JsonAcceptation
{

    public function __invoke($request, Closure $next)
    {
        $acceptHeader = $request->header('Accept');
        if ($acceptHeader != 'application/json') {
            return response()->json(['message' => 'ُThe request is not json'], 400);
        }

        return $next($request);
    }
}
