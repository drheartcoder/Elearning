<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StudentProgramQuestionModel extends Model
{
   
    protected $table = "student_program_questions";
    protected $fillable           = [
                                        'program_id',
                                        'template_id',
                                        'lesson_id',
                                        'question_id',
                                        'student_id',
                                        'audio_file',
                                        'answer_time',
                                        'wrong_attempts',
                                        'is_answer',
                                        'answer_date',
                                        'is_delay'
									];    
    
    public function program_details()
    {
    	return $this->belongsTo('App\Models\ProgramModel','program_id','id');
    }
    public function lessonData()
    {
        return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
    public function studentData()
    {
        return $this->belongsTo('App\Models\UsersModel', 'student_id', 'id');
    }
    public function template1()
    {
        return $this->belongsTo('App\Models\Template1Model', 'question_id', 'id');
    }
    public function template2()
    {
        return $this->belongsTo('App\Models\Template2Model', 'question_id', 'id');
    }
    public function template3()
    {
        return $this->belongsTo('App\Models\Template3Model', 'question_id', 'id');
    }
    public function template4()
    {
        return $this->belongsTo('App\Models\Template4Model', 'question_id', 'id');
    }
    public function template5()
    {
        return $this->belongsTo('App\Models\Template5Model', 'question_id', 'id');
    }
    public function template6()
    {
        return $this->belongsTo('App\Models\Template6Model', 'question_id', 'id');
    }
    public function template7()
    {
        return $this->belongsTo('App\Models\Template7Model', 'question_id', 'id');
    }
    public function template8()
    {
        return $this->belongsTo('App\Models\Template8Model', 'question_id', 'id');
    }
    public function template9()
    {
        return $this->belongsTo('App\Models\Template9Model', 'question_id', 'id');
    }
    public function template10()
    {
        return $this->belongsTo('App\Models\Template10Model', 'question_id', 'id');
    }
    public function template11()
    {
        return $this->belongsTo('App\Models\Template11Model', 'question_id', 'id');
    }
    public function template12()
    {
        return $this->belongsTo('App\Models\Template12Model', 'question_id', 'id');
    }
    public function template13()
    {
        return $this->belongsTo('App\Models\Template13Model', 'question_id', 'id');
    }
    public function template14()
    {
        return $this->belongsTo('App\Models\Template14Model', 'question_id', 'id');
    }
    public function template15()
    {
        return $this->belongsTo('App\Models\Template15Model', 'question_id', 'id');
    }
    public function template16()
    {
        return $this->belongsTo('App\Models\Template16Model', 'question_id', 'id');
    }
    public function template17()
    {
        return $this->belongsTo('App\Models\Template17Model', 'question_id', 'id');
    }
    public function template18()
    {
        return $this->belongsTo('App\Models\Template18Model', 'question_id', 'id');
    }
    public function template19()
    {
        return $this->belongsTo('App\Models\Template19Model', 'question_id', 'id');
    }
    public function template20()
    {
        return $this->belongsTo('App\Models\Template20Model', 'question_id', 'id');
    }
    public function template21()
    {
        return $this->belongsTo('App\Models\Template21Model', 'question_id', 'id');
    }
    public function template22()
    {
        return $this->belongsTo('App\Models\Template22Model', 'question_id', 'id');
    }
    public function template23()
    {
        return $this->belongsTo('App\Models\Template23Model', 'question_id', 'id');
    }
    public function template24()
    {
        return $this->belongsTo('App\Models\Template24Model', 'question_id', 'id');
    }    
    public function template25()
    {
        return $this->belongsTo('App\Models\Template25Model', 'question_id', 'id');
    }
    public function template26()
    {
        return $this->belongsTo('App\Models\Template26Model', 'question_id', 'id');
    }
    public function template27()
    {
        return $this->belongsTo('App\Models\Template27Model', 'question_id', 'id');
    }
    public function template28()
    {
        return $this->belongsTo('App\Models\Template28Model', 'question_id', 'id');
    }
    public function template29()
    {
        return $this->belongsTo('App\Models\Template29Model', 'question_id', 'id');
    }
    public function template30()
    {
        return $this->belongsTo('App\Models\Template30Model', 'question_id', 'id');
    }
    public function template31()
    {
        return $this->belongsTo('App\Models\Template31Model', 'question_id', 'id');
    }
    public function template32()
    {
        return $this->belongsTo('App\Models\Template32Model', 'question_id', 'id');
    }
    public function template33()
    {
        return $this->belongsTo('App\Models\Template33Model', 'question_id', 'id');
    }
    public function template34()
    {
        return $this->belongsTo('App\Models\Template34Model', 'question_id', 'id');
    }
    public function template35()
    {
        return $this->belongsTo('App\Models\Template35Model', 'question_id', 'id');
    }
    public function template36()
    {
        return $this->belongsTo('App\Models\Template36Model', 'question_id', 'id');
    }
    public function template37()
    {
        return $this->belongsTo('App\Models\Template37Model', 'question_id', 'id');
    }
    public function template38()
    {
        return $this->belongsTo('App\Models\Template38Model', 'question_id', 'id');
    }
    public function template39()
    {
        return $this->belongsTo('App\Models\Template39Model', 'question_id', 'id');
    }
    public function template40()
    {
        return $this->belongsTo('App\Models\Template40Model', 'question_id', 'id');
    }
    public function template41()
    {
        return $this->belongsTo('App\Models\Template41Model', 'question_id', 'id');
    }
    public function template42()
    {
        return $this->belongsTo('App\Models\Template42Model', 'question_id', 'id');
    }
    public function template43()
    {
        return $this->belongsTo('App\Models\Template43Model', 'question_id', 'id');
    }
    public function template44()
    {
        return $this->belongsTo('App\Models\Template44Model', 'question_id', 'id');
    }
    public function template45()
    {
        return $this->belongsTo('App\Models\Template45Model', 'question_id', 'id');
    }
    public function template46()
    {
        return $this->belongsTo('App\Models\Template46Model', 'question_id', 'id');
    }
    public function template47()
    {
        return $this->belongsTo('App\Models\Template47Model', 'question_id', 'id');
    }
    public function template48()
    {
        return $this->belongsTo('App\Models\Template48Model', 'question_id', 'id');
    }
    public function template49()
    {
        return $this->belongsTo('App\Models\Template49Model', 'question_id', 'id');
    }
    public function template50()
    {
        return $this->belongsTo('App\Models\Template50Model', 'question_id', 'id');
    }
}
