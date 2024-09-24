@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
    <!--middle section-->
    <div class="middle-section temp-36-main-section temp-42-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template42']['question']) && $arr_question['template42']['question']!='' ? ucwords($arr_question['template42']['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="question-count">
                        Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @php
                  $arr_answer1 = $arr_answer2 = $arr_answer3 = $arr_answer4 = $arr_answer5 = $arr_answer6 = [];
                  if(isset($arr_question['template42']['answer1']) && $arr_question['template42']['answer1']!=''){
                    $arr_answer1 = explode(',',$arr_question['template42']['answer1']);
                  }
                  if(isset($arr_question['template42']['answer2']) && $arr_question['template42']['answer2']!=''){
                    $arr_answer2 = explode(',',$arr_question['template42']['answer2']);
                  }
                  if(isset($arr_question['template42']['answer3']) && $arr_question['template42']['answer3']!=''){
                    $arr_answer3 = explode(',',$arr_question['template42']['answer3']);
                  }
                  if(isset($arr_question['template42']['answer4']) && $arr_question['template42']['answer4']!=''){
                    $arr_answer4 = explode(',',$arr_question['template42']['answer4']);
                  }
                  if(isset($arr_question['template42']['answer5']) && $arr_question['template42']['answer5']!=''){
                    $arr_answer5 = explode(',',$arr_question['template42']['answer5']);
                  }
                  if(isset($arr_question['template42']['answer6']) && $arr_question['template42']['answer6']!=''){
                    $arr_answer6 = explode(',',$arr_question['template42']['answer6']);
                  }
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
                            @if(isset($arr_question['template42']['question1']) && $arr_question['template42']['question1']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="equa-num">                                    
                                      <b>{!!isset($arr_question['template42']['question1']) && $arr_question['template42']['question1']!='' ? $arr_question['template42']['question1'] : "N/A" !!}</b>
                                  </div>
                                  <div class="equa-sign">=</div>        
                                  <div class="equa-num temp-42-input-section">
                                      <div class="div-num">
                                        @if(count($arr_answer1)>0)
                                          @foreach($arr_answer1 as $key => $val)
                                            <span>
                                              @if($arr_question['is_answer']=='yes')
                                                <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question1" maxlength="{{strlen($val)}}">
                                              @else
                                                <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question1" maxlength="{{strlen($val)}}" />
                                              @endif
                                            </span>
                                            @endforeach
                                        @endif
                                      </div>
                                  </div>                                
                              </div>
                            @endif
                            @if(isset($arr_question['template42']['question3']) && $arr_question['template42']['question3']!='')
                              <div class="division-wrapper equation-block">
                                  <div class="equa-num">                                    
                                      <b>{!!isset($arr_question['template42']['question3']) && $arr_question['template42']['question3']!='' ? $arr_question['template42']['question3'] : "N/A" !!}</b>
                                  </div>
                                  <div class="equa-sign">=</div>        
                                  <div class="equa-num temp-42-input-section">
                                      <div class="div-num">
                                        @if(count($arr_answer3)>0)
                                          @foreach($arr_answer3 as $key => $val)
                                            <span>
                                              @if($arr_question['is_answer']=='yes')
                                                <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question3" maxlength="{{strlen($val)}}">
                                              @else
                                                <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question3" maxlength="{{strlen($val)}}" />
                                              @endif
                                            </span>
                                            @endforeach
                                        @endif
                                      </div>
                                  </div>                                
                              </div>
                            @endif
                            @if(isset($arr_question['template42']['question5']) && $arr_question['template42']['question5']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['template42']['question5']) && $arr_question['template42']['question5']!='' ? $arr_question['template42']['question5'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer5)>0)
                                              @foreach($arr_answer5 as $key => $val)
                                                <span>
                                                  @if($arr_question['is_answer']=='yes')
                                                    <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question5" maxlength="{{strlen($val)}}">
                                                  @else
                                                    <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question5" maxlength="{{strlen($val)}}" />
                                                  @endif
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">
                                @if(isset($arr_question['template42']['question2']) && $arr_question['template42']['question2']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['template42']['question2']) && $arr_question['template42']['question2']!='' ? $arr_question['template42']['question2'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer2)>0)
                                              @foreach($arr_answer2 as $key => $val)
                                                <span>
                                                  @if($arr_question['is_answer']=='yes')
                                                    <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question2" maxlength="{{strlen($val)}}">
                                                  @else
                                                    <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question2" maxlength="{{strlen($val)}}" />
                                                  @endif
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                                 @endif                                
                                 @if(isset($arr_question['template42']['question4']) && $arr_question['template42']['question4']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['template42']['question4']) && $arr_question['template42']['question4']!='' ? $arr_question['template42']['question4'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer4)>0)
                                              @foreach($arr_answer4 as $key => $val)
                                                <span>
                                                  @if($arr_question['is_answer']=='yes')
                                                    <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question4" maxlength="{{strlen($val)}}">
                                                  @else
                                                    <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question4" maxlength="{{strlen($val)}}" />
                                                  @endif
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
                                      </div>                                
                                  </div>
                                @endif
                                @if(isset($arr_question['template42']['question6']) && $arr_question['template42']['question6']!='')
                                  <div class="division-wrapper equation-block">
                                      <div class="equa-num">                                    
                                          <b>{!!isset($arr_question['template42']['question6']) && $arr_question['template42']['question6']!='' ? $arr_question['template42']['question6'] : "N/A" !!}</b>
                                      </div>
                                      <div class="equa-sign">=</div>        
                                      <div class="equa-num temp-42-input-section">
                                          <div class="div-num">
                                            @if(count($arr_answer6)>0)
                                              @foreach($arr_answer6 as $key => $val)
                                                <span>
                                                  @if($arr_question['is_answer']=='yes')
                                                    <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$val}}" disabled="true" data-answer="{{$val}}" name="question6" maxlength="{{strlen($val)}}">
                                                  @else
                                                    <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$val}}" type="text" name="question6" maxlength="{{strlen($val)}}" />
                                                  @endif
                                                </span>
                                                @endforeach
                                            @endif
                                          </div>
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
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template42']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template42']['duration']));
            $minutes     = date('i',strtotime($arr_question['template42']['duration']));
            $seconds     = date('s',strtotime($arr_question['template42']['duration']));
        }
        $actual_time = $arr_question['template42']['duration'];
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
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script> 

<script type="text/javascript">
    
    $(':input:enabled:visible:first').focus();
    
    function checkAnswer(ref,event)
    {
        var maxlength = $(ref).attr('maxlength');
        $(ref).val($.trim($(ref).val()));
        if($(ref).val().length==1){
            $(ref).nextAll('input').first().focus();
        }
        var key = event.keyCode || event.charCode;
        if( key == 8)
        {
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
    if(is_answer=='no' && is_delay=='yes')
    {
        $('.questionCls').each(function(){
              $(this).attr('placeholder',$(this).data('answer'));
        });
    }
    function timeisUp()
    {
        if(is_answer=='no')
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
</script>