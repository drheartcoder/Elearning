<?php

namespace App\Common\Services;

use App\Models\ProgramQuestionModel;
use \Session;
use \Mail;
use App;
use Excel;
class ProgramService
{
	public function __construct()
	{
		$this->ProgramQuestionModel = new ProgramQuestionModel();
	}
	public function export_program($program_id)
	{
		$program_name             = '';
		$arr_program_question     = $arr_data = $arr_export = [];
		$obj_program_question     = $this->ProgramQuestionModel->select('id','program_id','template_id','lesson_id','question_id')
                                                  ->with([
                                                    'programData'=>function($programDataQuery){
                                                        $programDataQuery->select('id','name');
                                                    },
                                                    'lessonData'=>function($lessonDataQuery){
                                                        $lessonDataQuery->select('id','name');
                                                    }
                                                    ])
                                                  ->where('program_id', '=', $program_id)
                                                  ->orderBy('id', 'DESC')
                                                  ->get();
		
		if($obj_program_question)
		{
			$arr_program_question  = $obj_program_question->toArray();
		}
		if(isset($arr_program_question) && sizeof($arr_program_question)>0)
		{
			foreach($arr_program_question as $key => $program_question) 
            {
            	if($key==0)
            	{
            	  $program_name = isset($program_question['program_data']['name'])?$program_question['program_data']['name']:'';
            	}
            	$template_id = isset($program_question['template_id'])?$program_question['template_id']:'NA';
            	$program_id  = isset($program_question['question_id'])?$program_question['question_id']:'';

            	$arrQuestion = getQuestionInfo($template_id,$program_id);
            	$question    = isset($arrQuestion['question'])?$arrQuestion['question']:'';

                $arr_data['question']     = $question;
                $arr_data['lesson']       = isset($program_question['lesson_data']['name'])?$program_question['lesson_data']['name']:'NA';
                $arr_data['template']     = $template_id; 

                array_push($arr_export,$arr_data);
            }
  
		}
		$data = $arr_export;
        $type = 'CSV';

        return Excel::create($program_name.'-'.trans('parent.Program_Report'), function($excel) use ($data,$program_name) {

            // Set the title
            $excel->setTitle($program_name.trans('parent.Program_Report'));

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription($program_name.trans('parent.Program_Report'));

            $excel->sheet($program_name.trans('parent.Program_Report'), function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
	}
}