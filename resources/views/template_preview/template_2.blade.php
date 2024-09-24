@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid();
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
<!--middle section-->
<div class="middle-section">
    <div class="container">
        <div class="fill-in-the-blank-section">
            <div class="question-section">
                <div class="question-txt-section ques-block">
                    <i class="fa fa-angle-double-right"></i> <span>{{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}</span>
                </div>
                {{-- <div class="question-count">
                    Question: <span>{{$current_question}}/{{$total_question_count}}</span>
                </div> --}}
                <div class="clearfix"></div>

            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                   {{--  @if($current_question>1)
                        <div class="arrow-prev-section-block" onclick="previousQuestion()">
                            <a href="javascript:void(0);" class="arrow-prev-img">
                                <img class="arrow-img" src="{{url('/')}}/images/template/question-back-arrow-img.png" alt="">
                                <img class="arrow-over-img" src="{{url('/')}}/images/template/question-back-arrow-over-img.png" alt="">
                            </a>
                        </div>
                    @endif --}}
                    <div class="game-img-section  img-height-width-set">
                        @if(isset($arr_question['file']) && $arr_question['file']!="")
                        @php
                        $result = []; 
                        $result = get_image_public_path($arr_question['file'],$arr_question['file_type']);  @endphp
                        @endif
                        
                        @if(isset($arr_question['file_type']) && $arr_question['file_type']=='image')
                            <img src="{{$result['image_url'] or ''}}" alt="tamplate-one" />
                        @else
                            @if(isset($result['status']) && $result['status']=='success')
                                <video src="{{$result['image_url'] or ''}}" alt="tamplate-one" controls="true"></video>
                            @else
                                <img src="{{$result['image_url'] or ''}}" alt="tamplate-one" />
                            @endif
                        @endif
                    </div>
                </div>
                @php
                    $arr_word     = str_split($arr_question['question_text'], 1);
                    $arr_position = str_split($arr_question['answer_position'], 1);
                @endphp
                <div class="col-md-6 col-lg-6">
                    <div class="game-fill-text-section">
                        <div class="fill-txt-section">
                            <div class="alphabate-input" style="width: 100%;">
                                @foreach($arr_word as $word_key => $val)
                                    @foreach($arr_position as $position_key => $position_val)
                                        @if($word_key==$position_key)
                                                @if($position_val==1)
                                                    <span style="width: 6%">{{$val}}</span>
                                                @else
                                                    <input class="actual-ans questionCls" onkeyup="checkAnswer(this,event)" value="" data-answer={{$val}} type="text" placeholder="{{$val}}" name="image name" style="width: 9%" maxlength="1" disabled="" />
                                                @endif
                                        @endif
                                    @endforeach
                                @endforeach
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
                    <button >
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