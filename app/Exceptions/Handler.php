<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Http\Request;


use Meta;
use Flash;
use Session;
use DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    { 

        if($e instanceof \Illuminate\Session\TokenMismatchException) 
        {       
            if($request->segment(1)=='login')
            {
                Session::flash('error','Sorry, Please refresh your link properly, Please login again.');             
                return redirect()->back();
            }

            if($request->segment(1)=='admin')
            {
                Session::flash('error',' Please refresh your link properly, Please login again.');             
                return redirect()->back();    
            }
           
        }
        if($e instanceof \InvalidArgumentException)
        {
           return redirect(url('/').'/signin');   
        }
        if($e instanceof \Symfony\Component\HttpFoundation\File\Exception\FileException) 
        {       
            
            Session::flash('error','File limit is exceeded.');             
            return redirect()->back();   
        }
        if($e instanceof \Cartalyst\Sentinel\Checkpoints\ThrottlingException)
        {
           /* if($request->segment(1)=='login')
            {*/
                DB::table('throttle')->truncate();  
                return redirect()->back();
/*                return response()->json(['status'=>'error','msg'=>$e->getMessage()]);                  
            }

            if($request->segment(1)=='admin')
            {
                Flash::error($e->getMessage());                
                DB::table('throttle')->truncate();
                return redirect()->back();   
            }   */
            
        }
        if($e instanceof \GuzzleHttp\Exception\ConnectException)
        {
            Session::flash('error','Connection timeout,Please try again.');             
            return redirect(url('/').'/pricing');    
        }
        if($e instanceof \Yansongda\Pay\Exceptions\InvalidSignException)
        {
            Session::flash('error','Transaction Fail.');             
            return redirect(url('/').'/pricing');    
        }
        if($e instanceof Yansongda\Pay\Exceptions\GatewayException)
        {
            Session::flash('error','Transaction Fail,Service unavailable.');             
            return redirect(url('/').'/pricing');    
        }
        if($e instanceof \PayPal\Exception\PayPalConnectionException)
        {
            //Session::flash('error','Error occure while transaction.');             
            return redirect(url('/').'/pricing');    
        }
        if(env('APP_ENV','local')!='local')
        {
          if($e instanceof \Cartalyst\Sentinel\Checkpoints\ThrottlingException)
          {
            Session::flash('error',$e->getMessage());
            return redirect()->back();
          }

          if($e instanceof Exception)
          {
            parent::report($e);
            Meta::setTitle('404 Page Not Found ');

            return response()->view('errors.404',[],404);
          }
        }
        return parent::render($request, $e);
    }
}
