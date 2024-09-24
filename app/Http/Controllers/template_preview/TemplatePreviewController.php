<?php

namespace App\Http\Controllers\template_preview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;
use App\Models\ProgramModel;
use App\Models\ProgramQuestionModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\TemplateModel;
use App\Models\LessonModel;
use App\Models\ProgramReasonModel;
use App\Models\TemplatePreview1Model;
use App\Models\TemplatePreview2Model;
use App\Models\TemplatePreview3Model;
use App\Models\TemplatePreview4Model;
use App\Models\TemplatePreview5Model;
use App\Models\TemplatePreview6Model;
use App\Models\TemplatePreview7Model;
use App\Models\TemplatePreview8Model;
use App\Models\TemplatePreview9Model;
use App\Models\TemplatePreview10Model;
use App\Models\TemplatePreview11Model;
use App\Models\TemplatePreview12Model;
use App\Models\TemplatePreview13Model;
use App\Models\TemplatePreview14Model;
use App\Models\TemplatePreview15Model;
use App\Models\TemplatePreview16Model;
use App\Models\TemplatePreview17Model;
use App\Models\TemplatePreview18Model;
use App\Models\TemplatePreview19Model;
use App\Models\TemplatePreview20Model;
use App\Models\TemplatePreview21Model;
use App\Models\TemplatePreview22Model;
use App\Models\TemplatePreview23Model;
use App\Models\TemplatePreview24Model;
use App\Models\TemplatePreview25Model;
use App\Models\TemplatePreview26Model;
use App\Models\TemplatePreview27Model;
use App\Models\TemplatePreview28Model;
use App\Models\TemplatePreview29Model;
use App\Models\TemplatePreview30Model;
use App\Models\TemplatePreview31Model;
use App\Models\TemplatePreview32Model;
use App\Models\TemplatePreview33Model;
use App\Models\TemplatePreview34Model;
use App\Models\TemplatePreview35Model;
use App\Models\TemplatePreview36Model;
use App\Models\TemplatePreview37Model;
use App\Models\TemplatePreview38Model;
use App\Models\TemplatePreview39Model;
use App\Models\TemplatePreview40Model;
use App\Models\TemplatePreview41Model;
use App\Models\TemplatePreview42Model;
use App\Models\TemplatePreview43Model;
use App\Models\TemplatePreview44Model;
use App\Models\TemplatePreview45Model;
use App\Models\TemplatePreview46Model;
use App\Models\TemplatePreview47Model;
use App\Models\TemplatePreview48Model;
use App\Models\TemplatePreview49Model;
use App\Models\TemplatePreview50Model;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
use paginate;
use Image;
use Auth;

