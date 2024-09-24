<?php

namespace App\Http\Middleware\Supervisor;

use Closure;

class CheckAuthMiddleware
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
        $this->auth = auth()->guard('supervisor');

        if($this->auth->user())
        {
            return redirect(url('/supervisor/dashboard')); 
        }
        return $next($request);
    }
}
