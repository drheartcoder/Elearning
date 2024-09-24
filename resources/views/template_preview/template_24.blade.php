@if(isset($arr_question) && count($arr_question)>0)
@php
    $uniqid = uniqid(); 
    $str_options = $arr_question['answer_1'].','.$arr_question['answer_3'].','.$arr_question['answer_2'].','.$arr_question['answer_4'].','.$arr_question['answer_6'].','.$arr_question['answer_5'].','.$arr_question['answer_8'].','.$arr_question['answer_7'];
    $arr_options = options_array_shuffle($str_options);
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp    
    <link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

    <!--middle section-->
    <div class="middle-section temp-24-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row drawLineSection">
                    <div class="col-sm-12 col-mg-12 col-lg-12">                        
                        <div class="game-img-section">
                            <div class="row">
                                <div class="col-sm-6 col-mg-6 col-lg-6">
                                    @if(isset($arr_question['question_1']) && $arr_question['question_1']!='')
                                        <div class="ques-ans-block-section he-would checkQuestion" id="question_1" data-answer="{{isset($arr_question['answer_1']) && $arr_question['answer_1']!='' ? $arr_question['answer_1'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_1']) && $arr_question['question_1']!='' ? ucwords($arr_question['question_1']) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_question['question_2']) && $arr_question['question_2']!='')
                                        <div class="ques-ans-block-section i-will checkQuestion" id="question_2" data-answer="{{isset($arr_question['answer_2']) && $arr_question['answer_2']!='' ? $arr_question['answer_2'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_2']) && $arr_question['question_2']!='' ? ucwords($arr_question['question_2']) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_question['question_3']) && $arr_question['question_3']!='')
                                        <div class="ques-ans-block-section did-not checkQuestion" id="question_3" data-answer="{{isset($arr_question['answer_3']) && $arr_question['answer_3']!='' ? $arr_question['answer_3'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_3']) && $arr_question['question_3']!='' ? ucwords($arr_question['question_3']) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_question['question_4']) && $arr_question['question_4']!='')
                                        <div class="ques-ans-block-section have-class checkQuestion" id="question_4" data-answer="{{isset($arr_question['answer_4']) && $arr_question['answer_4']!='' ? $arr_question['answer_4'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_4']) && $arr_question['question_4']!='' ? ucwords($arr_question['question_4']) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_question['question_5']) && $arr_question['question_5']!='')
                                        <div class="ques-ans-block-section not-class checkQuestion" id="question_5" data-answer="{{isset($arr_question['answer_5']) && $arr_question['answer_5']!='' ? $arr_question['answer_5'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_5']) && $arr_question['question_5']!='' ? ucwords($arr_question['question_5']) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_question['question_6']) && $arr_question['question_6']!='')
                                        <div class="ques-ans-block-section she-is checkQuestion" id="question_6" data-answer="{{isset($arr_question['answer_6']) && $arr_question['answer_6']!='' ? $arr_question['answer_6'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_6']) && $arr_question['question_6']!='' ? ucwords($arr_question['question_6']) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_question['question_7']) && $arr_question['question_7']!='')
                                        <div class="ques-ans-block-section they-are checkQuestion" id="question_7" data-answer="{{isset($arr_question['answer_7']) && $arr_question['answer_7']!='' ? $arr_question['answer_7'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_7']) && $arr_question['question_7']!='' ? ucwords($arr_question['question_7']) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_question['question_8']) && $arr_question['question_8']!='')
                                        <div class="ques-ans-block-section you-have checkQuestion" id="question_8" data-answer="{{isset($arr_question['answer_8']) && $arr_question['answer_8']!='' ? $arr_question['answer_8'] : 'N/A' }}" style="cursor: pointer;" onclick="checkQuestion(this)">{{isset($arr_question['question_8']) && $arr_question['question_8']!='' ? ucwords($arr_question['question_8']) : "N/A" }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-6 col-mg-6 col-lg-6">
                                    @if(isset($arr_options[0]) && $arr_options[0]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_1" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[0]) && $arr_options[0]!='' ? ucwords($arr_options[0]) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_options[1]) && $arr_options[1]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_2" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[1]) && $arr_options[1]!='' ? ucwords($arr_options[1]) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_options[2]) && $arr_options[2]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_3" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[2]) && $arr_options[2]!='' ? ucwords($arr_options[2]) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_options[3]) && $arr_options[3]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_4" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[3]) && $arr_options[3]!='' ? ucwords($arr_options[3]) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_options[4]) && $arr_options[4]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_5" data-answer="{{isset($arr_options[4]) && $arr_options[4]!='' ? $arr_options[4] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[4]) && $arr_options[4]!='' ? ucwords($arr_options[4]) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_options[5]) && $arr_options[5]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_6" data-answer="{{isset($arr_options[5]) && $arr_options[5]!='' ? $arr_options[5] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[5]) && $arr_options[5]!='' ? ucwords($arr_options[5]) : "N/A" }}</div>
                                    @endif

                                    @if(isset($arr_options[6]) && $arr_options[6]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_7" data-answer="{{isset($arr_options[6]) && $arr_options[6]!='' ? $arr_options[6] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[6]) && $arr_options[6]!='' ? ucwords($arr_options[6]) : "N/A" }}</div>
                                    @endif
                                    
                                    @if(isset($arr_options[7]) && $arr_options[7]!='')
                                        <div class="ques-ans-block-section temp-24-ans-section checkAnswer" id="answer_8" data-answer="{{isset($arr_options[7]) && $arr_options[7]!='' ? $arr_options[7] : 'N/A' }}" style="cursor: pointer;" onclick="checkAnswer(this)">{{isset($arr_options[7]) && $arr_options[7]!='' ? ucwords($arr_options[7]) : "N/A" }}</div>
                                    @endif
                                </div>

                            </div>
                        </div>                        
                    </div>                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row mySection">
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
<script type="text/javascript">
    $('#answer_not_recorded_msg_box').hide();

    function getOffset( el ) { // return element top, left, width, height
        var _x = 0;
        var _y = 0;
        var _w = el.offsetWidth|0;
        var _h = el.offsetHeight|0;
        while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
            _x += el.offsetLeft - el.scrollLeft;
            _y += el.offsetTop - el.scrollTop;
            el = el.offsetParent;
        }
        return { top: _y, left: _x, width: _w, height: _h };
    }

    function connect(div1, div2, color, thickness) { // draw a line connecting elements
        var off1 = getOffset(div1);
        var off2 = getOffset(div2);
        // bottom right
        var x1 = off1.left + off1.width;
        var y1 = off1.top + off1.height - off1.height/2;
        // top right
        var x2 = off2.left;
        var y2 = off2.top + off2.height -  off2.height/2;
        // distance
        var length = Math.sqrt(((x2-x1) * (x2-x1)) + ((y2-y1) * (y2-y1)));
        // center
        var cx = ((x1 + x2) / 2) - (length / 2);
        var cy = ((y1 + y2) / 2) - (thickness / 2);
        // angle
        var angle = Math.atan2((y1-y2),(x1-x2))*(180/Math.PI);
        // make hr
        var htmlLine = "<div style='padding:0px; margin:0px; height:" + thickness + "px; background-color:" + color + "; line-height:1px; position:absolute; left:" + cx + "px; top:" + cy + "px; width:" + length + "px; -moz-transform:rotate(" + angle + "deg); -webkit-transform:rotate(" + angle + "deg); -o-transform:rotate(" + angle + "deg); -ms-transform:rotate(" + angle + "deg); transform:rotate(" + angle + "deg);' />";
        document.getElementsByClassName('drawLineSection')[0].innerHTML += htmlLine;
    }

</script>