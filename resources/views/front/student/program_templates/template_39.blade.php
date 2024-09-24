@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
    <!--middle section-->
    <div class="middle-section temp-36-main-section temp-39-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['template39']['question']) && $arr_question['template39']['question']!='' ? ucwords($arr_question['template39']['question'])." : " : "N/A" }} <br>
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
                           @if(isset($arr_question['template39']['digit1_1']) && $arr_question['template39']['digit1_1']!='')
                           <div class="division-wrapper">
                               <div class="division-block">
                                   <div class="division-num">
                                       <b>{{isset($arr_question['template39']['digit1_1']) && $arr_question['template39']['digit1_1']!='' ? $arr_question['template39']['digit1_1'] : 0 }}</b>
                                       <b>
                                          @if($arr_question['template39']['operator1'] && $arr_question['template39']['operator1']!='')
                                                @if($arr_question['template39']['operator1'] != '/')
                                                  {{$arr_question['template39']['operator1']}}
                                                @else
                                                  &#247;
                                                @endif
                                          @endif
                                          {{isset($arr_question['template39']['digit1_2']) && $arr_question['template39']['digit1_2']!='' ? $arr_question['template39']['digit1_2'] : 0 }}</b>
                                   </div>
                                    @if($arr_question['is_answer']=='yes')
                                        <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer1']}}" disabled="true" data-answer="{{$arr_question['template39']['answer1']}}" name="question1" maxlength="{{strlen($arr_question['template39']['answer1'])}}">
                                    @else
                                        <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer1']}}" type="text" name="question1" maxlength="{{strlen($arr_question['template39']['answer1'])}}" />
                                    @endif
                               </div>
                           </div>
                           @endif
                         
                           @if(isset($arr_question['template39']['digit3_1']) && $arr_question['template39']['digit3_1']!='')
                           <div class="division-wrapper">
                               <div class="division-block">
                                   <div class="division-num">
                                       <b>{{isset($arr_question['template39']['digit3_1']) && $arr_question['template39']['digit3_1']!='' ? $arr_question['template39']['digit3_1'] : 0 }}</b>
                                       <b>
                                        @if($arr_question['template39']['operator3'] && $arr_question['template39']['operator3']!='')
                                                @if($arr_question['template39']['operator3'] != '/')
                                                  {{$arr_question['template39']['operator3']}}
                                                @else
                                                  &#247;
                                                @endif
                                          @endif
                                        {{isset($arr_question['template39']['digit3_2']) && $arr_question['template39']['digit3_2']!='' ? $arr_question['template39']['digit3_2'] : 0 }}</b>
                                   </div>
                                    @if($arr_question['is_answer']=='yes')
                                        <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer3']}}" disabled="true" data-answer="{{$arr_question['template39']['answer3']}}" name="question3" maxlength="{{strlen($arr_question['template39']['answer3'])}}">
                                    @else
                                        <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer3']}}" type="text" name="question3" maxlength="{{strlen($arr_question['template39']['answer3'])}}" />
                                    @endif
                               </div>
                           </div>
                           @endif

                           @if(isset($arr_question['template39']['digit5_1']) && $arr_question['template39']['digit5_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['template39']['digit5_1']) && $arr_question['template39']['digit5_1']!='' ? $arr_question['template39']['digit5_1'] : 0 }}</b>
                                             <b>
                                              @if($arr_question['template39']['operator5'] && $arr_question['template39']['operator5']!='')
                                                @if($arr_question['template39']['operator5'] != '/')
                                                  {{$arr_question['template39']['operator5']}}
                                                @else
                                                  &#247;
                                                @endif
                                              @endif
                                             {{isset($arr_question['template39']['digit5_2']) && $arr_question['template39']['digit5_2']!='' ? $arr_question['template39']['digit5_2'] : 0 }}</b>
                                         </div>
                                          @if($arr_question['is_answer']=='yes')
                                              <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer5']}}" disabled="true" data-answer="{{$arr_question['template39']['answer5']}}" name="question5" maxlength="{{strlen($arr_question['template39']['answer5'])}}">
                                          @else
                                              <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer5']}}" type="text" name="question5" maxlength="{{strlen($arr_question['template39']['answer5'])}}" />
                                          @endif
                                     </div>
                                 </div>
                               @endif


                        </div>
                    </div>
                    <div class="col-sm-6 col-mg-6 col-lg-6">
                        <div class="game-fill-text-section">
                            <div class="fill-txt-section">

                           @if(isset($arr_question['template39']['digit2_1']) && $arr_question['template39']['digit2_1']!='')
                           <div class="division-wrapper">
                               <div class="division-block">
                                   <div class="division-num">
                                       <b>{{isset($arr_question['template39']['digit2_1']) && $arr_question['template39']['digit2_1']!='' ? $arr_question['template39']['digit2_1'] : 0 }}</b>
                                       <b>
                                        @if($arr_question['template39']['operator2'] && $arr_question['template39']['operator2']!='')
                                                @if($arr_question['template39']['operator2'] != '/')
                                                  {{$arr_question['template39']['operator2']}}
                                                @else
                                                  &#247;
                                                @endif
                                          @endif
                                        {{isset($arr_question['template39']['digit2_2']) && $arr_question['template39']['digit2_2']!='' ? $arr_question['template39']['digit2_2'] : 0 }}</b>
                                   </div>
                                    @if($arr_question['is_answer']=='yes')
                                        <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer2']}}" disabled="true" data-answer="{{$arr_question['template39']['answer2']}}" name="question2" maxlength="{{strlen($arr_question['template39']['answer2'])}}">
                                    @else
                                        <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer2']}}" type="text" name="question2" maxlength="{{strlen($arr_question['template39']['answer2'])}}" />
                                    @endif
                               </div>
                           </div>
                           @endif

                                @if(isset($arr_question['template39']['digit4_1']) && $arr_question['template39']['digit4_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['template39']['digit4_1']) && $arr_question['template39']['digit4_1']!='' ? $arr_question['template39']['digit4_1'] : 0 }}</b>
                                             <b>
                                              @if($arr_question['template39']['operator4'] && $arr_question['template39']['operator4']!='')
                                                @if($arr_question['template39']['operator4'] != '/')
                                                  {{$arr_question['template39']['operator4']}}
                                                @else
                                                  &#247;
                                                @endif
                                              @endif
                                              {{isset($arr_question['template39']['digit4_2']) && $arr_question['template39']['digit4_2']!='' ? $arr_question['template39']['digit4_2'] : 0 }}</b>
                                         </div>
                                          @if($arr_question['is_answer']=='yes')
                                              <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer4']}}" disabled="true" data-answer="{{$arr_question['template39']['answer4']}}" name="question4" maxlength="{{strlen($arr_question['template39']['answer4'])}}">
                                          @else
                                              <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer4']}}" type="text" name="question4" maxlength="{{strlen($arr_question['template39']['answer4'])}}" />
                                          @endif
                                     </div>
                                 </div>
                               @endif

                        
                               
                               @if(isset($arr_question['template39']['digit6_1']) && $arr_question['template39']['digit6_1']!='')
                                 <div class="division-wrapper">
                                     <div class="division-block">
                                         <div class="division-num">
                                             <b>{{isset($arr_question['template39']['digit6_1']) && $arr_question['template39']['digit6_1']!='' ? $arr_question['template39']['digit6_1'] : 0 }}</b>
                                             <b>
                                              @if($arr_question['template39']['operator6'] && $arr_question['template39']['operator6']!='')
                                                @if($arr_question['template39']['operator6'] != '/')
                                                  {{$arr_question['template39']['operator6']}}
                                                @else
                                                  &#247;
                                                @endif
                                              @endif
                                              {{isset($arr_question['template39']['digit6_2']) && $arr_question['template39']['digit6_2']!='' ? $arr_question['template39']['digit6_2'] : 0 }}</b>
                                         </div>
                                          @if($arr_question['is_answer']=='yes')
                                              <input class="input-number correct-ans" type="text" style="text-align: center;" value="{{$arr_question['template39']['answer6']}}" disabled="true" data-answer="{{$arr_question['template39']['answer6']}}" name="question6" maxlength="{{strlen($arr_question['template39']['answer6'])}}">
                                          @else
                                              <input class="input-number actual-ans questionCls" style="text-align: center;" onkeyup="checkAnswer(this,event)" value="" data-answer="{{$arr_question['template39']['answer6']}}" type="text" name="question6" maxlength="{{strlen($arr_question['template39']['answer6'])}}" />
                                          @endif
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
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['template39']['horn']}}"></audio>
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
            $hours       = date('H',strtotime($arr_question['template39']['duration']));
            $minutes     = date('i',strtotime($arr_question['template39']['duration']));
            $seconds     = date('s',strtotime($arr_question['template39']['duration']));
        }
        $actual_time = $arr_question['template39']['duration'];
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
    /* When Timer is Over ends here */

</script>