<?php
namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\StudentService;

use App\Models\UsersModel;
use App\Models\TextbookModel;
use App\Models\TextbookimagesModel;
use App\Models\SubjectModel;
use App\Models\GradeModel;

use Validator;
use Response;
use Session;
use flash;
use Excel;
use Auth;
use DB;

class TextbookController extends Controller
{
	public function __construct(
                                NotificationService $notification_service,
                                LanguageService     $language_service,
                                StudentService      $student_service
                                )
    {

        $this->NotificationService           = $notification_service;
        $this->StudentService                = $student_service;
        $this->LanguageService               = $language_service;
        
        $this->UsersModel                    = new UsersModel();
        $this->TextbookModel                 = new TextbookModel();
        $this->TextbookimagesModel           = new TextbookimagesModel();
        $this->SubjectModel                  = new SubjectModel();
        $this->GradeModel                    = new GradeModel();

        $this->textbook_file_base_img_path   = base_path().config('app.project.img_path.textbook_file');
        $this->textbook_file_public_img_path = url('/').config('app.project.img_path.textbook_file');
    }

    public function TextbookList(Request $request, $enc_program_id = false)
    {
        $arr_textbook = $arr_pagination = $arr_subject = $arr_grade = $arr_kid_subject = $arr_kid_grade = [];
        $subject_id   = $grade_id = '';
        $reset_link   = url('/').'/parent/textbook';
        $user_id      = Auth::user()->id;

        $getKids = getParentsAddedStudent($user_id);
        if( count($getKids) > 0 && !empty($getKids) )
        {
            foreach ($getKids as $key => $kids)
            {
                $arr_kid_subject[] = $kids['subject_id'];
                $arr_kid_grade[]   = $kids['grade_id'];
            }
        }

        $obj_textbook = $this->TextbookimagesModel->with(['textbookData' => function($query) {
                                                    $query->where('status','1');
                                                }])
                                                ->whereHas("textbookData", function($query) use($arr_kid_subject, $arr_kid_grade) {
                                                    $query->whereIn('subject_id', $arr_kid_subject);
                                                    $query->whereIn('grade_id', $arr_kid_grade);
                                                });

        // get only selected programs textbook
        if($enc_program_id != '' && !empty($enc_program_id))
        {
            $program_id   = base64_decode($enc_program_id);
            $obj_textbook = $obj_textbook->whereHas("textbookData", function($query) use($program_id) {
                                            $query->where('program_id', $program_id);
                                        });
            $reset_link = url('/').'/parent/textbook/'.$enc_program_id;
        }

        if( isset($_GET['subject']) && !empty($_GET['subject']) )
        {
            $subject_id   = base64_decode($_GET['subject']);
            $obj_textbook = $obj_textbook->whereHas("textbookData", function($query) use ($subject_id) {
                                            $query->where('subject_id', $subject_id);
                                        });

            $obj_grade    = $this->GradeModel->where('status', '1')->where('subject', $subject_id)->get();
            if($obj_grade)
            {
                $arr_grade = $obj_grade->toArray();
            }
        }

        if( isset($_GET['grade']) && !empty($_GET['grade']) )
        {
            $grade_id     = base64_decode($_GET['grade']);
            $obj_textbook = $obj_textbook->whereHas("textbookData", function($query) use ($grade_id) {
                                            $query->where('grade_id', $grade_id);
                                        });
        }

        $obj_textbook = $obj_textbook->paginate(16);
        if($obj_textbook)
        {
            $arr_textbook   = $obj_textbook->toArray();
            $arr_pagination = $obj_textbook->links();
        }

        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }

        $data['arr_textbook']                  = $arr_textbook;
        $data['arr_pagination']                = $arr_pagination;
        $data['arr_subject']                   = $arr_subject;
        $data['arr_grade']                     = $arr_grade;
        $data['search_subject_id']             = base64_encode($subject_id);
        $data['search_grade_id']               = base64_encode($grade_id);
        $data['reset_link']                    = $reset_link;

        $data['user_type']                     = 'parent';
        $data['parentTitle']                   = trans('parent.Dashboard');
        $data['pageTitle']                     = trans('parent.Textbook');
        $data['middleContent']                 = 'parent.textbook.index';

        $data['textbook_file_base_img_path']   = $this->textbook_file_base_img_path;
        $data['textbook_file_public_img_path'] = $this->textbook_file_public_img_path;
        
        return view('front.layout.master')->with($data);
    }



}
