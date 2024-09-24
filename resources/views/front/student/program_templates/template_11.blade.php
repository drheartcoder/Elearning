@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    $str_options = $arr_question['template11']['answer1'].','.$arr_question['template11']['answer3'].','.$arr_question['template11']['answer2'].','.$arr_question['template11']['answer4'];
    $arr_options = options_array_shuffle($str_options);
@endphp
    <!--middle section-->
    <div class="middle-section temp-11-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template11']['question']) && $arr_question['template11']['question']!='' ? ucwords($arr_question['template11']['question']) : "N/A" }}
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row drawLineSection">
                    <div class="col-sm-3 col-mg-3 col-lg-3">                                                
                        <div class="game-img-section temp-4-letter-section-div">
                            @if($current_question>1)
                            <div class="arrow-prev-section-block" onclick="previousQuestion()">
                                <a href="javascript:void(0);" class="arrow-prev-img">
                                    <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                    <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                                </a>
                            </div>
                            @endif
                            @if(isset($arr_question['template11']['question_1_file']) && $arr_question['template11']['question_1_file']!='')
                                @php $result = get_image_public_path($arr_question['template11']['question_1_file'],'image');  @endphp
                                @if($arr_question['is_answer']=="no")
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_1" data-answer="{{isset($arr_question['template11']['answer1']) && $arr_question['template11']['answer1']!='' ? $arr_question['template11']['answer1'] : 'N/A' }}" style="cursor: pointer;" class="checkQuestion" onclick="checkQuestion(this)"/>
                                @else
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_1" data-answer="{{isset($arr_question['template11']['answer1']) && $arr_question['template11']['answer1']!='' ? $arr_question['template11']['answer1'] : 'N/A' }}" class="checkQuestion"/>
                                @endif
                            @endif
                        </div>
                        @if($arr_question['is_answer']=="no")
                        <div class="img-name-txt-section checkAnswer" id="answer_1" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[0]) && $arr_options[0]!='' ? ucwords($arr_options[0]) : "N/A" }}</div>
                        @else
                        <div class="img-name-txt-section checkAnswer" id="answer_1" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}">{{isset($arr_options[0]) && $arr_options[0]!='' ? ucwords($arr_options[0]) : "N/A" }}</div>
                        @endif
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                        @if(isset($arr_question['template11']['question_2_file']) && $arr_question['template11']['question_2_file']!='')
                           @php $result = get_image_public_path($arr_question['template11']['question_2_file'],'image');  @endphp
                           @if($arr_question['is_answer']=="no")
                                <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_2" data-answer="{{isset($arr_question['template11']['answer2']) && $arr_question['template11']['answer2']!='' ? $arr_question['template11']['answer2'] : 'N/A' }}" style="cursor: pointer;" class="checkQuestion" onclick="checkQuestion(this)"/>
                            @else
                                <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_2" data-answer="{{isset($arr_question['template11']['answer2']) && $arr_question['template11']['answer2']!='' ? $arr_question['template11']['answer2'] : 'N/A' }}" class="checkQuestion"/>
                            @endif                            
                        @endif                            
                        </div>
                        @if($arr_question['is_answer']=="no")
                            <div class="img-name-txt-section checkAnswer" id="answer_2" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[1]) && $arr_options[1]!='' ? ucwords($arr_options[1]) : "N/A" }}</div>
                        @else
                            <div class="img-name-txt-section checkAnswer" id="answer_2" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}">{{isset($arr_options[1]) && $arr_options[1]!='' ? ucwords($arr_options[1]) : "N/A" }}</div>
                        @endif
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                           @if(isset($arr_question['template11']['question_3_file']) && $arr_question['template11']['question_3_file']!='')
                                @php $result = get_image_public_path($arr_question['template11']['question_3_file'],'image');  @endphp
                                @if($arr_question['is_answer']=="no")
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_3" data-answer="{{isset($arr_question['template11']['answer1']) && $arr_question['template11']['answer3']!='' ? $arr_question['template11']['answer3'] : 'N/A' }}" style="cursor: pointer;" class="checkQuestion" onclick="checkQuestion(this)"/>
                                @else
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_3" data-answer="{{isset($arr_question['template11']['answer3']) && $arr_question['template11']['answer3']!='' ? $arr_question['template11']['answer3'] : 'N/A' }}" class="checkQuestion"/>
                                @endif
                            @endif
                        </div>
                        @if($arr_question['is_answer']=="no")
                            <div class="img-name-txt-section checkAnswer" id="answer_3" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[2]) && $arr_options[2]!='' ? ucwords($arr_options[2]) : "N/A" }}</div>
                        @else
                            <div class="img-name-txt-section checkAnswer" id="answer_3" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}">{{isset($arr_options[2]) && $arr_options[2]!='' ? ucwords($arr_options[2]) : "N/A" }}</div>
                        @endif
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                            @if(isset($arr_question['template11']['question_4_file']) && $arr_question['template11']['question_4_file']!='')
                               @php $result = get_image_public_path($arr_question['template11']['question_4_file'],'image');  @endphp
                               @if($arr_question['is_answer']=="no")
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_4" data-answer="{{isset($arr_question['template11']['answer4']) && $arr_question['template11']['answer4']!='' ? $arr_question['template11']['answer4'] : 'N/A' }}" style="cursor: pointer;" class="checkQuestion" onclick="checkQuestion(this)"/>
                                @else
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_4" data-answer="{{isset($arr_question['template11']['answer4']) && $arr_question['template11']['answer4']!='' ? $arr_question['template11']['answer4'] : 'N/A' }}" class="checkQuestion"/>
                                @endif                            
                            @endif
                            @if($current_question<$total_question_count)
                            <div class="arrow-next-section-block" @if($arr_question['is_answer']=='yes') onclick="nextQuestion('manual')" @endif> 
                                <a href="javascript:void(0);" class="arrow-next-img">
                                    <img class="arrow-img" src="{{url('/')}}/images/template/question-next-arrow-img.png" alt="" />
                                    <img class="arrow-over-img" src="{{url('/')}}/images/template/question-next-arrow-over-img.png" alt="" />
                                </a>
                            </div>
                            @endif
                        </div>
                        @if($arr_question['is_answer']=="no")
                            <div class="img-name-txt-section checkAnswer" id="answer_4" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[3]) && $arr_options[3]!='' ? ucwords($arr_options[3]) : "N/A" }}</div>
                        @else
                            <div class="img-name-txt-section checkAnswer" id="answer_4" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}">{{isset($arr_options[3]) && $arr_options[3]!='' ? ucwords($arr_options[3]) : "N/A" }}</div>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row mySection">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="specker-mic-section" style="display: none">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template11']['horn']}}"></audio>
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
    <!--middle section end-->
    
    @php
        if($arr_question['is_answer']=='yes' || $arr_question['is_delay']=='yes')
        {
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template11']['duration']));
            $minutes     = date('i',strtotime($arr_question['template11']['duration']));
            $seconds     = date('s',strtotime($arr_question['template11']['duration']));
        }
        $actual_time = $arr_question['template11']['duration'];
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
    if(is_answer=='no')
    {
        $('input[type=radio]').attr('checked', false);
    }
    var isQuestion = 0;
    var isAnswer = 0;
    
    function checkQuestion(ref)
    {
        $(".image-highlight-section").removeClass("image-highlight-section");
        $(ref).parent().addClass('image-highlight-section');
        $(".isQuestion").removeClass("isQuestion");
        isQuestion = 1;
        $(ref).addClass('isQuestion');
        checkCurrentAnswer();
    }

    function checkAnswer(ref)
    {
        $(".text-highlight-section").removeClass("text-highlight-section");
        $(ref).addClass('text-highlight-section');
        $(".isAnswer").removeClass("isAnswer");
        isAnswer = 1;
        $(ref).addClass('isAnswer');
        checkCurrentAnswer();
    }

    function getOffset( el ) { // return element top, left, width, height
        var _x = 0;
        var _y = 0;
        var _w = el.offsetWidth|0;
        var _h = el.offsetHeight|0;
        while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
            _x += el.offsetLeft - el.scrollLeft;
            _y += el.offsetTop - el.scrollTop;
            el = el.offsetParent;
        }
        return { top: _y, left: _x, width: _w, height: _h };
    }

    function connect(div1, div2, color, thickness) { // draw a line connecting elements
        var off1 = getOffset(div1);
        var off2 = getOffset(div2);
        // bottom right
        var x1 = off1.left + off1.width/2;
        var y1 = off1.top + off1.height;
        // top right
        var x2 = off2.left + off2.width/2;
        var y2 = off2.top;
        // distance
        var length = Math.sqrt(((x2-x1) * (x2-x1)) + ((y2-y1) * (y2-y1)));
        // center
        var cx = ((x1 + x2) / 2) - (length / 2);
        var cy = ((y1 + y2) / 2) - (thickness / 2);
        // angle
        var angle = Math.atan2((y1-y2),(x1-x2))*(180/Math.PI);
        // make hr
        var htmlLine = "<div style='padding:0px; margin:0px; height:" + thickness + "px; background-color:" + color + "; line-height:1px; position:absolute; left:" + cx + "px; top:" + cy + "px; width:" + length + "px; -moz-transform:rotate(" + angle + "deg); -webkit-transform:rotate(" + angle + "deg); -o-transform:rotate(" + angle + "deg); -ms-transform:rotate(" + angle + "deg); transform:rotate(" + angle + "deg);' />";
        document.getElementsByClassName('drawLineSection')[0].innerHTML += htmlLine;
    }

    /* Check If given answer is right or not and change classes */
    function checkCurrentAnswer()
    {
        var isAudioRequired = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();

        if(isQuestion==1 && isAnswer==1)
        {
            $('#answer_not_recorded_msg_box').hide();
            question = $(".isQuestion").data('answer').toLowerCase();
            answer   = $(".isAnswer").data('answer').toLowerCase();
            div_1    = $(".isQuestion").attr('id');
            div_2    = $(".isAnswer").attr('id');
            if(question==answer)
            {
                $(".text-highlight-section").removeClass("text-highlight-section");
                $(".image-highlight-section").removeClass("image-highlight-section");
                var div1 = document.getElementById(div_1);
                var div2 = document.getElementById(div_2)
                $(div2).addClass('correct-ans');
                connect(div1, div2, "#008000", 2);
                isQuestion = isAnswer = 0;
                checkFinalAnswer();
            }
            else if(question!=answer)
            {
                $('#wrong_answer_msg_box').show();
                insertWrongAttempts();
            }
        }
    }

    function checkFinalAnswer()
    {
        var isAudioRequired    = $('#recordButton').data('id');
        $('#wrong_answer_msg_box').hide();
        $('#right_answer_msg_box').hide();
        $('#answer_not_recorded_msg_box').hide();

        if($('.correct-ans').length == $('.checkAnswer').length)
        {
            $('#wrong_answer_msg_box').hide();
        }

        if($('.correct-ans').length == $('.checkAnswer').length)
        {
            //$('.checkAnswer').attr('disabled',true);
            $(".checkAnswer").prop("onclick", null).off("click");
            $(".checkQuestion").prop("onclick", null).off("click");
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

    $(document).ready(function(){
        if(is_answer=='yes')
        {
            $('.checkAnswer').each(function(ans_index,ans_value){
                $('.checkQuestion').each(function(que_index,que_value){
                    if($(ans_value).data('answer').toLowerCase()==$(que_value).data('answer').toLowerCase())
                    {
                        div1 = document.getElementById($(que_value).attr('id'));
                        div2 = document.getElementById($(ans_value).attr('id'));
                        $(div2).addClass('correct-ans');
                        connect(div1, div2, "#008000", 2);
                    }   
                });
            });
        }
    });

    /*if(is_answer=='no' && is_delay=='yes')
    {
        $('.checkAnswer').each(function(ans_index,ans_value){
            $('.checkQuestion').each(function(que_index,que_value){
                if($(ans_value).data('answer').toLowerCase()==$(que_value).data('answer').toLowerCase())
                {
                    div1 = document.getElementById($(que_value).attr('id'));
                    div2 = document.getElementById($(ans_value).attr('id'));
                    connect(div1, div2, "#7c848b", 2);
                }   
            });
        });
    }*/
    function timeisUp()
    {
        if(is_answer=='no')
        {
            $('.checkAnswer').each(function(ans_index,ans_value){
                $('.checkQuestion').each(function(que_index,que_value){
                    if($(ans_value).data('answer').toLowerCase()==$(que_value).data('answer').toLowerCase())
                    {
                        div1 = document.getElementById($(que_value).attr('id'));
                        div2 = document.getElementById($(ans_value).attr('id'));
                        connect(div1, div2, "#7c848b", 2);
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