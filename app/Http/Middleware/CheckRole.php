<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user() === null && $roles !== null){
            //return response("Error", 401);
            return redirect()->route('login', ['returnUrl' => $request->path()]);
        }

        if (!$roles || $request->user()->hasAnyRole($roles)){
            return $next($request);
        }

        return response("Error", 401);
    }
}
