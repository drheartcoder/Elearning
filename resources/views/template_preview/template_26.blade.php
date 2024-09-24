@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp 
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

<!--middle section-->
<div class="middle-section temp-26-main-section">
    <div class="container">
        <div class="fill-in-the-blank-section template-26-main">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        <div class="game-img-section">                            
                            <div class="question-section-txt">                                
                                <div class="temp-26-question-section">
                                    <span class="ques-text-section">1. {{isset($arr_question['question_1_text']) && $arr_question['question_1_text']!='' ? ucwords($arr_question['question_1_text']) : "N/A" }}</span>
                                    <div class="radio-btns">  
                                        
                                        <div class="radio-btn question1 @if($arr_question['question_1_answer']==1) time-over-answer-section  @endif">
                                            <input type="radio" id="f-option1" onclick="checkFinalAnswer(this)" value="1" name="question1" disabled>
                                            <label for="f-option1">{{ucwords($arr_question['question_1_option1'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question1 @if($arr_question['question_1_answer']==2) time-over-answer-section  @endif">
                                            <input type="radio" id="s-option1" onclick="checkFinalAnswer(this)" value="2" name="question1" disabled>
                                            <label for="s-option1">{{ucwords($arr_question['question_1_option2'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question1 @if($arr_question['question_1_answer']==3) time-over-answer-section  @endif">
                                            <input type="radio" id="t-option1" onclick="checkFinalAnswer(this)" value="3" name="question1" disabled>
                                            <label for="t-option1">{{ucwords($arr_question['question_1_option3'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="temp-26-question-section">
                                    <span class="ques-text-section">2. {{isset($arr_question['question_2_text']) && $arr_question['question_2_text']!='' ? ucwords($arr_question['question_2_text']) : "N/A" }}</span>
                                    <div class="radio-btns">  
                                        
                                        <div class="radio-btn question2 @if($arr_question['question_2_answer']==1) time-over-answer-section  @endif">
                                            <input type="radio" id="f-option2" onclick="checkFinalAnswer(this)" value="1" name="question2" disabled>
                                            <label for="f-option2">{{ucwords($arr_question['question_2_option1'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question2 @if($arr_question['question_2_answer']==2) time-over-answer-section  @endif">
                                            <input type="radio" id="s-option2" onclick="checkFinalAnswer(this)" value="2" name="question2" disabled>
                                            <label for="s-option2">{{ucwords($arr_question['question_2_option2'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question2 @if($arr_question['question_2_answer']==3) time-over-answer-section  @endif">
                                            <input type="radio" id="t-option2" onclick="checkFinalAnswer(this)" value="3" name="question2" disabled>
                                            <label for="t-option2">{{ucwords($arr_question['question_2_option3'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="temp-26-question-section">
                                    <span class="ques-text-section">3. {{isset($arr_question['question_3_text']) && $arr_question['question_3_text']!='' ? ucwords($arr_question['question_3_text']) : "N/A" }}</span>
                                    <div class="radio-btns">  
                                        
                                        <div class="radio-btn question3 @if($arr_question['question_3_answer']==1) time-over-answer-section  @endif">
                                            <input type="radio" id="f-option3" onclick="checkFinalAnswer(this)" value="1" name="question3" disabled>
                                            <label for="f-option3">{{ucwords($arr_question['question_3_option1'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question3 @if($arr_question['question_3_answer']==2) time-over-answer-section  @endif">
                                            <input type="radio" id="s-option3" onclick="checkFinalAnswer(this)" value="2" name="question3" disabled>
                                            <label for="s-option3">{{ucwords($arr_question['question_3_option2'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="radio-btn question3 @if($arr_question['question_3_answer']==3) time-over-answer-section  @endif">
                                            <input type="radio" id="t-option3" onclick="checkFinalAnswer(this)" value="3" name="question3" disabled>
                                            <label for="t-option3">{{ucwords($arr_question['question_3_option3'])}}</label>
                                            <div class="circle-block"></div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>                    
                </div>                             
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="specker-mic-section">
                        <button onclick="togglePlay()" id="hornButton">
                            <img src="{{url('/')}}/images/template/specker-icon-img.png" alt="speaker-icon" />
                            <audio id="horn" src="{{$question_audio_public_path.$arr_question['horn']}}"></audio>
                        </button>
                        <button data-id="no">
                            <img src="{{url('/')}}/images/template/mic-icon-img.png" alt="mic-icon" />
                            <img class="red-ring" src="{{url('/')}}/images/recording-ring.png" alt="mic-icon" />
                        </button>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-6">
                    <div class="timer-section">
                        <div class="time-head-section">
                            <span>Min</span>
                            <span>Sec</span>
                        </div>
                        <div class="hm-timer-section">
                            <span id="hm_timer_{{$uniqid}}"></span>
                        </div>
                    </div>                     
                </div>
            </div>
            <span id="flashcontent"></span>               
    </div>
</div>

@endif

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/jquery.countdownTimer.css" />
<script type="text/javascript">
    $(function(){
        var t_minutes = '{{$minutes}}';
        var t_seconds = '{{$seconds}}';
        var uniqid    = '{{$uniqid}}';
        /*hours           = parseInt(hours);*/
        t_minutes       = parseInt(t_minutes);
        t_seconds       = parseInt(t_seconds);
        var script_url = SITE_URL+"/js/front/custom/jquery.countdownTimer.js";
        $.getScript( script_url, function() {
            $('#hm_timer_'+uniqid).countdowntimer({
                method       : "init",
                minutes      : t_minutes,
                seconds      : t_seconds,
                displayFormat: "MS",
                tickInterval : 0,
                size         : "md"
            });
        });
    });
    
    var isPlaying = false;
    function playHorn()
    {
        var horn      = document.getElementById("horn");
        var isPlaying = false;
        $('#hornButton').addClass('stop-playing');
        horn.play();
    }

    horn.onended = function() {
      $('#hornButton').removeClass('stop-pause');
      $('#hornButton').removeClass('stop-playing');
    };

    horn.onplaying = function() {
      isPlaying = true;
      $('#hornButton').removeClass('stop-pause');
      $('#hornButton').addClass('stop-playing');
    };
    horn.onpause = function() {
      isPlaying = false;
      $('#hornButton').removeClass('stop-playing');
      $('#hornButton').addClass('stop-pause');
    };
    
    function togglePlay() {
      if (isPlaying) {
        horn.pause();
      } else {
        horn.play();
      }
    };

    /* height calculate script */    

</script>
