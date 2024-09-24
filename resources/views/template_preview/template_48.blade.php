@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php $uniqid = uniqid();  @endphp 
@php
    $arr_word     = str_split($arr_question['question_1'], 1);
    $arr_position = str_split($arr_question['answer_position'], 1);
@endphp

<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

<!--middle section-->
<div class="middle-section temp-48-main-section">
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
                        <div class="temp-41-ques-text">{{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}</div>
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <ul class="main-ques-list">
                                        <li>
                                           <ul class="input-list">
                                                @foreach($arr_word as $word_key => $val)
                                                    @foreach($arr_position as $position_key => $position_val)
                                                        @if($word_key==$position_key)
                                                            
                                                            @if($position_val==1)
                                                                <li>{{$val}}</li>
                                                            @else
                                                                <input class="actual-ans" type="text" placeholder="{{$val}}" disabled="true" data-answer={{$val}} name="answer" maxlength="1">
                                                            @endif

                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>                                    
                                    </ul>                                   
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
</script>
@endif
