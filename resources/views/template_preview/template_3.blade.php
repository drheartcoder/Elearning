@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp 
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<!--middle section-->
<div class="middle-section">
    <div class="container">
        <div class="fill-in-the-blank-section template-3-main">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        @php
                        $arr_question1 = str_split($arr_question['question_1_text'], 1);
                        $arr_question2 = str_split($arr_question['question_2_text'], 1);
                        @endphp
                        <div class="game-img-section">
                            @if(isset($arr_question['question_1_file']) && $arr_question['question_1_file']!='')
                            @php $result = get_image_public_path($arr_question['question_1_file'],'image');  @endphp
                            <img src="{{$result['image_url']}}" alt="tamplate-two" />
                            @endif
                            <div class="image-name-section">
                                @if(isset($arr_question1) && count($arr_question1)>0)
                                    <div class="radio-btns">  
                                        @foreach($arr_question1 as $key1 => $val1)
                                            <div class="radio-btn">
                                                <input type="radio" id="{{$key1}}-option1" @if($arr_question['answer']==$val1) checked @endif value="{{$val1}}" name="question1" disabled="true">
                                                <label for="{{$key1}}-option1">{{$val1}}</label>
                                                <div class="circle-block"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="game-fill-text-section game-bird-section">
                            @if(isset($arr_question['question_2_file']) && $arr_question['question_2_file']!='')
                                @php $result = get_image_public_path($arr_question['question_2_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate-two" />
                            @endif
                            <div class="image-name-section">
                                @if(isset($arr_question2) && count($arr_question2)>0)
                                    <div class="radio-btns">  
                                        @foreach($arr_question2 as $key2 => $val2)
                                            <div class="radio-btn">
                                                <input type="radio" id="{{$key2}}-option2" @if($arr_question['answer']==$val2) checked @endif value="{{$val2}}" name="question2"  disabled="true">
                                                <label for="{{$key2}}-option2">{{$val2}}</label>
                                                <div class="circle-block"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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
                        <button>
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