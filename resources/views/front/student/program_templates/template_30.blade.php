@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $str_options = $arr_question['template30']['answer_1'].','.$arr_question['template30']['answer_3'].','.$arr_question['template30']['answer_2'].','.$arr_question['template30']['answer_4'].','.$arr_question['template30']['answer_5'];
    $arr_options = options_array_shuffle($str_options);
@endphp
    <!--middle section-->
    <div class="middle-section temp-30-main-section temp-28-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template30']['question']) && $arr_question['template30']['question']!='' ? ucwords($arr_question['template30']['question'])." : " : "N/A" }} <br>
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
                                <div class="temp-30-question">1. {{ucwords($arr_question['template30']['question_1'])}}
                                    <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template30']['answer_1']}}" type="text" name="question1" maxlength="1" />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}" id="a">A. {{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : "N/A" }}</div>
                            </div>
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">2. {{ucwords($arr_question['template30']['question_2'])}}
                                    <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template30']['answer_2']}}" type="text" name="question2" maxlength="1" />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}" id="b">B. {{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : "N/A" }}</div>
                            </div>
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">3. {{ucwords($arr_question['template30']['question_3'])}}
                                    <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template30']['answer_3']}}" type="text" name="question3" maxlength="1" />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}" id="c">C. {{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : "N/A" }}</div>
                            </div>
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">4. {{ucwords($arr_question['template30']['question_4'])}}
                                    <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template30']['answer_4']}}" type="text" name="question4" maxlength="1" />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}" id="d">D. {{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : "N/A" }}</div>
                            </div>
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">5. {{ucwords($arr_question['template30']['question_5'])}}
                                    <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template30']['answer_5']}}" type="text" name="question5" maxlength="1" />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[4]) && $arr_options[4]!='' ? $arr_options[4] : 'N/A' }}" id="e">E. {{isset($arr_options[4]) && $arr_options[4]!='' ? $arr_options[4] : "N/A" }}</div>
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
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template30']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template30']['duration']));
            $minutes     = date('i',strtotime($arr_question['template30']['duration']));
            $seconds     = date('s',strtotime($arr_question['template30']['duration']));
        }
        $actual_time = $arr_question['template30']['duration'];
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
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    
    $(':input:enabled:visible:first').focus();
    
    function checkAnswer(ref,event)
    {
        var key = event.keyCode || event.charCode;
        
        $(ref).removeClass('wrong-ans');
        $(ref).removeClass('correct-ans');
        $(ref).addClass('actual-ans');
        
        var given_answer_id  = $(ref).val();
        var actual_answer = $(ref).data('answer');
        if(given_answer_id!='' && actual_answer!='')
        {
            given_answer_id = given_answer_id.toLowerCase();
            actual_answer = actual_answer.toLowerCase();
            current_given_answer = $('#'+given_answer_id).data('answer').toLowerCase();
            
            if(current_given_answer==actual_answer)
            {
                $(ref).removeClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).addClass('correct-ans');
            }
            
            if(current_given_answer!=actual_answer)
            {
                $(ref).addClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('correct-ans');
                
                if ((key > 64 && key < 91) || (key > 96 && key < 123)) {
                    insertWrongAttempts();
                }
            }
        }
        checkFinalAnswer();
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
/*    if(is_answer=='no' && is_delay=='yes')
    {
        $('.questionCls').each(function(que_index,que_value){
            $('.answerCls').each(function(ans_index,ans_value){
                if($(ans_value).data('answer').toLowerCase() == $(que_value).data('answer').toLowerCase())
                {
                    $(que_value).attr('placeholder',$(ans_value).attr('id'));
                }                    
            });
        });
    }
*/
    if(is_answer=='yes')
    {
        $('.questionCls').each(function(que_index,que_value){
            $('.answerCls').each(function(ans_index,ans_value){
                if($(ans_value).data('answer').toLowerCase() == $(que_value).data('answer').toLowerCase())
                {
                    $(que_value).val($(ans_value).attr('id'));
                }                    
            });
        });
        $('.questionCls').attr('disabled',true);
        $('.questionCls').removeClass('actual-ans');
        $('.questionCls').addClass('correct-ans');
    }

    if(is_answer=="no" && is_delay == "yes")
    {
        $('.questionCls').each(function(que_index,que_value){
            $('.answerCls').each(function(ans_index,ans_value){
                if($(ans_value).data('answer').toLowerCase() == $(que_value).data('answer').toLowerCase())
                {
                    $(que_value).attr('placeholder',$(ans_value).attr('id'));
                }                    
            });
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('.questionCls').each(function(que_index,que_value){
                $('.answerCls').each(function(ans_index,ans_value){
                    if($(ans_value).data('answer').toLowerCase() == $(que_value).data('answer').toLowerCase())
                    {
                        $(que_value).attr('placeholder',$(ans_value).attr('id'));
                    }                    
                });
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