<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;
use App\Models\NotificationsModel;
use App\Models\StudentDetailsModel;
use App\Models\TransactionsModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\ProgramModel;

use Validator;
use Response;
use Session;
use flash;
use Auth;
use DB;
use PDF;
use Paginate;

class ParentController extends Controller
{
    public function __construct(NotificationService $notification_service)
    {
        $this->NotificationService         = $notification_service;
        $this->NotificationsModel          = new NotificationsModel();
        $this->StudentDetailsModel         = new StudentDetailsModel();
        $this->TransactionsModel           = new TransactionsModel();
        $this->SubjectModel                = new SubjectModel();
        $this->SubjectTranslationModel     = new SubjectTranslationModel();
        $this->GradeModel                  = new GradeModel();
        $this->GradeTranslationModel       = new GradeTranslationModel();
        $this->ProgramModel                = new ProgramModel();

        $this->invoice_path = url('/').config('app.project.invoice_path');        
        //dd($this->invoice_path);
    }

    public function PrintPin(Request $request)
    {
        $student_info=[];
        if(isset($_POST['btnPrintPin'])) 
        {
            $obj_student_info = $this->StudentDetailsModel->with(['student_data'=>function($q){
                                                            $q->select('id','pin','first_name','last_name');
                                                        }])->where('parent_id',Auth::id())->get();

            if(isset($obj_student_info) && count($obj_student_info)>0)
            {
                $student_info = $obj_student_info->toArray();
                
                $view = view('student-pin-pdf')->with(['student_info'=>$student_info]);            
                $html = $view->render();                 
                $res  = PDF::loadHTML($html)->save(base_path('uploads/student_pin/student-pin.pdf'),'F');
                $res->stream(base_path('uploads/student_pin/student-pin.pdf'));      

                Session::flash('file',url('/uploads/student_pin/student-pin.pdf'));
                return redirect()->back();
            }    
            else
            {
                Session::flash('error',trans('parent.Please_add_student_in_this_class'));
                return redirect()->back();
            }
        }        

        $data['pageTitle']      = trans('parent.Print_Pins');
        $data['middleContent']  = 'parent.my-children.print-pin';
        $data['user_type']      = 'parent';
        $data['parentTitle']    = trans('parent.Dashboard');
        return view('front.layout.master')->with($data);
    }

    public function Transactions(Request $request)
    {
        $transactions = $arr_data = [];
        $obj_transactions = '';
        $links = '';
        $search_term  = $request->input('keyword','');
        if(isset($search_term) && $search_term!="") 
        {
            $obj_transactions = $this->TransactionsModel->with(['plan_data'])
                                     ->where('user_id',Auth::id())
                                     ->where('transaction_id','LIKE',"%$search_term%")
                                     ->orWhere('status','LIKE',"$search_term")
                                     ->orWhere('payment_status','LIKE',"$search_term%")
                                     ->orWhere('amount','LIKE',"$search_term%")
                                     ->orWhereHas('plan_data.subscription_plan_translation', function($query) use($search_term)
                                     {
                                        $query->where('name', 'LIKE', '%'.$search_term.'%');
                                     })
                                     ->Paginate(10);
                                         
        }                                      
        else
        {
            $obj_transactions = $this->TransactionsModel->with(['plan_data'])->where('user_id',Auth::id())->orderBy('id','DESC')->Paginate(10);

        }

        if(isset($obj_transactions) && count($obj_transactions)>0)
        {
            $links = $obj_transactions->links();
            $transactions = $obj_transactions->toArray();
        }        

        $data['transactions_arr']    = $transactions;
        $data['invoice_path']        = $this->invoice_path;
        $data['pagination_link_arr'] = $links;
        $data['pageTitle']           =  trans('parent.My_Transactions');
        $data['middleContent']       = 'parent.transactions';     
        $data['parentTitle']         =  trans('parent.Dashboard');   
        $data['user_type']           = 'parent';

        return view('front.layout.master')->with($data);   
    }

    /**
    * Function  : my_kids($slug)
    * Author    : Akshay Garje
    * Date      : 05/09/2018
    * @return [view] [Return view of My Kids]
    */    
    public function my_kids()
    {

        $arr_transactions   = $arr_children = $arr_grade = $arr_program = [];
        $child_allowed      = $child_added = 0;
        $allow_to_add_child = 'yes';
        $parent_id          = Auth::user()->id;

        $arr_transactions = getActiveMembershipPlan($parent_id);
        
        if($arr_transactions)
        {            
            $child_allowed    = $arr_transactions['child_limit'];
        }

        $obj_children = $this->StudentDetailsModel->where('parent_id', $parent_id)
                                                  ->select('id', 'student_id', 'parent_id', 'added_by', 'subject_id', 'grade_id')
                                                  ->with(['user_data' => function($query){
                                                        $query->select('id', 'first_name', 'last_name', 'pin');
                                                    }])
                                                  ->with('subject_data','grade_data')
                                                  ->orderBy('id','DESC')
                                                  ->get();
        if($obj_children)
        {
            $arr_children = $obj_children->toArray();
            $child_added  = count($arr_children);
        }

        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }
        //dd($arr_subject);


        $obj_grade = $this->GradeModel->where('status', '1')->get();
        if($obj_grade)
        {
            $arr_grade = $obj_grade->toArray();
        }


        $obj_program = $this->ProgramModel->where('status', '1')->where('approve_status', 'approved')->get();
        if($obj_program)
        {
            $arr_program = $obj_program->toArray();
        }

        // check if parent is allow to add more children or not
        if($child_added > 0 && $child_allowed > 0 && $child_added >= $child_allowed)
        {
            $allow_to_add_child = 'no';
        }

        $data['allow_to_add_child'] = $allow_to_add_child;
        $data['arr_transactions']   = $arr_transactions;
        $data['arr_children']       = $arr_children;
        $data['arr_subject']        = $arr_subject;
        $data['arr_grade']          = $arr_grade;
        $data['arr_program']        = $arr_program;
        $data['pageTitle']          = trans('parent.My_Kids');
        $data['middleContent']      = 'parent.my-children.index';
        $data['user_type']          = 'parent';
        $data['parentTitle']        = trans('parent.Dashboard');

        return view('front.layout.master')->with($data);
    } // end Index    
}
