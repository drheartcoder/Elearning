<?php

namespace App\Http\Middleware\Front;

use Closure;

class CheckUsersAuthMiddleware
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
        $this->auth = auth()->guard('users');

        if($this->auth->user())
        {
            return redirect(url('/user/dashboard')); 
        }
        return $next($request);
    }
}
