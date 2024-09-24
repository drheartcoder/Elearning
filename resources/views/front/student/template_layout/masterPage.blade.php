@php
    require(base_path().'/BrowserDetection.php');
    $browser = new Wolfcast\BrowserDetection();
    $browser_name = strtolower($browser->getName());
@endphp
<noscript style="color: red"><center><h1>Please enable JavaScript in your browser for better use of the website.</h1></center></noscript>
<script type="text/javascript">
    var formData = new FormData();
</script>
<script src="{{url('/')}}/js/front/DetectRTC.js"> </script>
@if($browser_name == 'internet explorer')
<!-- JS and Code For Flash Audio Start -->
<script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/swfobject.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/recorder.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/basic.js"></script>
<link type="text/css" rel="stylesheet" href="{{url('/')}}/js/front/flash-recording/css/basic.css">

<button style="display: none" class="start-recording" id="flash_record" onclick="FWRecorder.record('audio', 'audio.wav');"></button>
<button style="display: none" class="start-playing" id="flash_record_play" onclick="FWRecorder.playBack('audio');" title="Play"></button>
<!-- JS and Code For Flash Audio End-->
@endif
<!--Template Section Starts-->
<div id="templateResult">
    @include('front.'.$templateContent)
</div>

<!-- Modal for daily lesson limit exceed start-->
<div id="popup_lesson_limit" class="modal fade inner-page-modal remove-class-modal change-lesson" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h4 id="popup_lesson_limit_msg"></h4>
                <div class="modal-button-section">
                    <button type="button" class="full-fill-button border-button sim-button-blue yes_button" data-dismiss="modal">{{trans('teacher.Ok')}}</button>
                    <div class="home-work-btn">
                        <button type="button" style="display: none" class="full-fill-button sim-button gotToHomework" data-dismiss="modal">{{trans('student.Go_to_Homework')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="remaining_minutes" name="remaining_minutes" id="remaining_minutes" readonly="" value="">
<input type="hidden" class="remaining_seconds" name="remaining_seconds" id="remaining_seconds" readonly="" value="">
<!-- Modal for daily lesson limit exceed end--> 
<input type="hidden" readonly="" id="program_slug" name="program_slug">
<input type="hidden" readonly="" id="subject_id" name="subject_id">

<!-- Modal for next lesson start-->
<div id="popup_next_lesson" class="modal fade inner-page-modal remove-class-modal change-lesson" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 id="popup_lesson_limit_msg">{{trans('student.Would_you_like_to_continue')}}</h4>
                <div class="modal-button-section">
                    <button type="button" class="full-fill-button border-button sim-button-blue yes_button" data-dismiss="modal">{{trans('student.No')}}</button>
                    <button type="button" class="full-fill-button border-button sim-button-blue gotToNextLesson" data-dismiss="modal">{{trans('student.Yes')}}</button>
                    <div class="home-work-btn">
                        <button type="button" style="display: none" class="full-fill-button sim-button gotToHomework" data-dismiss="modal">{{trans('student.Go_to_Homework')}}</button>
                    </div>
                 </div>
             </div>
        </div>
    </div>
</div>
<!-- Modal for next lesson end--> 
    
<!--Template section end-->

@if($browser_name != 'internet explorer')
<!-- JS and Code For Other Browser Audio Start -->
<audio controls style="display: none" id="audio"></audio>
<a class="button" style="display: none" id="record">Record</a>
<a class="button" style="display: none" id="play">Play</a>

<script type="text/javascript" src="{{ url('/') }}/js/front/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/recording/src/recorder.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/recording/src/Fr.voice.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/recording/js/app.js"></script>
<!-- JS and Code For Other Browser Audio End-->
@endif
<script type="text/javascript">

    jQuery(document).ready(function($) {
      if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, '');
            $(window).on('popstate', function() {
                window.location.reload();
            });
        }
    });
    
    $('.yes_button').on('click',function(){
        var program_slug = $('#program_slug').val();
        if(program_slug!=false)
        {
            window.location.href = SITE_URL+'/student/program/details/'+program_slug;
        }
        else
        {
            window.location.href = SITE_URL+'/student/dashboard';
        }
    });

    $('.gotToNextLesson').on('click',function(){
        nextQuestion('manual','yes');
    });

    $('.gotToHomework').on('click',function(){
        var subject_id   = $('#subject_id').val();
        var program_slug = $('#program_slug').val();
        if(subject_id!='')
        {
            window.location.href = SITE_URL+'/student/homework/?program='+program_id+'&subject='+subject_id+'&lesson='+lesson_id;
        }
        else
        {
            window.location.href = SITE_URL+'/student/program/details/'+program_slug;
        }
    });
    /* Go To Next Question */
    function nextQuestion(type,confirm=false)
    {                
        var isAudioRequired    = $('#recordButton').data('id');
        var answer_time        = "00:00:00";
        var remaining_seconds  = $('#remaining_seconds').val();
        var remaining_minutes  = $('#remaining_minutes').val();
        if((sessionStorage.getItem('remaining_minutes_'+storage_id)!=null && sessionStorage.getItem('remaining_minutes_'+storage_id)!=undefined) && (sessionStorage.getItem('remaining_seconds_'+storage_id)!=null && sessionStorage.getItem('remaining_seconds_'+storage_id)!=undefined))
        {
            remaining_minutes   = (isNaN(sessionStorage.getItem('remaining_minutes_'+storage_id))) ? 0 : sessionStorage.getItem('remaining_minutes_'+storage_id);
            remaining_seconds   = (isNaN(sessionStorage.getItem('remaining_seconds_'+storage_id))) ? 0 : sessionStorage.getItem('remaining_seconds_'+storage_id);
        }
        var current_time = "00:"+remaining_minutes+":"+remaining_seconds;
        formData.append('_token', csrf_token);
        formData.append('type', type);
        formData.append('program_id', program_id);
        formData.append('lesson_id', lesson_id);
        formData.append('current_template_id', template_id);
        formData.append('current_question_id', question_id);
        formData.append('template_id', next_question_template_id);
        formData.append('question_id', next_question_id);
        formData.append('current_time', current_time);
        formData.append('actual_time', actual_time);
        formData.append('next_question_confirmation', 'no');
        if(confirm=='yes'){
            formData.append('next_question_confirmation', 'yes');
        }

        if(isAudioRequired=='yes' && is_answer=='no')
        {
            if(sessionStorage.getItem('isRecorded_'+storage_id)=='no')
            {
                $('#wrong_answer_msg_box').hide();
                $('#right_answer_msg_box').hide();
                $('#answer_not_recorded_msg_box').show();
                return false;
            }
        }
        CallToNextQuestion(formData);
    }

    /* Give Call To Next Function */
    function CallToNextQuestion(data)
    {
        sessionStorage.removeItem('isRecorded_'+storage_id);
        sessionStorage.removeItem('isRecordingStart_'+storage_id);
        sessionStorage.removeItem('remaining_minutes_'+storage_id);
        sessionStorage.removeItem('remaining_seconds_'+storage_id);
        $('#hm_timer_'+uniqid).countdowntimer('clearTime');

        $.ajax({
                  type: 'POST',
                  url: SITE_URL+'/student/program/next_question',
                  contentType: false,
                  processData: false,
                  async: false,
                  cache: false,
                  data: data,
                  success: function(resultData) {
                    if(resultData.status=="fail")
                    {
                        $('.gotToHomework').hide();
                        if(resultData.type=='daily_limit')
                        {
                            $('#program_slug').val(resultData.program_slug);
                            $('#subject_id').val(resultData.subject_id);
                            if(resultData.homework_count > 0)
                            {
                                $('.gotToHomework').show();
                            }
                            $('#popup_lesson_limit_msg').html(resultData.msg);
                            $('#popup_lesson_limit').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                        }
                        if(resultData.type=='next_lesson')
                        {
                            $('#program_slug').val(resultData.program_slug);
                            $('#subject_id').val(resultData.subject_id);
                            if(resultData.homework_count > 0)
                            {
                                $('.gotToHomework').show();
                            }
                            $('#popup_next_lesson').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                        }
                        return false;
                    }
                    else if(resultData.status=="complete")
                    {
                        window.location.href = SITE_URL+'/student/program/certificate/'+resultData.program_slug;
                    }
                    else
                    {
                        $('#templateResult').html('');
                        $('#templateResult').html(resultData);
                        if(is_answer=='no')
                        {
                            playHorn();
                        }
                    }
                }
            });
    }

    /* Go To Previous Question */
    function previousQuestion()
    {
        $.ajax({
              type: 'POST',
              url: SITE_URL+'/student/program/previous_question',
              async: false,
              cache: false,
              data: {
                        _token      : csrf_token,
                        program_id  : program_id,
                        lesson_id   : lesson_id,
                        template_id : previous_question_template_id,
                        question_id : previous_question_id
                    },
              success: function(resultData) {
                if(resultData.msg=="fail")
                {
                    window.location.href = SITE_URL+'/student/dashboard';
                }
                else
                {
                   $("#templateResult").removeData();
                   $('#templateResult').html('');
                   $('#templateResult').html(resultData);
                   if(is_answer=='no')
                    {
                        playHorn();
                    }
                }
            }
        });
    }

    /* Insert Wrong attempts for question */
    function insertWrongAttempts()
    {
        $.ajax({
              type: 'POST',
              url: SITE_URL+'/student/program/wrong_attempts',
              data: {
                        _token      : csrf_token,
                        program_id  : program_id,
                        lesson_id   : lesson_id,
                        template_id : template_id,
                        question_id : question_id
                    },
              success: function(resultData) {
            }
        });
    }

    $(function(){
        if($(".game-img-section").height() != 'undefined')
        { $(".game-fill-text-section").css('height', $(".game-img-section").height()); }
    });
    
</script>