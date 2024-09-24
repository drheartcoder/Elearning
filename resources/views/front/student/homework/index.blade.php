@include('front.layout.bredcrum')

<div class="gray-btn-main-section my-student-middle-section print-report-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                 <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                 </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                     <div class="class-name-head-section">
                        {{ $pageTitle }}
                     </div>
                    <div class="homework-search">
                        <form method="get" id="form_serach_homework">
                            <div class="row">
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <div class="name-field">
                                            <select name="program" id="student_program">
                                                <option value="">{{trans('parent.Select_Program')}}</option>
                                                @if( isset($arr_program) && !empty($arr_program) )
                                                    @foreach($arr_program as $program)
                                                        <option value="{{ base64_encode($program['program_id']) }}" @if($search_program_id == base64_encode($program['program_id'])) selected @endif>{{ $program['program_details']['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <div class="name-field">
                                            <select name="subject" id="enc_subject">
                                                <option value="">{{trans('parent.Select_Subject')}}</option>
                                                @if( isset($arr_subject) && !empty($arr_subject) )
                                                    @foreach($arr_subject as $subject)
                                                        <option value="{{ base64_encode($subject['id']) }}" @if($search_subject_id == base64_encode($subject['id'])) selected @endif>{{ $subject['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <div class="name-field">
                                            <select name="lesson" id="enc_lesson">
                                                <option value="">{{trans('parent.Select_Lesson')}}</option>
                                                @if( isset($arr_lesson) && !empty($arr_lesson) )
                                                    @foreach($arr_lesson as $lesson)
                                                        <option value="{{ base64_encode($lesson['id']) }}" @if($search_lesson_id == base64_encode($lesson['id'])) selected @endif>{{ $lesson['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <div class="inline-btns">
                                        <button type="submit" id="btn_submit_parent_search_homework" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-search"></i></button>
                                        <a href="{{ $reset_link }}" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-retweet"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="file-wrapper">
                        <div class="row">
                            
                            @if(isset($arr_homework['data']) && !empty($arr_homework['data']))
                                @foreach($arr_homework['data'] as $key => $homework)

                                    <?php
                                        $file_html = "";
                                        $fileUrl   = "javascript:void(0)";
                                        if(isset($homework['file']) && $homework['file']!='')
                                        {
                                            if(file_exists($homework_file_base_img_path.$homework['file']))
                                            {
                                                $fileUrl = $homework_file_public_img_path.$homework['file'];
                                                $fileExt = strtolower(pathinfo($homework['file'], PATHINFO_EXTENSION));

                                                if($fileExt=='png' || $fileExt=='jpg' || $fileExt=='jpeg')
                                                {
                                                    $file_html = '<img src="'.$fileUrl.'" class="img-responsive" />';
                                                }
                                                else if($fileExt=='mp4')
                                                {
                                                    $file_html = '<video id="video1" controls width="190" height="80"><source src="'.$fileUrl.'" type="video/mp4" > Your browser does not support HTML5 video.</video>';
                                                }
                                                else if($fileExt=='pdf' || $fileExt=='txt')
                                                {
                                                    $file_html = '<img src="'.url('/').'/images/pdf-file.png" class="img-responsive"/>';
                                                }
                                                else if($fileExt=='docx' || $fileExt=='xlsx' || $fileExt=='pptx')
                                                {
                                                    $file_html = '<img src="'.url('/').'/images/doc-file.png" class="img-responsive"/>';
                                                }
                                            }
                                        }
                                    ?>

                                    <div class="col-xs-6 col-xs-6 col-sm-4 col-md-3 col-lg-3">
                                        <div class="file-block">
                                            <div class="file-img">{!! $file_html !!}</div>
                                            <a href="{{ $fileUrl }}" class="full-fill-button border-button sim-button-blue" data-dismiss="modal" download>{{trans('parent.Download')}}</a>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <div style="text-align: center;">{{trans('parent.No_homework_available')}}</div>
                            @endif

                        </div>
                    </div>

                    <div class="pagination-section-block">
                        <ul>{!! $arr_pagination !!}</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#enc_subject').change(function() {
    var subject_id = $('#enc_subject').val();
    getEncGrade(subject_id, '', 'add');
});

$('#enc_grade').change(function() {
    var subject_id = $('#enc_subject').val();
    var grade_id   = $('#enc_grade').val();

    getEncProgram(subject_id, grade_id, '', 'add');
});

$('#student_program').change(function() {
    var subject_id = $('#enc_subject').val();
    var grade_id   = $('#enc_grade').val();
    var program_id = $('#student_program').val();
    if(program_id!='')
    {
        getEncStundentLessonOptions(subject_id, grade_id, program_id, '', 'add');
        getSubject(program_id, '', 'add');
    }
});

function getEncGrade(subject_id = false, grade_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getencgrade",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_grade").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_grade").html(result);
            }
        }
    });
}

function getEncProgram(subject_id = false, grade_id = false, program_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getencprogram",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_program").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_program").html(result);
            }
        }
    });
}

function getEncStundentLessonOptions(subject_id = false, grade_id = false, program_id = false, lesson_id = false, event = false)
{
    $.ajax({
        url : SITE_URL+"/common/getEncStundentLessonOptions",
        type : "POST",
        data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id, lesson_id:lesson_id },
        success : function(result)
        {
            if(event == 'add')
            {
                $("#enc_lesson").html(result);
            }
            else if(event == 'edit')
            {
                $("#enc_edit_lesson").html(result);
            }
        }
    });
}

function getSubject(program_id = false)
{
    $.ajax({
        url : SITE_URL+"/common/getSubject",
        type : "POST",
        data : { _token:csrf_token, program_id:program_id},
        success : function(result)
        {
            $("#enc_subject").html(result);
        }
    });
}
</script>