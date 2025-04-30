<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSubscribedUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->subscribed('prod_SE108n2SgYwi6u')) {
            return redirect()->route('pricing')->with('error', 'You must be subscribed to access this page.');
        }

        return $next($request);
    }
}
