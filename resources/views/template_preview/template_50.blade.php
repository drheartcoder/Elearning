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
        <div class="fill-in-the-blank-section temp-41-main-section temp-49-main-section temp-50-main-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-mg-12 col-lg-12">
                        <div class="game-img-section">
                            <div class="clock-question">How much time has passed between clock A and clock B?</div>
                             <div class="clock-section">
                                 <div class="clock-block">
                                     <div class="clock-circle"><div id="clock"></div></div>
                                     <div class="clock-time">
                                         <h5>{{isset($arr_question['question_1']) ? date('h:i',strtotime($arr_question['question_1'])) : 0}}</h5>
                                         <p>Clock A</p>
                                     </div>
                                 </div>
                                 <div class="clock-block">
                                     <div class="clock-circle"><div id="clock2"></div></div>
                                     <div class="clock-time">
                                         <h5>{{isset($arr_question['question_2']) ? date('h:i',strtotime($arr_question['question_2'])) : 0}}</h5>
                                         <p>Clock B</p>
                                     </div>
                                 </div>
                             </div>       
                             <div class="radio-btns clock-options">  
                                   @if(isset($arr_question['option_1']) && $arr_question['option_1']!='' )
                                    <div class="radio-btn">
                                        <input type="radio" id="f-option" name="template50_checkbox" value="1" disabled="true" @if($arr_question['answer']==1) checked="true" @endif>
                                        <label for="f-option">
                                            {!! isset($arr_question['option_1']) && $arr_question['option_1']!='' ? ucwords($arr_question['option_1']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                    @if(isset($arr_question['option_2']) && $arr_question['option_2']!='' )
                                    <div class="radio-btn">
                                        <input type="radio" id="s-option" name="template50_checkbox" value="2" disabled="true" @if($arr_question['answer']==2) checked="true" @endif>
                                        <label for="s-option">
                                            {!! isset($arr_question['option_2']) && $arr_question['option_2']!='' ? ucwords($arr_question['option_2']) : "N/A" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                    @if(isset($arr_question['option_3']) && $arr_question['option_3']!='' )
                                    <div class="radio-btn">
                                        <input type="radio" id="t-option" name="template50_checkbox" value="3" disabled="true" @if($arr_question['answer']==3) checked="true" @endif>
                                        <label for="t-option">
                                            {!! isset($arr_question['option_3']) && $arr_question['option_3']!='' ? ucwords($arr_question['option_3']) : "" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                     @endif
                                     @if(isset($arr_question['option_4']) && $arr_question['option_4']!='' )
                                    <div class="radio-btn">
                                        <input type="radio" id="ft-option" name="template50_checkbox" value="4" disabled="true" @if($arr_question['answer']==4) checked="true" @endif>
                                        <label for="ft-option">
                                            {!! isset($arr_question['option_4']) && $arr_question['option_4']!='' ? ucwords($arr_question['option_4']) : "" !!}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                    @endif
                                    <div class="clearfix"></div>
                             </div>
                        </div>
                    </div>                    
                </div>                                
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="specker-mic-section" style="display: none">
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
    @php
        $c1_minutes  = isset($arr_question['question_1']) ? date('i',strtotime($arr_question['question_1'])) : 0;
        $c2_minutes  = isset($arr_question['question_2']) ? date('i',strtotime($arr_question['question_2'])) : 0;
        $c1_hours    = isset($arr_question['question_1']) ? date('h',strtotime($arr_question['question_1'])) : 0;
        $c2_hours    = isset($arr_question['question_2']) ? date('h',strtotime($arr_question['question_2'])) : 0;
    @endphp
@endif

<script type="text/javascript" src="{{url('/')}}/js/front/analogClock.js"></script>
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

    var  c1_hours   = "{{$c1_hours}}";
    var  c1_minutes = "{{$c1_minutes}}";
    var  c2_hours   = "{{$c2_hours}}";
    var  c2_minutes = "{{$c2_minutes}}";

    AnalogClock("clock",{ width: 110 , bgColor: "#fff", c_minutes:c1_minutes, c_hours:c1_hours});
    AnalogClock("clock2",{ width: 110 , bgColor: "#fff", c_minutes:c2_minutes, c_hours:c2_hours});
    var clock = new AnalogClock("clock", opt);
    var clock2 = new AnalogClock("clock2", opt);
    clock.panel.style.border = "solid 5px red";    
    clock2.panel.style.border = "solid 5px red";    
</script>

<script type="text/javascript">
    
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