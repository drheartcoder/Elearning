@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $arr_answer1 = explode(',',strtolower($arr_question['template27']['answer_1']));
    $arr_answer2 = explode(',',strtolower($arr_question['template27']['answer_2']));
    $arr_answer3 = explode(',',strtolower($arr_question['template27']['answer_3']));
    $maxlength1 = get_maxlength($arr_answer1);
    $maxlength2 = get_maxlength($arr_answer2);
    $maxlength3 = get_maxlength($arr_answer3);
@endphp
    <!--middle section-->
    <div class="middle-section temp-22-main-section temp-27-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template27']['question']) && $arr_question['template27']['question']!='' ? ucwords($arr_question['template27']['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        @if($current_question>1)
                            <div class="arrow-prev-section-block" onclick="previousQuestion()">
                                <a href="javascript:void(0);" class="arrow-prev-img">
                                    <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                    <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                                </a>
                            </div>
                        @endif
                        <div class="game-img-section">                            
                            <div class="question-section-txt">
                                <span class="ques-text-section">1. {{isset($arr_question['template27']['question_1']) && $arr_question['template27']['question_1']!='' ? ucwords($arr_question['template27']['question_1'])." : " : "N/A" }}</span>
                                <span class="temp-22-arrow-img-section">Ans.</span> 
                                <span class="temp-22-ques-text-section">
                                    @if(isset($arr_answer1) && count($arr_answer1)>0)
                                        @foreach($arr_answer1 as $key => $val)
                                            @if($arr_question['is_answer']=='yes')
                                                <input class="correct-ans" type="text" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question1" maxlength="1">
                                            @else
                                                <input class="actual-ans questionCls questionArr1" type="text" name="question_1_{{$key}}" id="question_1_{{$key}}" maxlength="{{$maxlength1}}" data-question="1" data-answer="{{$val}}" onkeyup="checkAnswer(this)" />
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="question-section-txt">
                                <span class="ques-text-section">2. {{isset($arr_question['template27']['question_2']) && $arr_question['template27']['question_2']!='' ? ucwords($arr_question['template27']['question_2'])." : " : "N/A" }}</span>
                                <span class="temp-22-arrow-img-section">Ans.</span> 
                                <span class="temp-22-ques-text-section">
                                    @if(isset($arr_answer2) && count($arr_answer2)>0)
                                        @foreach($arr_answer2 as $key => $val)
                                            @if($arr_question['is_answer']=='yes')
                                                <input class="correct-ans" type="text" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question1" maxlength="1">
                                            @else
                                                <input class="actual-ans questionCls questionArr2" type="text" name="question_2_{{$key}}" id="question_2_{{$key}}" maxlength="{{$maxlength2}}" data-question="2" data-answer="{{$val}}" onkeyup="checkAnswer(this)"/>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="question-section-txt">
                                <span class="ques-text-section">3. {{isset($arr_question['template27']['question_3']) && $arr_question['template27']['question_3']!='' ? ucwords($arr_question['template27']['question_3'])." : " : "N/A" }}</span>
                                <span class="temp-22-arrow-img-section">Ans.</span> 
                                <span class="temp-22-ques-text-section">
                                    @if(isset($arr_answer3) && count($arr_answer3)>0)
                                        @foreach($arr_answer3 as $key => $val)
                                            @if($arr_question['is_answer']=='yes')
                                                <input class="correct-ans" type="text" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question1" maxlength="1">
                                            @else
                                                <input class="actual-ans questionCls questionArr3" type="text" name="question_3_{{$key}}" id="question_3_{{$key}}" maxlength="{{$maxlength3}}" data-question="3" data-answer="{{$val}}" onkeyup="checkAnswer(this)"/>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                        @if($current_question<$total_question_count)
                            <div class="arrow-next-section-block" @if($arr_question['is_answer']=='yes') onclick="nextQuestion('manual')" @endif> 
                                <a href="javascript:void(0);" class="arrow-next-img">
                                    <img class="arrow-img" src="{{url('/')}}/images/template/question-next-arrow-img.png" alt="" />
                                    <img class="arrow-over-img" src="{{url('/')}}/images/template/question-next-arrow-over-img.png" alt="" />
                                </a>
                            </div>
                        @endif
                    </div>                    
                </div>                                
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="specker-mic-section">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template27']['horn']}}"></audio>
                        </button>
                        <button @if($arr_question['is_answer']=='no') id="recordButton" @endif data-id="yes">
                            <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                            <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6 tab-view-adjustment">
                    <div class="error-message-section error-show" style="display: none;" id="wrong_answer_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-oops-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section">
                            Oops, Try again!
                        </span>
                    </div>
                    <div class="error-message-section" style="display: none;" id="right_answer_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-funtastic-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section" id="right_answer_msg"></span>
                    </div>
                    <div class="error-message-section" style="display: none;" id="answer_not_recorded_msg_box">
                        <span class="error-img-section">
                            <img src="{{url('/')}}/images/template/error-funtastic-img.png" alt="error-img" />
                        </span>
                        <span class="error-txt-section"> Please Record your voice!</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="timer-section">
                        <div class="time-head-section">
                            <span>Min</span>
                            <span>Sec</span>
                        </div>
                        <div class="hm-timer-section">
                            <span id="hm_timer_{{$uniqid}}"></span>
                        </div>
                        <input type="hidden" name="remaining_minutes" id="remaining_minutes" readonly="" value="">
                        <input type="hidden" name="remaining_seconds" id="remaining_seconds" readonly="" value="">
                    </div>                     
                </div>
            </div>
            <span id="flashcontent"></span>                       
        </div>
    </div>
    <!--middle section end-->
    
    @php
        if($arr_question['is_answer']=='yes' || $arr_question['is_delay']=='yes')
        {
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template27']['duration']));
            $minutes     = date('i',strtotime($arr_question['template27']['duration']));
            $seconds     = date('s',strtotime($arr_question['template27']['duration']));
        }
        $actual_time = $arr_question['template27']['duration'];
        $template_id = base64_encode($arr_question['template_id']);
        $question_id = base64_encode($arr_question['question_id']);
    @endphp
