@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
    
    $question1    = $question2 = $question3 = '';
    if(isset($arr_question['template43']['question_1']) && $arr_question['template43']['question_1']!=''){
      $str_options1 = $arr_question['template43']['answer_1'];
      $arr_options1 = explode(',',$str_options1);
      $question1    = $arr_question['template43']['question_1'];
    }
    if(isset($arr_question['template43']['question_2']) && $arr_question['template43']['question_2']!=''){
      $str_options2 = $arr_question['template43']['answer_2'];
      $arr_options2 = explode(',',$str_options2);
      $question2    = $arr_question['template43']['question_2'];
    }
    if(isset($arr_question['template43']['question_3']) && $arr_question['template43']['question_3']!=''){
      $str_options3 = $arr_question['template43']['answer_3'];
      $arr_options3 = explode(',',$str_options3);
      $question3    = $arr_question['template43']['question_3'];
    }
    $maxlength   = 0;
@endphp
@if(isset($arr_options1) && count($arr_options1)>0)
    @foreach($arr_options1 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
        @if($arr_question['is_answer']=='yes')
            @php
            $replace    = '<input class="correct-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />';
            @endphp
        @else
            @php
            $replace    = '<input class="actual-ans questionCls" type="text" style="text-align: center" name="question" maxlength="'.strlen($val).'" data-answer="'.strtolower($val).'" onkeyup="checkAnswer(this,event)" />';
            @endphp
        @endif
        @php
         $question1 = preg_replace('/#BLANK#/', $replace, $question1,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options2) && count($arr_options2)>0)
    @foreach($arr_options2 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
        @if($arr_question['is_answer']=='yes')
            @php
            $replace    = '<input class="correct-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />';
            @endphp
        @else
            @php
            $replace    = '<input class="actual-ans questionCls" type="text" style="text-align: center" name="question" maxlength="'.strlen($val).'" data-answer="'.strtolower($val).'" onkeyup="checkAnswer(this,event)" />';
            @endphp
        @endif
        @php
         $question2 = preg_replace('/#BLANK#/', $replace, $question2,1);
        @endphp
    @endforeach
@endif

@if(isset($arr_options3) && count($arr_options3)>0)
    @foreach($arr_options3 as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
        @if($arr_question['is_answer']=='yes')
            @php
            $replace    = '<input class="correct-ans" type="text" style="text-align: center" name="question" value="'.strtolower($val).'" disabled="true" />';
            @endphp
        @else
            @php
            $replace    = '<input class="actual-ans questionCls" type="text" style="text-align: center" name="question" maxlength="'.strlen($val).'" data-answer="'.strtolower($val).'" onkeyup="checkAnswer(this,event)" />';
            @endphp
        @endif
        @php
         $question3 = preg_replace('/#BLANK#/', $replace, $question3,1);
        @endphp
    @endforeach
@endif
<!--middle section-->
<div class="middle-section temp-43-main-section">
    <div class="container">
        <div class="fill-in-the-blank-section">
            <div class="question-section">
                <div class="question-txt-section">
                    <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template43']['question']) && $arr_question['template43']['question']!='' ? ucwords($arr_question['template43']['question']) : "N/A" }}
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
                        <div class="template-43-question-img">
                            @if(isset($arr_question['template43']['question_file']) && $arr_question['template43']['question_file']!='')
                                @php $result = get_image_public_path($arr_question['template43']['question_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate seven" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-mg-6 col-lg-6">
                    <div class="game-fill-text-section">
                        <div class="fill-txt-section">
                            @if(isset($arr_question['template43']['question_1']) && $arr_question['template43']['question_1']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question1 !!}
                                  </div>
                              </div>
                            @endif
                            @if(isset($arr_question['template43']['question_2']) && $arr_question['template43']['question_2']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question2 !!}
                                  </div>
                              </div>
                            @endif
                            @if(isset($arr_question['template43']['question_3']) && $arr_question['template43']['question_3']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="question-section-txt">                                
                                      {!! $question3 !!}
                                  </div>
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
                        <audio id="horn" src="{{$question_audio_public_path.$arr_question['template43']['horn']}}"></audio>
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
            $hours = $minutes = $seconds = 0;
        }
        else
        {
            $hours       = date('H',strtotime($arr_question['template43']['duration']));
            $minutes     = date('i',strtotime($arr_question['template43']['duration']));
            $seconds     = date('s',strtotime($arr_question['template43']['duration']));
        }
        $actual_time = $arr_question['template43']['duration'];
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
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/custom/template.js"></script>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    
    $(':input:enabled:visible:first').focus();

    /* Check If given answer is right or not and change classes */
    function checkAnswer(ref,event)
    {
        var maxlength = $(ref).attr('maxlength');

        $(ref).val($.trim($(ref).val()));
        if($(ref).val().length==1){
            $(ref).nextAll('input').first().focus();
            //$(ref).next().focus();
        }
        
        var key = event.keyCode || event.charCode;
        if( key == 8)
        {
            //$(ref).prev().focus();
            $(ref).prevAll('input').first().focus();
        }

        $(ref).removeClass('wrong-ans');
        $(ref).removeClass('correct-ans');
        $(ref).addClass('actual-ans');
        
        var given_answer  = $(ref).val();
        var actual_answer = $(ref).data('answer');
        if(given_answer!='')
        {
            given_answer = given_answer;
            actual_answer = actual_answer;
            if(given_answer==actual_answer && maxlength==given_answer.length)
            {
                $(ref).removeClass('wrong-ans');
                $(ref).removeClass('actual-ans');
                $(ref).addClass('correct-ans');
            }
            if(given_answer!=actual_answer && maxlength==given_answer.length)
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
    /* Check If given answer is right or not and change classes ends here */
    
    /* Check If all given answer is right or not and submit Question if right starts here */
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
    /* Check If all given answer is right or not and submit Question if right ends here */

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