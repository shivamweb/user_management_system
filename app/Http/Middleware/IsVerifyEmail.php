<?php

namespace App\Http\Middleware;

use App\Models\records;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect('records')->with('message', 'You are already logged in. No need to go on login page.');
        }

        return $next($request);
    }
}
