<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $apiRequest = $this->isApiRequest($request);

        if ($request->user() === null && $roles !== null){
            if ($apiRequest){
                return $this->respond('roles.nouser', 'The user needs to be authenticated!', 401);
            }else{
                return redirect()->route('login', ['returnUrl' => $request->path()]);
            }
        }

        //valid user and role
        if (!$roles || $request->user()->hasAnyRole($roles)){
            return $next($request);
        }

        //valid user, role not allowed
        if ($apiRequest){
            return $this->respond('roles.invalid', 'You don\'t have permission to access this route!', 401);
        }else{
            return redirect('/');
        }
    }

    private function isApiRequest($request)
    {
        return $request->hasHeader('authorization');
    }
}
