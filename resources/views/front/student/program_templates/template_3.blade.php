@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
<!--middle section-->
<div class="middle-section">
    <div class="container">
        <div class="fill-in-the-blank-section template-3-main">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template3']['question']) && $arr_question['template3']['question']!='' ? ucwords($arr_question['template3']['question']) : "N/A" }}
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        @if($current_question>1)
                        <div class="arrow-prev-section-block" onclick="previousQuestion()">
                            <a href="javascript:void(0);" class="arrow-prev-img">
                                <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                            </a>
                        </div>
                        @endif
                        @php
                        $arr_question1 = str_split($arr_question['template3']['question_1_text'], 1);
                        $arr_question2 = str_split($arr_question['template3']['question_2_text'], 1);
                        @endphp
                        <div class="game-img-section">
                            @if(isset($arr_question['template3']['question_1_file']) && $arr_question['template3']['question_1_file']!='')
                            @php $result = get_image_public_path($arr_question['template3']['question_1_file'],'image');  @endphp
                            <img src="{{$result['image_url']}}" alt="tamplate-two" />
                            @endif
                            <div class="image-name-section">
                                @if(isset($arr_question1) && count($arr_question1)>0)
                                    <div class="radio-btns">  
                                        @foreach($arr_question1 as $key1 => $val1)
                                            @if($arr_question['is_answer']=='no')
                                                <div class="radio-btn @if($arr_question['template3']['answer']==$val1 && $arr_question['is_delay']=='yes') answer-gray-section  @endif">
                                                    <input type="radio" id="{{$key1}}-option1" onclick="checkFinalAnswer(this)" value="{{$val1}}" name="question1">
                                                    <label for="{{$key1}}-option1">{{$val1}}</label>
                                                    <div class="circle-block"></div>
                                                </div>
                                            @else
                                                <div class="radio-btn">
                                                    <input type="radio" id="{{$key1}}-option1" @if($arr_question['template3']['answer']==$val1) checked @endif value="{{$val1}}" name="question1" disabled="true">
                                                    <label for="{{$key1}}-option1">{{$val1}}</label>
                                                    <div class="circle-block"></div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        <div class="game-fill-text-section game-bird-section">
                            @if(isset($arr_question['template3']['question_2_file']) && $arr_question['template3']['question_2_file']!='')
                                @php $result = get_image_public_path($arr_question['template3']['question_2_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-two" />
                            @endif
                            <div class="image-name-section">
                                @if(isset($arr_question2) && count($arr_question2)>0)
                                    <div class="radio-btns">  
                                        @foreach($arr_question2 as $key2 => $val2)
                                            @if($arr_question['is_answer']=='no')
                                                <div class="radio-btn @if($arr_question['template3']['answer']==$val2 && $arr_question['is_delay']=='yes') answer-gray-section  @endif">
                                                    <input type="radio" id="{{$key2}}-option2" onclick="checkFinalAnswer(this)" value="{{$val2}}" name="question2">
                                                    <label for="{{$key2}}-option2">{{$val2}}</label>
                                                    <div class="circle-block"></div>
                                                </div>
                                            @else
                                                <div class="radio-btn">
                                                    <input type="radio" id="{{$key2}}-option2" @if($arr_question['template3']['answer']==$val2) checked @endif value="{{$val2}}" name="question2"  disabled="true">
                                                    <label for="{{$key2}}-option2">{{$val2}}</label>
                                                    <div class="circle-block"></div>
                                                </div>
                                            @endif
                                        @endforeach
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
                    <div class="specker-mic-section">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template3']['horn']}}"></audio>
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
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template3']['duration']));
            $minutes     = date('i',strtotime($arr_question['template3']['duration']));
            $seconds     = date('s',strtotime($arr_question['template3']['duration']));
        }
        $actual_time = $arr_question['template3']['duration'];
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
    var correct_answer                = "{{strtolower($arr_question['template3']['answer'])}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    if(is_answer=='no')
    {
        $('input[name="question1"]').attr('checked', false);
        $('input[name="question2"]').attr('checked', false);
    }
    
    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer(ref)
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
        $(ref).parent().removeClass('answer-gray-section');
        if($('input[name="question1"]:checked')!=undefined)
        {
            var answer1            = $('input[name="question1"]:checked').val().toLowerCase();
        }
        if($('input[name="question2"]:checked')!=undefined)
        {
            var answer2            = $('input[name="question2"]:checked').val().toLowerCase();
        }

        if((answer1!='' && answer1!=undefined) && (answer2!='' && answer2!=undefined))
        {
            if(answer1==correct_answer && answer2 == correct_answer)
            {
                $('input[type="radio"]').attr('disabled', true);
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
            else
            {
                insertWrongAttempts();
                $('#wrong_answer_msg_box').show();
                return false;
            }
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
        $('input[name="question1"]').each(function(){
            if($(this).val().toLowerCase()==correct_answer)
            {
                $(this).parent().addClass('answer-gray-section');   
            }
        });
        $('input[name="question2"]').each(function(){
            if($(this).val().toLowerCase()==correct_answer)
            {
                $(this).parent().addClass('answer-gray-section');   
            }
        });
    }

    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('input[name="question1"]').each(function(){
                if($(this).val().toLowerCase()==correct_answer)
                {
                    $(this).parent().addClass('answer-gray-section');   
                }
            });
            $('input[name="question2"]').each(function(){
                if($(this).val().toLowerCase()==correct_answer)
                {
                    $(this).parent().addClass('answer-gray-section');   
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