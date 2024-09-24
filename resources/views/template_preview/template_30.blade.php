@if(isset($arr_question) && count($arr_question)>0)
@php
      $uniqid = uniqid(); 
    $str_options = $arr_question['answer_1'].','.$arr_question['answer_3'].','.$arr_question['answer_2'].','.$arr_question['answer_4'].','.$arr_question['answer_5'];
    $arr_options = options_array_shuffle($str_options);
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp    
    <link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

    <!--middle section-->
    <div class="middle-section temp-30-main-section temp-28-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question'])." : " : "N/A" }} <br>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        <div class="game-img-section">                            
                            @if(isset($arr_question['question_1']) && $arr_question['question_1']!='')
                                <div class="question-section-txt">                                
                                    <div class="temp-30-question">1. {{ucwords($arr_question['question_1'])}}
                                        <span class="temp-30-input-section">
                                            <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" type="text" name="question1" data-answer="{{$arr_question['answer_1']}}" maxlength="1" disabled />
                                        </span>
                                    </div>
                                    <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}" id="a">A. {{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : "N/A" }}</div>
                                </div>
                            @endif
                            @if(isset($arr_question['question_2']) && $arr_question['question_2']!='')
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">2. {{ucwords($arr_question['question_2'])}}
                                    <span class="temp-30-input-section">
                                        <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" type="text" name="question2" data-answer="{{$arr_question['answer_2']}}" maxlength="1" disabled />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}" id="b">B. {{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : "N/A" }}</div>
                            </div>
                            @endif
                            @if(isset($arr_question['question_3']) && $arr_question['question_3']!='')
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">3. {{ucwords($arr_question['question_3'])}}
                                    <span class="temp-30-input-section">
                                        <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" type="text" name="question3" data-answer="{{$arr_question['answer_3']}}" maxlength="1" disabled />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}" id="c">C. {{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : "N/A" }}</div>
                            </div>
                            @endif
                            @if(isset($arr_question['question_4']) && $arr_question['question_4']!='')
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">4. {{ucwords($arr_question['question_4'])}}
                                    <span class="temp-30-input-section">
                                        <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" type="text" name="question4" data-answer="{{$arr_question['answer_4']}}" maxlength="1" disabled />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}" id="d">D. {{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : "N/A" }}</div>
                            </div>
                            @endif
                            @if(isset($arr_question['question_5']) && $arr_question['question_5']!='')
                            <div class="question-section-txt">                                
                                <div class="temp-30-question">5. {{ucwords($arr_question['question_5'])}}
                                    <span class="temp-30-input-section">
                                        <input class="actual-ans questionCls uppercase-style" style="text-align: center;" onkeyup="checkAnswer(this,event)" type="text" name="question5" data-answer="{{$arr_question['answer_5']}}" maxlength="1" disabled />
                                    </span>
                                </div>
                                <div class="temp-30-ans-section answerCls" data-answer="{{isset($arr_options[4]) && $arr_options[4]!='' ? $arr_options[4] : 'N/A' }}" id="e">E. {{isset($arr_options[4]) && $arr_options[4]!='' ? $arr_options[4] : "N/A" }}</div>
                            </div>
                            @endif
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
    <!--middle section end-->

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

    $('.questionCls').each(function(que_index,que_value){
        $('.answerCls').each(function(ans_index,ans_value){
            if($(ans_value).data('answer').toLowerCase() == $(que_value).data('answer').toLowerCase())
            {
                $(que_value).attr('placeholder',$(ans_value).attr('id'));
            }                    
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
