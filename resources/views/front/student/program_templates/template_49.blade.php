@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
    <!--middle section-->
    <div class="middle-section temp-41-main-section temp-49-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template49']['question']) && $arr_question['template49']['question']!='' ? ucwords($arr_question['template49']['question'])." : " : "N/A" }} <br>
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
                            <div class="temp-41-ques-text">{{isset($arr_question['template49']['question']) && $arr_question['template49']['question']!='' ? ucwords($arr_question['template49']['question']) : "N/A" }}</div>
                            <div class="equation-block">                                
                                <div class="question-nos-section">
                                    <div class="equa-num">
                                        <b>{!! isset($arr_question['template49']['question_1']) && $arr_question['template49']['question_1']!='' ? ucwords($arr_question['template49']['question_1']) : "N/A" !!}</b>
                                    </div>                                                                           
                                </div>
                                <div class="radio-btns">  
                                @if(isset($arr_question['template49']['option_1']) && $arr_question['template49']['option_1'])
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="f-option" name="template49_checkbox" value="1" disabled="true" @if($arr_question['template49']['answer']==1) checked="true" @endif>
                                        @else
                                            <input type="radio" id="f-option" name="template49_checkbox" value="1" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="f-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['template49']['option_1']) && $arr_question['template49']['option_1']!='' ? ucwords($arr_question['template49']['option_1']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                @if(isset($arr_question['template49']['option_2']) && $arr_question['template49']['option_2'])
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="s-option" name="template49_checkbox" value="2" disabled="true" @if($arr_question['template49']['answer']==2) checked="true" @endif>
                                        @else
                                            <input type="radio" id="s-option" name="template49_checkbox" value="2" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="s-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['template49']['option_2']) && $arr_question['template49']['option_2']!='' ? ucwords($arr_question['template49']['option_2']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                @if(isset($arr_question['template49']['option_3']) && $arr_question['template49']['option_3'])
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="t-option" name="template49_checkbox" value="3" disabled="true" @if($arr_question['template49']['answer']==3) checked="true" @endif>
                                        @else
                                            <input type="radio" id="t-option" name="template49_checkbox" value="3" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="t-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['template49']['option_3']) && $arr_question['template49']['option_3']!='' ? ucwords($arr_question['template49']['option_3']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>\
                               @endif
                               @if(isset($arr_question['template49']['option_4']) && $arr_question['template49']['option_4'])
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="ft-option" name="template49_checkbox" value="4" disabled="true" @if($arr_question['template49']['answer']==4) checked="true" @endif>
                                        @else
                                            <input type="radio" id="ft-option" name="template49_checkbox" value="4" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="ft-option">
                                            <span class="equation-block">
                                                <span class="equa-num">
                                                    {!! isset($arr_question['template49']['option_4']) && $arr_question['template49']['option_4']!='' ? ucwords($arr_question['template49']['option_4']) : "N/A" !!}
                                                </span> 
                                            </span>
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                </div>                                
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
                    <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template49']['horn']}}"></audio>
                        </button>
                        <button @if($arr_question['is_answer']=='no') id="recordButton" @endif data-id="no">
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
            $hours       = date('H',strtotime($arr_question['template49']['duration']));
            $minutes     = date('i',strtotime($arr_question['template49']['duration']));
            $seconds     = date('s',strtotime($arr_question['template49']['duration']));
        }
        $actual_time = $arr_question['template49']['duration'];
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
    var correct_answer                = "{{$arr_question['template49']['answer']}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script> 

<script type="text/javascript">

    if(is_answer=='no')
    {
        $('input[type=radio]').attr('checked', false);
    }

    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer(ref)
    {
        var isAudioRequired = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
        $(ref).parent().removeClass('time-over-answer-section');
        if($(ref).val()== correct_answer)
        {
            $('input[type=radio]').attr('disabled', true);
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
        else if(ref==undefined && $('input[type=radio]:checked').is(':checked'))
        {
            $('input[type=radio]').attr('disabled', true);
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

        if(ref!=undefined && $(ref).val()!= correct_answer)
        {
            insertWrongAttempts();
            $('#wrong_answer_msg_box').show();
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
        $('input[name="template49_checkbox"]').each(function(){
            if($(this).val()==correct_answer){
                $(this).closest( "div" ).addClass('time-over-answer-section');   
            }
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('input[name="template49_checkbox"]').each(function(){
                if($(this).val()==correct_answer){
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