<!--select css-->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/front/select2.min.css"/>  
<!-- bredcrum section -->
<div class="bredcrum-section-main">
    <div class="container">
        <div class="page-title-main">
            {{$pageTitle}}
        </div>
        <div class="page-bredcrum-section">
            <ul>
                <li><a href="{{ url('/') }}/student/dashboard">{{trans('parent.Dashboard')}}</a> &nbsp;&nbsp; <i class="fa fa-angle-right"></i> &nbsp;&nbsp; </li>
                <li>{{$pageTitle}}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- bredcrum section end -->
    
    <div class="gray-btn-main-section page-middle-section">
        <div class="container">  
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
                </div>
                @php
                 $lesson_id = '';
                @endphp
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    @if(isset($arr_programs) && count($arr_programs)>0)
                        <div class="select-style program-select">
                            <select class="frm-select program_select">
                                <option value="">{{trans('parent.Select_Program')}}</option>
                                @foreach($arr_programs as $key => $value)
                                    <option @if($value['program_details']['slug']==$slug) selected="" @endif value="{{$value['program_details']['slug']}}">{{isset($value['program_details']['name']) && $value['program_details']['name']!='' ? ucwords($value['program_details']['name']) : "N/A"}}</option>
                                @endforeach      
                            </select>
                        </div>
                        @endif
                        @if($slug!=false)
                        @if(isset($arr_program) && count($arr_program)>0)
                            @php $program_status = checkProgramStatus($arr_program[0]['program_id'],$arr_program[0]['student_id']) @endphp
                            <div class="program-section">
                                <div class="program-title">{{isset($arr_program[0]['program_details']['name']) && $arr_program[0]['program_details']['name']!='' ? ucwords($arr_program[0]['program_details']['name']) : "N/A"}}
                                    @if($program_status!='Pending')
                                        <span class="pull-right ml-10"><a href="{{url('/')}}/student/program/report/{{$slug}}" class="full-fill-button sim-button" title="{{trans('parent.Program_Report')}}"><i class="fa fa-file-text"></i></a></span>
                                    @endif
                                    @if($program_status=='Completed')
                                        <span class="pull-right ml-10"><a href="{{url('/')}}/student/program/certificate/{{$slug}}" class="full-fill-button sim-button" title="{{trans('parent.Program_Certificate')}}"><i class="fa fa-certificate"></i></a></span>
                                    @endif
                                </div>
                                <div class="program-details">
                                    <div class="pro-details-row">
                                        <label>{{trans('parent.Program_Name')}}</label>
                                        <p>{{isset($arr_program[0]['program_details']['name']) && $arr_program[0]['program_details']['name']!='' ? ucwords($arr_program[0]['program_details']['name']) : "N/A"}}</p>
                                    </div>
                                    <div class="pro-details-row">
                                        <label>{{trans('parent.No_of_Questions')}}</label>
                                        <p>{{QuestionCountInProgram($arr_program[0]['program_id'],$arr_program[0]['student_id'])}} {{trans('parent.Question')}}</p>
                                    </div>
                                    <div class="pro-details-row">
                                        <label>{{trans('parent.No_of_Lessons')}}</label>
                                        <p><a class="link">{{LessonCountInProgram($arr_program[0]['program_id'],$arr_program[0]['student_id'])}} {{trans('parent.Lessons')}}</a></p>
                                    </div>
                                    @php
                                        
                                        $is_exists = [];
                                        $count = 0;
                                    @endphp
                                    <div class="lesson-details">
                                       <div class="program-title">{{LessonCountInProgram($arr_program[0]['program_id'],$arr_program[0]['student_id'])}} {{trans('parent.Lessons')}}</div>
                                        <ul>
                                            @foreach($arr_program as $key => $value)
                                                @if(!in_array($value['lesson_id'],$is_exists))
                                                    @php
                                                        array_push($is_exists,$value['lesson_id'])
                                                    @endphp
                                                    @if($value['is_answer']=='no')
                                                        @if($lesson_id=='')
                                                            @php
                                                                $lesson_id = base64_encode($value['lesson_id']);
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @php
                                                        switch(CheckLessonStatus($value['program_id'],$value['lesson_id'],$value['student_id']))
                                                        {
                                                            case 'Pending':
                                                               $status = trans('parent.Pending');  
                                                               $label  = 'red-label';  
                                                            break;
                                                            case 'On-Going':
                                                               $status = trans('parent.On-Going');  
                                                               $label  = 'yellow-label';  
                                                            break;
                                                            case 'Completed':
                                                                $status = trans('parent.Completed');  
                                                                $label  = 'green-label';
                                                            break;
                                                            case 'default':
                                                                $status = trans('parent.Pending');  
                                                                $label  = 'red-label';
                                                            break;
                                                        }
                                                    @endphp
                                                    <li>{{isset($value['lesson_data']['name']) && $value['lesson_data']['name']!='' ? ucwords($value['lesson_data']['name']) : "N/A"}}  <span class="status-label {{ $label }}">{{ $status }}</span></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="pro-details-row">
                                        <label>{{trans('parent.Subject')}}</label>
                                        <p>{{isset($arr_program[0]['program_details']['subject_data']['name']) && $arr_program[0]['program_details']['subject_data']['name']!='' ? ucwords($arr_program[0]['program_details']['subject_data']['name']) : "N/A"}}</p>
                                    </div>
                                    <div class="pro-details-row">
                                        <label>{{trans('parent.Grade')}}</label>
                                        <p>{{isset($arr_program[0]['program_details']['grade_data']['name']) && $arr_program[0]['program_details']['grade_data']['name']!='' ? ucwords($arr_program[0]['program_details']['grade_data']['name']) : "N/A"}}</p>
                                    </div>
                                    @if($lesson_id!='')
                                    <div class="text-center">
                                        <a href="javascript:void(0)" onclick="reloadDetectRTC();"><button type="button" class="full-fill-button sim-button">{{trans('parent.Start')}}</button></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else
                        <center><h4>No Record Found</h4></center>
                    @endif
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="{{ url('/') }}/js/front/select2.min.js"></script> 
<script src="{{url('/')}}/js/front/DetectRTC.js"> </script>
<script type="text/javascript">
 
 $(document).ready(function(){
   $('.program_select').select2();
 });

$('.program_select').on('change',function(){
    var program = $.trim($(this).val());
    if(program!='')
    {
        var redirect_url = SITE_URL+'/student/program/details/'+program;
        window.location.href = redirect_url;
    }
});

function reloadDetectRTC() {
    DetectRTC.load(onDetectRTCLoaded);
}

function onDetectRTCLoaded() {
    var program_url = "{{url('/')}}/student/program/test/{{$slug}}/{{$lesson_id}}";
	window.location.href = program_url;
	/*if(DetectRTC.hasMicrophone==true)
    {
        if(DetectRTC.isWebsiteHasMicrophonePermissions==true){
            var program_url = "{{url('/')}}/student/program/test/{{$slug}}/{{$lesson_id}}";
            window.location.href = program_url;
        }
        else
        {
            swal("Please allow microphone in your browser setting to start program");
            return false;
        }
    }
    else
    {
        swal("You cannot start program. Because no microphone detected to your system.");
        return false;
    }*/
}

</script>