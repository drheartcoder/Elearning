<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*use \Dimsav\Translatable\Translatable;*/

class ProgramModel extends Model
{
	/*use Translatable;*/
    protected $table              = "program";
    protected $fillable           = [
                                        'user_id',
                                        'unique_id',
                                        'name',
                                        'slug',
                                        'description',
                                        'subject',
                                        'grade',
                                        'template_id',
                                        'status',
                                        'approve_status'
									];

    public function subjectData()
    {
        return $this->belongsTo('App\Models\SubjectModel', 'subject', 'id');
    }
    public function gradeData()
    {
        return $this->belongsTo('App\Models\GradeModel', 'grade', 'id');
    }
    public function lessonData()
    {
        return $this->hasMany('App\Models\LessonModel', 'program_id', 'id');
    }
    public function programReasonData()
    {
        return $this->hasMany('App\Models\ProgramReasonModel', 'program_id', 'id');
    }
    public function student_assign_program()
    {
        return $this->hasMany('App\Models\StudentProgramQuestionModel', 'program_id', 'id');
    }
    public function template1()
    {
        return $this->hasMany('App\Models\Template1Model', 'program_id', 'id');
    }
    public function template2()
    {
        return $this->hasMany('App\Models\Template2Model', 'program_id', 'id');
    }
    public function template3()
    {
        return $this->hasMany('App\Models\Template3Model', 'program_id', 'id');
    }
    public function template4()
    {
        return $this->hasMany('App\Models\Template4Model', 'program_id', 'id');
    }
    public function template5()
    {
        return $this->hasMany('App\Models\Template5Model', 'program_id', 'id');
    }
    public function template6()
    {
        return $this->hasMany('App\Models\Template6Model', 'program_id', 'id');
    }
    public function template7()
    {
        return $this->hasMany('App\Models\Template7Model', 'program_id', 'id');
    }
    public function template8()
    {
        return $this->hasMany('App\Models\Template8Model', 'program_id', 'id');
    }
    public function template9()
    {
        return $this->hasMany('App\Models\Template9Model', 'program_id', 'id');
    }
    public function template10()
    {
        return $this->hasMany('App\Models\Template10Model', 'program_id', 'id');
    }
    public function template11()
    {
        return $this->hasMany('App\Models\Template11Model', 'program_id', 'id');
    }
    public function template12()
    {
        return $this->hasMany('App\Models\Template12Model', 'program_id', 'id');
    }
    public function template13()
    {
        return $this->hasMany('App\Models\Template13Model', 'program_id', 'id');
    }
    public function template14()
    {
        return $this->hasMany('App\Models\Template14Model', 'program_id', 'id');
    }
    public function template15()
    {
        return $this->hasMany('App\Models\Template15Model', 'program_id', 'id');
    }
    public function template16()
    {
        return $this->hasMany('App\Models\Template16Model', 'program_id', 'id');
    }
    public function template17()
    {
        return $this->hasMany('App\Models\Template17Model', 'program_id', 'id');
    }
    public function template18()
    {
        return $this->hasMany('App\Models\Template18Model', 'program_id', 'id');
    }
    public function template19()
    {
        return $this->hasMany('App\Models\Template19Model', 'program_id', 'id');
    }
    public function template20()
    {
        return $this->hasMany('App\Models\Template20Model', 'program_id', 'id');
    }
    public function template21()
    {
        return $this->hasMany('App\Models\Template21Model', 'program_id', 'id');
    }
    public function template22()
    {
        return $this->hasMany('App\Models\Template22Model', 'program_id', 'id');
    }
    public function template23()
    {
        return $this->hasMany('App\Models\Template23Model', 'program_id', 'id');
    }
    public function template24()
    {
        return $this->hasMany('App\Models\Template24Model', 'program_id', 'id');
    }
    public function template25()
    {
        return $this->hasMany('App\Models\Template25Model', 'program_id', 'id');
    }
    public function template26()
    {
        return $this->hasMany('App\Models\Template26Model', 'program_id', 'id');
    }
    public function template27()
    {
        return $this->hasMany('App\Models\Template27Model', 'program_id', 'id');
    }
    public function template28()
    {
        return $this->hasMany('App\Models\Template28Model', 'program_id', 'id');
    }
    public function template29()
    {
        return $this->hasMany('App\Models\Template29Model', 'program_id', 'id');
    }
    public function template30()
    {
        return $this->hasMany('App\Models\Template30Model', 'program_id', 'id');
    }
    public function template31()
    {
        return $this->hasMany('App\Models\Template31Model', 'program_id', 'id');
    }
    public function template32()
    {
        return $this->hasMany('App\Models\Template32Model', 'program_id', 'id');
    }
    public function template33()
    {
        return $this->hasMany('App\Models\Template33Model', 'program_id', 'id');
    }
    public function template34()
    {
        return $this->hasMany('App\Models\Template34Model', 'program_id', 'id');
    }
    public function template35()
    {
        return $this->hasMany('App\Models\Template35Model', 'program_id', 'id');
    }
    public function template36()
    {
        return $this->hasMany('App\Models\Template36Model', 'program_id', 'id');
    }
    public function template37()
    {
        return $this->hasMany('App\Models\Template37Model', 'program_id', 'id');
    }
    public function template38()
    {
        return $this->hasMany('App\Models\Template38Model', 'program_id', 'id');
    }
    public function template39()
    {
        return $this->hasMany('App\Models\Template39Model', 'program_id', 'id');
    }
    public function template40()
    {
        return $this->hasMany('App\Models\Template40Model', 'program_id', 'id');
    }
    public function template41()
    {
        return $this->hasMany('App\Models\Template41Model', 'program_id', 'id');
    }
    public function template42()
    {
        return $this->hasMany('App\Models\Template42Model', 'program_id', 'id');
    }
    public function template43()
    {
        return $this->hasMany('App\Models\Template43Model', 'program_id', 'id');
    }
    public function template44()
    {
        return $this->hasMany('App\Models\Template44Model', 'program_id', 'id');
    }
    public function template45()
    {
        return $this->hasMany('App\Models\Template45Model', 'program_id', 'id');
    }
    public function template46()
    {
        return $this->hasMany('App\Models\Template46Model', 'program_id', 'id');
    }
    public function template47()
    {
        return $this->hasMany('App\Models\Template47Model', 'program_id', 'id');
    }
    public function template48()
    {
        return $this->hasMany('App\Models\Template48Model', 'program_id', 'id');
    }
    public function template49()
    {
        return $this->hasMany('App\Models\Template49Model', 'program_id', 'id');
    }
    public function template50()
    {
        return $this->hasMany('App\Models\Template50Model', 'program_id', 'id');
    }
}
