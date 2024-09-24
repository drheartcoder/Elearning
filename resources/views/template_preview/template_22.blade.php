@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp
@php
    $str_options = $arr_question['answer_1'].','.$arr_question['answer_2'];
    $arr_options = options_array_shuffle($str_options);
    $maxlength   = 0;
@endphp
@if(isset($arr_options) && count($arr_options)>0)
    @foreach($arr_options as $key => $val)
        @php
            if($maxlength < strlen($val))
            {
                $maxlength = strlen($val);
            }
        @endphp
    @endforeach
@endif
@php
    $answer_text1 = isset($arr_question['answer_1']) && $arr_question['answer_1']!='' ? $arr_question['answer_1'] : 'N/A';
    $answer_text2 = isset($arr_question['answer_2']) && $arr_question['answer_2']!='' ? $arr_question['answer_2'] : 'N/A';

    $replace1    = '<input class="actual-ans" type="text" name="question1" placeholder="'.$answer_text1.'" disabled="true" />';
    $replace2    = '<input class="actual-ans" type="text" name="question2" placeholder="'.$answer_text2.'" disabled="true" />';

    $question1       = str_replace('#BLANK#',$replace1,$arr_question['question_1']);
    $question2       = str_replace('#BLANK#',$replace2,$arr_question['question_2']);
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
    <link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    
    <!--middle section-->
    <div class="middle-section temp-22-main-section">
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
                            <div class="question-section-txt">
                                <span class="temp-22-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img" /> </span> 
                                <span class="temp-22-ques-text-section">{!! $question1 !!}</span>
                            </div>
                            <div class="question-section-txt">
                                <span class="temp-22-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img" /> </span> 
                                <span class="temp-22-ques-text-section">{!! $question2 !!}</span>
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
