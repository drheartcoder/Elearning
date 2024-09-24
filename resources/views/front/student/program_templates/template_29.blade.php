@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $correct_word_count = 0;
    $correct_word_count += calculate_word_count(strtolower($arr_question['template29']['question_1']),strtolower($arr_question['template29']['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['template29']['question_2']),strtolower($arr_question['template29']['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['template29']['question_3']),strtolower($arr_question['template29']['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['template29']['question_4']),strtolower($arr_question['template29']['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['template29']['question_5']),strtolower($arr_question['template29']['answer']));
@endphp
    <!--middle section-->
    <div class="middle-section temp-29-main-section temp-28-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template29']['question']) && $arr_question['template29']['question']!='' ? ucwords($arr_question['template29']['question'])." : " : "N/A" }}
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
                            @if(isset($arr_question['template29']['question_1']) && $arr_question['template29']['question_1']!='')                         
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    @if($arr_question['is_answer']=='yes')
                                        <span class="temp-29-ques-text-section">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_1']); @endphp
                                                @if(count($arr_words)>0 && count($arr_words)>0)
                                                    @foreach($arr_words as $key => $val)
                                                        @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                            <span class="correct-answer-underline-section">{{$val}}</span>
                                                        @else
                                                            <span>{{$val}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </span>
                                    @else
                                        <span class="temp-29-ques-text-section originalSection"><span>{!! isset($arr_question['template29']['question_1']) && $arr_question['template29']['question_1']!='' ? str_replace(" ","</span> <span>",$arr_question['template29']['question_1']) : "N/A" !!}</span>
                                        </span>    

                                        <span class="temp-29-ques-text-section graySection" style="display: none">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_1']); @endphp
                                            @if(count($arr_words)>0 && count($arr_words)>0)
                                                @foreach($arr_words as $key => $val)
                                                    @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                        <span class="actual-answer-underline-section">{{$val}}</span>
                                                    @else
                                                        <span>{{$val}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @endif
                            @if(isset($arr_question['template29']['question_2']) && $arr_question['template29']['question_2']!='')                         
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    @if($arr_question['is_answer']=='yes')
                                        <span class="temp-29-ques-text-section">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_2']); @endphp
                                                @if(count($arr_words)>0 && count($arr_words)>0)
                                                    @foreach($arr_words as $key => $val)
                                                        @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                            <span class="correct-answer-underline-section">{{$val}}</span>
                                                        @else
                                                            <span>{{$val}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </span>
                                    @else
                                        <span class="temp-29-ques-text-section originalSection"><span>{!! isset($arr_question['template29']['question_2']) && $arr_question['template29']['question_2']!='' ? str_replace(" ","</span> <span>",$arr_question['template29']['question_2']) : "N/A" !!}</span>
                                        </span>    

                                        <span class="temp-29-ques-text-section graySection" style="display: none">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_2']); @endphp
                                            @if(count($arr_words)>0 && count($arr_words)>0)
                                                @foreach($arr_words as $key => $val)
                                                    @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                        <span class="actual-answer-underline-section">{{$val}}</span>
                                                    @else
                                                        <span>{{$val}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @endif
                            @if(isset($arr_question['template29']['question_3']) && $arr_question['template29']['question_3']!='')    
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    @if($arr_question['is_answer']=='yes')
                                        <span class="temp-29-ques-text-section">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_3']); @endphp
                                                @if(count($arr_words)>0 && count($arr_words)>0)
                                                    @foreach($arr_words as $key => $val)
                                                        @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                            <span class="correct-answer-underline-section">{{$val}}</span>
                                                        @else
                                                            <span>{{$val}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </span>
                                    @else
                                        <span class="temp-29-ques-text-section originalSection"><span>{!! isset($arr_question['template29']['question_3']) && $arr_question['template29']['question_3']!='' ? str_replace(" ","</span> <span>",$arr_question['template29']['question_3']) : "N/A" !!}</span>
                                        </span>    

                                        <span class="temp-29-ques-text-section graySection" style="display: none">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_3']); @endphp
                                            @if(count($arr_words)>0 && count($arr_words)>0)
                                                @foreach($arr_words as $key => $val)
                                                    @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                        <span class="actual-answer-underline-section">{{$val}}</span>
                                                    @else
                                                        <span>{{$val}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @endif
                            @if(isset($arr_question['template29']['question_4']) && $arr_question['template29']['question_4']!='')
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    @if($arr_question['is_answer']=='yes')
                                        <span class="temp-29-ques-text-section">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_4']); @endphp
                                                @if(count($arr_words)>0 && count($arr_words)>0)
                                                    @foreach($arr_words as $key => $val)
                                                        @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                            <span class="correct-answer-underline-section">{{$val}}</span>
                                                        @else
                                                            <span>{{$val}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </span>
                                    @else
                                        <span class="temp-29-ques-text-section originalSection"><span>{!! isset($arr_question['template29']['question_4']) && $arr_question['template29']['question_4']!='' ? str_replace(" ","</span> <span>",$arr_question['template29']['question_4']) : "N/A" !!}</span>
                                        </span>    

                                        <span class="temp-29-ques-text-section graySection" style="display: none">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_4']); @endphp
                                            @if(count($arr_words)>0 && count($arr_words)>0)
                                                @foreach($arr_words as $key => $val)
                                                    @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                        <span class="actual-answer-underline-section">{{$val}}</span>
                                                    @else
                                                        <span>{{$val}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @endif
                            @if(isset($arr_question['template29']['question_5']) && $arr_question['template29']['question_5']!='')
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    @if($arr_question['is_answer']=='yes')
                                        <span class="temp-29-ques-text-section">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_5']); @endphp
                                                @if(count($arr_words)>0 && count($arr_words)>0)
                                                    @foreach($arr_words as $key => $val)
                                                        @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                            <span class="correct-answer-underline-section">{{$val}}</span>
                                                        @else
                                                            <span>{{$val}}</span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </span>
                                    @else
                                        <span class="temp-29-ques-text-section originalSection"><span>{!! isset($arr_question['template29']['question_5']) && $arr_question['template29']['question_5']!='' ? str_replace(" ","</span> <span>",$arr_question['template29']['question_5']) : "N/A" !!}</span>
                                        </span>    

                                        <span class="temp-29-ques-text-section graySection" style="display: none">
                                            @php $arr_words = explode(' ', $arr_question['template29']['question_5']); @endphp
                                            @if(count($arr_words)>0 && count($arr_words)>0)
                                                @foreach($arr_words as $key => $val)
                                                    @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['template29']['answer']))) === strtolower($arr_question['template29']['answer']))
                                                        <span class="actual-answer-underline-section">{{$val}}</span>
                                                    @else
                                                        <span>{{$val}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    @endif
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
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="specker-mic-section">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template29']['horn']}}"></audio>
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
    <!--middle section end-->
    
    @php
        if($arr_question['is_answer']=='yes' || $arr_question['is_delay']=='yes')
        {
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template29']['duration']));
            $minutes     = date('i',strtotime($arr_question['template29']['duration']));
            $seconds     = date('s',strtotime($arr_question['template29']['duration']));
        }
        $actual_time = $arr_question['template29']['duration'];
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
    var correct_answer                = "{{strtolower($arr_question['template29']['answer'])}}";
    var question_1                    = "{{strtolower($arr_question['template29']['question_1'])}}";
    var correct_word_count            = "{{$correct_word_count}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    var flag = 0;
    /* Check If given answer is right or not and change classes */
    $(".temp-29-ques-text-section span").on("click", function(){
       if(is_answer=='no')
       {
           var current_answer = $(this).html();
           if(current_answer!='' && current_answer!=undefined)
           {
                $(this).removeClass("actual-answer-underline-section");
                $(this).prop("onclick", null).off("click");
                if(current_answer.toLowerCase().match(correct_answer) && !$(this).hasClass("correct-answer-underline-section"))
                {
                    $('#wrong_answer_msg_box').hide();
                    $(this).addClass("correct-answer-underline-section");
                    checkFinalAnswer();
                }
                else
                {
                    $(this).addClass("wrong-answer-underline-section");
                    insertWrongAttempts();
                    $('#wrong_answer_msg_box').show();
                    return false;
                }
           }
       }
    });
    /* Check If given answer is right or not and change classes ends here */    

    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer()
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();

        if($('.correct-answer-underline-section').length == correct_word_count)
        {
            $(".temp-29-ques-text-section span").prop("onclick", null).off("click");
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
    if(is_answer=="no" && is_delay == "yes")
    {
        $('.originalSection').hide();
        $('.graySection').show();
    }
    function timeisUp()
    {
        if(is_answer=="no")
        {
            $('.originalSection').hide();
            $('.graySection').show();
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