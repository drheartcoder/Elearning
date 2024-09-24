@include('front.layout.bredcrum')

<div class="gray-btn-main-section my-student-middle-section print-report-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="class-name-head-section">
                    {{ $pageTitle }}
                </div>
                <div class="homework-search" style="{{ $search_option }}">
                    
                    <form method="get" id="form_serach_homework">
                        <div class="row">

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="name-field">
                                        <select name="subject" id="enc_homework_subject">
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
                                        <select name="grade" id="enc_homework_grade">
                                            <option value="">{{trans('parent.Select_Grade')}}</option>
                                            @if( isset($arr_grade) && !empty($arr_grade) )
                                                @foreach($arr_grade as $grade)
                                                    <option value="{{ base64_encode($grade['id']) }}" @if($search_grade_id == base64_encode($grade['id'])) selected @endif>{{ $grade['name'] }}</option>
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
                                        <select name="program" id="enc_homework_program">
                                            <option value="">{{trans('parent.Select_Program')}}</option>
                                            @if( isset($arr_program) && !empty($arr_program) )
                                                @foreach($arr_program as $program)
                                                    <option value="{{ base64_encode($program['id']) }}" @if($search_program_id == base64_encode($program['id'])) selected @endif>{{ $program['name'] }}</option>
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
                                        <select name="lesson" id="enc_homework_lesson">
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
                            
                            <div class="col-sm-4 col-md-4 col-lg-4">
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
                                    $fileUrl = "javascript:void(0)";
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
                                        else
                                        {
                                            $file_html = '<img src="'.url('/').'/images/default.jpg" class="img-responsive"/>';
                                        }
                                    }
                                    else
                                    {
                                        $file_html = '<img src="'.url('/').'/images/default.jpg" class="img-responsive"/>';
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
                            <div class="col-lg-12">
                            	<div class="no-record">{{ trans('parent.No_homework_available') }}</div>
                            </div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#enc_homework_subject").change(function(){
            var subject_id = $('#enc_homework_subject').val();
            getEncHomeworkGrade(subject_id, '');
        });

        $('#enc_homework_grade').change(function() {
            var subject_id = $('#enc_homework_subject').val();
            var grade_id   = $('#enc_homework_grade').val();

            getEncHomeworkProgram(subject_id, grade_id, '');
        });

        $('#enc_homework_program').change(function() {
            var subject_id = $('#enc_homework_subject').val();
            var grade_id   = $('#enc_homework_grade').val();
            var program_id = $('#enc_homework_program').val();

            getEncHomeworkLesson(subject_id, grade_id, program_id, '');
        });

        function getEncHomeworkGrade(subject_id = false, grade_id = false) {
            $.ajax({
                url : SITE_URL+"/common/getenchomeworkgrade",
                type : "POST",
                data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, user:"teacher" },
                success : function(result) {
                    $("#enc_homework_grade").html(result);
                }
            });
        }

        function getEncHomeworkProgram(subject_id = false, grade_id = false, program_id = false) {
            $.ajax({
                url : SITE_URL+"/common/getenchomeworkprogram",
                type : "POST",
                data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id, user:"teacher" },
                success : function(result) {
                    $("#enc_homework_program").html(result);
                }
            });
        }

        function getEncHomeworkLesson(subject_id = false, grade_id = false, program_id = false, lesson_id = false) {
            $.ajax({
                url : SITE_URL+"/common/getenchomeworklesson",
                type : "POST",
                data : { _token:csrf_token, subject_id:subject_id, grade_id:grade_id, program_id:program_id, lesson_id:lesson_id, user:"teacher" },
                success : function(result) {
                    $("#enc_homework_lesson").html(result);
                }
            });
        }
    });
</script>