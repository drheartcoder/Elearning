@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp 
@php
    $answer = $arr_question['answer'];
    $answer_text = isset($answer) && $answer!=0 ? $arr_question['option'.$answer] : 'N/A';

    /*if($arr_question['is_answer']=='yes'){*/
        $replace    = '</span><span class="input-txt-block" id="div1">'.$answer_text.'</span><span>';
    /*}
    else{
        $replace    = '</span><span class="input-txt-block" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></span><span>';
    }*/
    $question       = str_replace('#BLANK#',$replace,$arr_question['question_text']);
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    <!--middle section-->
    <div class="middle-section temp-9-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        <div class="game-img-section">                            
                            <div class="question-section-txt template-9-question template-9-question-answer" id="template-9-question">
                                <span>{!! $question !!} </span>
                            </div>
                            <div class="options-section-block">
                                <div class="option-one-block clsAnswer" id="1" data-option="{{ $arr_question['option1'] }}" draggable="true" style="cursor: pointer;">
                                    {{ $arr_question['option1'] }}
                                </div>
                                <div class="option-one-block clsAnswer" id="2" data-option="{{ $arr_question['option2'] }}" draggable="true" style="cursor: pointer;">
                                    {{ $arr_question['option2'] }}
                                </div>
                                <div class="clearfix"></div>
                                <div class="option-one-block clsAnswer" id="3" data-option="{{ $arr_question['option3'] }}" draggable="true" style="cursor: pointer;">
                                    {{ $arr_question['option3'] }}
                                </div>
                                <div class="option-one-block clsAnswer" id="4" data-option="{{ $arr_question['option4'] }}" draggable="true" style="cursor: pointer;">
                                    {{ $arr_question['option4'] }}
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
    if($(".game-img-section").height() != 'undefined')
    { $(".game-fill-text-section").css('height', $(".game-img-section").height());}

    
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