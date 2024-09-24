<?php

namespace App\Http\Middleware\Creator;

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
        $this->auth = auth()->guard('creator');

        if($this->auth->user())
        {
            return redirect(url('/'.$this->auth->user()->user_type.'/dashboard')); 
        }
        return $next($request);
    }
}
