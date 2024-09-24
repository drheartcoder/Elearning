@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $str_options = $arr_question['template18']['question_1_answer'].','.$arr_question['template18']['question_2_answer'].','.$arr_question['template18']['question_3_answer'].','.$arr_question['template18']['question_4_answer'].','.$arr_question['template18']['question_5_answer'].','.$arr_question['template18']['question_6_answer'];
    $arr_options = options_array_shuffle($str_options);
    $maxlength   = 0;
@endphp
    <!--middle section-->
    <div class="middle-section temp-18-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template18']['question']) && $arr_question['template18']['question']!='' ? ucwords($arr_question['template18']['question'])." : " : "N/A" }} <br>
                        @if(isset($arr_options) && count($arr_options)>0)
                            @foreach($arr_options as $key => $val)
                                @php
                                    if($maxlength < strlen($val))
                                    {
                                        $maxlength = strlen($val);
                                    }
                                @endphp
                                @if($key == count($arr_options)-1)
                                [ <span draggable="true" ondragstart="drag(this,event)" data-answer="{{ $val }}" style="cursor: pointer;">{{$val}}</span> ]
                                @else
                                [ <span draggable="true" ondragstart="drag(this,event)" data-answer="{{ $val }}" style="cursor: pointer;">{{$val}}</span> ],
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @php
                    $word1 = $word2 = $word3 = $word4 = $word5 = $word6 = [];
                    $arr_word1     = str_split($arr_question['template18']['question_1_text'], 1);
                    $arr_word2     = str_split($arr_question['template18']['question_2_text'], 1);
                    $arr_word3     = str_split($arr_question['template18']['question_3_text'], 1);
                    $arr_word4     = str_split($arr_question['template18']['question_4_text'], 1);
                    $arr_word5     = str_split($arr_question['template18']['question_5_text'], 1);
                    $arr_word6     = str_split($arr_question['template18']['question_6_text'], 1);
                    $arr_position1 = str_split($arr_question['template18']['question_1_answer_position'], 1);
                    $arr_position2 = str_split($arr_question['template18']['question_2_answer_position'], 1);
                    $arr_position3 = str_split($arr_question['template18']['question_3_answer_position'], 1);
                    $arr_position4 = str_split($arr_question['template18']['question_4_answer_position'], 1);
                    $arr_position4 = str_split($arr_question['template18']['question_4_answer_position'], 1);
                    $arr_position5 = str_split($arr_question['template18']['question_5_answer_position'], 1);
                    $arr_position6 = str_split($arr_question['template18']['question_6_answer_position'], 1);
                @endphp 

                    @php
                        $word1 = get_remainin_word($arr_word1, $arr_position1);
                        $word2 = get_remainin_word($arr_word2, $arr_position2);
                        $word3 = get_remainin_word($arr_word3, $arr_position3);
                        $word4 = get_remainin_word($arr_word4, $arr_position4);
                        $word5 = get_remainin_word($arr_word5, $arr_position5);
                        $word6 = get_remainin_word($arr_word6, $arr_position6);
                    @endphp
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
                            <div class="display-table-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_1_file']) && $arr_question['template18']['question_1_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_1_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image1" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_1_answer']}}" disabled="true" /><span class="uppercase-style">{{$word1}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image1" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_1_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word1}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="display-table-section middle-img-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_2_file']) && $arr_question['template18']['question_2_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_2_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image2" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_2_answer']}}" disabled="true" /><span class="uppercase-style">{{$word2}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image2" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_2_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word2}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="display-table-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_3_file']) && $arr_question['template18']['question_3_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_3_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image3" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_3_answer']}}" disabled="true" /><span class="uppercase-style">{{$word3}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image3" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_3_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word3}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>                                                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        <div class="game-img-section">                            
                            <div class="display-table-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_4_file']) && $arr_question['template18']['question_4_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_4_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image4" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_4_answer']}}" disabled="true" /><span class="uppercase-style">{{$word4}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image4" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_4_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word4}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="display-table-section middle-img-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_5_file']) && $arr_question['template18']['question_5_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_5_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image5" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_5_answer']}}" disabled="true" /><span class="uppercase-style">{{$word5}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image5" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_5_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word5}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="display-table-section">
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-img-section">
                                        @if(isset($arr_question['template18']['question_6_file']) && $arr_question['template18']['question_6_file']!='')
                                            @php $result = get_image_public_path($arr_question['template18']['question_6_file'],'image');  @endphp
                                            <img src="{{$result['image_url']}}" alt="tamplate 18" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6 display-table-cell-section">
                                    <div class="ques-18-ans-section">                                        
                                        @if($arr_question['is_answer']=='yes')
                                            <input class="correct-ans uppercase-style" type="text" name="image6" maxlength="{{$maxlength}}" value="{{$arr_question['template18']['question_6_answer']}}" disabled="true" /><span class="uppercase-style">{{$word6}}</span>
                                        @else
                                            <input class="actual-ans questionCls uppercase-style" type="text" name="image6" maxlength="{{$maxlength}}" data-answer="{{$arr_question['template18']['question_6_answer']}}" onkeyup="checkAnswer(this,event)" ondrop="drop(event,this)" ondragover="allowDrop(event)" /><span class="uppercase-style">{{$word6}}</span>
                                        @endif
                                    </div>
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
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template18']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template18']['duration']));
            $minutes     = date('i',strtotime($arr_question['template18']['duration']));
            $seconds     = date('s',strtotime($arr_question['template18']['duration']));
        }
        $actual_time = $arr_question['template18']['duration'];
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
    var maxlength                     = "{{$maxlength}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    var flag = 0;
    if(is_answer=='no')
    {
        $(':input:enabled:visible:first').focus();
    }

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ref,ev) {
        ev.dataTransfer.setData("answer", ev.target.getAttribute('data-answer'));
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();
    }

    function drop(ev,ref) {
        ev.preventDefault();
        var answer   = ev.dataTransfer.getData("answer");
        $(ref).removeClass('correct-ans');
        $(ref).removeClass('wrong-ans');
        
        if(answer == $(ref).data('answer'))
        {
            $(ref).removeClass('actual-ans');
            $(ref).addClass('correct-ans');
            $(ref).attr('disabled','true');
            $(ref).val(answer);
            checkFinalAnswer();
        }
        else
        {
            $(ref).removeClass('actual-ans');
            $(ref).addClass('wrong-ans');
            $('#wrong_answer_msg_box').show();
            insertWrongAttempts();
        }
    }

    /* Check If given answer is right or not and change classes */
    function checkAnswer(ref,event)
    {
        $(ref).removeClass('wrong-ans');
        $(ref).removeClass('correct-ans');
        $(ref).addClass('actual-ans');
        
        var key = event.keyCode || event.charCode;
        var given_answer = $(ref).val();
        var actual_answer = $(ref).data('answer');
        if(given_answer!='' && actual_answer!='')
        {
            given_answer = given_answer.toLowerCase();
            actual_answer = actual_answer.toLowerCase();
            if(given_answer==actual_answer)
            {
                $(ref).removeClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).addClass('correct-ans');
                $(ref).attr('disabled','true');
            }
            if( given_answer.length==maxlength && given_answer!=actual_answer)
            {
                $(ref).addClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).removeClass('correct-ans');
                
                if (((key > 64 && key < 91) || (key > 96 && key < 123)) && flag==0) {
                    insertWrongAttempts();
                    flag = 1;
                }
            }
            else
            {
                flag = 0;
            }
        }
        checkFinalAnswer();
    }
    /* Check If given answer is right or not and change classes ends here */    

    /* Check If given answer is right or not and change classes */
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
        $('.questionCls').each(function(){
                $(this).attr('placeholder',$(this).data('answer'));
        });
    }
    function timeisUp()
    {
        if(is_answer=="no")
        {
            $('.questionCls').each(function(){
                $(this).attr('placeholder',$(this).data('answer'));
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