<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App;

class LangController extends Controller
{
    
    public function Index($locale=false)
    {
    	if($locale!=false)
    	{
    		Session::put('locale',$locale);
    		App::setLocale($locale);
    		return redirect()->back();
    	}
    }
}
