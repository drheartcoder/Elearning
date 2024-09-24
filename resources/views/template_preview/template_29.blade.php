@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid(); 
    $correct_word_count = 0;
    $correct_word_count += calculate_word_count(strtolower($arr_question['question_1']),strtolower($arr_question['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['question_2']),strtolower($arr_question['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['question_3']),strtolower($arr_question['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['question_4']),strtolower($arr_question['answer']));
    $correct_word_count += calculate_word_count(strtolower($arr_question['question_5']),strtolower($arr_question['answer']));
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
    
    <link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    
    <!--middle section-->
    <div class="middle-section temp-29-main-section temp-28-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question'])." : " : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        <div class="game-img-section">                            
                            @if(isset($arr_question['question_1']) && $arr_question['question_1']!='')
                            <div class="question-section-txt">                                
                                <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                <span class="temp-29-ques-text-section">
                                    @php $arr_words = explode(' ', $arr_question['question_1']); @endphp
                                    @if(count($arr_words)>0 && count($arr_words)>0)
                                        @foreach($arr_words as $key => $val)
                                            @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['answer']))) === strtolower($arr_question['answer']))
                                                <span class="actual-answer-underline-section">{{$val}}</span>
                                            @else
                                                <span>{{$val}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            @endif
                            @if(isset($arr_question['question_2']) && $arr_question['question_2']!='')
                                <div class="question-section-txt">                                
                                    <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                    <span class="temp-29-ques-text-section">
                                        @php $arr_words = explode(' ', $arr_question['question_2']); @endphp
                                        @if(count($arr_words)>0 && count($arr_words)>0)
                                            @foreach($arr_words as $key => $val)
                                                @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['answer']))) === strtolower($arr_question['answer']))
                                                    <span class="actual-answer-underline-section">{{$val}}</span>
                                                @else
                                                    <span>{{$val}}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </div>
                            @endif
                            @if(isset($arr_question['question_3']) && $arr_question['question_3']!='')
                            <div class="question-section-txt">                                
                                <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                <span class="temp-29-ques-text-section">
                                    @php $arr_words = explode(' ', $arr_question['question_3']); @endphp
                                    @if(count($arr_words)>0 && count($arr_words)>0)
                                        @foreach($arr_words as $key => $val)
                                            @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['answer']))) === strtolower($arr_question['answer']))
                                                <span class="actual-answer-underline-section">{{$val}}</span>
                                            @else
                                                <span>{{$val}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            @endif
                            @if(isset($arr_question['question_4']) && $arr_question['question_4']!='')
                            <div class="question-section-txt">                                
                                <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                <span class="temp-29-ques-text-section">
                                    @php $arr_words = explode(' ', $arr_question['question_4']); @endphp
                                    @if(count($arr_words)>0 && count($arr_words)>0)
                                        @foreach($arr_words as $key => $val)
                                            @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['answer']))) === strtolower($arr_question['answer']))
                                                <span class="actual-answer-underline-section">{{$val}}</span>
                                            @else
                                                <span>{{$val}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            @endif
                            @if(isset($arr_question['question_5']) && $arr_question['question_5']!='')
                            <div class="question-section-txt">                                
                                <span class="temp-29-arrow-img-section"><img src="{{url('/')}}/images/temp-22-arrow-img.png" alt="arrow-img"> </span> 
                                <span class="temp-29-ques-text-section">
                                    @php $arr_words = explode(' ', $arr_question['question_5']); @endphp
                                    @if(count($arr_words)>0 && count($arr_words)>0)
                                        @foreach($arr_words as $key => $val)
                                            @if(substr(strtolower($val), 0, strlen(strtolower($arr_question['answer']))) === strtolower($arr_question['answer']))
                                                <span class="actual-answer-underline-section">{{$val}}</span>
                                            @else
                                                <span>{{$val}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
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