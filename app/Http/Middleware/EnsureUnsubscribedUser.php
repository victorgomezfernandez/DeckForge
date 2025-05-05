<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUnsubscribedUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->subscribed('prod_SE108n2SgYwi6u')) {
            return redirect()->route('success')->with('error', 'You must be unsubscribed to access this page.');
        }

        return $next($request);
    }
}