@endif
<script type="text/javascript">
    
    var t_minutes                     = "{{$minutes}}";
    var t_seconds                     = "{{$seconds}}";
    var actual_time                   = "{{$actual_time}}";
    var program_id                    = "{{$program_id}}";
    var lesson_id                     = "{{$lesson_id}}";
    var template_id                   = "{{$template_id}}";
    var question_id                   = "{{$question_id}}";
    var next_question_template_id     = "{{$next_question_template_id}}";
    var next_question_id              = "{{$next_question_id}}";
    var previous_question_template_id = "{{$previous_question_template_id}}";
    var previous_question_id          = "{{$previous_question_id}}";
    var temp_id                       = "{{$arr_question['template_id']}}";
    var storage_id                    = "{{$arr_question['id']}}";
    var uniqid                        = "{{$uniqid}}";
    var is_answer                     = "{{$arr_question['is_answer']}}";
    var is_delay                      = "{{$arr_question['is_delay']}}";
    var question_audio_base_path      = "{{$question_audio_base_path}}";
    var arr_answer1                   = @php echo json_encode($arr_answer1) @endphp;
    var arr_answer2                   = @php echo json_encode($arr_answer2) @endphp;
    var arr_answer3                   = @php echo json_encode($arr_answer3) @endphp;
    var arr_answer_check1             = @php echo json_encode($arr_answer1) @endphp;
    var arr_answer_check2             = @php echo json_encode($arr_answer2) @endphp;
    var arr_answer_check3             = @php echo json_encode($arr_answer3) @endphp;

