<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiToken;

class ValidateApiToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('PUBLIC-API-TOKEN');

        if (!$token || !ApiToken::where('token', $token)->where('valid_for', now()->toDateString())->exists()) {
            return response()->json(['message' => 'Invalid or missing token'], 401);
        }

        return $next($request);
    }
}
