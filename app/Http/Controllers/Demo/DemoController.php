<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Flash;
use Sentinel;
use Mail;
use Meta;
use Session;
use App;

class DemoController extends Controller
{
    public function index(Request $request)
    { 
		return view('recording-demo');	
		
    }

    public function load_template($type=null)
    {
        if($type)
        {
            try
            {
                if($type=='IE')
                {
                    return view('ieflash-recorder');
                }	
                else
                {
                	return view('other-browser-recorder');
                }
            }

            catch(\Exception $e){
                echo '<div class="form-group"><label class="control-label col-lg-2"></label><div class="col-lg-5">Error!! View Not Found</div></div>';
            }
        }
    }
} 