</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    $(':input:enabled:visible:first').focus();

    function checkAnswer(ref)
    {
        var check_answer = '';
        var question     = $(ref).data('question');
        var maxlength    = $(ref).attr('maxlength');
        var check_answer = $(ref).val().toLowerCase();
        $(ref).removeClass('wrong-ans');

        if(question==1)
        {
            if (jQuery.inArray(check_answer, arr_answer1)!='-1') {
                var index = arr_answer1.indexOf(check_answer);
                arr_answer1.splice(index,1);
                arr_answer_check1.splice(index,1);
                $(ref).attr('disabled','true');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('questionArr1');
                $(ref).addClass('correct-ans');
                $(ref).closest('input').nextAll('input').first().focus();
                checkFinalAnswer();
            }
            else
            {
                if(check_answer.length == maxlength && jQuery.inArray(check_answer, arr_answer1)=='-1')
                {
                    $(ref).removeClass('actual-ans');
                    $(ref).addClass('wrong-ans');
                    insertWrongAttempts();
                }
            }
        }
        
        if(question==2)
        {
            if (jQuery.inArray(check_answer, arr_answer2)!='-1') {
                var index = arr_answer2.indexOf(check_answer);
                arr_answer2.splice(index,1);
                arr_answer_check2.splice(index,1);
                $(ref).attr('disabled','true');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('questionArr2');
                $(ref).addClass('correct-ans');
                $(ref).closest('input').nextAll('input').first().focus();
                checkFinalAnswer();
            }
            else
            {
                if(check_answer.length == maxlength && jQuery.inArray(check_answer, arr_answer2)=='-1')
                {
                    $(ref).removeClass('actual-ans');
                    $(ref).addClass('wrong-ans');
                    insertWrongAttempts();
                }
            }
        }

        if(question==3)
        {
            if (jQuery.inArray(check_answer, arr_answer3)!='-1') {
                var index = arr_answer3.indexOf(check_answer);
                arr_answer3.splice(index,1);
                arr_answer_check3.splice(index,1);
                $(ref).attr('disabled','true');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('questionArr3');
                $(ref).addClass('correct-ans');
                $(ref).closest('input').nextAll('input').first().focus();
                checkFinalAnswer();
            }
            else
            {
                if(check_answer.length == maxlength && jQuery.inArray(check_answer, arr_answer3)=='-1')
                {
                    $(ref).removeClass('actual-ans');
                    $(ref).addClass('wrong-ans');
                    insertWrongAttempts();
                }
            }
        }
    }
    /* Check If given answer is right or not and change classes */
    //checkFinalAnswer();
    function checkFinalAnswer()
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();

        if($('.actual-ans').length == $('.questionCls').length)
        {
            $('#wrong_answer_msg_box').hide();
        }
        if($('.wrong-ans').length > 0)
        {
            $('#wrong_answer_msg_box').show();
            return false;
        }
        if($('.correct-ans').length == $('.questionCls').length)
        {
            $('.questionCls').attr('disabled',true);
            if(isAudioRequired=='yes')
            {
                if(sessionStorage.getItem('isRecorded_'+storage_id)=='no')
                {
                    $('#wrong_answer_msg_box').hide();
                    $('#answer_not_recorded_msg_box').show();
                    return false;
                }
            }
            var success_msg = getSuccessMessage();
            $('#right_answer_msg').html(success_msg);
            $('#right_answer_msg_box').show();
            
            setTimeout(function(){
                nextQuestion('save');
            }, 1000);
        }
    }
    /* Check If given answer is right or not and change classes ends here */

    /* Return the randomly generated success messages */
    var success_messages = ["Good Job!", "Great!", "Awesome!", "Superb!", "Fantastic!"];
    function getSuccessMessage() {
       return success_messages[Math.floor(Math.random() * success_messages.length)];
    }
    
    /* When Timer is Over starts here */
    if(is_answer=='no' && is_delay=='yes')
    {
        $.each(arr_answer_check1, function (key, value) {
            $('.questionArr1').each(function(){
                $(this).attr('placeholder',value);
                var index = arr_answer_check1.indexOf(value);
                $(this).removeClass('questionArr1');
                return false;
            });
        })
        $.each(arr_answer_check2, function (key, value) {
            $('.questionArr2').each(function(){
                $(this).attr('placeholder',value);
                var index = arr_answer_check2.indexOf(value);
                $(this).removeClass('questionArr2');
                return false;
            });
        })
        $.each(arr_answer_check3, function (key, value) {
            $('.questionArr3').each(function(){
                $(this).attr('placeholder',value);
                var index = arr_answer_check3.indexOf(value);
                $(this).removeClass('questionArr3');
                return false;
            });
        })
    }

    function timeisUp()
    {
        if(is_answer=='no')
        {
            $.each(arr_answer_check1, function (key, value) {
                $('.questionArr1').each(function(){
                    $(this).attr('placeholder',value);
                    var index = arr_answer_check1.indexOf(value);
                    $(this).removeClass('questionArr1');
                    return false;
                });
            })
            $.each(arr_answer_check2, function (key, value) {
                $('.questionArr2').each(function(){
                    $(this).attr('placeholder',value);
                    var index = arr_answer_check2.indexOf(value);
                    $(this).removeClass('questionArr2');
                    return false;
                });
            })
            $.each(arr_answer_check3, function (key, value) {
                $('.questionArr3').each(function(){
                    $(this).attr('placeholder',value);
                    var index = arr_answer_check3.indexOf(value);
                    $(this).removeClass('questionArr3');
                    return false;
                });
            })
            $.ajax({
                  type: 'POST',
                  url: SITE_URL+'/student/program/update_delay_flag',
                  data: {
                            _token      : csrf_token,
                            program_id  : program_id,
                            lesson_id   : lesson_id,
                            template_id : template_id,
                            question_id : question_id
                        },
                  success: function(resultData)
                  {
                }
            });
        }
    }
    /* When Timer is Over ends here */

</script>