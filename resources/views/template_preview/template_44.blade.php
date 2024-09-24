@if(isset($arr_question) && count($arr_question)>0)
@php
    $arr_time = explode(':',$arr_question['duration']);
    $minutes  = $arr_time['1'];
    $seconds  = $arr_time['2'];
@endphp
@php
    $table_from = isset($arr_question['table_from']) && $arr_question['table_from']!='' ? $arr_question['table_from'] : 0 ;
    $table_to   = isset($arr_question['table_to']) && $arr_question['table_to']!='' ? $arr_question['table_to'] : 0 ;
@endphp
@php $uniqid = uniqid();  @endphp 
<link href="{{ url('/') }}/css/admin/template-css.css" rel="stylesheet" type="text/css" />

    <!--middle section-->
    <div class="middle-section temp-44-main-section temp-35-main-section">
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
                            <ul class="main-ques-list">
                                <li>
                                   <ul class="input-list">
                                        <li>{{isset($arr_question['digit1_1']) && $arr_question['digit1_1']!='' ? $arr_question['digit1_1'] : 0 }}</li>
                                        <li>{{isset($arr_question['operator1']) && $arr_question['operator1']!='' ? $arr_question['operator1'] : "N/A" }}</li>
                                        <li>{{isset($arr_question['digit1_2']) && $arr_question['digit1_2']!='' ? $arr_question['digit1_2'] : 0 }}</li>
                                        <li>=</li>
                                        <li>
                                            <input class="actual-ans table-nw" type="text" style="text-align: center;" placeholder="{{$arr_question['answer1']}}" disabled="true" data-answer="{{$arr_question['answer1']}}" name="question1" maxlength="{{strlen($arr_question['answer1'])}}">
                                        </li>
                                    </ul>
                                </li>                        
                            </ul>
                            <div class="table-section">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>X <div class="green-dot">&nbsp;</div></th>
                                            @if($table_to!=0 && $table_from!=0)
                                                @for($i=$table_from; $i <= $table_to; $i++)
                                                    <th>{{$i}}</th>
                                                @endfor
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($table_to!=0 && $table_from!=0)
                                            @for($row=$table_from; $row <= $table_to; $row++)
                                                <tr>
                                                    <td>{{$row}}</td>
                                                    @for($col=$table_from; $col <= $table_to; $col++)
                                                        @php
                                                        $rows_active = $blank_class = '';
                                                        if($row==$arr_question['digit1_1'] || $col==$arr_question['digit1_2'])
                                                        {
                                                            $rows_active = "active-box";
                                                        }
                                                        if($row==$arr_question['digit1_1'] && $col==$arr_question['digit1_2'])
                                                        {
                                                            $blank_class = "input-active-section";
                                                        }
                                                        @endphp
                                                        <td class="{{$rows_active}} {{$blank_class}}">
                                                            <span>{{$col * $row}}</span>
                                                            <input class="table-black-input" type="text" name="number-section" disabled="" placeholder="{{$arr_question['answer1']}}" />
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                        @endif
                                    </tbody>
                                </table>
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
    <!--middle section end-->
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/javascript" src="{{url('/')}}/js/MathJax-master/MathJax.js?config=TeX-AMS_HTML" ></script> 
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