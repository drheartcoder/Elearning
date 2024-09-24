@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
<!--middle section-->
<div class="middle-section">
    <div class="container">
        <div class="fill-in-the-blank-section temp-41-main-section temp-49-main-section temp-50-main-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template50']['question']) && $arr_question['template50']['question']!='' ? ucwords($arr_question['template50']['question']) : "N/A" }}
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
                            <div class="clock-question">How much time has passed between clock A and clock B?</div>
                             <div class="clock-section">
                                 <div class="clock-block">
                                     <div class="clock-circle"><div id="clock"></div></div>
                                     <div class="clock-time">
                                         <h5>{{isset($arr_question['template50']['question_1']) ? date('h:i',strtotime($arr_question['template50']['question_1'])) : 0}}</h5>
                                         <p>Clock A</p>
                                     </div>
                                 </div>
                                 <div class="clock-block">
                                     <div class="clock-circle"><div id="clock2"></div></div>
                                     <div class="clock-time">
                                         <h5>{{isset($arr_question['template50']['question_2']) ? date('h:i',strtotime($arr_question['template50']['question_2'])) : 0}}</h5>
                                         <p>Clock B</p>
                                     </div>
                                 </div>
                             </div>       
                             <div class="radio-btns clock-options">  
                                @if(isset($arr_question['template50']['option_1']) && $arr_question['template50']['option_1']!='')
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="f-option" name="template50_checkbox" value="1" disabled="true" @if($arr_question['template50']['answer']==1) checked="true" @endif>
                                        @else
                                            <input type="radio" id="f-option" name="template50_checkbox" value="1" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="f-option">
                                            {!! isset($arr_question['template50']['option_1']) && $arr_question['template50']['option_1']!='' ? ucwords($arr_question['template50']['option_1']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                 @if(isset($arr_question['template50']['option_2']) && $arr_question['template50']['option_2']!='')
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="s-option" name="template50_checkbox" value="2" disabled="true" @if($arr_question['template50']['answer']==2) checked="true" @endif>
                                        @else
                                            <input type="radio" id="s-option" name="template50_checkbox" value="2" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="s-option">
                                            {!! isset($arr_question['template50']['option_2']) && $arr_question['template50']['option_2']!='' ? ucwords($arr_question['template50']['option_2']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                 @if(isset($arr_question['template50']['option_3']) && $arr_question['template50']['option_3']!='')
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="t-option" name="template50_checkbox" value="3" disabled="true" @if($arr_question['template50']['answer']==3) checked="true" @endif>
                                        @else
                                            <input type="radio" id="t-option" name="template50_checkbox" value="3" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="t-option">
                                            {!! isset($arr_question['template50']['option_3']) && $arr_question['template50']['option_3']!='' ? ucwords($arr_question['template50']['option_3']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
                                 @if(isset($arr_question['template50']['option_4']) && $arr_question['template50']['option_4']!='')
                                    <div class="radio-btn">
                                        @if(isset($arr_question['is_answer']) && $arr_question['is_answer']=='yes')
                                            <input type="radio" id="ft-option" name="template50_checkbox" value="4" disabled="true" @if($arr_question['template50']['answer']==4) checked="true" @endif>
                                        @else
                                            <input type="radio" id="ft-option" name="template50_checkbox" value="4" onclick="checkFinalAnswer(this)">
                                        @endif
                                        <label for="ft-option">
                                            {!! isset($arr_question['template50']['option_4']) && $arr_question['template50']['option_4']!='' ? ucwords($arr_question['template50']['option_4']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endif
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
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template50']['horn']}}"></audio>
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
                        <span class="error-txt-section"> Now, Please Record your voice!</span>
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
    @php

        if($arr_question['is_answer']=='yes' || $arr_question['is_delay']=='yes')
        {
            $hours = $minutes = $seconds = $c1_minutes = $c2_minutes = $c1_hours = $c2_hours = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template50']['duration']));
            $minutes     = date('i',strtotime($arr_question['template50']['duration']));
            $seconds     = date('s',strtotime($arr_question['template50']['duration']));
        }
        $actual_time = $arr_question['template50']['duration'];
        $template_id = base64_encode($arr_question['template_id']);
        $question_id = base64_encode($arr_question['question_id']);

        $c1_minutes  = isset($arr_question['template50']['question_1']) ? date('i',strtotime($arr_question['template50']['question_1'])) : 0;
        $c2_minutes  = isset($arr_question['template50']['question_2']) ? date('i',strtotime($arr_question['template50']['question_2'])) : 0;
        $c1_hours    = isset($arr_question['template50']['question_1']) ? date('h',strtotime($arr_question['template50']['question_1'])) : 0;
        $c2_hours    = isset($arr_question['template50']['question_2']) ? date('h',strtotime($arr_question['template50']['question_2'])) : 0;
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
    var correct_answer                = "{{$arr_question['template50']['answer']}}";
    var  c1_hours                     = "{{$c1_hours}}";
    var  c1_minutes                   = "{{$c1_minutes}}";
    var  c2_hours                     = "{{$c2_hours}}";
    var  c2_minutes                   = "{{$c2_minutes}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/analogClock.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
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
        $('input[name="template50_checkbox"]').each(function(){
            if($(this).val()==correct_answer){
                $(this).closest( "div" ).addClass('time-over-answer-section');   
            }
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('input[name="template50_checkbox"]').each(function(){
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

    AnalogClock("clock",{ width: 110 , bgColor: "#fff", c_minutes:c1_minutes, c_hours:c1_hours});
    AnalogClock("clock2",{ width: 110 , bgColor: "#fff", c_minutes:c2_minutes, c_hours:c2_hours});
    var clock = new AnalogClock("clock", opt);
    var clock2 = new AnalogClock("clock2", opt);
    clock.panel.style.border = "solid 5px red";    
    clock2.panel.style.border = "solid 5px red";    
</script>