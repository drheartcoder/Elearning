<?php

namespace App\Http\Middleware\Front;
use App\Models\MasterModel;

use Closure;
use Session;
use Auth;
use DB;


class RoutingMiddleware
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
        if(Auth::check()==false)   
        {
            return $next($request);
        }
        else
        {
            $user = Auth::user();                       
        	return redirect(url('/'.$user->user_type.'/dashboard'));	
        }        
    }
}