class TemplatePreviewController extends Controller
{
    use MultiActionTrait;
	public function __construct(NotificationService $notification_service)
	{
        $this->arr_view_data              = [];
        $this->module_title               = "Program";
        $this->module_icon                = "fa fa-tasks";
        $this->module_view_folder         = "template_preview";
        $this->module_url_path            = url('/');

        $this->creator_module_url_path    = url(config('app.project.creator_panel_slug')."/program");

        $this->LanguageService            = new LanguageService();

        $this->template_js_path           = url('/').'/js/admin/template/';

        $this->NotificationService        = $notification_service;
        $this->auth                       = auth()->guard('creator');
        $this->ProgramModel               = new ProgramModel();
        $this->TemplatePreview1Model      = new TemplatePreview1Model();
        $this->TemplatePreview2Model      = new TemplatePreview2Model();
        $this->TemplatePreview3Model      = new TemplatePreview3Model();
        $this->TemplatePreview4Model      = new TemplatePreview4Model();
        $this->TemplatePreview5Model      = new TemplatePreview5Model();
        $this->TemplatePreview6Model      = new TemplatePreview6Model();
        $this->TemplatePreview7Model      = new TemplatePreview7Model();
        $this->TemplatePreview8Model      = new TemplatePreview8Model();
        $this->TemplatePreview9Model      = new TemplatePreview9Model();
        $this->TemplatePreview10Model     = new TemplatePreview10Model();
        $this->TemplatePreview11Model     = new TemplatePreview11Model();
        $this->TemplatePreview12Model     = new TemplatePreview12Model();
        $this->TemplatePreview13Model     = new TemplatePreview13Model();
        $this->TemplatePreview14Model     = new TemplatePreview14Model();
        $this->TemplatePreview15Model     = new TemplatePreview15Model();
        $this->TemplatePreview16Model     = new TemplatePreview16Model();
        $this->TemplatePreview17Model     = new TemplatePreview17Model();
        $this->TemplatePreview18Model     = new TemplatePreview18Model();
        $this->TemplatePreview19Model     = new TemplatePreview19Model();
        $this->TemplatePreview20Model     = new TemplatePreview20Model();
        $this->TemplatePreview21Model     = new TemplatePreview21Model();
        $this->TemplatePreview22Model     = new TemplatePreview22Model();
        $this->TemplatePreview23Model     = new TemplatePreview23Model();
        $this->TemplatePreview24Model     = new TemplatePreview24Model();
        $this->TemplatePreview25Model     = new TemplatePreview25Model();
        $this->TemplatePreview26Model     = new TemplatePreview26Model();
        $this->TemplatePreview27Model     = new TemplatePreview27Model();
        $this->TemplatePreview28Model     = new TemplatePreview28Model();
        $this->TemplatePreview29Model     = new TemplatePreview29Model();
        $this->TemplatePreview30Model     = new TemplatePreview30Model();
        $this->TemplatePreview31Model     = new TemplatePreview31Model();
        $this->TemplatePreview32Model     = new TemplatePreview32Model();
        $this->TemplatePreview33Model     = new TemplatePreview33Model();
        $this->TemplatePreview34Model     = new TemplatePreview34Model();
        $this->TemplatePreview35Model     = new TemplatePreview35Model();
        $this->TemplatePreview36Model     = new TemplatePreview36Model();
        $this->TemplatePreview37Model     = new TemplatePreview37Model();
        $this->TemplatePreview38Model     = new TemplatePreview38Model();
        $this->TemplatePreview39Model     = new TemplatePreview39Model();
        $this->TemplatePreview40Model     = new TemplatePreview40Model();
        $this->TemplatePreview41Model     = new TemplatePreview41Model();
        $this->TemplatePreview42Model     = new TemplatePreview42Model();
        $this->TemplatePreview43Model     = new TemplatePreview43Model();
        $this->TemplatePreview44Model     = new TemplatePreview44Model();
        $this->TemplatePreview45Model     = new TemplatePreview45Model();
        $this->TemplatePreview46Model     = new TemplatePreview46Model();
        $this->TemplatePreview47Model     = new TemplatePreview47Model();
        $this->TemplatePreview48Model     = new TemplatePreview48Model();
        $this->TemplatePreview49Model     = new TemplatePreview49Model();
        $this->TemplatePreview50Model     = new TemplatePreview50Model();

        $this->template_base_img_path     = base_path().config('app.project.img_path.template_image');
        $this->template_public_img_path   = url('/').config('app.project.img_path.template_image');
        $this->default_base_img_path      = base_path().config('app.project.img_path.default_image');
        $this->default_public_img_path    = url('/').config('app.project.img_path.default_image');
     
        $this->question_image_base_path   = base_path().config('app.project.img_path.question_image');
        $this->question_image_public_path = url('/').config('app.project.img_path.question_image');

        $this->question_image_thumb_base_path   = base_path().config('app.project.img_path.question_image_thumb');
        $this->question_image_thumb_public_path = url('/').config('app.project.img_path.question_image_thumb');
     
        $this->question_video_base_path   = base_path().config('app.project.img_path.question_video');
        $this->question_video_public_path = url('/').config('app.project.img_path.question_video');
        $this->question_audio_base_path   = base_path().config('app.project.img_path.question_audio');
        $this->question_audio_public_path = url('/').config('app.project.img_path.question_audio');
	}

/*    public function template_preview(Request $request)
    {
        dd($request->all());
        $this->arr_view_data['page_title']           = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['supervisor_panel_slug']= $this->supervisor_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }*/
    public function template_preview($enc_id='',Request $request)
    {
        $resp = $template_data = [];
        $resp['status'] = 'fail';
        $created_by = Session('loggedinId');
        
        if($enc_id=='' && ($created_by!=false && $created_by!=null))
        {
            return json_encode([
                        'errors' => 'hiddenTemplate',
                        'code'   => 422,
                        'status' => 'fail',
                    ]);
        }

        if($request->input('hiddenTemplate')==null || $request->input('hiddenTemplate')=='')
        {
            return json_encode([
                                'errors' => 'hiddenTemplate',
                                'code'   => 422,
                                'status' => 'error',
                            ]);
        }
        
        $programId  = base64_decode($enc_id);
        $templateId = $request->input('hiddenTemplate');
        $moduleName = 'TemplatePreview'.$templateId.'Model';
        
        /* Delete Previous Question : 1*/
        $this->questionDelete($programId,$templateId,$created_by);

        /*TEMPLATE : 1*/
        if($request->input('hiddenTemplate')==1)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['fileType']  = 'required';
            if($request->input('fileType')=='image')
            {
                $arr_rules['imgFile'] = 'required';
            }
            else if($request->input('fileType')=='video')
            {
                $arr_rules['vdoFile'] = 'required';
            }
            $arr_rules['question'] = 'required';
            $arr_rules['flHorn']   = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code'   => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('imgFile'))
            {
                $fileName      = $request->file('imgFile');
                $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName   = date('dmY').time().'.'.$fileExtension;
                    $imageThumb = Image::make($request->file('imgFile'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                    
                    $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'imgFile',
                        'code'   => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('vdoFile'))
            {
                $fileName      = $request->file('vdoFile');
                $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp4']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'vdoFile',
                        'code'   => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName      = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code'   => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id']    = $programId;
            $arr_data['created_by']    = $created_by;
            $arr_data['question']      = trim($request->input('direction'));
            $arr_data['file_type']     = trim($request->input('fileType'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['duration']      = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /*TEMPLATE : 2*/
        else if($request->input('hiddenTemplate')==2)
        {
            /*dump($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['fileType'] = 'required';
            if($request->input('fileType')=='image')
            {
                $arr_rules['imgFile'] = 'required';
            }
            else if($request->input('fileType')=='video')
            {
                $arr_rules['vdoFile'] = 'required';
            }
            $arr_rules['question'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('blankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            
            if(!$request->input('chkBlankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            $strAns = '';
            if(count($request->input('blankLetter')) > 0)
            {
                foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                {
                    if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                    {
                        $strAns.=0;
                    }
                    else
                    {
                        $strAns.=1;
                    }
                }
            }
            if($strAns=='')
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            else
            {
                $arr_data['answer_position'] = $strAns;
            }

            if($request->hasFile('imgFile'))
            {
                $fileName = $request->file('imgFile');
                $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;

                    $imageThumb = Image::make($request->file('imgFile'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'imgFile',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('vdoFile'))
            {
                $fileName = $request->file('vdoFile');
                $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp4']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'vdoFile',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['file_type'] = trim($request->input('fileType'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));

            $result = $this->$moduleName->create($arr_data);

        }
        /*TEMPLATE : 3*/
        else if($request->input('hiddenTemplate')==3)
        {   
            $arr_rules['direction'] = 'required';
            $arr_rules['answer'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);

            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                    ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['jpg','jpeg','png']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['jpg','jpeg','png']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id']      = $programId;
            $arr_data['created_by']      = $created_by;
            $arr_data['question']        = trim($request->input('direction'));
            $arr_data['answer']          = trim(strtoupper($request->input('answer')));
            $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
            $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
            $arr_data['duration']        = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /*TEMPLATE : 4*/
        else if($request->input('hiddenTemplate')==4)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['answer'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question3'] = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['jpg','jpeg','png']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['jpg','jpeg','png']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = $request->file('flQuestion3')->getClientOriginalExtension();
                if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);   
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['answer']     = trim(ucwords($request->input('answer')));
            $arr_data['question_1_text'] = trim(ucwords($request->input('question1')));
            $arr_data['question_2_text'] = trim(ucwords($request->input('question2')));
            $arr_data['question_3_text'] = trim(ucwords($request->input('question3')));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 5 */
        else if($request->input('hiddenTemplate')==5)
        {
            /*dd($request->all());*/
            $arr_rules['fileType'] = 'required';
            if($request->input('fileType')=='image')
            {
                $arr_rules['imgFile'] = 'required';
            }
            else if($request->input('fileType')=='video')
            {
                $arr_rules['vdoFile'] = 'required';
            }
            $arr_rules['direction'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['rdoOption'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('imgFile'))
            {
                $fileName = $request->file('imgFile');
                $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;

                    $imageThumb = Image::make($request->file('imgFile'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'imgFile',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('vdoFile'))
            {
                $fileName = $request->file('vdoFile');
                $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp4']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'vdoFile',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['file_type'] = trim($request->input('fileType'));
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['option1'] = trim(ucwords($request->input('option1')));
            $arr_data['option2'] = trim(ucwords($request->input('option2')));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 6 */
        else if($request->input('hiddenTemplate')==6)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['rdoOption'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion'))
            {
                $fileName = $request->file('flQuestion');
                $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp4']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;
                    $isUpload = $request->file('flQuestion')->move($this->question_video_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['option1'] = trim($request->input('option1'));
            $arr_data['option2'] = trim($request->input('option2'));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 7 */
        else if($request->input('hiddenTemplate')==7)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['flQuestion5'] = 'required';
            $arr_rules['answer5'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(210,210);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(210,210);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(210,210);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(210,210);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(210,210);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            $arr_data['answer3'] = trim($request->input('answer3'));
            $arr_data['answer4'] = trim($request->input('answer4'));
            $arr_data['answer5'] = trim($request->input('answer5'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 8 */
        else if($request->input('hiddenTemplate')==8)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['question_2_text'] = trim($request->input('question2'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 9 */
        else if($request->input('hiddenTemplate')==9)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['option3'] = 'required';
            $arr_rules['option4'] = 'required';
            $arr_rules['rdoOption'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['option1'] = trim($request->input('option1'));
            $arr_data['option2'] = trim($request->input('option2'));
            $arr_data['option3'] = trim($request->input('option3'));
            $arr_data['option4'] = trim($request->input('option4'));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 10 */
        else if($request->input('hiddenTemplate')==10)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion'] = 'required';
            $arr_rules['question'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['rdoOption'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion'))
            {
                $fileName = $request->file('flQuestion');
                $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['option1'] = trim($request->input('option1'));
            $arr_data['option2'] = trim($request->input('option2'));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 11 */
        else if($request->input('hiddenTemplate')==11)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(270,270);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            $arr_data['answer3'] = trim($request->input('answer3'));
            $arr_data['answer4'] = trim($request->input('answer4'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 12 */
        else if($request->input('hiddenTemplate')==12)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['flHorn'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer1'] = trim(strtoupper($request->input('answer1')));
            $arr_data['answer2'] = trim(strtoupper($request->input('answer2')));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 13 */
        else if($request->input('hiddenTemplate')==13)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['flQuestion5'] = 'required';
            $arr_rules['answer5'] = 'required';
            $arr_rules['flQuestion6'] = 'required';
            $arr_rules['answer6'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion6'))
            {
                $fileName = $request->file('flQuestion6');
                $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'6.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion6'));
                    $imageThumb->resize(165,165);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_6_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            $arr_data['answer3'] = trim($request->input('answer3'));
            $arr_data['answer4'] = trim($request->input('answer4'));
            $arr_data['answer5'] = trim($request->input('answer5'));
            $arr_data['answer6'] = trim($request->input('answer6'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 14 */
        else if($request->input('hiddenTemplate')==14)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['flQuestion5'] = 'required';
            $arr_rules['answer5'] = 'required';
            $arr_rules['flQuestion6'] = 'required';
            $arr_rules['answer6'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion6'))
            {
                $fileName = $request->file('flQuestion6');
                $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'6.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion6'));
                    $imageThumb->resize(200,138);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_6_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['answer1']    = trim($request->input('answer1'));
            $arr_data['answer2']    = trim($request->input('answer2'));
            $arr_data['answer3']    = trim($request->input('answer3'));
            $arr_data['answer4']    = trim($request->input('answer4'));
            $arr_data['answer5']    = trim($request->input('answer5'));
            $arr_data['answer6']    = trim($request->input('answer6'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 15 */
        else if($request->input('hiddenTemplate')==15)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';

            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['rdoQuestion1'] = 'required';

            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['rdoQuestion2'] = 'required';

            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('rdoQuestion1Text'))
            {
                return json_encode([
                        'errors' => 'rdoQuestion1Text',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            
            if(!$request->input('rdoQuestion2Text'))
            {
                return json_encode([
                        'errors' => 'rdoQuestion2Text',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
            $strQuestion_1_answer_position = $question_1_answer = '';
            if($request->input('rdoQuestion1Text'))
            {
                if(count($request->input('rdoQuestion1Text')) > 0)
                {
                    foreach ($request->input('rdoQuestion1Text') as $rdoQuestion1TextKey=>$rdoQuestion1TextVal)
                    {
                        if($rdoQuestion1TextKey==$request->input('rdoQuestion1'))
                        {
                            $question_1_answer = $rdoQuestion1TextVal;
                            $strQuestion_1_answer_position.=0;
                        }
                        else
                        {
                            $strQuestion_1_answer_position.=1;
                        }
                    }
                }
            }
            $arr_data['question_1_answer'] = $question_1_answer;
            $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;

            $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
            $strQuestion_2_answer_position = $question_2_answer = '';
            if($request->input('rdoQuestion2Text'))
            {
                if(count($request->input('rdoQuestion2Text')) > 0)
                {
                    foreach ($request->input('rdoQuestion2Text') as $rdoQuestion2TextKey=>$rdoQuestion2TextVal)
                    {
                        if($rdoQuestion2TextKey==$request->input('rdoQuestion2'))
                        {
                            $question_2_answer = $rdoQuestion2TextVal;
                            $strQuestion_2_answer_position.=0;
                        }
                        else
                        {
                            $strQuestion_2_answer_position.=1;
                        }
                    }
                }
            }
            $arr_data['question_2_answer'] = $question_2_answer;
            $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;

            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 16 */
        else if($request->input('hiddenTemplate')==16)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['question_2_text'] = trim($request->input('question2'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 17 */
        else if($request->input('hiddenTemplate')==17)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['option1_1'] = 'required';
            $arr_rules['option1_2'] = 'required';
            $arr_rules['option1_3'] = 'required';
            $arr_rules['rdoOption1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['option2_1'] = 'required';
            $arr_rules['option2_2'] = 'required';
            $arr_rules['option2_3'] = 'required';
            $arr_rules['rdoOption2'] = 'required';
            $arr_rules['flHorn'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $arr_data['question_1_option1'] = trim($request->input('option1_1'));
            $arr_data['question_1_option2'] = trim($request->input('option1_2'));
            $arr_data['question_1_option3'] = trim($request->input('option1_3'));
            $arr_data['question_1_answer'] = $request->input('rdoOption1');
            $arr_data['question_2_text'] = trim($request->input('question2'));
            $arr_data['question_2_option1'] = trim($request->input('option2_1'));
            $arr_data['question_2_option2'] = trim($request->input('option2_2'));
            $arr_data['question_2_option3'] = trim($request->input('option2_3'));
            $arr_data['question_2_answer'] = $request->input('rdoOption2');
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 18 */
        else if($request->input('hiddenTemplate')==18)
        {
            /*dump($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['flQuestion5'] = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['flQuestion6'] = 'required';
            $arr_rules['question6']   = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('blankLetter1'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter1'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter2'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter2'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter3'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter3'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter4'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter4'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter5'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter5'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter6'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter6'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion6'))
            {
                $fileName = $request->file('flQuestion6');
                $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'6.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion6'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_6_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $strQuestion_1_answer_position = $question_1_answer = '';
            $arrChkBlankLetter1 = [];
            if($request->input('chkBlankLetter1'))
            {
                if(count($request->input('chkBlankLetter1')) > 0)
                {
                    $arrChkBlankLetter1 = $request->input('chkBlankLetter1');
                }     
            }
            if($request->input('blankLetter1'))
            {
                if(count($request->input('blankLetter1')) > 0)
                {
                    foreach ($request->input('blankLetter1') as $blankLetter1Key=>$blankLetter1Val)
                    {
                        if(in_array($blankLetter1Key, $arrChkBlankLetter1))
                        {
                            $question_1_answer.=$blankLetter1Val;
                            $strQuestion_1_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_1_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_1_answer'] = $question_1_answer;
            $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;

            $arr_data['question_2_text'] = trim($request->input('question2'));
            $strQuestion_2_answer_position = $question_2_answer = '';
            $arrChkBlankLetter2 = [];
            if($request->input('chkBlankLetter2'))
            {
                if(count($request->input('chkBlankLetter2')) > 0)
                {
                    $arrChkBlankLetter2 = $request->input('chkBlankLetter2');
                }     
            }
            if($request->input('blankLetter2'))
            {
                if(count($request->input('blankLetter2')) > 0)
                {
                    foreach ($request->input('blankLetter2') as $blankLetter2Key=>$blankLetter2Val)
                    {
                        if(in_array($blankLetter2Key, $arrChkBlankLetter2))
                        {
                            $question_2_answer.=$blankLetter2Val;
                            $strQuestion_2_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_2_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_2_answer'] = $question_2_answer;
            $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;

            $arr_data['question_3_text'] = trim($request->input('question3'));
            $strQuestion_3_answer_position = $question_3_answer = '';
            $arrChkBlankLetter3 = [];
            if($request->input('chkBlankLetter3'))
            {
                if(count($request->input('chkBlankLetter3')) > 0)
                {
                    $arrChkBlankLetter3 = $request->input('chkBlankLetter3');
                }     
            }
            if($request->input('blankLetter3'))
            {
                if(count($request->input('blankLetter3')) > 0)
                {
                    foreach ($request->input('blankLetter3') as $blankLetter3Key=>$blankLetter3Val)
                    {
                        if(in_array($blankLetter3Key, $arrChkBlankLetter3))
                        {
                            $question_3_answer.=$blankLetter3Val;
                            $strQuestion_3_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_3_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_3_answer'] = $question_3_answer;
            $arr_data['question_3_answer_position'] = $strQuestion_3_answer_position;

            $arr_data['question_4_text'] = trim($request->input('question4'));
            $strQuestion_4_answer_position = $question_4_answer = '';
            $arrChkBlankLetter4 = [];
            if($request->input('chkBlankLetter4'))
            {
                if(count($request->input('chkBlankLetter4')) > 0)
                {
                    $arrChkBlankLetter4 = $request->input('chkBlankLetter4');
                }     
            }
            if($request->input('blankLetter4'))
            {
                if(count($request->input('blankLetter4')) > 0)
                {
                    foreach ($request->input('blankLetter4') as $blankLetter4Key=>$blankLetter4Val)
                    {
                        if(in_array($blankLetter4Key, $arrChkBlankLetter4))
                        {
                            $question_4_answer.=$blankLetter4Val;
                            $strQuestion_4_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_4_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_4_answer'] = $question_4_answer;
            $arr_data['question_4_answer_position'] = $strQuestion_4_answer_position;

            $arr_data['question_5_text'] = trim($request->input('question5'));
            $strQuestion_5_answer_position = $question_5_answer = '';
            $arrChkBlankLetter5 = [];
            if($request->input('chkBlankLetter5'))
            {
                if(count($request->input('chkBlankLetter5')) > 0)
                {
                    $arrChkBlankLetter5 = $request->input('chkBlankLetter5');
                }     
            }
            if($request->input('blankLetter5'))
            {
                if(count($request->input('blankLetter5')) > 0)
                {
                    foreach ($request->input('blankLetter5') as $blankLetter5Key=>$blankLetter5Val)
                    {
                        if(in_array($blankLetter5Key, $arrChkBlankLetter5))
                        {
                            $question_5_answer.=$blankLetter5Val;
                            $strQuestion_5_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_5_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_5_answer'] = $question_5_answer;
            $arr_data['question_5_answer_position'] = $strQuestion_5_answer_position;

            $arr_data['question_6_text'] = trim($request->input('question6'));
            $strQuestion_6_answer_position = $question_6_answer = '';
            $arrChkBlankLetter6 = [];
            if($request->input('chkBlankLetter6'))
            {
                if(count($request->input('chkBlankLetter6')) > 0)
                {
                    $arrChkBlankLetter6 = $request->input('chkBlankLetter6');
                }     
            }
            if($request->input('blankLetter6'))
            {
                if(count($request->input('blankLetter6')) > 0)
                {
                    foreach ($request->input('blankLetter6') as $blankLetter6Key=>$blankLetter6Val)
                    {
                        if(in_array($blankLetter6Key, $arrChkBlankLetter6))
                        {
                            $question_6_answer.=$blankLetter6Val;
                            $strQuestion_6_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_6_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_6_answer'] = $question_6_answer;
            $arr_data['question_6_answer_position'] = $strQuestion_6_answer_position;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 19 */
        else if($request->input('hiddenTemplate')==19)
        {
            /*dump($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['answer2']   = 'required';
            $arr_rules['flQuestion3'] = 'required';
            $arr_rules['answer3']   = 'required';
            $arr_rules['flQuestion4'] = 'required';
            $arr_rules['answer4']   = 'required';
            $arr_rules['flQuestion5'] = 'required';
            $arr_rules['answer5']   = 'required';
            $arr_rules['flQuestion6'] = 'required';
            $arr_rules['answer6']   = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']      = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion6'))
            {
                $fileName = $request->file('flQuestion6');
                $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'6.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion6'));
                    $imageThumb->resize(185,121);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_6_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_answer'] = trim($request->input('answer1'));
            $arr_data['question_2_answer'] = trim($request->input('answer2'));
            $arr_data['question_3_answer'] = trim($request->input('answer3'));
            $arr_data['question_4_answer'] = trim($request->input('answer4'));
            $arr_data['question_5_answer'] = trim($request->input('answer5'));
            $arr_data['question_6_answer'] = trim($request->input('answer6'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 20 */
        else if($request->input('hiddenTemplate')==20)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['option1_1']   = 'required';
            $arr_rules['option1_2']   = 'required';
            $arr_rules['option1_3']   = 'required';
            $arr_rules['rdoOption1']   = 'required';
            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['option2_1']   = 'required';
            $arr_rules['option2_2']   = 'required';
            $arr_rules['option2_3']   = 'required';
            $arr_rules['rdoOption2']   = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']      = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_option1'] = trim($request->input('option1_1'));
            $arr_data['question_1_option2'] = trim($request->input('option1_2'));
            $arr_data['question_1_option3'] = trim($request->input('option1_3'));
            $arr_data['question_1_answer']  = trim($request->input('rdoOption1'));
            $arr_data['question_2_option1'] = trim($request->input('option2_1'));
            $arr_data['question_2_option2'] = trim($request->input('option2_2'));
            $arr_data['question_2_option3'] = trim($request->input('option2_3'));
            $arr_data['question_2_answer']  = trim($request->input('rdoOption2'));
            $arr_data['duration']           = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 21 */
        else if($request->input('hiddenTemplate')==21)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']   = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']   = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']   = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['answer5']   = 'required';
            $arr_rules['question6']   = 'required';
            $arr_rules['answer6']   = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']      = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3'] = trim($request->input('answer3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4'] = trim($request->input('answer4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5'] = trim($request->input('answer5'));
            $arr_data['question_6'] = trim($request->input('question6'));
            $arr_data['answer_6'] = trim($request->input('answer6'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 22 */
        else if($request->input('hiddenTemplate')==22)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('answer2'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 23 */
        else if($request->input('hiddenTemplate')==23)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['flHorn']     = 'required';
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 24 */
        else if($request->input('hiddenTemplate')==24)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']     = 'required';
            /*$arr_rules['question5']   = 'required';
            $arr_rules['answer5']     = 'required';
            $arr_rules['question6']   = 'required';
            $arr_rules['answer6']     = 'required';
            $arr_rules['question7']   = 'required';
            $arr_rules['answer7']     = 'required';
            $arr_rules['question8']   = 'required';
            $arr_rules['answer8']     = 'required';*/
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('answer3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4']   = trim($request->input('answer4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5']   = trim($request->input('answer5'));
            $arr_data['question_6'] = trim($request->input('question6'));
            $arr_data['answer_6']   = trim($request->input('answer6'));
            $arr_data['question_7'] = trim($request->input('question7'));
            $arr_data['answer_7']   = trim($request->input('answer7'));
            $arr_data['question_8'] = trim($request->input('question8'));
            $arr_data['answer_8']   = trim($request->input('answer8'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 25 */
        else if($request->input('hiddenTemplate')==25)
        {
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion']  = 'required';
            $arr_rules['question']    = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion'))
            {
                $fileName = $request->file('flQuestion');
                $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp4']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;
                    $isUpload = $request->file('flQuestion')->move($this->question_video_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 26 */
        else if($request->input('hiddenTemplate')==26)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['option1_1'] = 'required';
            $arr_rules['option1_2'] = 'required';
            $arr_rules['option1_3'] = 'required';
            $arr_rules['rdoOption1']= 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['option2_1'] = 'required';
            $arr_rules['option2_2'] = 'required';
            $arr_rules['option2_3'] = 'required';
            $arr_rules['rdoOption2']= 'required';
            $arr_rules['question3'] = 'required';
            $arr_rules['option3_1'] = 'required';
            $arr_rules['option3_2'] = 'required';
            $arr_rules['option3_3'] = 'required';
            $arr_rules['rdoOption3']= 'required';
            $arr_rules['flHorn']    = 'required';
            $arr_rules['duration']  = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            $arr_data['program_id']           = $programId;
            $arr_data['created_by']           = $created_by;
            $arr_data['question']             = trim($request->input('direction'));
            $arr_data['question_1_text']      = trim($request->input('question1'));
            $arr_data['question_1_option1']   = trim($request->input('option1_1'));
            $arr_data['question_1_option2']   = trim($request->input('option1_2'));
            $arr_data['question_1_option3']   = trim($request->input('option1_3'));
            $arr_data['question_1_answer']    = $request->input('rdoOption1');
            $arr_data['question_2_text']      = trim($request->input('question2'));
            $arr_data['question_2_option1']   = trim($request->input('option2_1'));
            $arr_data['question_2_option2']   = trim($request->input('option2_2'));
            $arr_data['question_2_option3']   = trim($request->input('option2_3'));
            $arr_data['question_2_answer']    = $request->input('rdoOption2');
            $arr_data['question_3_text']      = trim($request->input('question3'));
            $arr_data['question_3_option1']   = trim($request->input('option3_1'));
            $arr_data['question_3_option2']   = trim($request->input('option3_2'));
            $arr_data['question_3_option3']   = trim($request->input('option3_3'));
            $arr_data['question_3_answer']    = $request->input('rdoOption3');
            $arr_data['duration']             = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 27 */
        else if($request->input('hiddenTemplate')==27)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('answer3'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 28 */
        else if($request->input('hiddenTemplate')==28)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['rdoOption1']  = 'required';
/*            $arr_rules['question2']   = 'required';
            $arr_rules['rdoOption2']  = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['rdoOption3']  = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['rdoOption4']  = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['rdoOption5']  = 'required';*/
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('rdoOption1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('rdoOption2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('rdoOption3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4']   = trim($request->input('rdoOption4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5']   = trim($request->input('rdoOption5'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 29 */
        else if($request->input('hiddenTemplate')==29)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['answer']      = 'required|max:1';
            $arr_rules['question1']   = 'required';
            /*$arr_rules['question2']   = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['question5']   = 'required';*/
            $arr_rules['flHorn']      = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer']       = trim($request->input('answer'));
            $arr_data['question_1']   = trim($request->input('question1'));
            $arr_data['question_2']   = trim($request->input('question2'));
            $arr_data['question_3']   = trim($request->input('question3'));
            $arr_data['question_4']   = trim($request->input('question4'));
            $arr_data['question_5']   = trim($request->input('question5'));
            $arr_data['duration']     = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 30 */
        else if($request->input('hiddenTemplate')==30)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']     = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['answer5']     = 'required';
            /*$arr_rules['flHorn']      = 'required';*/
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            if(trim($request->input('question2'))!=''){
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
            }
            if(trim($request->input('question3'))!=''){
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
            }
            if(trim($request->input('question4'))!=''){
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('answer4'));
            }
            if(trim($request->input('question5'))!=''){
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('answer5'));
            }
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 31 */
        else if($request->input('hiddenTemplate')==31)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['answer']     = 'required';
            $arr_rules['flHorn']     = 'required';
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['answer']     = trim($request->input('answer'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 32 */
        else if($request->input('hiddenTemplate')==32)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['answer']     = 'required';
            $arr_rules['flHorn']     = 'required';
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['answer']     = trim($request->input('answer'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 33 */
        else if($request->input('hiddenTemplate')==33)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';

/*            $arr_rules['digit2_1']   = 'required';
            $arr_rules['operator2']  = 'required';
            $arr_rules['digit2_2']   = 'required';
            $arr_rules['answer2']    = 'required';

            $arr_rules['digit3_1']   = 'required';
            $arr_rules['operator3']  = 'required';
            $arr_rules['digit3_2']   = 'required';
            $arr_rules['answer3']    = 'required';

            $arr_rules['digit4_1']   = 'required';
            $arr_rules['operator4']  = 'required';
            $arr_rules['digit4_2']   = 'required';
            $arr_rules['answer4']    = 'required';

            $arr_rules['digit5_1']   = 'required';
            $arr_rules['operator5']  = 'required';
            $arr_rules['digit5_2']   = 'required';
            $arr_rules['answer5']    = 'required';

            $arr_rules['digit6_1']   = 'required';
            $arr_rules['operator6']  = 'required';
            $arr_rules['digit6_2']   = 'required';
            $arr_rules['answer6']    = 'required';

            $arr_rules['digit7_1']   = 'required';
            $arr_rules['operator7']  = 'required';
            $arr_rules['digit7_2']   = 'required';
            $arr_rules['answer7']    = 'required';

            $arr_rules['digit8_1']   = 'required';
            $arr_rules['operator8']  = 'required';
            $arr_rules['digit8_2']   = 'required';
            $arr_rules['answer8']    = 'required';

            $arr_rules['digit9_1']   = 'required';
            $arr_rules['operator9']  = 'required';
            $arr_rules['digit9_2']   = 'required';
            $arr_rules['answer9']    = 'required';

            $arr_rules['digit10_1']  = 'required';
            $arr_rules['operator10'] = 'required';
            $arr_rules['digit10_2']  = 'required';
            $arr_rules['answer10']   = 'required';

            $arr_rules['digit11_1']  = 'required';
            $arr_rules['operator11'] = 'required';
            $arr_rules['digit11_2']  = 'required';
            $arr_rules['answer11']   = 'required';

            $arr_rules['digit12_1']  = 'required';
            $arr_rules['operator12'] = 'required';
            $arr_rules['digit12_2']  = 'required';
            $arr_rules['answer12']   = 'required';
            $arr_rules['duration']   = 'required';*/
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            
            if($request->input('digit1_1')!='')
            {
                $arr_data['digit1_1']   = trim($request->input('digit1_1'));
                $arr_data['operator1']  = trim($request->input('operator1'));
                $arr_data['digit1_2']   = trim($request->input('digit1_2'));
                $arr_data['answer1']    = trim($request->input('answer1'));
            }

            if($request->input('digit2_1')!='')
            {
                $arr_data['digit2_1']   = trim($request->input('digit2_1'));
                $arr_data['operator2']  = trim($request->input('operator2'));
                $arr_data['digit2_2']   = trim($request->input('digit2_2'));
                $arr_data['answer2']    = trim($request->input('answer2'));
            }

            if($request->input('digit3_1')!='')
            {
                $arr_data['digit3_1']   = trim($request->input('digit3_1'));
                $arr_data['operator3']  = trim($request->input('operator3'));
                $arr_data['digit3_2']   = trim($request->input('digit3_2'));
                $arr_data['answer3']    = trim($request->input('answer3'));
            }
            
            if($request->input('digit4_1')!='')
            {
                $arr_data['digit4_1']   = trim($request->input('digit4_1'));
                $arr_data['operator4']  = trim($request->input('operator4'));
                $arr_data['digit4_2']   = trim($request->input('digit4_2'));
                $arr_data['answer4']    = trim($request->input('answer4'));
            }

            if($request->input('digit5_1')!='')
            {
                $arr_data['digit5_1']   = trim($request->input('digit5_1'));
                $arr_data['operator5']  = trim($request->input('operator5'));
                $arr_data['digit5_2']   = trim($request->input('digit5_2'));
                $arr_data['answer5']    = trim($request->input('answer5'));
            }

            if($request->input('digit6_1')!='')
            {
                $arr_data['digit6_1']   = trim($request->input('digit6_1'));
                $arr_data['operator6']  = trim($request->input('operator6'));
                $arr_data['digit6_2']   = trim($request->input('digit6_2'));
                $arr_data['answer6']    = trim($request->input('answer6'));
            }

            if($request->input('digit7_1')!='')
            {
                $arr_data['digit7_1']   = trim($request->input('digit7_1'));
                $arr_data['operator7']  = trim($request->input('operator7'));
                $arr_data['digit7_2']   = trim($request->input('digit7_2'));
                $arr_data['answer7']    = trim($request->input('answer7'));
            }

            if($request->input('digit8_1')!='')
            {
                $arr_data['digit8_1']   = trim($request->input('digit8_1'));
                $arr_data['operator8']  = trim($request->input('operator8'));
                $arr_data['digit8_2']   = trim($request->input('digit8_2'));
                $arr_data['answer8']    = trim($request->input('answer8'));
            }

            if($request->input('digit9_1')!='')
            {
                $arr_data['digit9_1']   = trim($request->input('digit9_1'));
                $arr_data['operator9']  = trim($request->input('operator9'));
                $arr_data['digit9_2']   = trim($request->input('digit9_2'));
                $arr_data['answer9']    = trim($request->input('answer9'));
            }

            if($request->input('digit10_1')!='')
            {
                $arr_data['digit10_1']  = trim($request->input('digit10_1'));
                $arr_data['operator10'] = trim($request->input('operator10'));
                $arr_data['digit10_2']  = trim($request->input('digit10_2'));
                $arr_data['answer10']   = trim($request->input('answer10'));
            }

            if($request->input('digit11_1')!='')
            {
                $arr_data['digit11_1']  = trim($request->input('digit11_1'));
                $arr_data['operator11'] = trim($request->input('operator11'));
                $arr_data['digit11_2']  = trim($request->input('digit11_2'));
                $arr_data['answer11']   = trim($request->input('answer11'));
            }            

            if($request->input('digit12_1')!='')
            {            
                $arr_data['digit12_1']  = trim($request->input('digit12_1'));
                $arr_data['operator12'] = trim($request->input('operator12'));
                $arr_data['digit12_2']  = trim($request->input('digit12_2'));
                $arr_data['answer12']   = trim($request->input('answer12'));
            }
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 34 */
        else if($request->input('hiddenTemplate')==34)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['flQuestion'] = 'required';
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']   = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion'))
            {
                $fileName = $request->file('flQuestion');
                $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion'));
                    $imageThumb->resize(583,560);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['digit1_1']   = trim($request->input('digit1_1'));
            $arr_data['operator1']  = trim($request->input('operator1'));
            $arr_data['digit1_2']   = trim($request->input('digit1_2'));
            $arr_data['answer1']    = trim($request->input('answer1'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 35 */
        else if($request->input('hiddenTemplate')==35)
        {
            /*dd($request->all());*/
            /*dd($request->all());*/
            $arr_rules['direction']        = 'required';
            $arr_rules['flQuestion1']      = 'required';
            
            $arr_rules['digit1_1']         = 'required';
            $arr_rules['operator1']        = 'required';
            $arr_rules['digit1_2']         = 'required';
            $arr_rules['answer1']          = 'required';
            $arr_rules['chkBlankLetter_1'] = 'required';

/*            $arr_rules['digit2_1']         = 'required';
            $arr_rules['operator2']        = 'required';
            $arr_rules['digit2_2']         = 'required';
            $arr_rules['answer2']          = 'required';
            $arr_rules['chkBlankLetter_2'] = 'required';

            $arr_rules['digit3_1']         = 'required';
            $arr_rules['operator3']        = 'required';
            $arr_rules['digit3_2']         = 'required';
            $arr_rules['answer3']          = 'required';
            $arr_rules['chkBlankLetter_3'] = 'required';

            $arr_rules['digit4_1']         = 'required';
            $arr_rules['operator4']        = 'required';
            $arr_rules['digit4_2']         = 'required';
            $arr_rules['answer4']          = 'required';
            $arr_rules['chkBlankLetter_4'] = 'required';

            $arr_rules['digit5_1']         = 'required';
            $arr_rules['operator5']        = 'required';
            $arr_rules['digit5_2']         = 'required';
            $arr_rules['answer5']          = 'required';
            $arr_rules['chkBlankLetter_5'] = 'required';*/

            $arr_rules['duration']         = 'required';
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
                        if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion5'))
            {
                $fileName = $request->file('flQuestion5');
                $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'5.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion5'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_5_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $answer1Position = null;
            if($request->input('chkBlankLetter_1'))
            {
                if(count($request->input('chkBlankLetter_1')) > 0)
                {
                    for ($i=1; $i <= 3; $i++)
                    { 
                        if(in_array($i, $request->input('chkBlankLetter_1')))
                        {
                            $answer1Position.='0';   
                        }
                        else
                        {
                            $answer1Position.='1';
                        }
                    }
                }
            }
            $arr_data['answer1Position'] = $answer1Position;

                        $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $answer1Position = null;
            if($request->input('chkBlankLetter_1'))
            {
                if(count($request->input('chkBlankLetter_1')) > 0)
                {
                    for ($i=1; $i <= 3; $i++)
                    { 
                        if(in_array($i, $request->input('chkBlankLetter_1')))
                        {
                            $answer1Position.='0';   
                        }
                        else
                        {
                            $answer1Position.='1';
                        }
                    }
                }
            }
            $arr_data['answer1Position'] = $answer1Position;

            if($request->has('digit2_1') && $request->input('digit2_1')!=''){
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                $arr_data['operator2'] = trim($request->input('operator2'));
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
                $answer2Position = null;
                if($request->input('chkBlankLetter_2'))
                {
                    if(count($request->input('chkBlankLetter_2')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_2')))
                            {
                                $answer2Position.='0';   
                            }
                            else
                            {
                                $answer2Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer2Position'] = $answer2Position;
            }

            if($request->has('digit3_1') && $request->input('digit3_1')!=''){
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                $arr_data['operator3'] = trim($request->input('operator3'));
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                $arr_data['answer3'] = trim($request->input('answer3'));
                $answer3Position = null;
                if($request->input('chkBlankLetter_3'))
                {
                    if(count($request->input('chkBlankLetter_3')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_3')))
                            {
                                $answer3Position.='0';   
                            }
                            else
                            {
                                $answer3Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer3Position'] = $answer3Position;
            }
            
            if($request->has('digit4_1') && $request->input('digit4_1')!=''){
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
                $arr_data['operator4'] = trim($request->input('operator4'));
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
                $arr_data['answer4'] = trim($request->input('answer4'));
                $answer4Position = null;
                if($request->input('chkBlankLetter_4'))
                {
                    if(count($request->input('chkBlankLetter_4')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_4')))
                            {
                                $answer4Position.='0';   
                            }
                            else
                            {
                                $answer4Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer4Position'] = $answer4Position;
            }
            
            if($request->has('digit5_1') && $request->input('digit5_1')!=''){
                $arr_data['digit5_1'] = trim($request->input('digit5_1'));
                $arr_data['operator5'] = trim($request->input('operator5'));
                $arr_data['digit5_2'] = trim($request->input('digit5_2'));
                $arr_data['answer5'] = trim($request->input('answer5'));
                $answer5Position = null;
                if($request->input('chkBlankLetter_5'))
                {
                    if(count($request->input('chkBlankLetter_5')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_5')))
                            {
                                $answer5Position.='0';   
                            }
                            else
                            {
                                $answer5Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer5Position'] = $answer5Position;
            }
            
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 36 */
        else if($request->input('hiddenTemplate')==36)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['answer']      = 'required';
            $arr_rules['duration']    = 'required';
            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer'] = trim($request->input('answer'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 37 */
        else if($request->input('hiddenTemplate')==37)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';

            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']    = 'required';

            if($request->hasFile('flQuestion2'))
            {
                $arr_rules['flQuestion2'] = 'required';
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';                
            }
            if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
            {
                $arr_rules['flQuestion2'] = 'required';
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';                   
            }

            if($request->hasFile('flQuestion3'))
            {
                $arr_rules['flQuestion3'] = 'required';
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';                
            }
            if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
            {
                $arr_rules['flQuestion3'] = 'required';
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';                   
            }

            if($request->hasFile('flQuestion4'))
            {
                $arr_rules['flQuestion4'] = 'required';
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';                
            }
            if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
            {
                $arr_rules['flQuestion4'] = 'required';
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';                   
            }

            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(504,67);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(504,67);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion3'))
            {
                $fileName = $request->file('flQuestion3');
                $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'3.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion3'));
                    $imageThumb->resize(504,67);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_3_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion4'))
            {
                $fileName = $request->file('flQuestion4');
                $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'4.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion4'));
                    $imageThumb->resize(504,67);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_4_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            if($request->input('digit2_1'))
            {
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
            }
            if($request->input('operator2'))
            {
                $arr_data['operator2'] = trim($request->input('operator2'));
            }
            if($request->input('digit2_2'))
            {
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
            }
            if($request->input('answer2'))
            {
                $arr_data['answer2'] = trim($request->input('answer2'));
            }

            if($request->input('digit3_1'))
            {
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
            }
            if($request->input('operator3'))
            {
                $arr_data['operator3'] = trim($request->input('operator3'));
            }
            if($request->input('digit3_2'))
            {
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
            }
            if($request->input('answer3'))
            {
                $arr_data['answer3'] = trim($request->input('answer3'));
            }

            if($request->input('digit4_1'))
            {
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
            }
            if($request->input('operator4'))
            {
                $arr_data['operator4'] = trim($request->input('operator4'));
            }
            if($request->input('digit4_2'))
            {
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
            }
            if($request->input('answer4'))
            {
                $arr_data['answer4'] = trim($request->input('answer4'));
            }

            $result = $this->$moduleName->create($arr_data);
            
        }
        /* Template : 38 */
        else if($request->input('hiddenTemplate')==38)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(498,384);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $question2 = null;
            if($request->input('question2'))
            {
                $question2 = $request->input('question2');
            }
            $arr_data['question_2'] = $question2;
            $answer2 = null;
            if($request->input('answer2'))
            {
                $answer2 = $request->input('answer2');
            }
            $arr_data['answer_2'] = $answer2;
            $question3 = null;
            if($request->input('question3'))
            {
                $question3 = $request->input('question3');    
            }
            $arr_data['question_3'] = $question3;
            $answer3 = null;
            if($request->input('answer3'))
            {
                $answer3 = $request->input('answer3');
            }
            $arr_data['answer_3'] = $answer3;
            $question4 = null;
            if($request->input('question4'))
            {
                $question4 = $request->input('question4');
            }
            $arr_data['question_4'] = $question4;
            $answer4 = null;
            if($request->input('answer4'))
            {
                $answer4 = $request->input('answer4');
            }
            $arr_data['answer_4'] = $answer4;
            
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 39 */
        else if($request->input('hiddenTemplate')==39)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';

            if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
            {
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';
            }

            if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
            {
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';
            }


            if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
            {
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';
            }

            if($request->input('digit5_1') || $request->input('operator5') || $request->input('digit5_2') || $request->input('answer5'))
            {
                $arr_rules['digit5_1']   = 'required';
                $arr_rules['operator5']  = 'required';
                $arr_rules['digit5_2']   = 'required';
                $arr_rules['answer5']    = 'required';
            }

            if($request->input('digit6_1') || $request->input('operator6') || $request->input('digit6_2') || $request->input('answer6'))
            {
                $arr_rules['digit6_1']   = 'required';
                $arr_rules['operator6']  = 'required';
                $arr_rules['digit6_2']   = 'required';
                $arr_rules['answer6']    = 'required';
            }
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));

            if($request->input('digit2_1'))
            {
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                $arr_data['operator2'] = trim($request->input('operator2'));
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
            }

            if($request->input('digit3_1'))
            {
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                $arr_data['operator3'] = trim($request->input('operator3'));
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                $arr_data['answer3'] = trim($request->input('answer3'));
            }
            if($request->input('digit4_1'))
            {
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
            }
            if($request->input('operator4'))
            {
                $arr_data['operator4'] = trim($request->input('operator4'));
            }
            if($request->input('digit4_2'))
            {
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
            }
            if($request->input('answer4'))
            {
                $arr_data['answer4'] = trim($request->input('answer4'));
            }

            if($request->input('digit5_1'))
            {
                $arr_data['digit5_1'] = trim($request->input('digit5_1'));
            }
            if($request->input('operator5'))
            {
                $arr_data['operator5'] = trim($request->input('operator5'));
            }
            if($request->input('digit5_2'))
            {
                $arr_data['digit5_2'] = trim($request->input('digit5_2'));
            }
            if($request->input('answer5'))
            {
                $arr_data['answer5'] = trim($request->input('answer5'));
            }

            if($request->input('digit6_1'))
            {
                $arr_data['digit6_1'] = trim($request->input('digit6_1'));
            }
            if($request->input('operator6'))
            {
                $arr_data['operator6'] = trim($request->input('operator6'));
            }
            if($request->input('digit6_2'))
            {
                $arr_data['digit6_2'] = trim($request->input('digit6_2'));
            }
            if($request->input('answer6'))
            {
                $arr_data['answer6'] = trim($request->input('answer6'));
            }

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 40 */
        else if($request->input('hiddenTemplate')==40)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['duration']   = 'required';
            
            $arr_rules['question1_1']   = 'required';
            $arr_rules['question1_2']   = 'required';
            $arr_rules['operator1']   = 'required';

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1',''));
            $arr_data['question1_2'] = trim($request->input('question1_2',''));
            $arr_data['answer_1'] = trim($request->input('operator1',''));
            
            $arr_data['question2_1'] = trim($request->input('question2_1',''));
            $arr_data['question2_2'] = trim($request->input('question2_2',''));
            $arr_data['answer_2'] = trim($request->input('operator2',''));

            $arr_data['question3_1'] = trim($request->input('question3_1',''));
            $arr_data['question3_2'] = trim($request->input('question3_2',''));
            $arr_data['answer_3'] = trim($request->input('operator3',''));

            $arr_data['question4_1'] = trim($request->input('question4_1',''));
            $arr_data['question4_2'] = trim($request->input('question4_2',''));
            $arr_data['answer_4'] = trim($request->input('operator4',''));

            $arr_data['question5_1'] = trim($request->input('question5_1',''));
            $arr_data['question5_2'] = trim($request->input('question5_2',''));
            $arr_data['answer_5'] = trim($request->input('operator5',''));
            
            $arr_data['question6_1'] = trim($request->input('question6_1',''));
            $arr_data['question6_2'] = trim($request->input('question6_2',''));
            $arr_data['answer_6']    = trim($request->input('operator6',''));
            $arr_data['duration']    = gmdate('H:i:s', $request->input('duration',''));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 41 */
        else if($request->input('hiddenTemplate')==41)
        {
            /*dd($request->all());*/
            $arr_rules['direction']     = 'required';
            
            $arr_rules['question1_1']   = 'required';
            $arr_rules['question1_2']   = 'required';
            $arr_rules['operator1']     = 'required';

            $arr_rules['duration']      = 'required';

            if($request->input('question4_1') || $request->input('question4_2') || $request->input('operator4'))
            {
                $arr_rules['question4_1']   = 'required';
                $arr_rules['question4_2']   = 'required';
                $arr_rules['operator4']     = 'required';
            }

            if($request->input('question5_1') || $request->input('question5_2') || $request->input('operator5'))
            {
                $arr_rules['question5_1']   = 'required';
                $arr_rules['question5_2']   = 'required';
                $arr_rules['operator5']     = 'required';
            }

            if($request->input('question6_1') || $request->input('question6_2') || $request->input('operator6'))
            {
                $arr_rules['question6_1']   = 'required';
                $arr_rules['question6_2']   = 'required';
                $arr_rules['operator6']     = 'required';
            }

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1',''));
            $arr_data['question1_2'] = trim($request->input('question1_2',''));
            $arr_data['answer_1'] = trim($request->input('operator1',''));
            
            $arr_data['question2_1'] = trim($request->input('question2_1',''));
            $arr_data['question2_2'] = trim($request->input('question2_2',''));
            $arr_data['answer_2'] = trim($request->input('operator2',''));

            $arr_data['question3_1'] = trim($request->input('question3_1',''));
            $arr_data['question3_2'] = trim($request->input('question3_2',''));
            $arr_data['answer_3'] = trim($request->input('operator3',''));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration',''));
            $question4_1 = null;
            if($request->input('question4_1'))
            {
                $question4_1 = $request->input('question4_1');
            }
            $arr_data['question4_1'] = $question4_1;
            $question4_2 = null;
            if($request->input('question4_2'))
            {
                $question4_2 = $request->input('question4_2');
            }
            $arr_data['question4_2'] = $question4_2;
            $operator4 = null;
            if($request->input('operator4'))
            {
                $operator4 = $request->input('operator4');
            }
            $arr_data['answer_4'] = $operator4;

            $question5_1 = null;
            if($request->input('question5_1'))
            {
                $question5_1 = $request->input('question5_1');
            }
            $arr_data['question5_1'] = $question5_1;
            $question5_2 = null;
            if($request->input('question5_2'))
            {
                $question5_2 = $request->input('question5_2');
            }
            $arr_data['question5_2'] = $question5_2;
            $operator5 = null;
            if($request->input('operator5'))
            {
                $operator5 = $request->input('operator5');
            }
            $arr_data['answer_5'] = $operator5;
            
            $question6_1 = null;
            if($request->input('question6_1'))
            {
                $question6_1 = $request->input('question6_1');
            }
            $arr_data['question6_1'] = $question6_1;
            $question6_2 = null;
            if($request->input('question6_2'))
            {
                $question6_2 = $request->input('question6_2');
            }
            $arr_data['question6_2'] = $question6_2;
            $operator6 = null;
            if($request->input('operator6'))
            {
                $operator6 = $request->input('operator6');
            }
            $arr_data['answer_6'] = $operator6;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 42 */
        else if($request->input('hiddenTemplate')==42)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            
            $arr_rules['question1_1']   = 'required';
            $arr_rules['answer1_1']   = 'required';
            $arr_rules['answer1_2']   = 'required';

            if($request->input('question4_1') || $request->input('answer4_1') || $request->input('answer4_2'))
            {
                $arr_rules['question4_1']   = 'required';
                $arr_rules['answer4_1']   = 'required';
                $arr_rules['answer4_2']   = 'required';
            }

            if($request->input('question5_1') || $request->input('answer5_1') || $request->input('answer5_2'))
            {
                $arr_rules['question5_1']   = 'required';
                $arr_rules['answer5_1']   = 'required';
                $arr_rules['answer5_2']   = 'required';
            }

            if($request->input('question6_1') || $request->input('answer6_1') || $request->input('answer6_2'))
            {
                $arr_rules['question6_1']   = 'required';
                $arr_rules['answer6_1']   = 'required';
                $arr_rules['answer6_2']   = 'required';
            }

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1'] = trim($request->input('question1_1',''));
            $arr_data['answer1'] = trim($request->input('answer1_1','')).','.trim($request->input('answer1_2',''));

            $arr_data['question2'] = trim($request->input('question2_1',''));
            $arr_data['answer2'] = trim($request->input('answer2_1','')).','.trim($request->input('answer2_2',''));
            
            $arr_data['question3'] = trim($request->input('question3_1',''));
            $arr_data['answer3'] = trim($request->input('answer3_1','')).','.trim($request->input('answer3_2',''));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration',''));
            $question4 = null;
            if($request->input('question4_1'))
            {
                $question4 = $request->input('question4_1');
            }
            $arr_data['question4'] = $question4;
            $answer4 = null;
            if($request->input('answer4_1') && $request->input('answer4_2'))
            {
                $answer4 = $request->input('answer4_1').','.$request->input('answer4_2');
            }
            $arr_data['answer4'] = $answer4;
            
            $question5 = null;
            if($request->input('question5_1'))
            {
                $question5 = $request->input('question5_1');
            }
            $arr_data['question5'] = $question5;
            $answer5 = null;
            if($request->input('answer5_1') && $request->input('answer5_2'))
            {
                $answer5 = $request->input('answer5_1').','.$request->input('answer5_2');
            }
            $arr_data['answer5'] = $answer5;

            $question6 = null;
            if($request->input('question6_1'))
            {
                $question6 = $request->input('question6_1');
            }
            $arr_data['question6'] = $question6;
            $answer6 = null;
            if($request->input('answer6_1') && $request->input('answer6_2'))
            {
                $answer6 = $request->input('answer6_1').','.$request->input('answer6_2');
            }
            $arr_data['answer6'] = $answer6;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 43 */
        else if($request->input('hiddenTemplate')==43)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion'] = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']      = 'required';
         /*   $arr_rules['question2']   = 'required';
            $arr_rules['answer2']      = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']      = 'required';*/
            $arr_rules['duration']      = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion'))
            {
                $fileName = $request->file('flQuestion');
                $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion'));
                    $imageThumb->resize(570,540);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3'] = trim($request->input('answer3'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
         /* Template : 34 */
        else if($request->input('hiddenTemplate')==44)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['row']        = 'required';
            $arr_rules['column']     = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']    = 'required';
            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['table_from'] = trim($request->input('row'));
            $arr_data['table_to'] = trim($request->input('column'));
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 45 */
        else if($request->input('hiddenTemplate')==45)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1_1']   = 'required';
            $arr_rules['answer1_1']      = 'required';
            /*$arr_rules['question1_2']   = 'required';
            $arr_rules['answer1_2']      = 'required';
            $arr_rules['question1_3']   = 'required';
            $arr_rules['answer1_3']      = 'required';*/

            $arr_rules['flQuestion2'] = 'required';
            $arr_rules['question2_1']   = 'required';
            $arr_rules['answer2_1']      = 'required';
            /*$arr_rules['question2_2']   = 'required';
            $arr_rules['answer2_2']      = 'required';
            $arr_rules['question2_3']   = 'required';
            $arr_rules['answer2_3']      = 'required';*/
            $arr_rules['duration']      = 'required';

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(429,269);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_1_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            if($request->hasFile('flQuestion2'))
            {
                $fileName = $request->file('flQuestion2');
                $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'2.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion2'));
                    $imageThumb->resize(429,269);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_2_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1'));
            $arr_data['answer1_1'] = trim($request->input('answer1_1'));
            $arr_data['question1_2'] = trim($request->input('question1_2'));
            $arr_data['answer1_2'] = trim($request->input('answer1_2'));
            $arr_data['question1_3'] = trim($request->input('question1_3'));
            $arr_data['answer1_3'] = trim($request->input('answer1_3'));

            $arr_data['question2_1'] = trim($request->input('question2_1'));
            $arr_data['answer2_1'] = trim($request->input('answer2_1'));
            $arr_data['question2_2'] = trim($request->input('question2_2'));
            $arr_data['answer2_2'] = trim($request->input('answer2_2'));
            $arr_data['question2_3'] = trim($request->input('question2_3'));
            $arr_data['answer2_3'] = trim($request->input('answer2_3'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 46 */
        else if($request->input('hiddenTemplate')==46)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['flQuestion1'] = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $request->file('flQuestion1');
                $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                if(in_array($fileExtension, ['png','jpg','jpeg']))
                {
                    $fileName = date('dmY').time().'1.'.$fileExtension;

                    $imageThumb = Image::make($request->file('flQuestion1'));
                    $imageThumb->resize(570,442);
                    $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                    $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['question_file'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flQuestion1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction',''));
            $arr_data['question_1'] = trim($request->input('question1',''));
            $arr_data['answer_1'] = trim($request->input('answer1',''));
            $arr_data['question_2'] = trim($request->input('question2',''));
            $arr_data['answer_2'] = trim($request->input('answer2',''));
            $arr_data['question_3'] = trim($request->input('question3',''));
            $arr_data['answer_3'] = trim($request->input('answer3',''));
            $arr_data['question_4'] = trim($request->input('question4',''));
            $arr_data['answer_4'] = trim($request->input('answer4',''));
            $arr_data['question_5'] = trim($request->input('question5',''));
            $arr_data['answer_5'] = trim($request->input('answer5',''));
            $arr_data['question_6'] = trim($request->input('question6',''));
            $arr_data['answer_6'] = trim($request->input('answer6',''));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 47 */
        else if($request->input('hiddenTemplate')==47)
        {
            /*dump($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('question'))
            {
                return json_encode([
                        'errors' => 'question',
                        'code' => 422,
                        'status' => 'question',
                    ]);
            }
            if(!$request->input('chkBlankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'chkBlankLetter',
                    ]);
            }


            $strQuestionText = $strAnswerText = '';
            if($request->input('question'))
            {
                if(count($request->input('question')) > 0)
                {
                    $arrCnt = 1;
                    foreach ($request->input('question') as $questionVal)
                    {
                        if($request->input('chkBlankLetter'))
                        {
                            if(count($request->input('chkBlankLetter')) > 0)
                            {
                                if(in_array($arrCnt, $request->input('chkBlankLetter')))
                                {
                                    $strAnswerText.='0'.',';
                                }
                                else
                                {
                                    $strAnswerText.='1'.',';
                                }
                            }
                        }
                        else
                        {
                            $strAnswerText.='1'.',';
                        }
                        $strQuestionText.=$questionVal.',';
                        $arrCnt++;
                    }
                }   
            }
            $strQuestionText = rtrim($strQuestionText, ',');
            $strAnswerText   = rtrim($strAnswerText, ',');

            $arr_data['program_id']    = $programId;
            $arr_data['created_by']    = $created_by;
            $arr_data['question']      = trim($request->input('direction'));
            $arr_data['question_text'] = $strQuestionText;
            $arr_data['answer']        = $strAnswerText;
            $arr_data['duration']      = gmdate('H:i:s', $request->input('duration'));
            /*dd($arr_data);*/
            $result = $this->$moduleName->create($arr_data);

        }
        /* TEMPLATE : 48 */
        else if($request->input('hiddenTemplate')==48)
        {
            /*dump($request->all());
            dd('TEMPLATE2');*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question'] = 'required';
            $arr_rules['duration'] = 'required';
            /*$arr_rules['flHorn'] = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('blankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            
            if(!$request->input('chkBlankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            $strAns = '';
            if(count($request->input('blankLetter')) > 0)
            {
                foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                {
                    if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                    {
                        $strAns.=0;
                    }
                    else
                    {
                        $strAns.=1;
                    }
                }
            }
            if($strAns=='')
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            else
            {
                $arr_data['answer_position'] = $strAns;
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 49 */
        else if($request->input('hiddenTemplate')==49)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['option_1']   = 'required';
            $arr_rules['rdoOption']   = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['option_1'] = trim($request->input('option_1',''));
            $arr_data['option_2'] = trim($request->input('option_2',''));
            $arr_data['option_3'] = trim($request->input('option_3',''));
            $arr_data['option_4'] = trim($request->input('option_4',''));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 50 */
        else if($request->input('hiddenTemplate')==50)
        {

            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['option_1']   = 'required';
            $arr_rules['rdoOption1']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/
            $arr_rules['duration']      = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = date('H:i', strtotime($request->input('question1')));
            $arr_data['question_2'] = date('H:i', strtotime($request->input('question2')));
            $arr_data['option_1'] = trim($request->input('option_1',''));
            $arr_data['option_2'] = trim($request->input('option_2',''));
            $arr_data['option_3'] = trim($request->input('option_3',''));
            $arr_data['option_4'] = trim($request->input('option_4',''));
            $arr_data['answer'] = trim($request->input('rdoOption1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        if($result)
        {
            $questionId = $result->id;
            $arr_question = [];
            $arr_question = $this->$moduleName->where('id', '=', $questionId)->first();
            if(count($arr_question) > 0)
            {
                $arr_question = $arr_question->toArray();
                $this->template_data['arr_question'] = $arr_question;
                $this->template_data['default_base_img_path']     = $this->default_base_img_path;
                $this->template_data['default_public_img_path']   = $this->default_public_img_path;
                $this->template_data['template_base_img_path']    = $this->template_base_img_path;
                $this->template_data['template_public_img_path']  = $this->template_public_img_path;

                $this->template_data['question_image_base_path']  = $this->question_image_base_path;
                $this->template_data['question_image_public_path']= $this->question_image_public_path;
                $this->template_data['question_video_base_path']  = $this->question_video_base_path;
                $this->template_data['question_video_public_path']= $this->question_video_public_path;
                $this->template_data['question_audio_base_path']  = $this->question_audio_base_path;
                $this->template_data['question_audio_public_path']= $this->question_audio_public_path;
            }

            $resp['status'] = 'success';
            $view = view($this->module_view_folder.'.template_'.$templateId,$this->template_data);
            $resp['view'] = $view->render();
        }
        return response()->json($resp);
    }

    public function questionDelete($programId,$templateId,$created_by)
    {
        $questionDelete = false;
        if($programId!='' && $templateId!='' && $created_by!='' )
        {
            $modelName = 'TemplatePreview'.$templateId.'Model';
            /* Template : 1 */
            if($templateId == 1)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'lesson_id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->where('created_by', '=', $created_by)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                                
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }           
                        }
                    }
                }
            }
            /* Template : 2 */
            else if($templateId == 2)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }           
                        }
                    }
                }
            }
            /* Template : 3 */
            else if($templateId == 3)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }       
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 4 */
            else if($templateId == 4)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 5 */
            else if($templateId == 5)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 6 */
            else if($templateId == 6)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 7 */
            else if($templateId == 7)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 8 */
            else if($templateId == 8)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 9)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 10 */
            else if($templateId == 10)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 11 */
            else if($templateId == 11)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file'/*, 'horn'*/)->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 12 */
            else if($templateId == 12)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 13 */
            else if($templateId == 13)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 14 */
            else if($templateId == 14)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 15 */
            else if($templateId == 15)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 16 */
            else if($templateId == 16)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 17)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 18 */
            else if($templateId == 18)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 19 */
            else if($templateId == 19)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 20 */
            else if($templateId == 20)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 21 */
            else if($templateId == 21)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 22 */
            else if($templateId == 22)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 23 */
            else if($templateId == 23)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 24 */
            else if($templateId == 24)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 25 */
            else if($templateId == 25)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 26 */
            else if($templateId == 26)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 27 */
            else if($templateId == 27)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 28 */
            else if($templateId == 28)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 29 */
            else if($templateId == 29)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 30 */
            else if($templateId == 30)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 31 */
            else if($templateId == 31)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 32 */
            else if($templateId == 32)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 33 */
            else if($templateId == 33)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 34 */
            else if($templateId == 34)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 35 */
            else if($templateId == 35)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 36 */
            else if($templateId == 36)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 37 */
            else if($templateId == 37)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 38 */
            else if($templateId == 38)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 39 */
            else if($templateId == 39)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 40 */
            else if($templateId == 40)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 41 */
            else if($templateId == 41)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 42 */
            else if($templateId == 42)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 43 */
            else if($templateId == 43)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 44 */
            else if($templateId == 44)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 45 */
            else if($templateId == 45)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 46 */
            else if($templateId == 46)
            {

                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            else if($templateId == 47)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }         
            /* Template : 48 */
            else if($templateId == 48)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 49 */
            else if($templateId == 49)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 50 */
            else if($templateId == 50)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
        }
        return $questionDelete;
    } 
    public function edit_template_preview($enc_id='',Request $request)
    {
       
        $resp = $template_data = $arrQuestion = $arr_data = [];
        $resp['status'] = 'fail';
        $created_by = Session('loggedinId');
        
        if($enc_id=='' && ($created_by!=false && $created_by!=null))
        {
            return json_encode([
                        'errors' => 'templateId',
                        'code'   => 422,
                        'status' => 'fail',
                    ]);
        }

        if($request->input('templateId')==null || $request->input('templateId')=='')
        {
            return json_encode([
                                'errors' => 'templateId',
                                'code'   => 422,
                                'status' => 'error',
                            ]);
        }
        $questionId = $request->input('questionId');
        $programId  = base64_decode($enc_id);
        $templateId = $request->input('templateId');
        $moduleName = 'TemplatePreview'.$templateId.'Model';
    
        /* Delete Previous Question : 1*/
        $this->questionDelete($programId,$templateId,$created_by);
        $arrQuestion = DB::table('template_'.$templateId)->where('id', '=', $questionId)->first();

        /*TEMPLATE : 1*/
        if($request->input('templateId')==1)
        {
          
            $isUpload = 0;
            $arr_rules['direction'] = 'required';
            $arr_rules['fileType'] = 'required';
            $arr_rules['question'] = 'required';
            /*$arr_rules['duration'] = 'required';*/


            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                  return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            //upload & copy code of image
            if($request->hasFile('imgFile'))
            {
                $fileName = $this->uploadFile($request->file('imgFile'),570,442);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->file) && $arrQuestion->file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->file);
                        }
                    }
                    $arr_data['file'] = $fileName;
                }
            }
            else
            {   
                $fileType = $request->input('fileType','');
                if(isset($fileType) && $fileType=='image')
                {
                    $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                    $newfileName      = $this->copyFile($old_file_name,'image');
                    if(isset($newfileName) && $newfileName!=false)
                    {
                         $arr_data['file'] = $newfileName;
                    }
                   
                }
            }
             //upload & copy code of video
            if($request->hasFile('vdoFile'))
            {
                $videoName = $this->uploadVideoFile($request->file('vdoFile'));
                if(isset($videoName) && $videoName!=false)
                {
                    if(isset($arrQuestion->file) && $arrQuestion->file!='')
                    {
                        if(file_exists($this->question_video_base_path.$arrQuestion->file))
                        {
                            @unlink($this->question_video_base_path.$arrQuestion->file);
                        }
                    }
                    $arr_data['file'] = $videoName;
                }
            }
            else
            {   
                $fileType = $request->input('fileType','');
                if(isset($fileType) && $fileType=='video')
                {
                    $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                    $newfileName      = $this->copyFile($old_file_name,$arrQuestion->file_type);
                    if(isset($newfileName) && $newfileName!=false)
                    {
                         $arr_data['file'] = $newfileName;
                    }
                }
               
            }
             //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']      = $programId;
            $arr_data['created_by']      = $created_by;
            $arr_data['question']        = trim($request->input('direction'));
            $arr_data['file_type']       = trim($request->input('fileType'));
            $arr_data['question_text']   = trim($request->input('question'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }

            $result = $this->$moduleName->create($arr_data);
           
        
        }
        /*TEMPLATE : 2*/
        else if($request->input('templateId')==2)
        {
                $isUpload = 0;
                $arr_rules['direction'] = 'required';
                $arr_rules['fileType'] = 'required';
                $arr_rules['question'] = 'required';   
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                     return json_encode([
                                'errors' => 'invalid',
                                'code' => 422,
                                'status' => 'fail',
                            ]);
                } 

                if(!$request->input('blankLetter'))
                {
                    return json_encode([
                                'errors' => 'blankLetter',
                                'code' => 422,
                                'status' => 'fail',
                            ]);
                }
                
                if(!$request->input('chkBlankLetter'))
                {
                    return json_encode([
                                'errors' => 'chkBlankLetter',
                                'code' => 422,
                                'status' => 'fail',
                            ]);
                }

                $strAns = '';
                if(count($request->input('blankLetter')) > 0)
                {
                    foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                    {
                        if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                        {
                            $strAns.=0;
                        }
                        else
                        {
                            $strAns.=1;
                        }
                    }
                }
                if($strAns=='')
                {
                    return json_encode([
                            'errors' => 'chkBlankLetter',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                }
                else
                {
                    $arr_data['answer_position'] = $strAns;
                }
                //upload & copy code of image
                if($request->hasFile('imgFile'))
                {
                    $fileName = $this->uploadFile($request->file('imgFile'),570,442);
                    if(isset($fileName) && $fileName!=false)
                    {
                        if(isset($arrQuestion->file) && $arrQuestion->file!='')
                        {
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion->file))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion->file);
                            }
                        }
                        $arr_data['file'] = $fileName;
                    }
                }
                else
                {   
                    $fileType = $request->input('fileType','');
                    if(isset($fileType) && $fileType=='image')
                    {
                        $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                        $newfileName      = $this->copyFile($old_file_name,'image');
                        if(isset($newfileName) && $newfileName!=false)
                        {
                             $arr_data['file'] = $newfileName;
                        }
                       
                    }
                }
                 //upload & copy code of video
                if($request->hasFile('vdoFile'))
                {
                    $videoName = $this->uploadVideoFile($request->file('vdoFile'));
                    if(isset($videoName) && $videoName!=false)
                    {
                        if(isset($arrQuestion->file) && $arrQuestion->file!='')
                        {
                            if(file_exists($this->question_video_base_path.$arrQuestion->file))
                            {
                                @unlink($this->question_video_base_path.$arrQuestion->file);
                            }
                        }
                        $arr_data['file'] = $videoName;
                    }
                }
                else
                {   
                    $fileType = $request->input('fileType','');
                    if(isset($fileType) && $fileType=='video')
                    {
                        $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                        $newfileName      = $this->copyFile($old_file_name,$arrQuestion->file_type);
                        if(isset($newfileName) && $newfileName!=false)
                        {
                             $arr_data['file'] = $newfileName;
                        }
                    }
                   
                }
                //upload & copy code of audio
                if($request->hasFile('flHorn'))
                {
                    $fileName = $this->uploadAudioFile($request->file('flHorn'));
                    if(isset($fileName) && $fileName!=false)
                    {
                        $arr_data['horn'] = $fileName;
                        if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                        {
                            if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                            {
                                @unlink($this->question_audio_base_path.$arrQuestion->horn);
                            }
                        }
                    }
                }
                else
                {   
                    $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                    $newfileName      = $this->copyFile($old_file_name,'audio');
                    if(isset($newfileName) && $newfileName!=false)
                    {
                         $arr_data['horn'] = $newfileName;
                    }
                }

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                $arr_data['program_id']    = $programId;
                $arr_data['created_by']    = $created_by;
                $arr_data['question']      = trim($request->input('direction'));
                $arr_data['file_type']     = trim($request->input('fileType'));
                $arr_data['question_text'] = trim($request->input('question'));

                $result = $this->$moduleName->create($arr_data);

        }
        /*TEMPLATE : 3*/
        else if($request->input('templateId')==3)
        {   
            $arr_rules['direction'] = 'required';
            $arr_rules['answer'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['question2'] = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);

            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                    ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    /*if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }*/
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
         
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName2 = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName2) && $flQuestion2_fileName2!=false)
                {
                   /* if(isset($arrQuestion->question_2_file) && $arrQuestion->question_2_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_2_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_2_file);
                        }
                    }*/
                    $arr_data['question_2_file'] = $flQuestion2_fileName2;
                }

            }
            else
            {   
                $flQuestion2_old_file_name2    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_newfileName2      = $this->copyFile($flQuestion2_old_file_name2,'image');
                if(isset($flQuestion2_newfileName2) && $flQuestion2_newfileName2!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_newfileName2;
                }

            }
           
            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;

            $arr_data['question']        = trim($request->input('direction'));
            $arr_data['answer']          = trim(strtoupper($request->input('answer')));
            $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
            $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /*TEMPLATE : 4*/
        else if($request->input('templateId')==4)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['answer']    = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['question3'] = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),270,270);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }


            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),270,270);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file_name    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';

                $fileExtension    = explode(".", $flQuestion2_old_file_name);
                $extension        = isset($fileExtension[1])?$fileExtension[1]:$ext;
                $newfileName      = date('dmY').time().'2'.'.'.$extension;
                $old_question2_file_path    = $this->question_image_thumb_base_path.$flQuestion2_old_file_name;
                if(file_exists($old_question2_file_path))
                {
                    $new_question2_file_path    = $this->question_image_thumb_base_path.$newfileName;
                    copy($old_question2_file_path,$new_question2_file_path);
                    $arr_data['question_2_file'] =  $newfileName;
                } 
                    

            }
            //flQuestion3
              if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),270,270);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file_name    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';

                $fileExtension    = explode(".", $flQuestion3_old_file_name);
                $extension        = isset($fileExtension[1])?$fileExtension[1]:$ext;
                $newfileName      = date('dmY').time().'3'.'.'.$extension;
                $old_question3_file_path    = $this->question_image_thumb_base_path.$flQuestion3_old_file_name;
                if(file_exists($old_question3_file_path))
                {
                    $new_question3_file_path    = $this->question_image_thumb_base_path.$newfileName;
                    copy($old_question3_file_path,$new_question3_file_path);
                    $arr_data['question_3_file'] =  $newfileName;
                } 
            }
            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }
            $arr_data['program_id']      = $programId;
            $arr_data['created_by']      = $created_by;
            $arr_data['question']        = trim($request->input('direction'));
            $arr_data['answer']          = trim(ucwords($request->input('answer')));
            $arr_data['question_1_text'] = trim(ucwords($request->input('question1')));
            $arr_data['question_2_text'] = trim(ucwords($request->input('question2')));
            $arr_data['question_3_text'] = trim(ucwords($request->input('question3')));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s',$request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 5 */
        else if($request->input('templateId')==5)
        {
            /*dd($request->all());*/
            $isUpload = 0;
            $arr_rules['fileType'] = 'required';
            $arr_rules['direction'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['rdoOption'] = 'required';

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
             //upload & copy code of image
            if($request->hasFile('imgFile'))
            {
                $fileName = $this->uploadFile($request->file('imgFile'),570,442);
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['file'] = $fileName;
                }
            }
            else
            {   
                $fileType = $request->input('fileType','');
                if(isset($fileType) && $fileType=='image')
                {
                    $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                    $newfileName      = $this->copyFile($old_file_name,'image');
                    if(isset($newfileName) && $newfileName!=false)
                    {
                         $arr_data['file'] = $newfileName;
                    }
                   
                }
            }
             //upload & copy code of video
            if($request->hasFile('vdoFile'))
            {
                $videoName = $this->uploadVideoFile($request->file('vdoFile'));
                if(isset($videoName) && $videoName!=false)
                {
                   
                    $arr_data['file'] = $videoName;
                }
            }
            else
            {   
                $fileType = $request->input('fileType','');
                if(isset($fileType) && $fileType=='video')
                {
                    $old_file_name    = isset($arrQuestion->file)?$arrQuestion->file:'';
                    $newfileName      = $this->copyFile($old_file_name,$arrQuestion->file_type);
                    if(isset($newfileName) && $newfileName!=false)
                    {
                         $arr_data['file'] = $newfileName;
                    }
                }
               
            }
             //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['file_type'] = trim($request->input('fileType'));
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['option1'] = trim(ucwords($request->input('option1')));
            $arr_data['option2'] = trim(ucwords($request->input('option2')));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 6 */
        else if($request->input('templateId')==6)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['rdoOption'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion'))
            {
                $fileName = $this->uploadVideoFile($request->file('flQuestion'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {   
              
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $newfileName      = $this->copyFile($old_file_name,'video');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_file'] = $newfileName;
                }
              
            }
           
             if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['option1'] = trim($request->input('option1'));
            $arr_data['option2'] = trim($request->input('option2'));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 7 */
        else if($request->input('templateId')==7)
        {

            $arr_rules['direction'] = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['answer2']   = 'required';
            $arr_rules['answer3']   = 'required';
            $arr_rules['answer4']   = 'required';
            $arr_rules['answer5']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),210,210);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),210,210);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),210,210);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),210,210);
                 if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }
            if($request->hasFile('flQuestion5'))
            {
                $flQuestion5_fileName = $this->uploadFile($request->file('flQuestion5'),210,210);
                 if(isset($flQuestion5_fileName) && $flQuestion5_fileName!=false)
                {
                    $arr_data['question_5_file'] = $flQuestion5_fileName;
                }
            }
            else
            {
                $flQuestion5_old_file    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $flQuestion5_new_file    = $this->copyFile($flQuestion5_old_file,'image');
                if(isset($flQuestion5_old_file) && $flQuestion5_old_file!=false)
                {
                     $arr_data['question_5_file'] = $flQuestion5_new_file;
                }   
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }


            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer1']      = trim($request->input('answer1'));
            $arr_data['answer2']      = trim($request->input('answer2'));
            $arr_data['answer3']      = trim($request->input('answer3'));
            $arr_data['answer4']      = trim($request->input('answer4'));
            $arr_data['answer5']      = trim($request->input('answer5'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 8 */
        else if($request->input('templateId')==8)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['answer2'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['question_2_text'] = trim($request->input('question2'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 9 */
        else if($request->input('templateId')==9)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question'] = 'required';
            $arr_rules['option1'] = 'required';
            $arr_rules['option2'] = 'required';
            $arr_rules['option3'] = 'required';
            $arr_rules['option4'] = 'required';
            $arr_rules['rdoOption'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['option1'] = trim($request->input('option1'));
            $arr_data['option2'] = trim($request->input('option2'));
            $arr_data['option3'] = trim($request->input('option3'));
            $arr_data['option4'] = trim($request->input('option4'));
            $arr_data['answer'] = trim($request->input('rdoOption'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 10 */
        else if($request->input('templateId')==10)
        {

            $arr_rules['direction'] = 'required';
            $arr_rules['question']  = 'required';
            $arr_rules['option1']   = 'required';
            $arr_rules['option2']   = 'required';
            $arr_rules['rdoOption'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
           
            if($request->hasFile('flQuestion'))
            {
                $flQuestion_fileName = $this->uploadFile($request->file('flQuestion'),570,442);
                if(isset($flQuestion_fileName) && $flQuestion_fileName!=false)
                {
                    $arr_data['question_file'] = $flQuestion_fileName;
                }
            }
            else
            {   
                $flQuestion_old_file_name = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $flQuestion_new_file      = $this->copyFile($flQuestion_old_file_name,'image');
                if(isset($flQuestion_new_file) && $flQuestion_new_file!=false)
                {
                     $arr_data['question_file'] = $flQuestion_new_file;
                }

            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']    = $programId;
            $arr_data['created_by']    = $created_by;
            $arr_data['question']      = trim($request->input('direction'));
            $arr_data['question_text'] = trim($request->input('question'));
            $arr_data['option1']       = trim($request->input('option1'));
            $arr_data['option2']       = trim($request->input('option2'));
            $arr_data['answer']        = trim($request->input('rdoOption'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 11 */
        else if($request->input('templateId')==11)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['answer4'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),270,270);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),270,270);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),270,270);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),270,270);
                 if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }

            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer1']      = trim($request->input('answer1'));
            $arr_data['answer2']      = trim($request->input('answer2'));
            $arr_data['answer3']      = trim($request->input('answer3'));
            $arr_data['answer4']      = trim($request->input('answer4'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 12 */
        else if($request->input('templateId')==12)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['answer2'] = 'required';
            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer1'] = trim(strtoupper($request->input('answer1')));
            $arr_data['answer2'] = trim(strtoupper($request->input('answer2')));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 13 */
        else if($request->input('templateId')==13)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['answer5'] = 'required';
            $arr_rules['answer6'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),165,165);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),165,165);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),165,165);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),165,165);
                if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }
            //flQuestion5
            if($request->hasFile('flQuestion5'))
            {
                $flQuestion5_fileName = $this->uploadFile($request->file('flQuestion5'),165,165);
                 if(isset($flQuestion5_fileName) && $flQuestion5_fileName!=false)
                {
                    $arr_data['question_5_file'] = $flQuestion5_fileName;
                }
            }
            else
            {
                $flQuestion5_old_file    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $flQuestion5_new_file    = $this->copyFile($flQuestion5_old_file,'image');
                if(isset($flQuestion5_new_file) && $flQuestion5_new_file!=false)
                {
                     $arr_data['question_5_file'] = $flQuestion5_new_file;
                }   
              
            }
             //flQuestion6
            if($request->hasFile('flQuestion6'))
            {
                $flQuestion6_fileName = $this->uploadFile($request->file('flQuestion6'),165,165);
                 if(isset($flQuestion6_fileName) && $flQuestion6_fileName!=false)
                {
                    $arr_data['question_6_file'] = $flQuestion6_fileName;
                }
            }
            else
            {
                $flQuestion6_old_file    = isset($arrQuestion->question_6_file)?$arrQuestion->question_6_file:'';
                $flQuestion6_new_file    = $this->copyFile($flQuestion6_old_file,'image');
                if(isset($flQuestion6_new_file) && $flQuestion6_new_file!=false)
                {
                     $arr_data['question_6_file'] = $flQuestion6_new_file;
                }   
              
            }
           
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer1']      = trim($request->input('answer1'));
            $arr_data['answer2']      = trim($request->input('answer2'));
            $arr_data['answer3']      = trim($request->input('answer3'));
            $arr_data['answer4']      = trim($request->input('answer4'));
            $arr_data['answer5']      = trim($request->input('answer5'));
            $arr_data['answer6']      = trim($request->input('answer6'));

            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 14 */
        else if($request->input('templateId')==14)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['answer1'] = 'required';
            $arr_rules['answer2'] = 'required';
            $arr_rules['answer3'] = 'required';
            $arr_rules['answer4'] = 'required';
            $arr_rules['answer5'] = 'required';
            $arr_rules['answer6'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),200,138);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),200,138);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),200,138);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),200,138);
                if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }
            //flQuestion5
            if($request->hasFile('flQuestion5'))
            {
                $flQuestion5_fileName = $this->uploadFile($request->file('flQuestion5'),200,138);
                 if(isset($flQuestion5_fileName) && $flQuestion5_fileName!=false)
                {
                    $arr_data['question_5_file'] = $flQuestion5_fileName;
                }
            }
            else
            {
                $flQuestion5_old_file    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $flQuestion5_new_file    = $this->copyFile($flQuestion5_old_file,'image');
                if(isset($flQuestion5_new_file) && $flQuestion5_new_file!=false)
                {
                     $arr_data['question_5_file'] = $flQuestion5_new_file;
                }   
              
            }
             //flQuestion6
            if($request->hasFile('flQuestion6'))
            {
                $flQuestion6_fileName = $this->uploadFile($request->file('flQuestion6'),200,138);
                 if(isset($flQuestion6_fileName) && $flQuestion6_fileName!=false)
                {
                    $arr_data['question_6_file'] = $flQuestion6_fileName;
                }
            }
            else
            {
                $flQuestion6_old_file    = isset($arrQuestion->question_6_file)?$arrQuestion->question_6_file:'';
                $flQuestion6_new_file    = $this->copyFile($flQuestion6_old_file,'image');
                if(isset($flQuestion6_new_file) && $flQuestion6_new_file!=false)
                {
                     $arr_data['question_6_file'] = $flQuestion6_new_file;
                }   
              
            }
           
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer1']      = trim($request->input('answer1'));
            $arr_data['answer2']      = trim($request->input('answer2'));
            $arr_data['answer3']      = trim($request->input('answer3'));
            $arr_data['answer4']      = trim($request->input('answer4'));
            $arr_data['answer5']      = trim($request->input('answer5'));
            $arr_data['answer6']      = trim($request->input('answer6'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 15 */
        else if($request->input('templateId')==15)
        {
            /*dd($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['rdoQuestion1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['rdoQuestion2'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('rdoQuestion1Text'))
            {
                return json_encode([
                        'errors' => 'rdoQuestion1Text',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            
            if(!$request->input('rdoQuestion2Text'))
            {
                return json_encode([
                        'errors' => 'rdoQuestion2Text',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }


            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
            $strQuestion_1_answer_position = $question_1_answer = '';

            if($request->input('rdoQuestion1Text'))
            {
                if(count($request->input('rdoQuestion1Text')) > 0)
                {
                    foreach ($request->input('rdoQuestion1Text') as $rdoQuestion1TextKey=>$rdoQuestion1TextVal)
                    {
                        if($rdoQuestion1TextKey==$request->input('rdoQuestion1'))
                        {
                            $question_1_answer = $rdoQuestion1TextVal;
                            $strQuestion_1_answer_position.=0;
                        }
                        else
                        {
                            $strQuestion_1_answer_position.=1;
                        }
                    }
                }
            }
            $arr_data['question_1_answer'] = $question_1_answer;
            $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;

            $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
            $strQuestion_2_answer_position = $question_2_answer = '';
            if($request->input('rdoQuestion2Text'))
            {
                if(count($request->input('rdoQuestion2Text')) > 0)
                {
                    foreach ($request->input('rdoQuestion2Text') as $rdoQuestion2TextKey=>$rdoQuestion2TextVal)
                    {
                        if($rdoQuestion2TextKey==$request->input('rdoQuestion2'))
                        {
                            $question_2_answer = $rdoQuestion2TextVal;
                            $strQuestion_2_answer_position.=0;
                        }
                        else
                        {
                            $strQuestion_2_answer_position.=1;
                        }
                    }
                }
            }
            $arr_data['question_2_answer'] = $question_2_answer;
            $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 16 */
        else if($request->input('templateId')==16)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['answer2']   = 'required';
            
            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
            //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_text'] = trim($request->input('question1'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['question_2_text'] = trim($request->input('question2'));
            $arr_data['answer2'] = trim($request->input('answer2'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 17 */
        else if($request->input('templateId')==17)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['option1_1'] = 'required';
            $arr_rules['option1_2'] = 'required';
            $arr_rules['option1_3'] = 'required';
            $arr_rules['rdoOption1'] = 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['option2_1'] = 'required';
            $arr_rules['option2_2'] = 'required';
            $arr_rules['option2_3'] = 'required';
            $arr_rules['rdoOption2'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']         = $programId;
            $arr_data['created_by']         = $created_by;
            $arr_data['question']           = trim($request->input('direction'));
            $arr_data['question_1_text']    = trim($request->input('question1'));
            $arr_data['question_1_option1'] = trim($request->input('option1_1'));
            $arr_data['question_1_option2'] = trim($request->input('option1_2'));
            $arr_data['question_1_option3'] = trim($request->input('option1_3'));
            $arr_data['question_1_answer']  = $request->input('rdoOption1');
            $arr_data['question_2_text']    = trim($request->input('question2'));
            $arr_data['question_2_option1'] = trim($request->input('option2_1'));
            $arr_data['question_2_option2'] = trim($request->input('option2_2'));
            $arr_data['question_2_option3'] = trim($request->input('option2_3'));
            $arr_data['question_2_answer']  = $request->input('rdoOption2');
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 18 */
        else if($request->input('templateId')==18)
        {

            /*dump($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['question6']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('blankLetter1'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter1'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter1',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter2'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter2'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter2',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter3'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter3'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter3',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter4'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter4'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter4',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter5'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter5'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter5',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            if(!$request->input('blankLetter6'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            if(!$request->input('chkBlankLetter6'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter6',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
                        if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),185,121);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),185,121);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),185,121);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),185,121);
                if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }
            //flQuestion5
            if($request->hasFile('flQuestion5'))
            {
                $flQuestion5_fileName = $this->uploadFile($request->file('flQuestion5'),185,121);
                 if(isset($flQuestion5_fileName) && $flQuestion5_fileName!=false)
                {
                    $arr_data['question_5_file'] = $flQuestion5_fileName;
                }
            }
            else
            {
                $flQuestion5_old_file    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $flQuestion5_new_file    = $this->copyFile($flQuestion5_old_file,'image');
                if(isset($flQuestion5_new_file) && $flQuestion5_new_file!=false)
                {
                     $arr_data['question_5_file'] = $flQuestion5_new_file;
                }   
              
            }
             //flQuestion6
            if($request->hasFile('flQuestion6'))
            {
                $flQuestion6_fileName = $this->uploadFile($request->file('flQuestion6'),185,121);
                 if(isset($flQuestion6_fileName) && $flQuestion6_fileName!=false)
                {
                    $arr_data['question_6_file'] = $flQuestion6_fileName;
                }
            }
            else
            {
                $flQuestion6_old_file    = isset($arrQuestion->question_6_file)?$arrQuestion->question_6_file:'';
                $flQuestion6_new_file    = $this->copyFile($flQuestion6_old_file,'image');
                if(isset($flQuestion6_new_file) && $flQuestion6_new_file!=false)
                {
                     $arr_data['question_6_file'] = $flQuestion6_new_file;
                }   
              
            }
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }
            
            $arr_data['program_id']        = $programId;
            $arr_data['created_by']        = $created_by;
            $arr_data['question']          = trim($request->input('direction'));
            $arr_data['duration']          = gmdate('H:i:s', $request->input('duration'));
            $arr_data['question_1_text']   = trim($request->input('question1'));
            $strQuestion_1_answer_position = $question_1_answer = '';
            $arrChkBlankLetter1 = [];
            if($request->input('chkBlankLetter1'))
            {
                if(count($request->input('chkBlankLetter1')) > 0)
                {
                    $arrChkBlankLetter1 = $request->input('chkBlankLetter1');
                }     
            }
            if($request->input('blankLetter1'))
            {
                if(count($request->input('blankLetter1')) > 0)
                {
                    foreach ($request->input('blankLetter1') as $blankLetter1Key=>$blankLetter1Val)
                    {
                        if(in_array($blankLetter1Key, $arrChkBlankLetter1))
                        {
                            $question_1_answer.=$blankLetter1Val;
                            $strQuestion_1_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_1_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_1_answer']          = $question_1_answer;
            $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;

            $arr_data['question_2_text']           = trim($request->input('question2'));
            $strQuestion_2_answer_position         = $question_2_answer = '';
           
            $arrChkBlankLetter2 = [];
            if($request->input('chkBlankLetter2'))
            {
                if(count($request->input('chkBlankLetter2')) > 0)
                {
                    $arrChkBlankLetter2 = $request->input('chkBlankLetter2');
                }     
            }
            if($request->input('blankLetter2'))
            {
                if(count($request->input('blankLetter2')) > 0)
                {
                    foreach ($request->input('blankLetter2') as $blankLetter2Key=>$blankLetter2Val)
                    {
                        if(in_array($blankLetter2Key, $arrChkBlankLetter2))
                        {
                            $question_2_answer.=$blankLetter2Val;
                            $strQuestion_2_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_2_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_2_answer'] = $question_2_answer;
            $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;

            $arr_data['question_3_text']   = trim($request->input('question3'));
            $strQuestion_3_answer_position = $question_3_answer = '';
            $arrChkBlankLetter3 = [];
            if($request->input('chkBlankLetter3'))
            {
                if(count($request->input('chkBlankLetter3')) > 0)
                {
                    $arrChkBlankLetter3 = $request->input('chkBlankLetter3');
                }     
            }
            if($request->input('blankLetter3'))
            {
                if(count($request->input('blankLetter3')) > 0)
                {
                    foreach ($request->input('blankLetter3') as $blankLetter3Key=>$blankLetter3Val)
                    {
                        if(in_array($blankLetter3Key, $arrChkBlankLetter3))
                        {
                            $question_3_answer.=$blankLetter3Val;
                            $strQuestion_3_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_3_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_3_answer'] = $question_3_answer;
            $arr_data['question_3_answer_position'] = $strQuestion_3_answer_position;

            $arr_data['question_4_text'] = trim($request->input('question4'));
            $strQuestion_4_answer_position = $question_4_answer = '';
            $arrChkBlankLetter4 = [];
            if($request->input('chkBlankLetter4'))
            {
                if(count($request->input('chkBlankLetter4')) > 0)
                {
                    $arrChkBlankLetter4 = $request->input('chkBlankLetter4');
                }     
            }
            if($request->input('blankLetter4'))
            {
                if(count($request->input('blankLetter4')) > 0)
                {
                    foreach ($request->input('blankLetter4') as $blankLetter4Key=>$blankLetter4Val)
                    {
                        if(in_array($blankLetter4Key, $arrChkBlankLetter4))
                        {
                            $question_4_answer.=$blankLetter4Val;
                            $strQuestion_4_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_4_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_4_answer'] = $question_4_answer;
            $arr_data['question_4_answer_position'] = $strQuestion_4_answer_position;

            $arr_data['question_5_text'] = trim($request->input('question5'));
            $strQuestion_5_answer_position = $question_5_answer = '';
            $arrChkBlankLetter5 = [];
            if($request->input('chkBlankLetter5'))
            {
                if(count($request->input('chkBlankLetter5')) > 0)
                {
                    $arrChkBlankLetter5 = $request->input('chkBlankLetter5');
                }     
            }
            if($request->input('blankLetter5'))
            {
                if(count($request->input('blankLetter5')) > 0)
                {
                    foreach ($request->input('blankLetter5') as $blankLetter5Key=>$blankLetter5Val)
                    {
                        if(in_array($blankLetter5Key, $arrChkBlankLetter5))
                        {
                            $question_5_answer.=$blankLetter5Val;
                            $strQuestion_5_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_5_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_5_answer'] = $question_5_answer;
            $arr_data['question_5_answer_position'] = $strQuestion_5_answer_position;

            $arr_data['question_6_text'] = trim($request->input('question6'));
            $strQuestion_6_answer_position = $question_6_answer = '';
            $arrChkBlankLetter6 = [];
            if($request->input('chkBlankLetter6'))
            {
                if(count($request->input('chkBlankLetter6')) > 0)
                {
                    $arrChkBlankLetter6 = $request->input('chkBlankLetter6');
                }     
            }
            if($request->input('blankLetter6'))
            {
                if(count($request->input('blankLetter6')) > 0)
                {
                    foreach ($request->input('blankLetter6') as $blankLetter6Key=>$blankLetter6Val)
                    {
                        if(in_array($blankLetter6Key, $arrChkBlankLetter6))
                        {
                            $question_6_answer.=$blankLetter6Val;
                            $strQuestion_6_answer_position.=0;   
                        }
                        else
                        {
                            $strQuestion_6_answer_position.=1;   
                        }
                    }
                }
            }
            $arr_data['question_6_answer'] = $question_6_answer;
            $arr_data['question_6_answer_position'] = $strQuestion_6_answer_position;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 19 */
        else if($request->input('templateId')==19)
        {
            /*dump($request->all());*/
             $arr_rules['direction'] = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['answer2']   = 'required';
            $arr_rules['answer3']   = 'required';
            $arr_rules['answer4']   = 'required';
            $arr_rules['answer5']   = 'required';
            $arr_rules['answer6']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),185,121);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),185,121);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            //flQuestion3
            if($request->hasFile('flQuestion3'))
            {
                $flQuestion3_fileName = $this->uploadFile($request->file('flQuestion3'),185,121);
                if(isset($flQuestion3_fileName) && $flQuestion3_fileName!=false)
                {
                    $arr_data['question_3_file'] = $flQuestion3_fileName;
                }
            }
            else
            {
                $flQuestion3_old_file    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $flQuestion3_new_file    = $this->copyFile($flQuestion3_old_file,'image');
                if(isset($flQuestion3_new_file) && $flQuestion3_new_file!=false)
                {
                     $arr_data['question_3_file'] = $flQuestion3_new_file;
                }   
              
            }
            //flQuestion4
            if($request->hasFile('flQuestion4'))
            {
                $flQuestion4_fileName = $this->uploadFile($request->file('flQuestion4'),185,121);
                if(isset($flQuestion4_fileName) && $flQuestion4_fileName!=false)
                {
                    $arr_data['question_4_file'] = $flQuestion4_fileName;
                }
            }
            else
            {
                $flQuestion4_old_file    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $flQuestion4_new_file    = $this->copyFile($flQuestion4_old_file,'image');
                if(isset($flQuestion4_old_file) && $flQuestion4_old_file!=false)
                {
                     $arr_data['question_4_file'] = $flQuestion4_new_file;
                }   
              
            }
            //flQuestion5
            if($request->hasFile('flQuestion5'))
            {
                $flQuestion5_fileName = $this->uploadFile($request->file('flQuestion5'),185,121);
                 if(isset($flQuestion5_fileName) && $flQuestion5_fileName!=false)
                {
                    $arr_data['question_5_file'] = $flQuestion5_fileName;
                }
            }
            else
            {
                $flQuestion5_old_file    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $flQuestion5_new_file    = $this->copyFile($flQuestion5_old_file,'image');
                if(isset($flQuestion5_new_file) && $flQuestion5_new_file!=false)
                {
                     $arr_data['question_5_file'] = $flQuestion5_new_file;
                }   
              
            }
             //flQuestion6
            if($request->hasFile('flQuestion6'))
            {
                $flQuestion6_fileName = $this->uploadFile($request->file('flQuestion6'),185,121);
                 if(isset($flQuestion6_fileName) && $flQuestion6_fileName!=false)
                {
                    $arr_data['question_6_file'] = $flQuestion6_fileName;
                }
            }
            else
            {
                $flQuestion6_old_file    = isset($arrQuestion->question_6_file)?$arrQuestion->question_6_file:'';
                $flQuestion6_new_file    = $this->copyFile($flQuestion6_old_file,'image');
                if(isset($flQuestion6_new_file) && $flQuestion6_new_file!=false)
                {
                     $arr_data['question_6_file'] = $flQuestion6_new_file;
                }   
              
            }
           
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_answer'] = trim($request->input('answer1'));
            $arr_data['question_2_answer'] = trim($request->input('answer2'));
            $arr_data['question_3_answer'] = trim($request->input('answer3'));
            $arr_data['question_4_answer'] = trim($request->input('answer4'));
            $arr_data['question_5_answer'] = trim($request->input('answer5'));
            $arr_data['question_6_answer'] = trim($request->input('answer6'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 20 */
        else if($request->input('templateId')==20)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['option1_1']   = 'required';
            $arr_rules['option1_2']   = 'required';
            $arr_rules['option1_3']   = 'required';
            $arr_rules['rdoOption1']   = 'required';
            $arr_rules['option2_1']   = 'required';
            $arr_rules['option2_2']   = 'required';
            $arr_rules['option2_3']   = 'required';
            $arr_rules['rdoOption2']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $flQuestion1_fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($flQuestion1_fileName) && $flQuestion1_fileName!=false)
                {
                    $arr_data['question_1_file'] = $flQuestion1_fileName;
                }
            }
            else
            {   
                $flQuestion1_old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $flQuestion1_newfileName      = $this->copyFile($flQuestion1_old_file_name,'image');
                if(isset($flQuestion1_newfileName) && $flQuestion1_newfileName!=false)
                {
                     $arr_data['question_1_file'] = $flQuestion1_newfileName;
                }

            }
             //flQuestion2
            if($request->hasFile('flQuestion2'))
            {
                $flQuestion2_fileName = $this->uploadFile($request->file('flQuestion2'),570,442);
                if(isset($flQuestion2_fileName) && $flQuestion2_fileName!=false)
                {
                    $arr_data['question_2_file'] = $flQuestion2_fileName;

                }
            }
            else
            {
                $flQuestion2_old_file         = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $flQuestion2_new_file        = $this->copyFile($flQuestion2_old_file,'image');
                if(isset($flQuestion2_new_file) && $flQuestion2_new_file!=false)
                {
                     $arr_data['question_2_file'] = $flQuestion2_new_file;
                }        

            }
            
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1_option1'] = trim($request->input('option1_1'));
            $arr_data['question_1_option2'] = trim($request->input('option1_2'));
            $arr_data['question_1_option3'] = trim($request->input('option1_3'));
            $arr_data['question_1_answer'] = trim($request->input('rdoOption1'));
            $arr_data['question_2_option1'] = trim($request->input('option2_1'));
            $arr_data['question_2_option2'] = trim($request->input('option2_2'));
            $arr_data['question_2_option3'] = trim($request->input('option2_3'));
            $arr_data['question_2_answer'] = trim($request->input('rdoOption2'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 21 */
        else if($request->input('templateId')==21)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']   = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']   = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']   = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['answer5']   = 'required';
            $arr_rules['question6']   = 'required';
            $arr_rules['answer6']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3'] = trim($request->input('answer3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4'] = trim($request->input('answer4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5'] = trim($request->input('answer5'));
            $arr_data['question_6'] = trim($request->input('question6'));
            $arr_data['answer_6'] = trim($request->input('answer6'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 22 */
        else if($request->input('templateId')==22)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            if($request->input('duration'))
            {
                $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            }
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 23 */
        else if($request->input('templateId')==23)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 24 */
        else if($request->input('templateId')==24)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']     = 'required';
/*            $arr_rules['question5']   = 'required';
            $arr_rules['answer5']     = 'required';
            $arr_rules['question6']   = 'required';
            $arr_rules['answer6']     = 'required';
            $arr_rules['question7']   = 'required';
            $arr_rules['answer7']     = 'required';
            $arr_rules['question8']   = 'required';
            $arr_rules['answer8']     = 'required';*/
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('answer3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4']   = trim($request->input('answer4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5']   = trim($request->input('answer5'));
            $arr_data['question_6'] = trim($request->input('question6'));
            $arr_data['answer_6']   = trim($request->input('answer6'));
            $arr_data['question_7'] = trim($request->input('question7'));
            $arr_data['answer_7']   = trim($request->input('answer7'));
            $arr_data['question_8'] = trim($request->input('question8'));
            $arr_data['answer_8']   = trim($request->input('answer8'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 25 */
        else if($request->input('templateId')==25)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question']    = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion'))
            {
                $fileName = $this->uploadVideoFile($request->file('flQuestion'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }
                    $arr_data['question_1_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $newfileName      = $this->copyFile($old_file_name,'video');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_1_file'] = $newfileName;
                }
            }
            
            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 26 */
        else if($request->input('templateId')==26)
        {
            $arr_rules['direction'] = 'required';
            $arr_rules['question1'] = 'required';
            $arr_rules['option1_1'] = 'required';
            $arr_rules['option1_2'] = 'required';
            $arr_rules['option1_3'] = 'required';
            $arr_rules['rdoOption1']= 'required';
            $arr_rules['question2'] = 'required';
            $arr_rules['option2_1'] = 'required';
            $arr_rules['option2_2'] = 'required';
            $arr_rules['option2_3'] = 'required';
            $arr_rules['rdoOption2']= 'required';
            $arr_rules['question3'] = 'required';
            $arr_rules['option3_1'] = 'required';
            $arr_rules['option3_2'] = 'required';
            $arr_rules['option3_3'] = 'required';
            $arr_rules['rdoOption3']= 'required';
            $arr_rules['duration']  = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            
            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']           = $programId;
            $arr_data['created_by']           = $created_by;
            $arr_data['question']             = trim($request->input('direction'));
            $arr_data['question_1_text']      = trim($request->input('question1'));
            $arr_data['question_1_option1']   = trim($request->input('option1_1'));
            $arr_data['question_1_option2']   = trim($request->input('option1_2'));
            $arr_data['question_1_option3']   = trim($request->input('option1_3'));
            $arr_data['question_1_answer']    = $request->input('rdoOption1');
            $arr_data['question_2_text']      = trim($request->input('question2'));
            $arr_data['question_2_option1']   = trim($request->input('option2_1'));
            $arr_data['question_2_option2']   = trim($request->input('option2_2'));
            $arr_data['question_2_option3']   = trim($request->input('option2_3'));
            $arr_data['question_2_answer']    = $request->input('rdoOption2');
            $arr_data['question_3_text']      = trim($request->input('question3'));
            $arr_data['question_3_option1']   = trim($request->input('option3_1'));
            $arr_data['question_3_option2']   = trim($request->input('option3_2'));
            $arr_data['question_3_option3']   = trim($request->input('option3_3'));
            $arr_data['question_3_answer']    = $request->input('rdoOption3');
            $arr_data['duration']             = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 27 */
        else if($request->input('templateId')==27)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('answer3'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 28 */
        else if($request->input('templateId')==28)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            /*$arr_rules['rdoOption1']  = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['rdoOption2']  = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['rdoOption3']  = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['rdoOption4']  = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['rdoOption5']  = 'required';*/
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('rdoOption1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2']   = trim($request->input('rdoOption2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3']   = trim($request->input('rdoOption3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4']   = trim($request->input('rdoOption4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5']   = trim($request->input('rdoOption5'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 29 */
        else if($request->input('templateId')==29)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['answer']      = 'required|max:1';
            $arr_rules['question1']   = 'required';
            /*$arr_rules['question2']   = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['question5']   = 'required';*/
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id']   = $programId;
            $arr_data['created_by']   = $created_by;
            $arr_data['question']     = trim($request->input('direction'));
            $arr_data['answer']       = trim($request->input('answer'));
            $arr_data['question_1']   = trim($request->input('question1'));
            $arr_data['question_2']   = trim($request->input('question2'));
            $arr_data['question_3']   = trim($request->input('question3'));
            $arr_data['question_4']   = trim($request->input('question4'));
            $arr_data['question_5']   = trim($request->input('question5'));
            $arr_data['duration']     = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 30 */
        else if($request->input('templateId')==30)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']     = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']     = 'required';
            $arr_rules['question4']   = 'required';
            $arr_rules['answer4']     = 'required';
            $arr_rules['question5']   = 'required';
            $arr_rules['answer5']     = 'required';
            /*$arr_rules['flHorn']      = 'required';*/
            $arr_rules['duration']    = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

             //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1']   = trim($request->input('answer1'));
            if(trim($request->input('question2'))!=''){
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
            }
            if(trim($request->input('question3'))!=''){
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
            }
            if(trim($request->input('question4'))!=''){
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('answer4'));
            }
            if(trim($request->input('question5'))!=''){
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('answer5'));
            }
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 31 */
        else if($request->input('templateId')==31)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['answer']     = 'required';
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

             //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['answer']     = trim($request->input('answer'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 32 */
        else if($request->input('templateId')==32)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['answer']     = 'required';
            /*$arr_rules['flHorn']     = 'required';*/
            $arr_rules['duration']   = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

             //upload & copy code of audio
            if($request->hasFile('flHorn'))
            {
                $fileName = $this->uploadAudioFile($request->file('flHorn'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['horn'] = $fileName;
                    if(isset($arrQuestion->horn) && $arrQuestion->horn!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion->horn))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion->horn);
                        }
                    }
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->horn)?$arrQuestion->horn:'';
                $newfileName      = $this->copyFile($old_file_name,'audio');
                if(isset($newfileName) && $newfileName!=false)
                {
                     $arr_data['horn'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['answer']     = trim($request->input('answer'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 33 */
        else if($request->input('templateId')==33)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';

/*            $arr_rules['digit2_1']   = 'required';
            $arr_rules['operator2']  = 'required';
            $arr_rules['digit2_2']   = 'required';
            $arr_rules['answer2']    = 'required';

            $arr_rules['digit3_1']   = 'required';
            $arr_rules['operator3']  = 'required';
            $arr_rules['digit3_2']   = 'required';
            $arr_rules['answer3']    = 'required';

            $arr_rules['digit4_1']   = 'required';
            $arr_rules['operator4']  = 'required';
            $arr_rules['digit4_2']   = 'required';
            $arr_rules['answer4']    = 'required';

            $arr_rules['digit5_1']   = 'required';
            $arr_rules['operator5']  = 'required';
            $arr_rules['digit5_2']   = 'required';
            $arr_rules['answer5']    = 'required';

            $arr_rules['digit6_1']   = 'required';
            $arr_rules['operator6']  = 'required';
            $arr_rules['digit6_2']   = 'required';
            $arr_rules['answer6']    = 'required';

            $arr_rules['digit7_1']   = 'required';
            $arr_rules['operator7']  = 'required';
            $arr_rules['digit7_2']   = 'required';
            $arr_rules['answer7']    = 'required';

            $arr_rules['digit8_1']   = 'required';
            $arr_rules['operator8']  = 'required';
            $arr_rules['digit8_2']   = 'required';
            $arr_rules['answer8']    = 'required';

            $arr_rules['digit9_1']   = 'required';
            $arr_rules['operator9']  = 'required';
            $arr_rules['digit9_2']   = 'required';
            $arr_rules['answer9']    = 'required';

            $arr_rules['digit10_1']  = 'required';
            $arr_rules['operator10'] = 'required';
            $arr_rules['digit10_2']  = 'required';
            $arr_rules['answer10']   = 'required';

            $arr_rules['digit11_1']  = 'required';
            $arr_rules['operator11'] = 'required';
            $arr_rules['digit11_2']  = 'required';
            $arr_rules['answer11']   = 'required';

            $arr_rules['digit12_1']  = 'required';
            $arr_rules['operator12'] = 'required';
            $arr_rules['digit12_2']  = 'required';
            $arr_rules['answer12']   = 'required';*/
            $arr_rules['duration']   = 'required';
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            
            if($request->input('digit1_1')!='')
            {
                $arr_data['digit1_1']   = trim($request->input('digit1_1'));
                $arr_data['operator1']  = trim($request->input('operator1'));
                $arr_data['digit1_2']   = trim($request->input('digit1_2'));
                $arr_data['answer1']    = trim($request->input('answer1'));
            }

            if($request->input('digit2_1')!='')
            {
                $arr_data['digit2_1']   = trim($request->input('digit2_1'));
                $arr_data['operator2']  = trim($request->input('operator2'));
                $arr_data['digit2_2']   = trim($request->input('digit2_2'));
                $arr_data['answer2']    = trim($request->input('answer2'));
            }

            if($request->input('digit3_1')!='')
            {
                $arr_data['digit3_1']   = trim($request->input('digit3_1'));
                $arr_data['operator3']  = trim($request->input('operator3'));
                $arr_data['digit3_2']   = trim($request->input('digit3_2'));
                $arr_data['answer3']    = trim($request->input('answer3'));
            }
            
            if($request->input('digit4_1')!='')
            {
                $arr_data['digit4_1']   = trim($request->input('digit4_1'));
                $arr_data['operator4']  = trim($request->input('operator4'));
                $arr_data['digit4_2']   = trim($request->input('digit4_2'));
                $arr_data['answer4']    = trim($request->input('answer4'));
            }

            if($request->input('digit5_1')!='')
            {
                $arr_data['digit5_1']   = trim($request->input('digit5_1'));
                $arr_data['operator5']  = trim($request->input('operator5'));
                $arr_data['digit5_2']   = trim($request->input('digit5_2'));
                $arr_data['answer5']    = trim($request->input('answer5'));
            }

            if($request->input('digit6_1')!='')
            {
                $arr_data['digit6_1']   = trim($request->input('digit6_1'));
                $arr_data['operator6']  = trim($request->input('operator6'));
                $arr_data['digit6_2']   = trim($request->input('digit6_2'));
                $arr_data['answer6']    = trim($request->input('answer6'));
            }

            if($request->input('digit7_1')!='')
            {
                $arr_data['digit7_1']   = trim($request->input('digit7_1'));
                $arr_data['operator7']  = trim($request->input('operator7'));
                $arr_data['digit7_2']   = trim($request->input('digit7_2'));
                $arr_data['answer7']    = trim($request->input('answer7'));
            }

            if($request->input('digit8_1')!='')
            {
                $arr_data['digit8_1']   = trim($request->input('digit8_1'));
                $arr_data['operator8']  = trim($request->input('operator8'));
                $arr_data['digit8_2']   = trim($request->input('digit8_2'));
                $arr_data['answer8']    = trim($request->input('answer8'));
            }

            if($request->input('digit9_1')!='')
            {
                $arr_data['digit9_1']   = trim($request->input('digit9_1'));
                $arr_data['operator9']  = trim($request->input('operator9'));
                $arr_data['digit9_2']   = trim($request->input('digit9_2'));
                $arr_data['answer9']    = trim($request->input('answer9'));
            }

            if($request->input('digit10_1')!='')
            {
                $arr_data['digit10_1']  = trim($request->input('digit10_1'));
                $arr_data['operator10'] = trim($request->input('operator10'));
                $arr_data['digit10_2']  = trim($request->input('digit10_2'));
                $arr_data['answer10']   = trim($request->input('answer10'));
            }

            if($request->input('digit11_1')!='')
            {
                $arr_data['digit11_1']  = trim($request->input('digit11_1'));
                $arr_data['operator11'] = trim($request->input('operator11'));
                $arr_data['digit11_2']  = trim($request->input('digit11_2'));
                $arr_data['answer11']   = trim($request->input('answer11'));
            }            

            if($request->input('digit12_1')!='')
            {            
                $arr_data['digit12_1']  = trim($request->input('digit12_1'));
                $arr_data['operator12'] = trim($request->input('operator12'));
                $arr_data['digit12_2']  = trim($request->input('digit12_2'));
                $arr_data['answer12']   = trim($request->input('answer12'));
            }
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 34 */
        else if($request->input('templateId')==34)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['flQuestion'] = 'required';
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']   = 'required';*/

            if($request->hasFile('flQuestion'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion'),583,560);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_file) && $arrQuestion->question_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_file);
                        }
                    }
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_file'] = $newfileName;
                }
            }
            
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['digit1_1']   = trim($request->input('digit1_1'));
            $arr_data['operator1']  = trim($request->input('operator1'));
            $arr_data['digit1_2']   = trim($request->input('digit1_2'));
            $arr_data['answer1']    = trim($request->input('answer1'));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 35 */
        else if($request->input('templateId')==35)
        {
            /*dd($request->all());*/
            /*dd($request->all());*/
            $arr_rules['direction']        = 'required';
            /*$arr_rules['flQuestion1']      = 'required';*/
            
            $arr_rules['digit1_1']         = 'required';
            $arr_rules['operator1']        = 'required';
            $arr_rules['digit1_2']         = 'required';
            $arr_rules['answer1']          = 'required';
            $arr_rules['chkBlankLetter_1'] = 'required';

/*            $arr_rules['digit2_1']         = 'required';
            $arr_rules['operator2']        = 'required';
            $arr_rules['digit2_2']         = 'required';
            $arr_rules['answer2']          = 'required';
            $arr_rules['chkBlankLetter_2'] = 'required';

            $arr_rules['digit3_1']         = 'required';
            $arr_rules['operator3']        = 'required';
            $arr_rules['digit3_2']         = 'required';
            $arr_rules['answer3']          = 'required';
            $arr_rules['chkBlankLetter_3'] = 'required';

            $arr_rules['digit4_1']         = 'required';
            $arr_rules['operator4']        = 'required';
            $arr_rules['digit4_2']         = 'required';
            $arr_rules['answer4']          = 'required';
            $arr_rules['chkBlankLetter_4'] = 'required';

            $arr_rules['digit5_1']         = 'required';
            $arr_rules['operator5']        = 'required';
            $arr_rules['digit5_2']         = 'required';
            $arr_rules['answer5']          = 'required';
            $arr_rules['chkBlankLetter_5'] = 'required';*/

            $arr_rules['duration']         = 'required';
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }
                    $arr_data['question_1_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_1_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion2'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion2'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_2_file) && $arrQuestion->question_2_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_2_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_2_file);
                        }
                    }
                    $arr_data['question_2_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_2_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion3'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion3'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_3_file) && $arrQuestion->question_3_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_3_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_3_file);
                        }
                    }
                    $arr_data['question_3_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_3_file'] = $newfileName;
                }
            }            

            if($request->hasFile('flQuestion4'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion4'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_4_file) && $arrQuestion->question_4_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_4_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_4_file);
                        }
                    }
                    $arr_data['question_4_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_4_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion5'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion5'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_5_file) && $arrQuestion->question_5_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_5_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_5_file);
                        }
                    }
                    $arr_data['question_5_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_5_file)?$arrQuestion->question_5_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_5_file'] = $newfileName;
                }
            }            
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $answer1Position = null;
            if($request->input('chkBlankLetter_1'))
            {
                if(count($request->input('chkBlankLetter_1')) > 0)
                {
                    for ($i=1; $i <= 3; $i++)
                    { 
                        if(in_array($i, $request->input('chkBlankLetter_1')))
                        {
                            $answer1Position.='0';   
                        }
                        else
                        {
                            $answer1Position.='1';
                        }
                    }
                }
            }
            $arr_data['answer1Position'] = $answer1Position;

            if($request->has('digit2_1') && $request->input('digit2_1')!=''){
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                $arr_data['operator2'] = trim($request->input('operator2'));
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
                $answer2Position = null;
                if($request->input('chkBlankLetter_2'))
                {
                    if(count($request->input('chkBlankLetter_2')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_2')))
                            {
                                $answer2Position.='0';   
                            }
                            else
                            {
                                $answer2Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer2Position'] = $answer2Position;
            }

            if($request->has('digit3_1') && $request->input('digit3_1')!=''){
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                $arr_data['operator3'] = trim($request->input('operator3'));
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                $arr_data['answer3'] = trim($request->input('answer3'));
                $answer3Position = null;
                if($request->input('chkBlankLetter_3'))
                {
                    if(count($request->input('chkBlankLetter_3')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_3')))
                            {
                                $answer3Position.='0';   
                            }
                            else
                            {
                                $answer3Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer3Position'] = $answer3Position;
            }
            
            if($request->has('digit4_1') && $request->input('digit4_1')!=''){
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
                $arr_data['operator4'] = trim($request->input('operator4'));
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
                $arr_data['answer4'] = trim($request->input('answer4'));
                $answer4Position = null;
                if($request->input('chkBlankLetter_4'))
                {
                    if(count($request->input('chkBlankLetter_4')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_4')))
                            {
                                $answer4Position.='0';   
                            }
                            else
                            {
                                $answer4Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer4Position'] = $answer4Position;
            }
            
            if($request->has('digit5_1') && $request->input('digit5_1')!=''){
                $arr_data['digit5_1'] = trim($request->input('digit5_1'));
                $arr_data['operator5'] = trim($request->input('operator5'));
                $arr_data['digit5_2'] = trim($request->input('digit5_2'));
                $arr_data['answer5'] = trim($request->input('answer5'));
                $answer5Position = null;
                if($request->input('chkBlankLetter_5'))
                {
                    if(count($request->input('chkBlankLetter_5')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_5')))
                            {
                                $answer5Position.='0';   
                            }
                            else
                            {
                                $answer5Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer5Position'] = $answer5Position;
            }
            
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 36 */
        else if($request->input('templateId')==36)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['answer']      = 'required';
            $arr_rules['duration']    = 'required';
            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }
                    $arr_data['question_1_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_1_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion2'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion2'));
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_2_file) && $arrQuestion->question_2_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_2_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_2_file);
                        }
                    }
                    $arr_data['question_2_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_2_file'] = $newfileName;
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['answer'] = trim($request->input('answer'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 37 */
        else if($request->input('templateId')==37)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';

            /*$arr_rules['flQuestion1'] = 'required';*/
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']    = 'required';

            if($request->hasFile('flQuestion2'))
            {
                /*$arr_rules['flQuestion2'] = 'required';*/
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';                
            }
            if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
            {
                /*$arr_rules['flQuestion2'] = 'required';*/
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';                   
            }

            if($request->hasFile('flQuestion3'))
            {
                /*$arr_rules['flQuestion3'] = 'required';*/
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';                
            }
            if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
            {
                /*$arr_rules['flQuestion3'] = 'required';*/
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';                   
            }

            if($request->hasFile('flQuestion4'))
            {
                /*$arr_rules['flQuestion4'] = 'required';*/
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';                
            }
            if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
            {
                /*$arr_rules['flQuestion4'] = 'required';*/
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';                   
            }

            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'),504,67);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }
                    $arr_data['question_1_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_1_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion2'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion2'),504,67);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_2_file) && $arrQuestion->question_2_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_2_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_2_file);
                        }
                    }
                    $arr_data['question_2_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_2_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion3'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion3'),504,67);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_3_file) && $arrQuestion->question_3_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_3_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_3_file);
                        }
                    }
                    $arr_data['question_3_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_3_file)?$arrQuestion->question_3_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_3_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion4'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion4'),504,67);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_4_file) && $arrQuestion->question_4_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_4_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_4_file);
                        }
                    }
                    $arr_data['question_4_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_4_file)?$arrQuestion->question_4_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_4_file'] = $newfileName;
                }
            }            

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            if($request->input('digit2_1'))
            {
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
            }
            if($request->input('operator2'))
            {
                $arr_data['operator2'] = trim($request->input('operator2'));
            }
            if($request->input('digit2_2'))
            {
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
            }
            if($request->input('answer2'))
            {
                $arr_data['answer2'] = trim($request->input('answer2'));
            }

            if($request->input('digit3_1'))
            {
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
            }
            if($request->input('operator3'))
            {
                $arr_data['operator3'] = trim($request->input('operator3'));
            }
            if($request->input('digit3_2'))
            {
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
            }
            if($request->input('answer3'))
            {
                $arr_data['answer3'] = trim($request->input('answer3'));
            }

            if($request->input('digit4_1'))
            {
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
            }
            if($request->input('operator4'))
            {
                $arr_data['operator4'] = trim($request->input('operator4'));
            }
            if($request->input('digit4_2'))
            {
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
            }
            if($request->input('answer4'))
            {
                $arr_data['answer4'] = trim($request->input('answer4'));
            }

            $result = $this->$moduleName->create($arr_data);
            
        }
        /* Template : 38 */
        else if($request->input('templateId')==38)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']   = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'),498,384);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_file) && $arrQuestion->question_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_file);
                        }
                    }
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_file'] = $newfileName;
                }
            }
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $question2 = null;
            if($request->input('question2'))
            {
                $question2 = $request->input('question2');
            }
            $arr_data['question_2'] = $question2;
            $answer2 = null;
            if($request->input('answer2'))
            {
                $answer2 = $request->input('answer2');
            }
            $arr_data['answer_2'] = $answer2;
            $question3 = null;
            if($request->input('question3'))
            {
                $question3 = $request->input('question3');    
            }
            $arr_data['question_3'] = $question3;
            $answer3 = null;
            if($request->input('answer3'))
            {
                $answer3 = $request->input('answer3');
            }
            $arr_data['answer_3'] = $answer3;
            $question4 = null;
            if($request->input('question4'))
            {
                $question4 = $request->input('question4');
            }
            $arr_data['question_4'] = $question4;
            $answer4 = null;
            if($request->input('answer4'))
            {
                $answer4 = $request->input('answer4');
            }
            $arr_data['answer_4'] = $answer4;
            
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 39 */
        else if($request->input('templateId')==39)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['duration']    = 'required';
            
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';

            if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
            {
                $arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';
            }

            if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
            {
                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';
            }


            if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
            {
                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';
            }

            if($request->input('digit5_1') || $request->input('operator5') || $request->input('digit5_2') || $request->input('answer5'))
            {
                $arr_rules['digit5_1']   = 'required';
                $arr_rules['operator5']  = 'required';
                $arr_rules['digit5_2']   = 'required';
                $arr_rules['answer5']    = 'required';
            }

            if($request->input('digit6_1') || $request->input('operator6') || $request->input('digit6_2') || $request->input('answer6'))
            {
                $arr_rules['digit6_1']   = 'required';
                $arr_rules['operator6']  = 'required';
                $arr_rules['digit6_2']   = 'required';
                $arr_rules['answer6']    = 'required';
            }
            
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));

            if($request->input('digit2_1'))
            {
                $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                $arr_data['operator2'] = trim($request->input('operator2'));
                $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
            }

            if($request->input('digit3_1'))
            {
                $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                $arr_data['operator3'] = trim($request->input('operator3'));
                $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                $arr_data['answer3'] = trim($request->input('answer3'));
            }
            if($request->input('digit4_1'))
            {
                $arr_data['digit4_1'] = trim($request->input('digit4_1'));
            }
            if($request->input('operator4'))
            {
                $arr_data['operator4'] = trim($request->input('operator4'));
            }
            if($request->input('digit4_2'))
            {
                $arr_data['digit4_2'] = trim($request->input('digit4_2'));
            }
            if($request->input('answer4'))
            {
                $arr_data['answer4'] = trim($request->input('answer4'));
            }

            if($request->input('digit5_1'))
            {
                $arr_data['digit5_1'] = trim($request->input('digit5_1'));
            }
            if($request->input('operator5'))
            {
                $arr_data['operator5'] = trim($request->input('operator5'));
            }
            if($request->input('digit5_2'))
            {
                $arr_data['digit5_2'] = trim($request->input('digit5_2'));
            }
            if($request->input('answer5'))
            {
                $arr_data['answer5'] = trim($request->input('answer5'));
            }

            if($request->input('digit6_1'))
            {
                $arr_data['digit6_1'] = trim($request->input('digit6_1'));
            }
            if($request->input('operator6'))
            {
                $arr_data['operator6'] = trim($request->input('operator6'));
            }
            if($request->input('digit6_2'))
            {
                $arr_data['digit6_2'] = trim($request->input('digit6_2'));
            }
            if($request->input('answer6'))
            {
                $arr_data['answer6'] = trim($request->input('answer6'));
            }

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 40 */
        else if($request->input('templateId')==40)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['duration']   = 'required';
            
            $arr_rules['question1_1']   = 'required';
            $arr_rules['question1_2']   = 'required';
            $arr_rules['operator1']   = 'required';

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1'));
            $arr_data['question1_2'] = trim($request->input('question1_2'));
            $arr_data['answer_1'] = trim($request->input('operator1'));
            
            $arr_data['question2_1'] = trim($request->input('question2_1'));
            $arr_data['question2_2'] = trim($request->input('question2_2'));
            $arr_data['answer_2'] = trim($request->input('operator2'));

            $arr_data['question3_1'] = trim($request->input('question3_1'));
            $arr_data['question3_2'] = trim($request->input('question3_2'));
            $arr_data['answer_3'] = trim($request->input('operator3'));

            $arr_data['question4_1'] = trim($request->input('question4_1'));
            $arr_data['question4_2'] = trim($request->input('question4_2'));
            $arr_data['answer_4'] = trim($request->input('operator4'));

            $arr_data['question5_1'] = trim($request->input('question5_1'));
            $arr_data['question5_2'] = trim($request->input('question5_2'));
            $arr_data['answer_5'] = trim($request->input('operator5'));
            
            $arr_data['question6_1'] = trim($request->input('question6_1'));
            $arr_data['question6_2'] = trim($request->input('question6_2'));
            $arr_data['answer_6'] = trim($request->input('operator6'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 41 */
        else if($request->input('templateId')==41)
        {
            $arr_rules['direction']     = 'required';
            $arr_rules['question1_1']   = 'required';
            $arr_rules['question1_2']   = 'required';
            $arr_rules['operator1']     = 'required';

/*          $arr_rules['question2_1']   = 'required';
            $arr_rules['question2_2']   = 'required';
            $arr_rules['operator2']   = 'required';

            $arr_rules['question3_1']   = 'required';
            $arr_rules['question3_2']   = 'required';
            $arr_rules['operator3']   = 'required';*/

            $arr_rules['duration']   = 'required';

            if($request->input('question4_1') || $request->input('question4_2') || $request->input('operator4'))
            {
                $arr_rules['question4_1']   = 'required';
                $arr_rules['question4_2']   = 'required';
                $arr_rules['operator4']     = 'required';
            }

            if($request->input('question5_1') || $request->input('question5_2') || $request->input('operator5'))
            {
                $arr_rules['question5_1']   = 'required';
                $arr_rules['question5_2']   = 'required';
                $arr_rules['operator5']     = 'required';
            }

            if($request->input('question6_1') || $request->input('question6_2') || $request->input('operator6'))
            {
                $arr_rules['question6_1']   = 'required';
                $arr_rules['question6_2']   = 'required';
                $arr_rules['operator6']     = 'required';
            }

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1',''));
            $arr_data['question1_2'] = trim($request->input('question1_2',''));
            $arr_data['answer_1'] = trim($request->input('operator1'));
            
            $arr_data['question2_1'] = trim($request->input('question2_1',''));
            $arr_data['question2_2'] = trim($request->input('question2_2',''));
            $arr_data['answer_2'] = trim($request->input('operator2',''));

            $arr_data['question3_1'] = trim($request->input('question3_1',''));
            $arr_data['question3_2'] = trim($request->input('question3_2',''));
            $arr_data['answer_3'] = trim($request->input('operator3',''));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration',''));
            $question4_1 = null;
            if($request->input('question4_1'))
            {
                $question4_1 = $request->input('question4_1');
            }
            $arr_data['question4_1'] = $question4_1;
            $question4_2 = null;
            if($request->input('question4_2'))
            {
                $question4_2 = $request->input('question4_2');
            }
            $arr_data['question4_2'] = $question4_2;
            $operator4 = null;
            if($request->input('operator4'))
            {
                $operator4 = $request->input('operator4');
            }
            $arr_data['answer_4'] = $operator4;

            $question5_1 = null;
            if($request->input('question5_1'))
            {
                $question5_1 = $request->input('question5_1');
            }
            $arr_data['question5_1'] = $question5_1;
            $question5_2 = null;
            if($request->input('question5_2'))
            {
                $question5_2 = $request->input('question5_2');
            }
            $arr_data['question5_2'] = $question5_2;
            $operator5 = null;
            if($request->input('operator5'))
            {
                $operator5 = $request->input('operator5');
            }
            $arr_data['answer_5'] = $operator5;
            
            $question6_1 = null;
            if($request->input('question6_1'))
            {
                $question6_1 = $request->input('question6_1');
            }
            $arr_data['question6_1'] = $question6_1;
            $question6_2 = null;
            if($request->input('question6_2'))
            {
                $question6_2 = $request->input('question6_2');
            }
            $arr_data['question6_2'] = $question6_2;
            $operator6 = null;
            if($request->input('operator6'))
            {
                $operator6 = $request->input('operator6');
            }
            $arr_data['answer_6'] = $operator6;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 42 */
        else if($request->input('templateId')==42)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1_1'] = 'required';
            $arr_rules['answer1_1']   = 'required';
            $arr_rules['answer1_2']   = 'required';
            $arr_rules['duration']    = 'required';

            if($request->input('question4_1') || $request->input('answer4_1') || $request->input('answer4_2'))
            {
                $arr_rules['question4_1']   = 'required';
                $arr_rules['answer4_1']   = 'required';
                $arr_rules['answer4_2']   = 'required';
            }

            if($request->input('question5_1') || $request->input('answer5_1') || $request->input('answer5_2'))
            {
                $arr_rules['question5_1']   = 'required';
                $arr_rules['answer5_1']   = 'required';
                $arr_rules['answer5_2']   = 'required';
            }

            if($request->input('question6_1') || $request->input('answer6_1') || $request->input('answer6_2'))
            {
                $arr_rules['question6_1']   = 'required';
                $arr_rules['answer6_1']   = 'required';
                $arr_rules['answer6_2']   = 'required';
            }

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));

            $arr_data['question1'] = trim($request->input('question1_1',''));
            $arr_data['answer1']   = trim($request->input('answer1_1','')).','.trim($request->input('answer1_2',''));

            $arr_data['question2'] = trim($request->input('question2_1',''));
            $arr_data['answer2']   = trim($request->input('answer2_1','')).','.trim($request->input('answer2_2',''));
            
            $arr_data['question3'] = trim($request->input('question3_1',''));
            $arr_data['answer3']   = trim($request->input('answer3_1','')).','.trim($request->input('answer3_2',''));
            $arr_data['duration']  = gmdate('H:i:s', $request->input('duration'));
            $question4 = null;
            if($request->input('question4_1'))
            {
                $question4 = $request->input('question4_1');
            }
            $arr_data['question4'] = $question4;
            $answer4 = null;
            if($request->input('answer4_1') && $request->input('answer4_2'))
            {
                $answer4 = $request->input('answer4_1').','.$request->input('answer4_2');
            }
            $arr_data['answer4'] = $answer4;
            
            $question5 = null;
            if($request->input('question5_1'))
            {
                $question5 = $request->input('question5_1');
            }
            $arr_data['question5'] = $question5;
            $answer5 = null;
            if($request->input('answer5_1') && $request->input('answer5_2'))
            {
                $answer5 = $request->input('answer5_1').','.$request->input('answer5_2');
            }
            $arr_data['answer5'] = $answer5;

            $question6 = null;
            if($request->input('question6_1'))
            {
                $question6 = $request->input('question6_1');
            }
            $arr_data['question6'] = $question6;
            $answer6 = null;
            if($request->input('answer6_1') && $request->input('answer6_2'))
            {
                $answer6 = $request->input('answer6_1').','.$request->input('answer6_2');
            }
            $arr_data['answer6'] = $answer6;

            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 43 */
        else if($request->input('templateId')==43)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']      = 'required';
/*            $arr_rules['question2']   = 'required';
            $arr_rules['answer2']      = 'required';
            $arr_rules['question3']   = 'required';
            $arr_rules['answer3']      = 'required';*/
            $arr_rules['duration']      = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            //upload & copy code of image
            if($request->hasFile('flQuestion'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion'),570,540);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_file) && $arrQuestion->question_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_file);
                        }
                    }
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_file'] = $newfileName;
                }
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3'] = trim($request->input('answer3'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
         /* Template : 34 */
        else if($request->input('templateId')==44)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['digit1_1']   = 'required';
            $arr_rules['row']        = 'required';
            $arr_rules['column']     = 'required';
            $arr_rules['operator1']  = 'required';
            $arr_rules['digit1_2']   = 'required';
            $arr_rules['answer1']    = 'required';
            $arr_rules['duration']    = 'required';
            /*$arr_rules['flHorn']     = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }
            
            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['table_from'] = trim($request->input('row'));
            $arr_data['table_to'] = trim($request->input('column'));
            $arr_data['digit1_1'] = trim($request->input('digit1_1'));
            $arr_data['operator1'] = trim($request->input('operator1'));
            $arr_data['digit1_2'] = trim($request->input('digit1_2'));
            $arr_data['answer1'] = trim($request->input('answer1'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 45 */
        else if($request->input('templateId')==45)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            
            /*$arr_rules['flQuestion1'] = 'required';*/
            $arr_rules['question1_1']   = 'required';
            $arr_rules['answer1_1']      = 'required';
            /*$arr_rules['question1_2']   = 'required';
            $arr_rules['answer1_2']      = 'required';
            $arr_rules['question1_3']   = 'required';
            $arr_rules['answer1_3']      = 'required';*/

            /*$arr_rules['flQuestion2'] = 'required';*/
            $arr_rules['question2_1']   = 'required';
            $arr_rules['answer2_1']      = 'required';
            /*$arr_rules['question2_2']   = 'required';
            $arr_rules['answer2_2']      = 'required';
            $arr_rules['question2_3']   = 'required';
            $arr_rules['answer2_3']      = 'required';*/
            $arr_rules['duration']      = 'required';

            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'),429,269);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_1_file) && $arrQuestion->question_1_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_1_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_1_file);
                        }
                    }
                    $arr_data['question_1_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_1_file)?$arrQuestion->question_1_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_1_file'] = $newfileName;
                }
            }

            if($request->hasFile('flQuestion2'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion2'),429,269);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_2_file) && $arrQuestion->question_2_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_2_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_2_file);
                        }
                    }
                    $arr_data['question_2_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_2_file)?$arrQuestion->question_2_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_2_file'] = $newfileName;
                }
            }            

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));

            $arr_data['question1_1'] = trim($request->input('question1_1'));
            $arr_data['answer1_1'] = trim($request->input('answer1_1'));
            $arr_data['question1_2'] = trim($request->input('question1_2'));
            $arr_data['answer1_2'] = trim($request->input('answer1_2'));
            $arr_data['question1_3'] = trim($request->input('question1_3'));
            $arr_data['answer1_3'] = trim($request->input('answer1_3'));

            $arr_data['question2_1'] = trim($request->input('question2_1'));
            $arr_data['answer2_1'] = trim($request->input('answer2_1'));
            $arr_data['question2_2'] = trim($request->input('question2_2'));
            $arr_data['answer2_2'] = trim($request->input('answer2_2'));
            $arr_data['question2_3'] = trim($request->input('question2_3'));
            $arr_data['answer2_3'] = trim($request->input('answer2_3'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 46 */
        else if($request->input('templateId')==46)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['answer1']     = 'required';
            $arr_rules['duration']    = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

/*          if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'));
                if(isset($fileName) && $fileName!=false)
                {
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $fileExtension    = explode(".", $old_file_name);
                $extension        = isset($fileExtension[1])?$fileExtension[1]:'jpg';

                $newfileName      = date('dmY').time().'.'.$extension;
                $old_file_path    = $this->question_image_thumb_base_path.$old_file_name;

                $new_file_path    = $this->question_image_thumb_base_path.$newfileName;
                copy($old_file_path,$new_file_path);
                $arr_data['question_file'] = $newfileName;
            }*/

            //upload & copy code of image
            if($request->hasFile('flQuestion1'))
            {
                $fileName = $this->uploadFile($request->file('flQuestion1'),570,442);
                if(isset($fileName) && $fileName!=false)
                {
                    if(isset($arrQuestion->question_file) && $arrQuestion->question_file!='')
                    {
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion->question_file))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion->question_file);
                        }
                    }
                    $arr_data['question_file'] = $fileName;
                }
            }
            else
            {   
                $old_file_name    = isset($arrQuestion->question_file)?$arrQuestion->question_file:'';
                $newfileName      = $this->copyFile($old_file_name,'image');
                if(isset($newfileName) && $newfileName!=false)
                {
                    $arr_data['question_file'] = $newfileName;
                }
            }

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question1'));
            $arr_data['answer_1'] = trim($request->input('answer1'));
            $arr_data['question_2'] = trim($request->input('question2'));
            $arr_data['answer_2'] = trim($request->input('answer2'));
            $arr_data['question_3'] = trim($request->input('question3'));
            $arr_data['answer_3'] = trim($request->input('answer3'));
            $arr_data['question_4'] = trim($request->input('question4'));
            $arr_data['answer_4'] = trim($request->input('answer4'));
            $arr_data['question_5'] = trim($request->input('question5'));
            $arr_data['answer_5'] = trim($request->input('answer5'));
            $arr_data['question_6'] = trim($request->input('question6'));
            $arr_data['answer_6'] = trim($request->input('answer6'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 47 */
        else if($request->input('templateId')==47)
        {
            /*dump($request->all());*/
            $arr_rules['direction'] = 'required';
            $arr_rules['duration'] = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('question'))
            {
                return json_encode([
                        'errors' => 'question',
                        'code' => 422,
                        'status' => 'question',
                    ]);
            }
            if(!$request->input('chkBlankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'chkBlankLetter',
                    ]);
            }


            $strQuestionText = $strAnswerText = '';
            if($request->input('question'))
            {
                if(count($request->input('question')) > 0)
                {
                    $arrCnt = 1;
                    foreach ($request->input('question') as $questionVal)
                    {
                        if($request->input('chkBlankLetter'))
                        {
                            if(count($request->input('chkBlankLetter')) > 0)
                            {
                                if(in_array($arrCnt, $request->input('chkBlankLetter')))
                                {
                                    $strAnswerText.='0'.',';
                                }
                                else
                                {
                                    $strAnswerText.='1'.',';
                                }
                            }
                        }
                        else
                        {
                            $strAnswerText.='1'.',';
                        }
                        $strQuestionText.=$questionVal.',';
                        $arrCnt++;
                    }
                }   
            }
            $strQuestionText = rtrim($strQuestionText, ',');
            $strAnswerText   = rtrim($strAnswerText, ',');

            $arr_data['program_id']    = $programId;
            $arr_data['created_by']    = $created_by;
            $arr_data['question']      = trim($request->input('direction'));
            $arr_data['question_text'] = $strQuestionText;
            $arr_data['answer']        = $strAnswerText;
            $arr_data['duration']      = gmdate('H:i:s', $request->input('duration'));
            /*dd($arr_data);*/
            $result = $this->$moduleName->create($arr_data);

        }
        /* TEMPLATE : 48 */
        else if($request->input('templateId')==48)
        {
            /*dump($request->all());
            dd('TEMPLATE2');*/
            $arr_rules['direction'] = 'required';
            $arr_rules['question'] = 'required';
            $arr_rules['duration'] = 'required';
            /*$arr_rules['flHorn'] = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            if(!$request->input('blankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            
            if(!$request->input('chkBlankLetter'))
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }

            $strAns = '';
            if(count($request->input('blankLetter')) > 0)
            {
                foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                {
                    if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                    {
                        $strAns.=0;
                    }
                    else
                    {
                        $strAns.=1;
                    }
                }
            }
            if($strAns=='')
            {
                return json_encode([
                        'errors' => 'chkBlankLetter',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
            }
            else
            {
                $arr_data['answer_position'] = $strAns;
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question'));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);

        }
        /* Template : 49 */
        else if($request->input('templateId')==49)
        {
            /*dd($request->all());*/
            $arr_rules['direction']  = 'required';
            $arr_rules['question']   = 'required';
            $arr_rules['option_1']   = 'required';
            $arr_rules['rdoOption']  = 'required';
            $arr_rules['duration']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/

            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question']   = trim($request->input('direction'));
            $arr_data['question_1'] = trim($request->input('question',''));
            $arr_data['option_1']   = trim($request->input('option_1',''));
            $arr_data['option_2']   = trim($request->input('option_2',''));
            $arr_data['option_3']   = trim($request->input('option_3',''));
            $arr_data['option_4']   = trim($request->input('option_4',''));
            $arr_data['answer']     = trim($request->input('rdoOption',''));
            $arr_data['duration']   = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        /* Template : 50 */
        else if($request->input('templateId')==50)
        {
            /*dd($request->all());*/
            $arr_rules['direction']   = 'required';
            $arr_rules['question1']   = 'required';
            $arr_rules['question2']   = 'required';
            $arr_rules['option_1']   = 'required';
            $arr_rules['rdoOption1']   = 'required';
            /*$arr_rules['flHorn']      = 'required';*/
            $arr_rules['duration']      = 'required';

            $validator = Validator::make($request->all(), $arr_rules);
            if($validator->fails())
            {
                return json_encode([
                    'errors' => $validator->errors()->getMessages(),
                    'code' => 422,
                    'status' => 'fail',
                ]);
            }

            /*if($request->hasFile('flHorn'))
            {
                $fileName = $request->file('flHorn');
                $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                if(in_array($fileExtension, ['mp3','wave','m4a']))
                {
                    $fileName = date('dmY').time().'.'.$fileExtension;
                    $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                    if($isUpload)
                    {
                        $arr_data['horn'] = $fileName;
                    }
                }
                else
                {
                    return json_encode([
                        'errors' => 'flHorn',
                        'code' => 422,
                        'status' => 'fail',
                    ]);
                }
            }*/
            $arr_data['program_id'] = $programId;
            $arr_data['created_by'] = $created_by;
            $arr_data['question'] = trim($request->input('direction'));
            $arr_data['question_1'] = date('H:i', strtotime($request->input('question1')));
            $arr_data['question_2'] = date('H:i', strtotime($request->input('question2')));
            $arr_data['option_1'] = trim($request->input('option_1',''));
            $arr_data['option_2'] = trim($request->input('option_2',''));
            $arr_data['option_3'] = trim($request->input('option_3',''));
            $arr_data['option_4'] = trim($request->input('option_4',''));
            $arr_data['answer'] = trim($request->input('rdoOption1',''));
            $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
            $result = $this->$moduleName->create($arr_data);
        }
        if($result)
        {
            $questionId = $result->id;
            $arr_question = [];
            $arr_question = $this->$moduleName->where('id', '=', $questionId)->first();
            if(count($arr_question) > 0)
            {
                $arr_question = $arr_question->toArray();
                $this->template_data['arr_question'] = $arr_question;
                $this->template_data['default_base_img_path']     = $this->default_base_img_path;
                $this->template_data['default_public_img_path']   = $this->default_public_img_path;
                $this->template_data['template_base_img_path']    = $this->template_base_img_path;
                $this->template_data['template_public_img_path']  = $this->template_public_img_path;

                $this->template_data['question_image_base_path']  = $this->question_image_base_path;
                $this->template_data['question_image_public_path']= $this->question_image_public_path;
                $this->template_data['question_video_base_path']  = $this->question_video_base_path;
                $this->template_data['question_video_public_path']= $this->question_video_public_path;
                $this->template_data['question_audio_base_path']  = $this->question_audio_base_path;
                $this->template_data['question_audio_public_path']= $this->question_audio_public_path;
            }

            $resp['status'] = 'success';
            $view = view($this->module_view_folder.'.template_'.$templateId,$this->template_data);
            $resp['view'] = $view->render();
        }
        return response()->json($resp);
    }
    public function uploadFile($file,$width=570,$height=442)
    {
            $isUpload = false;
            $fileExtension = strtolower($file->getClientOriginalExtension());
            if(in_array($fileExtension, ['png','jpg','jpeg']))
            {
                $random_no   = $this->generate_random_no();
                $fileName    = date('dmY').time().$random_no.'.'.$fileExtension;

                $imageThumb  = Image::make($file);
                $imageThumb->resize($width,$height);
                $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                $isUpload    = $file->move($this->question_image_base_path, $fileName);
                if($isUpload)
                {
                   return $fileName;
                }
            }
            return $isUpload;
    }
    public function uploadVideoFile($file)
    {
        $isUpload = false;
        $fileExtension = strtolower($file->getClientOriginalExtension());
        if(in_array($fileExtension,['mp4']))
        {
            $fileName = date('dmY').time().'.'.$fileExtension;
            $isUpload = $file->move($this->question_video_base_path,$fileName);
            if($isUpload)
            {
               return $fileName;
            }
        }
        return $isUpload;
    }
    public function uploadAudioFile($file)
    {
        $isUpload = false;
        $fileExtension = strtolower($file->getClientOriginalExtension());
        if(in_array($fileExtension, ['mp3','wave','m4a']))
        {
            $fileName = date('dmY').time().'.'.$fileExtension;
            $isUpload = $file->move($this->question_audio_base_path, $fileName);
            if($isUpload)
            {
              return $fileName;
            }
        }
        return $isUpload;
    }
    public function copyFile($old_file_name,$type)
    {
        if(isset($old_file_name) && $old_file_name!="")
        {
            if($type=='image')
            {
                $ext = 'jpg';
                $path = $this->question_image_thumb_base_path;
            }
            elseif($type=='video')
            {
                $ext = 'mp4';
                $path = $this->question_video_base_path;
            }
            elseif($type=='audio')
            {
                $ext = 'mp3';
                $path = $this->question_audio_base_path;
            }
            $random_no   = $this->generate_random_no();
            $fileExtension    = explode(".", $old_file_name);
            $extension        = isset($fileExtension[1])?$fileExtension[1]:$ext;
            $newfileName      = date('dmY').time().$random_no.'.'.$extension;
            $old_file_path    = $path.$old_file_name;
            if(file_exists($old_file_path))
            {
                $new_file_path    = $path.$newfileName;
                copy($old_file_path,$new_file_path);
                return $newfileName;
            } 
           
        }
        return false;
    }
    public function generate_random_no()
    {
        $digits = 3;
        $random_no =  rand(pow(10, $digits-1), pow(10, $digits)-1);
        return $random_no;
    }
}