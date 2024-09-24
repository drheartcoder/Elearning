@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $answer = $arr_question['template9']['answer'];
    $answer_text = isset($answer) && $answer!=0 ? $arr_question['template9']['option'.$answer] : 'N/A';

    if($arr_question['is_answer']=='yes'){
        $replace    = '</span><span class="input-txt-block" id="div1">'.$answer_text.'</span><span>';
    }
    else{
        $replace    = '</span><span class="input-txt-block" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></span><span>';
    }
    $question       = str_replace('#BLANK#',$replace,$arr_question['template9']['question_text']);
@endphp
    <!--middle section-->
    <div class="middle-section temp-9-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template9']['question']) && $arr_question['template9']['question']!='' ? ucwords($arr_question['template9']['question']) : "N/A" }}
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
                            <div class="question-section-txt template-9-question @if($arr_question['is_answer']=='yes') template-9-question-answer @endif" id="template-9-question">
                                <span>{!! $question !!} </span>
                            </div>
                            <div class="options-section-block">
                                <div class="option-one-block clsAnswer" id="1" data-option="{{ $arr_question['template9']['option1'] }}" draggable="true" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template9']['option1'] }}
                                </div>
                                <div class="option-one-block clsAnswer" id="2" data-option="{{ $arr_question['template9']['option2'] }}" draggable="true" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template9']['option2'] }}
                                </div>
                                <div class="clearfix"></div>
                                <div class="option-one-block clsAnswer" id="3" data-option="{{ $arr_question['template9']['option3'] }}" draggable="true" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template9']['option3'] }}
                                </div>
                                <div class="option-one-block clsAnswer" id="4" data-option="{{ $arr_question['template9']['option4'] }}" draggable="true" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template9']['option4'] }}
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
                    <div class="specker-mic-section">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template9']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template9']['duration']));
            $minutes     = date('i',strtotime($arr_question['template9']['duration']));
            $seconds     = date('s',strtotime($arr_question['template9']['duration']));
        }
        $actual_time = $arr_question['template9']['duration'];
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
    var correct_answer                = "{{$arr_question['template9']['answer']}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    var flag = 0;
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ref,ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        if(data==correct_answer)
        {
            flag = 1;
            answer_text = $('#'+data).data('option');
            ev.target.append(answer_text);
            checkFinalAnswer();
        }
        else
        {
            $('#template-9-question').addClass('template-9-question-answer-wrong');
            $('#wrong_answer_msg_box').show();
            insertWrongAttempts();
        }
    }

    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer()
    {
        var isAudioRequired = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
        $('#template-9-question').removeClass('template-9-question-answer-wrong');
        if(flag==1)
        {
            $('#template-9-question').addClass('template-9-question-answer');
            $('.clsAnswer').attr('draggable','false');
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
        $('#'+correct_answer).addClass('time-over-answer-section');   
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('#'+correct_answer).addClass('time-over-answer-section');   
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