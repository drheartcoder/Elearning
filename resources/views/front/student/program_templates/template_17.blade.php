@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $answer1 = $arr_question['template17']['question_1_answer'];
    $answer2 = $arr_question['template17']['question_2_answer'];
    $answer_text1 = isset($answer1) && $answer1!=0 ? $arr_question['template17']['question_1_option'.$answer1] : 'N/A';
    $answer_text2 = isset($answer2) && $answer2!=0 ? $arr_question['template17']['question_2_option'.$answer2] : 'N/A';
    if($arr_question['is_answer']=='yes'){
        $replace1    = '</span><span class="input-txt-block" id="div1">'.$answer_text1.'</span><span>';
        $replace2    = '</span><span class="input-txt-block" id="div2">'.$answer_text2.'</span><span>';
    }
    else{
        $replace1    = '</span><span class="input-txt-block" id="div1" data-id="1" ondrop="drop(event,this)" ondragover="allowDrop(event)"></span><span>';
        $replace2    = '</span><span class="input-txt-block" id="div2" data-id="2"ondrop="drop(event,this)" ondragover="allowDrop(event)"></span><span>';
    }
    $question1       = str_replace('#BLANK#',$replace1,$arr_question['template17']['question_1_text']);
    $question2       = str_replace('#BLANK#',$replace2,$arr_question['template17']['question_2_text']);
@endphp
    <!--middle section-->
    <div class="middle-section temp-17-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template17']['question']) && $arr_question['template17']['question']!='' ? ucwords($arr_question['template17']['question']) : "N/A" }}
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
                        <div class="game-img-section">
                            <div class="ques-ans-section-block template-17-question @if($arr_question['is_answer']=='yes') template-17-question-answer @endif" id="template-17-question_1">
                                1. {!! $question1 !!}
                            </div>
                            <div class="options-section-block">
                                <div class="option-one-block clsAnswer1" id="option_1_1" data-option="1" data-question="1" draggable="true" data-answer="{{ $arr_question['template17']['question_1_option1'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_1_option1'] }}
                                </div>
                                <div class="option-one-block clsAnswer1" id="option_1_2" data-option="2" data-question="1" draggable="true" data-answer="{{ $arr_question['template17']['question_1_option2'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_1_option2'] }}
                                </div>
                                <div class="option-one-block clsAnswer1" id="option_1_3" data-option="3" data-question="1" draggable="true" data-answer="{{ $arr_question['template17']['question_1_option3'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_1_option3'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        <div class="game-fill-text-section">                            
                            @if($current_question<$total_question_count)
                                <div class="arrow-next-section-block" @if($arr_question['is_answer']=='yes') onclick="nextQuestion('manual')" @endif> 
                                    <a href="javascript:void(0);" class="arrow-next-img">
                                        <img class="arrow-img" src="{{url('/')}}/images/template/question-next-arrow-img.png" alt="" />
                                        <img class="arrow-over-img" src="{{url('/')}}/images/template/question-next-arrow-over-img.png" alt="" />
                                    </a>
                                </div>
                            @endif                           
                            <div class="ques-ans-section-block template-17-question @if($arr_question['is_answer']=='yes') template-17-question-answer @endif" id="template-17-question_2">
                                2. {!! $question2 !!}
                            </div>
                            <div class="options-section-block">
                                <div class="option-one-block clsAnswer2" id="option_2_1" data-option="1" data-question="2" draggable="true" data-answer="{{ $arr_question['template17']['question_2_option1'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_2_option1'] }}
                                </div>
                                <div class="option-one-block clsAnswer2" id="option_2_2" data-option="2" data-question="2" draggable="true" data-answer="{{ $arr_question['template17']['question_2_option2'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_2_option2'] }}
                                </div>
                                <div class="option-one-block clsAnswer2" id="option_2_3" data-option="3" data-question="2" draggable="true" data-answer="{{ $arr_question['template17']['question_2_option3'] }}" ondragstart="drag(this,event)" style="cursor: pointer;">
                                    {{ $arr_question['template17']['question_2_option3'] }}
                                </div>
                            </div>
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
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template17']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template17']['duration']));
            $minutes     = date('i',strtotime($arr_question['template17']['duration']));
            $seconds     = date('s',strtotime($arr_question['template17']['duration']));
        }
        $actual_time = $arr_question['template17']['duration'];
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
    var correct_answer1                = "{{$arr_question['template17']['question_1_answer']}}";
    var correct_answer2                = "{{$arr_question['template17']['question_2_answer']}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    var flag = 0;
    sessionStorage.setItem('answer1','no');
    sessionStorage.setItem('answer2','no');
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ref,ev) {
        ev.dataTransfer.setData("id", ev.target.id);
        ev.dataTransfer.setData("option", ev.target.getAttribute('data-option'));
        ev.dataTransfer.setData("question", ev.target.getAttribute('data-question'));
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
    }

    function drop(ev,ref) {
        ev.preventDefault();
        var id       = ev.dataTransfer.getData("id");
        var option   = ev.dataTransfer.getData("option");
        var question = ev.dataTransfer.getData("question");
        if(question==1 && $(ref).data('id')==1)
        {
            $('#template-17-question_1').removeClass('template-17-question-answer');
            $('#template-17-question_1').removeClass('template-17-question-answer-wrong');
            if(option == correct_answer1)
            {
                sessionStorage.setItem('answer1','yes');
                $('.clsAnswer1').attr('draggable','false');
                var answer_text1 = $('#'+id).data('answer');
                $(ref).append(answer_text1);
                $('#template-17-question_1').addClass('template-17-question-answer');
                checkFinalAnswer();
            }
            else
            {
                $('#template-17-question_1').addClass('template-17-question-answer-wrong');
                $('#wrong_answer_msg_box').show();
                insertWrongAttempts();
            }
        }
        if(question==2 && $(ref).data('id')==2)
        {
            $('#template-17-question_2').removeClass('template-17-question-answer');
            $('#template-17-question_2').removeClass('template-17-question-answer-wrong');
            if(option == correct_answer2)
            {
                sessionStorage.setItem('answer2','yes');
                $('.clsAnswer2').attr('draggable','false');
                var answer_text2 = $('#'+id).data('answer');
                $(ref).append(answer_text2);
                $('#template-17-question_2').addClass('template-17-question-answer');
                checkFinalAnswer();
            }
            else
            {
                $('#template-17-question_2').addClass('template-17-question-answer-wrong');
                $('#wrong_answer_msg_box').show();
                insertWrongAttempts();
            }
        }
    }

    /* Check If given answer is right or not and change classes */
    function checkFinalAnswer()
    {
        var isAudioRequired = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
        
        if(sessionStorage.getItem('answer1')=='yes' && sessionStorage.getItem('answer2')=='yes')
        {
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
        $('#option_1_'+correct_answer1).addClass('time-over-answer-section');   
        $('#option_2_'+correct_answer2).addClass('time-over-answer-section');   
    }
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('#option_1_'+correct_answer1).addClass('time-over-answer-section');   
            $('#option_2_'+correct_answer2).addClass('time-over-answer-section');   
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