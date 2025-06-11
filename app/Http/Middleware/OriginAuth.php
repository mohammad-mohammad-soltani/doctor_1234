<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OriginAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('origin')->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'لطفاً ابتدا وارد شوید'], 401);
            }
            return redirect()->route('origin.login');
        }

        return $next($request);
    }
}
