<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyDashboard {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if ($request->header('Authorization') !== '$2y$12$y2S1VAbP5AONr1iekaba4OuyIi9sC1gzyRxZuN44Vf4sgwtrpK3ji') {
            abort(403);
        }

        return $next($request);
    }
}
