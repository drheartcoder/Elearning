@if(isset($arr_question) && count($arr_question)>0)
@php $uniqid = uniqid();  @endphp 
@php
    $str_options = $arr_question['answer1'].','.$arr_question['answer3'].','.$arr_question['answer2'].','.$arr_question['answer4'];
    $arr_options = options_array_shuffle($str_options);
@endphp
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />
    <!--middle section-->
    <div class="middle-section temp-11-main-section">
        <div class="container">
            <div class="fill-in-the-blank-section">
                <div class="question-section">
                    <div class="question-txt-section">
                        <i class="fa fa-angle-double-right"></i> {{isset($arr_question['question']) && $arr_question['question']!='' ? ucwords($arr_question['question']) : "N/A" }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row drawLineSection">
                    <div class="col-sm-3 col-mg-3 col-lg-3">                                                
                        <div class="game-img-section temp-4-letter-section-div">
                            @if(isset($arr_question['question_1_file']) && $arr_question['question_1_file']!='')
                                @php $result = get_image_public_path($arr_question['question_1_file'],'image');  @endphp
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_1" data-answer="{{isset($arr_question['answer1']) && $arr_question['answer1']!='' ? $arr_question['answer1'] : 'N/A' }}" class="checkQuestion"/>
                            @endif
                        </div>
                        <div class="img-name-txt-section checkAnswer" id="answer_1" data-answer="{{isset($arr_options[0]) && $arr_options[0]!='' ? $arr_options[0] : 'N/A' }}">{{isset($arr_options[0]) && $arr_options[0]!='' ? ucwords($arr_options[0]) : "N/A" }}</div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                        @if(isset($arr_question['question_2_file']) && $arr_question['question_2_file']!='')
                           @php $result = get_image_public_path($arr_question['question_2_file'],'image');  @endphp
                                <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_2" data-answer="{{isset($arr_question['answer2']) && $arr_question['answer2']!='' ? $arr_question['answer2'] : 'N/A' }}" class="checkQuestion"/>
                        @endif                            
                        </div>
                            <div class="img-name-txt-section checkAnswer" id="answer_2" data-answer="{{isset($arr_options[1]) && $arr_options[1]!='' ? $arr_options[1] : 'N/A' }}">{{isset($arr_options[1]) && $arr_options[1]!='' ? ucwords($arr_options[1]) : "N/A" }}</div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                           @if(isset($arr_question['question_3_file']) && $arr_question['question_3_file']!='')
                                @php $result = get_image_public_path($arr_question['question_3_file'],'image');  @endphp
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_3" data-answer="{{isset($arr_question['answer3']) && $arr_question['answer3']!='' ? $arr_question['answer3'] : 'N/A' }}" class="checkQuestion"/>
                            @endif
                        </div>
                            <div class="img-name-txt-section checkAnswer" id="answer_3" data-answer="{{isset($arr_options[2]) && $arr_options[2]!='' ? $arr_options[2] : 'N/A' }}">{{isset($arr_options[2]) && $arr_options[2]!='' ? ucwords($arr_options[2]) : "N/A" }}</div>
                    </div>
                    <div class="col-sm-3 col-mg-3 col-lg-3">
                        <div class="game-img-section temp-4-letter-section-div">
                            @if(isset($arr_question['question_4_file']) && $arr_question['question_4_file']!='')
                               @php $result = get_image_public_path($arr_question['question_4_file'],'image');  @endphp
                                    <img src="{{$result['image_url']}}" alt="tamplate 11" id="question_4" data-answer="{{isset($arr_question['answer4']) && $arr_question['answer4']!='' ? $arr_question['answer4'] : 'N/A' }}" class="checkQuestion"/>
                            @endif
                        </div>
                            <div class="img-name-txt-section checkAnswer" id="answer_4" data-answer="{{isset($arr_options[3]) && $arr_options[3]!='' ? $arr_options[3] : 'N/A' }}">{{isset($arr_options[3]) && $arr_options[3]!='' ? ucwords($arr_options[3]) : "N/A" }}</div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        
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
    <div class="clearfix"></div>
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
        function connect(div1, div2, color, thickness) { // draw a line connecting elements
            var off1 = getOffset(div1);
            var off2 = getOffset(div2);
            // bottom right
            var x1 = off1.left + off1.width/2;
            var y1 = off1.top + off1.height;
            // top right
            var x2 = off2.left + off2.width/2;
            var y2 = off2.top;
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

/*        setTimeout(function(){
            $('.checkAnswer').each(function(ans_index,ans_value){
                $('.checkQuestion').each(function(que_index,que_value){
                    if($(ans_value).data('answer').toLowerCase()==$(que_value).data('answer').toLowerCase())
                    {
                        div1 = document.getElementById($(que_value).attr('id'));
                        div2 = document.getElementById($(ans_value).attr('id'));
                        connect(div1, div2, "#7c848b", 2);
                    }   
                });
            });
        }, 1500);*/
</script>