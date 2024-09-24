@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
        <!--middle section-->
    <div class="middle-section temp-4-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template4']['question']) && $arr_question['template4']['question']!='' ? ucwords($arr_question['template4']['question']) : "N/A" }}
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-mg-3 col-lg-3">                        
                        @if($current_question>1)
                        <div class="arrow-prev-section-block" onclick="previousQuestion()">
                            <a href="javascript:void(0);" class="arrow-prev-img">
                                <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                            </a>
                        </div>
                        @endif
                        <div class="game-img-section temp-4-letter-section-div">                                                        
                            <img src="{{url('/')}}/images/temp-4-letter-img.png" alt="letter-img"/>
                            <div class="temp-4-letter">
                                <span>{{$arr_question['template4']['answer']}}</span>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-fill-text-section template-4-main-section">
                            @if(isset($arr_question['template4']['question_1_file']) && $arr_question['template4']['question_1_file']!='')
                                @php $result = get_image_public_path($arr_question['template4']['question_1_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-four" />
                            @endif
                            <div class="check-block template-4-checkbox @if($arr_question['is_delay']=='yes' && $arr_question['is_answer']=='no' && strpos(strtolower($arr_question['template4']['question_1_text']), strtolower($arr_question['template4']['answer'])) !== false) time-over-answer-section @endif" >
                                @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                    <input id="filled-in-box" class="filled-in" name="template4_checkbox" type="checkbox" value="{{$arr_question['template4']['question_1_text']}}" disabled="true" @if(strpos(strtolower($arr_question['template4']['question_1_text']), strtolower($arr_question['template4']['answer'])) !== false) checked="" @endif>
                                @else
                                    <input id="filled-in-box" class="filled-in" name="template4_checkbox" type="checkbox" onclick="checkFinalAnswer(this)" value="{{$arr_question['template4']['question_1_text']}}">
                                @endif
                                <label for="filled-in-box"><span>{{isset($arr_question['template4']['question_1_text']) && $arr_question['template4']['question_1_text']!='' ? ucwords($arr_question['template4']['question_1_text']) : "N/A"}}</span></label>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-fill-text-section template-4-main-section">
                            @if(isset($arr_question['template4']['question_2_file']) && $arr_question['template4']['question_2_file']!='')
                                @php $result = get_image_public_path($arr_question['template4']['question_2_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-four" />
                            @endif
                            <div class="check-block template-4-checkbox @if($arr_question['is_delay']=='yes' && $arr_question['is_answer']=='no' && strpos(strtolower($arr_question['template4']['question_2_text']), strtolower($arr_question['template4']['answer'])) !== false) time-over-answer-section @endif">
                                @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                    <input id="filled-in-box2" class="filled-in" name="template4_checkbox" type="checkbox" value="{{$arr_question['template4']['question_2_text']}}" disabled="true" @if(strpos(strtolower($arr_question['template4']['question_2_text']), strtolower($arr_question['template4']['answer'])) !== false) checked="" @endif>
                                @else
                                    <input id="filled-in-box2" class="filled-in" name="template4_checkbox" type="checkbox" onclick="checkFinalAnswer(this)" value="{{$arr_question['template4']['question_2_text']}}">
                                @endif
                                <label for="filled-in-box2"><span>{{isset($arr_question['template4']['question_2_text']) && $arr_question['template4']['question_2_text']!='' ? ucwords($arr_question['template4']['question_2_text']) : "N/A"}}</span></label>
                            </div>  
                        </div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-fill-text-section template-4-main-section">
                            @if(isset($arr_question['template4']['question_3_file']) && $arr_question['template4']['question_3_file']!='')
                                @php $result = get_image_public_path($arr_question['template4']['question_3_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-four" />
                            @endif
                            <div class="check-block template-4-checkbox @if($arr_question['is_delay']=='yes' && $arr_question['is_answer']=='no' && strpos(strtolower($arr_question['template4']['question_3_text']), strtolower($arr_question['template4']['answer'])) !== false) time-over-answer-section @endif">
                                @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                    <input id="filled-in-box3" class="filled-in" name="template4_checkbox" type="checkbox" value="{{$arr_question['template4']['question_3_text']}}" disabled="true" @if(strpos(strtolower($arr_question['template4']['question_3_text']), strtolower($arr_question['template4']['answer'])) !== false) checked="" @endif>
                                @else
                                    <input id="filled-in-box3" class="filled-in" name="template4_checkbox" type="checkbox" onclick="checkFinalAnswer(this)" value="{{$arr_question['template4']['question_3_text']}}">
                                @endif
                                <label for="filled-in-box3"><span>{{isset($arr_question['template4']['question_3_text']) && $arr_question['template4']['question_3_text']!='' ? ucwords($arr_question['template4']['question_3_text']) : "N/A"}}</span></label>
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
                </div>                                
                <div class="clearfix"></div>
            </div>
            <div class="specker-mic-section">
                <button onclick="togglePlay()" id="hornButton">
                    <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                    <audio id="horn" src="{{$question_audio_public_path.$arr_question['template4']['horn']}}"></audio>
                </button>
                <button @if($arr_question['is_answer']=='no') id="recordButton" @endif data-id="yes">
                    <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                    <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                </button>
            </div>
            
            <div class="col-sm-12 col-md-7 col-lg-8 tab-view-adjustment">
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
                    <span class="error-txt-section"> Now, Please Record your voice!</span>
                </div>
            </div>

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
            $hours       = date('H',strtotime($arr_question['template4']['duration']));
            $minutes     = date('i',strtotime($arr_question['template4']['duration']));
            $seconds     = date('s',strtotime($arr_question['template4']['duration']));
        }
        $actual_time = $arr_question['template4']['duration'];
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
    var is_delay                      = "{{$arr_question['is_delay']}}";
    var is_answer                     = "{{$arr_question['is_answer']}}";
    var question_audio_base_path      = "{{$question_audio_base_path}}";
    var correct_answer                = "{{$arr_question['template4']['answer']}}";
    var correct_answer                = correct_answer.toLowerCase();
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    if(is_answer=='no')
    {
        $('input[name="template4_checkbox"]').attr('checked', false);
    }
    /* Check Total number of right answers */
    var total_answers = 0;
    $('input[name="template4_checkbox"]').each(function(){
        var current_question = $(this).val().toLowerCase();
        if(current_question.indexOf(correct_answer) != -1){
            total_answers = total_answers + 1;
        }
    });

    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer(ref)
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
        $(ref).parent().removeClass('time-over-answer-section');
        var correct_answers = 0;
        var flag = 0;
        if(ref!=undefined && $(ref).val().toLowerCase().indexOf(correct_answer) != -1)
        {
            $('input[name="template4_checkbox"]:checked').each(function(){
                var current_question = $(this).val().toLowerCase();
                if(current_question.indexOf(correct_answer) != -1){
                    correct_answers = correct_answers + 1;
                }
                else
                {
                    insertWrongAttempts();
                    $('#wrong_answer_msg_box').show();
                    flag = 1;
                }
            });
        }
        else
        {
            if(ref!=undefined && $(ref).is(':checked'))
            {
                insertWrongAttempts();
                $('#wrong_answer_msg_box').show();
                return false;
            }
            else
            {
                $('input[name="template4_checkbox"]:checked').each(function(){
                    var current_question = $(this).val().toLowerCase();
                    if(current_question.indexOf(correct_answer) != -1){
                        correct_answers = correct_answers + 1;
                    }
                    else
                    {
                        insertWrongAttempts();
                        $('#wrong_answer_msg_box').show();
                        flag = 1;
                    }
                }); 
            }
        }
        if(flag==0 && correct_answers==total_answers)
        {
            $('input[name="template4_checkbox"]').attr('disabled', true);
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
    if(is_answer=="no" && is_delay=="yes")
    {
        $('input[name="template4_checkbox"]').each(function(){
            var current_question = $(this).val().toLowerCase();
            if(current_question.indexOf(correct_answer) != -1){
            $(this).closest( "div" ).addClass('time-over-answer-section');   
            }
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('input[name="template4_checkbox"]').each(function(){
                var current_question = $(this).val().toLowerCase();
                if(current_question.indexOf(correct_answer) != -1){
                $(this).closest( "div" ).addClass('time-over-answer-section');   
                }
            });
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